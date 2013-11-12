<?php
/**
* @version      2.9.4 16.04.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
include_once(JPATH_COMPONENT_SITE."/payments/payment.php");

class JshoppingControllerPayments extends JController{

    function __construct( $config = array() ){
        parent::__construct( $config );

        $this->registerTask( 'add',   'edit' );
        $this->registerTask( 'apply', 'save' );
        checkAccessController("payments");
        addSubmenu("other");        
    }
	
	function display() {
		$payments = &$this->getModel("payments");
		$rows = $payments->getAllPaymentMethods(0);

		$view=&$this->getView("payments_list", 'html');
		$view->assign('rows', $rows);
        $view->display();
	}
	
	function edit() {
        $jshopConfig = &JSFactory::getConfig();
		$payment_id = JRequest::getInt("payment_id");
		$db = &JFactory::getDBO();
		$payment = &JTable::getInstance('paymentMethod', 'jshop');
		$payment->load($payment_id);
		$parseString = new parseString($payment->payment_params);
		$params = $parseString->parseStringToParams();
		$edit = ($payment_id)?($edit = 1):($edit = 0);
        $_lang = &$this->getModel("languages");
        $languages = $_lang->getAllLanguages(1);
        $multilang = count($languages)>1;
		
		$_payments = &$this->getModel("payments");
		$payment_type = $_payments->getTypes();

		foreach ($payment_type as $key => $value) {
			$payms[] = JHTML::_('select.option', $key,$value,'payment_type','payment_type_name');
		}
		if ($edit) {
            if (file_exists(JPATH_SITE . "/components/com_jshopping/payments/" . $payment->payment_class."/".$payment->payment_class. ".php")){
			    require_once (JPATH_SITE . "/components/com_jshopping/payments/" . $payment->payment_class."/".$payment->payment_class. ".php");
                ob_start();
			    call_user_func(array($payment->payment_class,'showAdminFormParams'), $params);
                $lists['html'] = ob_get_contents();
                ob_get_clean();
            }else{
                $lists['html'] = '';
            }
		} else {
			$lists['html'] = '';
		}
		$lists['type_payment'] = JHTML::_('select.genericlist', $payms,'payment_type','class = "inputbox" size ="1"','payment_type','payment_type_name',$payment->payment_type);
        
        $currencyCode = getMainCurrencyCode();
        
        $_tax = &$this->getModel("taxes");
        $all_taxes = $_tax->getAllTaxes();
        $list_tax = array();        
        foreach ($all_taxes as $tax) {
            $list_tax[] = JHTML::_('select.option', $tax->tax_id, $tax->tax_name . ' (' . $tax->tax_value . '%)','tax_id','tax_name');
        }
        if (count($all_taxes)==0) $withouttax = 1; else $withouttax = 0;
        $lists['tax'] = JHTML::_('select.genericlist', $list_tax, 'tax_id', 'class = "inputbox"','tax_id','tax_name', $payment->tax_id);
        
        $list_price_type = array();
        $list_price_type[] = JHTML::_('select.option', "1", $currencyCode, 'id','name');
        $list_price_type[] = JHTML::_('select.option', "2", "%", 'id','name');
        $lists['price_type'] = JHTML::_('select.genericlist', $list_price_type, 'price_type', 'class = "inputbox"', 'id', 'name', $payment->price_type);
        
        $nofilter = array();
        JFilterOutput::objectHTMLSafe( $payment, ENT_QUOTES, $nofilter);
        
		$view=&$this->getView("payments_edit", 'html');
		$view->assign('payment', $payment);
		$view->assign('edit', $edit);
		$view->assign('params', $params);
		$view->assign('lists', $lists);
        $view->assign('languages', $languages);
        $view->assign('multilang', $multilang);
        $view->assign('withouttax', $withouttax);
        $view->display();
	}	
	
	function save() {
		$payment_id = JRequest::getInt("payment_id");
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();        
		$db = &JFactory::getDBO();
		$payment = &JTable::getInstance('paymentMethod', 'jshop');
        $post = JRequest::get("post");
        if (!isset($post['payment_publish'])) $post['payment_publish'] = 0;
        if (!isset($post['show_descr_in_email'])) $post['show_descr_in_email'] = 0;
        $post['price'] = saveAsPrice($post['price']);
        
        $dispatcher->trigger( 'onBeforeSavePayment', array(&$post) );
        
        $_lang = &$this->getModel("languages");
        $languages = $_lang->getAllLanguages(1);
        foreach($languages as $lang){            
            $post['description_'.$lang->language] = JRequest::getVar('description'.$lang->id,'','post',"string",2);
        }
        
		if (!$payment->bind($post)) {
			JError::raiseWarning("",_JSHOP_ERROR_BIND);
			$this->setRedirect("index.php?option=com_jshopping&controller=payments");
			return 0;
		}
        
        $_payments = &$this->getModel("payments");
        if (!$payment->payment_id){
            $payment->payment_ordering = $_payments->getMaxOrdering() + 1;
        }
        
		if (isset($post['pm_params'])) {
			$parseString = new parseString($post['pm_params']);
			$payment->payment_params = $parseString->splitParamsToString();
		}
		
		if (!$payment->store()) {
			JError::raiseWarning("",_JSHOP_ERROR_SAVE_DATABASE." ".$payment->getError());
			$this->setRedirect("index.php?option=com_jshopping&controller=payments");
			return 0;
		}
        
        $dispatcher->trigger( 'onAfterSavePayment', array(&$payment) );
		
        if ($this->getTask()=='apply'){
            $this->setRedirect("index.php?option=com_jshopping&controller=payments&task=edit&payment_id=".$payment->payment_id); 
        }else{
            $this->setRedirect("index.php?option=com_jshopping&controller=payments");
        }
	
	}
	
	function remove(){
		$cid = JRequest::getVar("cid");
		$db = &JFactory::getDBO();
		$text = '';
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeRemovePayment', array(&$cid) );
		foreach ($cid as $key => $value) {
			$query = "DELETE FROM `#__jshopping_payment_method`
					  WHERE `payment_id` = '" . $db->getEscaped($value) . "'";
			$db->setQuery($query);
			if ($db->query())
				$text .= _JSHOP_PAYMENT_DELETED."<br>";
			else
				$text .= _JSHOP_ERROR_PAYMENT_DELETED."<br>";
		}
        
        $dispatcher->trigger( 'onAfterRemovePayment', array(&$cid) );

		$this->setRedirect("index.php?option=com_jshopping&controller=payments", $text);
	}
	
	function publish(){
        $this->publishPayment(1);
    }
    
    function unpublish(){
        $this->publishPayment(0);
    }
	
	function publishPayment($flag) {
		$db = &JFactory::getDBO();
		$cid = JRequest::getVar("cid");
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforePublishPayment', array(&$cid, &$flag) );
		foreach($cid as $key => $value) {
			$query = "UPDATE `#__jshopping_payment_method`
					   SET `payment_publish` = '" . $db->getEscaped($flag) . "'
					   WHERE `payment_id` = '" . $db->getEscaped($value) . "'";
			$db->setQuery($query);
			$db->query();
		}
        
        $dispatcher->trigger( 'onAfterPublishPayment', array(&$cid, &$flag) );
		
		$this->setRedirect("index.php?option=com_jshopping&controller=payments");
	}
	
	function order() {
		$order = JRequest::getVar("order");
		$cid = JRequest::getInt("id");
		$number = JRequest::getInt("number");
		$db = &JFactory::getDBO();
		switch ($order) {
			case 'up':
				$query = "SELECT a.payment_id, a.payment_ordering
					   FROM `#__jshopping_payment_method` AS a
					   WHERE a.payment_ordering < '" . $number . "'
					   ORDER BY a.payment_ordering DESC
					   LIMIT 1";
				break;
			case 'down':
				$query = "SELECT a.payment_id, a.payment_ordering
					   FROM `#__jshopping_payment_method` AS a
					   WHERE a.payment_ordering > '" . $number . "'
					   ORDER BY a.payment_ordering ASC
					   LIMIT 1";
		}
		$db->setQuery($query);
		$row = $db->loadObject();
		$query1 = "UPDATE `#__jshopping_payment_method` AS a
					 SET a.payment_ordering = '" . $row->payment_ordering . "'
					 WHERE a.payment_id = '" . $cid . "'";
		$query2 = "UPDATE `#__jshopping_payment_method` AS a
					 SET a.payment_ordering = '" . $number . "'
					 WHERE a.payment_id = '" . $row->payment_id . "'";
		$db->setQuery($query1);
		$db->query();
		$db->setQuery($query2);
		$db->query();
	
		$this->setRedirect("index.php?option=com_jshopping&controller=payments");
	}
	   
}
?>		