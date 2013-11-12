<?php
/**
* @version      2.0.0 31.07.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.application.component.model');

class JshoppingModelPayments extends JModel{
    
    function getAllPaymentMethods($publish = 1) {
        $database =& JFactory::getDBO(); 
        $query_where = ($publish)?("WHERE payment_publish = '1'"):("");
        $lang = &JSFactory::getLang();
        $query = "SELECT payment_id, `".$lang->get("name")."` as name, `".$lang->get("description")."` as description , payment_code, payment_class, payment_publish, payment_ordering, payment_params, payment_type FROM `#__jshopping_payment_method`
                  $query_where
                  ORDER BY payment_ordering";
        $database->setQuery($query);
        return $database->loadObjectList();
    }
    
    function getTypes(){
    	return array('1' => _JSHOP_TYPE_DEFAULT,'2' => _JSHOP_PAYPAL_RELATED);
    }
    
    function getMaxOrdering(){
        $db =& JFactory::getDBO(); 
        $query = "select max(payment_ordering) from `#__jshopping_payment_method`";
        $db->setQuery($query);
        return $db->loadResult();
    }
       
}
?>