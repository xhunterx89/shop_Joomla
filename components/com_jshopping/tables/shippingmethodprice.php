<?php
/**
* @version      2.9.2 20.11.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

class jshopShippingMethodPrice extends JTable {
    
    var $sh_pr_method_id = null;
    var $shipping_method_id = null;
    var $shipping_stand_price = null;
    var $shipping_tax_id = null;

    function __construct( &$_db ){
        parent::__construct( '#__jshopping_shipping_method_price', 'sh_pr_method_id', $_db );
    }

    function getPricesWeight($sh_pr_method_id, $id_country) {
        $db =& JFactory::getDBO();
        $jshopConfig = &JSFactory::getConfig();

        $query = "SELECT (sh_pr_weight.shipping_price + sh_pr_weight.shipping_package_price) AS shipping_price, sh_pr_weight.shipping_weight_from, sh_pr_weight.shipping_weight_to, sh_price.shipping_tax_id
                  FROM `#__jshopping_shipping_method_price` AS sh_price
                  INNER JOIN `#__jshopping_shipping_method_price_weight` AS sh_pr_weight ON sh_pr_weight.sh_pr_method_id = sh_price.sh_pr_method_id
                  INNER JOIN `#__jshopping_shipping_method_price_countries` AS sh_pr_countr ON sh_pr_weight.sh_pr_method_id = sh_pr_countr.sh_pr_method_id
                  WHERE sh_price.sh_pr_method_id = '" . $db->getEscaped($sh_pr_method_id) . "'AND sh_pr_countr.country_id = '" . $db->getEscaped($id_country) . "' 
                  ORDER BY sh_pr_weight.shipping_weight_from";
        $db->setQuery($query);
        $list = $db->loadObjectList();
        foreach($list as $k=>$v){
            $list[$k]->shipping_price = $list[$k]->shipping_price * $jshopConfig->currency_value;
            $list[$k]->shipping_price = getPriceCalcParamsTax($list[$k]->shipping_price, $list[$k]->shipping_tax_id);
        }
        return $list; 
    }

    function getPrices($orderdir = "asc") {
        $query = "SELECT * FROM `#__jshopping_shipping_method_price_weight` AS sh_price
                  WHERE sh_price.sh_pr_method_id = '" . $this->_db->getEscaped($this->sh_pr_method_id) . "'
                  ORDER BY sh_price.shipping_weight_from ".$orderdir;
        $this->_db->setQuery($query);
        return $this->_db->loadObjectList();
    }

    function getCountries() {
        $lang = &JSFactory::getLang();
        $query = "SELECT sh_country.country_id, countries.`".$lang->get('name')."` as name
                  FROM `#__jshopping_shipping_method_price_countries` AS sh_country
                  INNER JOIN `#__jshopping_countries` AS countries ON countries.country_id = sh_country.country_id
                  WHERE sh_country.sh_pr_method_id = '" . $this->_db->getEscaped($this->sh_pr_method_id) . "'";
        $this->_db->setQuery($query);        
        return $this->_db->loadObjectList();
    }

    function getTax(){        
        $taxes = &JSFactory::getAllTaxes();        
        return $taxes[$this->shipping_tax_id];
    }

    function calculateSum(&$cart) {
        
        $jshopConfig = &JSFactory::getConfig();
        if ($cart->getSum() >= ($jshopConfig->summ_null_shipping * $jshopConfig->currency_value) && $jshopConfig->summ_null_shipping > 0){
            return 0;
        }
        
        $weight_sum = $cart->getWeightProducts();
        $sh_price = $this->getPrices("desc");        
        foreach ($sh_price as $sh_pr) {
            if ($weight_sum >= $sh_pr->shipping_weight_from && ($weight_sum <= $sh_pr->shipping_weight_to || $sh_pr->shipping_weight_to==0)) {
                $price = ($sh_pr->shipping_price + $sh_pr->shipping_package_price) * $jshopConfig->currency_value;
                $price = getPriceCalcParamsTax($price, $this->shipping_tax_id);
                return $price;
            }
        }
        $price = $this->shipping_stand_price * $jshopConfig->currency_value;
        $price = getPriceCalcParamsTax($price, $this->shipping_tax_id); 
        return $price;
    }

    function calculateTax($sum) {
        $jshopConfig = &JSFactory::getConfig();
        $pricetax = getPriceTaxValue($sum, $this->getTax(), $jshopConfig->display_price_front_current);
        return $pricetax;
    }

    /**
    * check correct this shipping to country     
    * @param int $id_country
    */
    function isCorrectMethodForCountry($id_country) {
        $query = "SELECT `sh_method_country_id` FROM `#__jshopping_shipping_method_price_countries`
                  WHERE `country_id` = '" . $this->_db->getEscaped($id_country) . "' AND `sh_pr_method_id` = '" . $this->_db->getEscaped($this->sh_pr_method_id) . "'";
        $this->_db->setQuery($query);
        $this->_db->query();
        return ($this->_db->getNumRows())?(1):(0);
    }

}
?>