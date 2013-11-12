<?php
/**
* @version      2.9.2 19.07.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die('Restricted access');

class jshopConfig extends JTableAvto {
    
    function __construct( &$_db ){
        parent::__construct( '#__jshopping_config', 'id', $_db );
    }

    function transformPdfParameters() {
        if (is_array($this->pdf_parameters)){
            $this->pdf_parameters = implode(":",$this->pdf_parameters);
        }
    }
    
    function updateAdminMenu(){
    	$db = &JFactory::getDBO();
		$arr_links  = array(
			'option=com_jshopping',
			'option=com_jshopping&controller=categories&catid=0',
			'option=com_jshopping&controller=products&category_id=0', 
			'option=com_jshopping&controller=manufacturers', 
			'option=com_jshopping&controller=coupons', 
			'option=com_jshopping&controller=config', 
			'option=com_jshopping&controller=orders', 
			'option=com_jshopping&controller=users', 
			'option=com_jshopping&controller=info', 
			'option=com_jshopping&controller=update',
			'option=com_jshopping&controller=other'
				);
		$arr_names = array(
				_JSHOP_MENU_MAIN, 	      
				_JSHOP_MENU_CATEGORIES, 			     
				_JSHOP_MENU_PRODUCTS,                
				_JSHOP_MENU_MANUFACTURERS,				
				_JSHOP_MENU_COUPONS, 				
				_JSHOP_MENU_CONFIG,				   
				_JSHOP_MENU_ORDERS,               
				_JSHOP_MENU_CLIENTS,              
				_JSHOP_MENU_INFO,                
				_JSHOP_PANEL_UPDATE,
				_JSHOP_MENU_OTHER
				);
		foreach ($arr_names as $key=>$value){
			$query = "UPDATE `#__components` SET `name` = '"  . $db->getEscaped($value) . "',
						`admin_menu_alt`  = '" . $db->getEscaped($value) . "'
					  	WHERE `admin_menu_link` = '" . $db->getEscaped($arr_links[$key])  . "'";
			$db->setQuery($query);
			$db->query();
		}
    }
    
    function loadCurrencyValue(){
        $session =& JFactory::getSession();
        $id_currency_session = $session->get('js_id_currency');
        $id_currency = JRequest::getInt('id_currency');
        
        if ($session->get('js_id_currency_orig') && $session->get('js_id_currency_orig')!=$this->mainCurrency) {
            $id_currency_session = 0;
            $session->set('js_update_all_price', 1);
        }

        if (!$id_currency && $id_currency_session){
            $id_currency = $id_currency_session;
        }

        $session->set('js_id_currency_orig', $this->mainCurrency);

        if ($id_currency){
            $this->cur_currency = $id_currency;
        }else{
            $this->cur_currency = $this->mainCurrency;
        }

        if ($this->cur_currency != $id_currency_session){
            $current_currency = &JTable::getInstance('currency', 'jshop');
            $current_currency->load($this->cur_currency);
            if (!$current_currency->currency_value) $current_currency->currency_value = 1;
            
            $session->set('js_id_currency', $this->cur_currency);
            $session->set('js_currency_value', $current_currency->currency_value);
            $session->set('js_currency_code', $current_currency->currency_code);
            $session->set('js_currency_code_iso', $current_currency->currency_code_iso);
            
            $this->currency_value = $current_currency->currency_value;
            $this->currency_code = $current_currency->currency_code;
            $this->currency_code_iso = $current_currency->currency_code_iso;
        }else{
            $this->currency_value = $session->get('js_currency_value');
            $this->currency_code = $session->get('js_currency_code');
            $this->currency_code_iso = $session->get('js_currency_code_iso');
            if (!$this->currency_value) $this->currency_value = 1;
        }
    }
    
    function getDisplayPriceFront(){
        $display_price = $this->display_price_front;
        
        if ($this->use_extend_display_price_rule > 0){
            $adv_user = &JSFactory::getUserShop();
            $country_id = $adv_user->country;
            $client_type = $adv_user->client_type;
            if (!$country_id){
                $adv_user = &JSFactory::getUserShopGuest();
                $country_id = $adv_user->country;
                $client_type = $adv_user->client_type;
            }    
            if ($country_id){
                $configDisplayPrice = &JTable::getInstance('configDisplayPrice', 'jshop');
                $rows = $configDisplayPrice->getList();        
                foreach($rows as $v){
                    if (in_array($country_id, $v->countries)){
                        if ($client_type==2){
                            $display_price = $v->display_price_firma;
                        }else{
                            $display_price = $v->display_price;
                        }
                    }
                }
            }
        }
        return $display_price;
    }
    
    function getListFieldsRegister(){
        if ($this->fields_register!=""){
            return unserialize($this->fields_register);
        }else{
            return array();
        }
    }
    
    function getProductListDisplayExtraFields(){
        if ($this->product_list_display_extra_fields!=""){
            return unserialize($this->product_list_display_extra_fields);
        }else{
            return array();
        }
    }
    
    function setProductListDisplayExtraFields($data){
        if (is_array($data)){
            $this->product_list_display_extra_fields = serialize($data);
        }else{
            $this->product_list_display_extra_fields = serialize(array());
        }
    }
    
    function getFilterDisplayExtraFields(){
        if ($this->filter_display_extra_fields!=""){
            return unserialize($this->filter_display_extra_fields);
        }else{
            return array();
        }
    }
    
    function setFilterDisplayExtraFields($data){
        if (is_array($data)){
            $this->filter_display_extra_fields = serialize($data);
        }else{
            $this->filter_display_extra_fields = serialize(array());
        }
    }
    
    function getProductHideExtraFields(){
        if ($this->product_hide_extra_fields!=""){
            return unserialize($this->product_hide_extra_fields);
        }else{
            return array();
        }
    }
    
    function setProductHideExtraFields($data){
        if (is_array($data)){
            $this->product_hide_extra_fields = serialize($data);
        }else{
            $this->product_hide_extra_fields = serialize(array());
        }
    }
    
    function updateNextOrderNumber(){
        $db = &JFactory::getDBO();
        $query = "update `#__jshopping_config` set next_order_number=next_order_number+1";
        $db->setQuery($query);
        $db->query();    
    }
    
}
?>