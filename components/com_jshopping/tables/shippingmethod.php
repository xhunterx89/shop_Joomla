<?php
/**
* @version      2.2.2 14.09.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

class jshopShippingMethod extends JTableAvto {

    function __construct( &$_db ){
        parent::__construct( '#__jshopping_shipping_method', 'shipping_id', $_db );
    }
    
    function getAllShippingMethods($publish = 1) {
        $db =& JFactory::getDBO(); 
        $query_where = ($publish)?("WHERE shipping_publish = '1'"):("");
        $lang = &JSFactory::getLang();
        $query = "SELECT shipping_id, `".$lang->get('name')."` as name, `".$lang->get("description")."` as description, shipping_publish, shipping_ordering  
                  FROM `#__jshopping_shipping_method` 
                  $query_where 
                  ORDER BY shipping_ordering";
        $db->setQuery($query);
        return $db->loadObjectList();
    }

    function getAllShippingMethodsCountry($country_id, $publish = 1) {
        $db =& JFactory::getDBO(); 
        $lang = &JSFactory::getLang();
        $query_where = ($publish) ? ("AND sh_method.shipping_publish = '1'") : ("");
        $query = "SELECT *, sh_method.`".$lang->get("name")."` as name, `".$lang->get("description")."` as description FROM `#__jshopping_shipping_method` AS sh_method
                  INNER JOIN `#__jshopping_shipping_method_price` AS sh_pr_method ON sh_method.shipping_id = sh_pr_method.shipping_method_id
                  INNER JOIN `#__jshopping_shipping_method_price_countries` AS sh_pr_method_country ON sh_pr_method_country.sh_pr_method_id = sh_pr_method.sh_pr_method_id
                  INNER JOIN `#__jshopping_countries` AS countries  ON sh_pr_method_country.country_id = countries.country_id
                  WHERE countries.country_id = '" . $db->getEscaped($country_id) . "' $query_where
                  ORDER BY sh_method.shipping_ordering";
        $db->setQuery($query);
        return $db->loadObjectList();
    }

}

?>