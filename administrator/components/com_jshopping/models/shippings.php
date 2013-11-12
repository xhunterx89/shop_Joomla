<?php
/**
* @version      2.5.0 03.11.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.application.component.model');

class JshoppingModelShippings extends JModel{
    
    function getAllShippings($publish = 1) {
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
    
    function getAllShippingPrices($publish = 1, $shipping_method_id = 0) {
        $db =& JFactory::getDBO(); 
        $query_where = "";
        $query_where .= ($publish)?(" and shipping.shipping_publish = '1'"):("");
        $query_where .= ($shipping_method_id)?(" and shipping_price.shipping_method_id= '".$shipping_method_id."'"):("");
        
        $lang = &JSFactory::getLang();
        $query = "SELECT shipping_price.*, shipping.`".$lang->get('name')."` as name
                  FROM `#__jshopping_shipping_method_price` AS shipping_price
                  INNER JOIN `#__jshopping_shipping_method` AS shipping ON shipping.shipping_id = shipping_price.shipping_method_id
                  where (1=1) $query_where
                  ORDER BY shipping_price.sh_pr_method_id";
        $db->setQuery($query);
        return $db->loadObjectList();
    }
    
    function getMaxOrdering(){
        $db =& JFactory::getDBO(); 
        $query = "select max(shipping_ordering) from `#__jshopping_shipping_method`";
        $db->setQuery($query);
        return $db->loadResult();
    }
    
    function saveCountries($sh_pr_method_id, $countries) {
        $db =& JFactory::getDBO();
        $query = "DELETE FROM `#__jshopping_shipping_method_price_countries` WHERE `sh_pr_method_id` = '" . $db->getEscaped($sh_pr_method_id) . "'";
        $db->setQuery($query);
        $db->query();
        foreach ($countries as $key => $value) {
            $query = "INSERT INTO `#__jshopping_shipping_method_price_countries`
                      SET `country_id` = '" . $db->getEscaped($value) . "', `sh_pr_method_id` = '" . $db->getEscaped($sh_pr_method_id) . "'";
            $db->setQuery($query);
            $db->query();
        }
    }

    function savePrices($sh_pr_method_id, $array_post) {        
        $db =& JFactory::getDBO();
        
        $query = "DELETE FROM `#__jshopping_shipping_method_price_weight` WHERE `sh_pr_method_id` = '".$db->getEscaped($sh_pr_method_id)."'";
        $db->setQuery($query);
        $db->query();
        
        foreach ($array_post['shipping_price'] as $key => $value) {
            if(!$array_post['shipping_weight_from'][$key] && !$array_post['shipping_weight_to'][$key]){
                continue;
            }
            $sh_method = &JTable::getInstance('shippingMethodPriceWeight', 'jshop');            
            $sh_method->sh_pr_method_id = $sh_pr_method_id;
            $sh_method->shipping_price = saveAsPrice($array_post['shipping_price'][$key]);
            $sh_method->shipping_package_price = saveAsPrice($array_post['shipping_package_price'][$key]);
            $sh_method->shipping_weight_from = saveAsPrice($array_post['shipping_weight_from'][$key]);
            $sh_method->shipping_weight_to = saveAsPrice($array_post['shipping_weight_to'][$key]);
            if(!$sh_method->store()) {
                JError::raiseWarning("", "Error saving to database" . $sh_method->_db->stderr());
            }
        }
    }
    
    function deletePriceWeight($sh_pr_weight_id) {
        $db =& JFactory::getDBO();
        $query = "DELETE FROM `#__jshopping_shipping_method_price_weight` WHERE `sh_pr_weight_id` = '" . $db->getEscaped($sh_pr_weight_id) . "'";
        $db->setQuery($query);
        $db->query();
    }
    
}
?>