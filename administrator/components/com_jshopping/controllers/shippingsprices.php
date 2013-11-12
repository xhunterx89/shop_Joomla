<?php
/**
* @version      2.9.4 20.11.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class JshoppingControllerShippingsPrices extends JController{

    function __construct( $config = array() ){
        parent::__construct( $config );

        $this->registerTask( 'add',   'edit' );
        $this->registerTask( 'apply', 'save' );
        checkAccessController("shippingsprices");
        addSubmenu("other");
    }
    
    function display() {
		$db = &JFactory::getDBO();
        $lang = &JSFactory::getLang();
        $jshopConfig = &JSFactory::getConfig();
        $shipping_id_back = JRequest::getInt("shipping_id_back");
		$shippings = &$this->getModel("shippings");
		$rows = $shippings->getAllShippingPrices(0, $shipping_id_back);
        $currency =& JTable::getInstance('currency', 'jshop');
        $currency->load($jshopConfig->mainCurrency);
        
        $query = "select MPC.sh_pr_method_id, C.`".$lang->get("name")."` as name from #__jshopping_shipping_method_price_countries as MPC 
                  left join #__jshopping_countries as C on C.country_id=MPC.country_id order by MPC.sh_pr_method_id, C.ordering";
        $db->setQuery($query);
        $list = $db->loadObjectList();        
        $shipping_countries = array();        
        foreach($list as $smp){
            $shipping_countries[$smp->sh_pr_method_id][] = $smp->name;
        }
        unset($list);
        foreach($rows as $k=>$row){
            $rows[$k]->countries = "";
            if (is_array($shipping_countries[$row->sh_pr_method_id])){
                if (count($shipping_countries[$row->sh_pr_method_id])>10){
                    $tmp =  array_slice($shipping_countries[$row->sh_pr_method_id],0,10);
                    $rows[$k]->countries = implode(", ",$tmp)."...";
                }else{
                    $rows[$k]->countries = implode(", ",$shipping_countries[$row->sh_pr_method_id]);
                }                
            }
        }
                        
		$view=&$this->getView("shippingsprices_list", 'html');
		$view->assign('rows', $rows);
        $view->assign('currency', $currency);
        $view->assign('shipping_id_back', $shipping_id_back);
		$view->display(); 
	}
    
    function edit() {
        $jshopConfig = &JSFactory::getConfig();
		$sh_pr_method_id = JRequest::getInt('sh_pr_method_id');
        $shipping_id_back = JRequest::getInt("shipping_id_back");
		$db = &JFactory::getDBO();
		$sh_method_price = &JTable::getInstance('shippingMethodPrice', 'jshop');
		$sh_method_price->load($sh_pr_method_id);
		$sh_method_price->prices = $sh_method_price->getPrices();
		$taxes = &$this->getModel("taxes");
		$all_taxes = $taxes->getAllTaxes();
		$list_tax = array();
		
		foreach ($all_taxes as $tax) {
			$list_tax[] = JHTML::_('select.option', $tax->tax_id,$tax->tax_name . ' (' . $tax->tax_value . '%)','tax_id','tax_name');
		}
        if (count($all_taxes)==0) $withouttax = 1; else $withouttax = 0;
		$shippings = &$this->getModel("shippings");
		$countries = &$this->getModel("countries");
		$lists['taxes'] = JHTML::_('select.genericlist', $list_tax,'shipping_tax_id','class = "inputbox" size = "1" id = "shipping_tax_id"','tax_id','tax_name',$sh_method_price->shipping_tax_id);
        $actived = $sh_method_price->shipping_method_id;
        if (!$actived) $actived = $shipping_id_back;        
		$lists['shipping_methods'] = JHTML::_('select.genericlist', $shippings->getAllShippings(0),'shipping_method_id','class = "inputbox" size = "1"','shipping_id','name',$actived);
                
		$lists['countries'] = JHTML::_('select.genericlist', $countries->getAllCountries(0),'shipping_countries_id[]','class = "inputbox" size = "10", multiple = "multiple"','country_id','name', $sh_method_price->getCountries());
        
        $currency =& JTable::getInstance('currency', 'jshop');
        $currency->load($jshopConfig->mainCurrency);

		$view=&$this->getView("shippingsprices_edit", 'html');
		$view->assign('sh_method_price', $sh_method_price);
		$view->assign('lists', $lists);
        $view->assign('shipping_id_back', $shipping_id_back);
        $view->assign('currency', $currency);
        $view->assign('withouttax', $withouttax);
		$view->display();
	}
	
	function save() {
    	$sh_method_id = JRequest::getInt("sh_method_id");
        $shipping_id_back = JRequest::getInt("shipping_id_back");
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
		
        $shippings = &$this->getModel("shippings");
		$shipping_pr = &JTable::getInstance('shippingMethodPrice', 'jshop');
        $post = JRequest::get("post");
        $post['shipping_stand_price'] = saveAsPrice($post['shipping_stand_price']);
        $dispatcher->trigger( 'onBeforeSaveShippingPrice', array(&$post) );
        
        $countries = JRequest::getVar('shipping_countries_id');
		if (!$shipping_pr->bind($post)) {
			JError::raiseWarning("",_JSHOP_ERROR_BIND);
			$this->setRedirect("index.php?option=com_jshopping&controller=shippingsprices");
			return 0;
		}
	
		if (!$shipping_pr->store()) {
			JError::raiseWarning("",_JSHOP_ERROR_SAVE_DATABASE);
			$this->setRedirect("index.php?option=com_jshopping&controller=shippingsprices");
			return 0;
		}
		
		$shippings->savePrices($shipping_pr->sh_pr_method_id, $post);
		$shippings->saveCountries($shipping_pr->sh_pr_method_id, $countries);
        
        $dispatcher->trigger( 'onAfterSaveShippingPrice', array(&$shipping_pr) );
		
		if ($this->getTask()=='apply'){
            $this->setRedirect("index.php?option=com_jshopping&controller=shippingsprices&task=edit&sh_pr_method_id=".$shipping_pr->sh_pr_method_id."&shipping_id_back=".$shipping_id_back); 
        }else{
            $this->setRedirect("index.php?option=com_jshopping&controller=shippingsprices&shipping_id_back=".$shipping_id_back);
        }
		
	}	
	
	function remove(){
		$cid = JRequest::getVar("cid");
		$db = &JFactory::getDBO();
        $shipping_id_back = JRequest::getInt("shipping_id_back");
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeRemoveShippingPrice', array(&$cid) );
		$text = '';
		foreach ($cid as $key => $value) {
			$query = "DELETE FROM `#__jshopping_shipping_method_price`
					  WHERE `sh_pr_method_id` = '" . $db->getEscaped($value) . "'";
			$db->setQuery($query);
			if ($db->query()) {
				$text .= _JSHOP_SHIPPING_DELETED;
				$query = "DELETE FROM `#__jshopping_shipping_method_price_weight`
						  WHERE `sh_pr_method_id` = '" . $db->getEscaped($value) . "'";
				$db->setQuery($query);
				$db->query();
				
				$query = "DELETE FROM `#__jshopping_shipping_method_price_countries`
						  WHERE `sh_pr_method_id` = '" . $db->getEscaped($value) . "'";
				$db->setQuery($query);
				$db->query();
			} else {
				$text .= _JSHOP_ERROR_SHIPPING_DELETED;
			}
		}
        
        $dispatcher->trigger( 'onAfterRemoveShippingPrice', array(&$cid) );
		
		$this->setRedirect("index.php?option=com_jshopping&controller=shippingsprices&shipping_id_back=".$shipping_id_back, $text);
	}
    
    function back(){
        $this->setRedirect("index.php?option=com_jshopping&controller=shippings");
    }
    
    
}

?>