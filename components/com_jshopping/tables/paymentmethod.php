<?php
/**
* @version      2.8.3 18.04.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

class jshopPaymentMethod extends JTableAvto {

    function __construct( &$_db ){
        parent::__construct( '#__jshopping_payment_method', 'payment_id', $_db );
    }

    function getAllPaymentMethods($publish = 1) {
        $db =& JFactory::getDBO(); 
        $query_where = ($publish)?("WHERE payment_publish = '1'"):("");
        $lang = &JSFactory::getLang();
        $query = "SELECT payment_id, `".$lang->get("name")."` as name, `".$lang->get("description")."` as description , payment_code, payment_class, payment_publish, payment_ordering, payment_params, payment_type, price, price_type, tax_id FROM `#__jshopping_payment_method`
                  $query_where
                  ORDER BY payment_ordering";
        $db->setQuery($query);
        return $db->loadObjectList();
    }

    /**
    * get id payment for payment_class
    */
    function getId(){
        $db =& JFactory::getDBO();
        $query = "SELECT payment_id FROM `#__jshopping_payment_method` WHERE payment_class = '".$db->getEscaped($this->class)."'";
        $db->setQuery($query);
        return $db->loadResult();
    }
    
    function setCart(&$cart){
        $this->_cart = $cart;
    }
    
    function &getCart(){
        return $this->_cart;
    }
    
    function getPrice(){
        $jshopConfig = &JSFactory::getConfig();
        if ($this->price_type==2){
            $cart = &$this->getCart();
            $price = $cart->getSummForCalculePlusPayment() * $this->price / 100;            
            if ($jshopConfig->display_price_front_current){
                $price = $price / (1 + $this->getTax() / 100);
            }
        }else{
            $price = $this->price * $jshopConfig->currency_value; 
            $price = getPriceCalcParamsTax($price, $this->tax_id);
        }
        return $price;
    }
    
    function getTax(){        
        $taxes = &JSFactory::getAllTaxes();        
        return $taxes[$this->tax_id];
    }
    
    function calculateTax(){
        $jshopConfig = &JSFactory::getConfig();
        $price = $this->getPrice();
        $pricetax = getPriceTaxValue($price, $this->getTax(), $jshopConfig->display_price_front_current);
        return $pricetax;
    }
    
    /**
    * static
    * get config payment for classname
    */
    function getConfigsForClassName($classname) {
        $db =& JFactory::getDBO(); 
        $query = "SELECT payment_params FROM `#__jshopping_payment_method` WHERE payment_class = '".$db->getEscaped($classname)."'";
        $db->setQuery($query);
        $params_str = $db->loadResult();
        $parseString = new parseString($params_str);
        $params = $parseString->parseStringToParams();
        return $params;
    }
    
    /**
    * get config    
    */
    function getConfigs(){
        $parseString = new parseString($this->payment_params);
        $params = $parseString->parseStringToParams();
        return $params;
    }
}
?>