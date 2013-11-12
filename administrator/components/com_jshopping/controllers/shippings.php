<?php
/**
* @version      2.9.4 25.11.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerShippings extends JController{

    function __construct( $config = array() ){
        parent::__construct( $config );

        $this->registerTask( 'add',   'edit' );
        $this->registerTask( 'apply', 'save' );
        checkAccessController("shippings");
        addSubmenu("other");
    }
    
    function display() {
		$db = &JFactory::getDBO();
		$shippings = &$this->getModel("shippings");
		$rows = $shippings->getAllShippings(0);
        
        $not_set_price = 0;
        $rowsprices = $shippings->getAllShippingPrices(0);        
        $shippings_prices = array();
        foreach($rowsprices as $row){
            $shippings_prices[$row->shipping_method_id][] = $row;
        }
        foreach($rows as $k=>$v){
            if (is_array($shippings_prices[$v->shipping_id])){
                $rows[$k]->count_shipping_price = count($shippings_prices[$v->shipping_id]);
            }else{
                $not_set_price = 1;
                $rows[$k]->count_shipping_price = 0;
            }
        }
        
        if ($not_set_price){
            JError::raiseNotice("", _JSHOP_CERTAIN_METHODS_DELIVERY_NOT_SET_PRICE);
        }
		
		$view=&$this->getView("shippings_list", 'html');
		$view->assign('rows', $rows);
		$view->display(); 
	}
	
	function edit() {
		$shipping_id = JRequest::getInt("shipping_id");
		$shipping = &JTable::getInstance('shippingMethod', 'jshop');
		$shipping->load($shipping_id);
		$edit = ($shipping_id)?($edit = 1):($edit = 0);
        $_lang = &$this->getModel("languages");
        $languages = $_lang->getAllLanguages(1);
        $multilang = count($languages)>1;

        $nofilter = array();
        JFilterOutput::objectHTMLSafe( $shipping, ENT_QUOTES, $nofilter);
        
		$view=&$this->getView("shippings_edit", 'html');        
		$view->assign('shipping', $shipping);
		$view->assign('edit', $edit);
        $view->assign('languages', $languages);
        $view->assign('multilang', $multilang);
		$view->display();
	}
	
	function save() {
		$shipping_id = JRequest::getInt("shipping_id", 0);
		$shipping = &JTable::getInstance('shippingMethod', 'jshop');
        if (!isset($_POST['shipping_publish'])) $_POST['shipping_publish'] = 0;
        $post = JRequest::get("post");
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeSaveShipping', array(&$post) );

        
        $_lang = &$this->getModel("languages");
        $languages = $_lang->getAllLanguages(1);
        foreach($languages as $lang){            
            $post['description_'.$lang->language] = JRequest::getVar('description'.$lang->id,'','post',"string",2);
        }
		if(!$shipping->bind($post)) {
			JError::raiseWarning("",_JSHOP_ERROR_BIND);
			$this->setRedirect("index.php?option=com_jshopping&controller=shippings");
			return 0;
		}
        
        $_shippings = &$this->getModel("shippings");
        if (!$shipping->shipping_id){
            $shipping->shipping_ordering = $_shippings->getMaxOrdering() + 1;
        }	
	
		if (!$shipping->store()) {
			JError::raiseWarning("",_JSHOP_ERROR_SAVE_DATABASE);
			$this->setRedirect("index.php?option=com_jshopping&controller=shippings");
			return 0;
		}
        
        $dispatcher->trigger( 'onAfterSaveShipping', array(&$shipping) );
        
		if ($this->getTask()=='apply'){
            $this->setRedirect("index.php?option=com_jshopping&controller=shippings&task=edit&shipping_id=".$shipping->shipping_id); 
        }else{
            $this->setRedirect("index.php?option=com_jshopping&controller=shippings");
        }

	}
	
	function remove() {
		$cid = JRequest::getVar("cid");
		$db = &JFactory::getDBO();
		$text = array();
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeRemoveShipping', array(&$cid) );

        
		foreach ($cid as $key => $value) {
			$query = "DELETE FROM `#__jshopping_shipping_method`
					  WHERE `shipping_id` = '" . $db->getEscaped($value) . "'";
			$db->setQuery($query);
			if($db->query()) {
				$text[] = _JSHOP_SHIPPING_DELETED;
				
				$query = "SELECT `sh_pr_method_id`
						  FROM `#__jshopping_shipping_method_price`
						  WHERE `shipping_method_id` = '" . $db->getEscaped($value) . "'";
				$db->setQuery($query);
				$sh_pr_ids = $db->loadObjectList();
				
				if (count($sh_pr_ids)){
					foreach ($sh_pr_ids as $key2=>$value2){
						$query = "DELETE FROM `#__jshopping_shipping_method_price_weight`
								  WHERE `sh_pr_method_id` = '" . $db->getEscaped($value2). "'";
						$db->setQuery($query);
						$db->query();
					}
				}
				
				$query = "DELETE FROM `#__jshopping_shipping_method_price`
						  WHERE `shipping_method_id` = '" . $db->getEscaped($value). "'";
				$db->setQuery($query);
				$db->query();
                					
			} else {
				$text[] = _JSHOP_ERROR_SHIPPING_DELETED;
			}
		}
        
        $dispatcher->trigger( 'onAfterRemoveShipping', array(&$cid) );
		
		$this->setRedirect("index.php?option=com_jshopping&controller=shippings", implode("</li><li>", $text) );
	}
	
	function publish(){
        $this->publishShipping(1);
    }
    
    function unpublish(){
        $this->publishShipping(0);
    }
	
	function publishShipping($flag) {
		$cid = JRequest::getVar("cid");
		$db = &JFactory::getDBO();
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforePublishShipping', array(&$cid,&$flag) );

		foreach($cid as $key => $value) {
			$query = "UPDATE `#__jshopping_shipping_method`
					   SET `shipping_publish` = '" . $db->getEscaped($flag) . "'
					   WHERE `shipping_id` = '" . $db->getEscaped($value) . "'";
			$db->setQuery($query);
			$db->query();
		}

        $dispatcher->trigger('onAfterPublishShipping', array(&$cid,&$flag) );
        
		$this->setRedirect("index.php?option=com_jshopping&controller=shippings");
	}
	
	function order() {
		$order = JRequest::getVar("order");
		$cid = JRequest::getInt("id");
		$number = JRequest::getInt("number");
		$db = &JFactory::getDBO();
		switch ($order) {
			case 'up':
				$query = "SELECT a.shipping_id, a.shipping_ordering FROM `#__jshopping_shipping_method` AS a
					   WHERE a.shipping_ordering < '" . $number . "'
					   ORDER BY a.shipping_ordering DESC
					   LIMIT 1";
				break;
			case 'down':
				$query = "SELECT a.shipping_id, a.shipping_ordering FROM `#__jshopping_shipping_method` AS a
					   WHERE a.shipping_ordering > '" . $number . "'
					   ORDER BY a.shipping_ordering ASC
					   LIMIT 1";
		}
		$db->setQuery($query);
		$row = $db->loadObject();

		$query1 = "UPDATE `#__jshopping_shipping_method` AS a
					 SET a.shipping_ordering = '" . $row->shipping_ordering . "'
					 WHERE a.shipping_id = '" . $cid . "'";
		$query2 = "UPDATE `#__jshopping_shipping_method` AS a
					 SET a.shipping_ordering = '" . $number . "'
					 WHERE a.shipping_id = '" . $row->shipping_id . "'";
		$db->setQuery($query1);
		$db->query();
		$db->setQuery($query2);
		$db->query();
		
		$this->setRedirect("index.php?option=com_jshopping&controller=shippings");
	}
    
    
}
?>