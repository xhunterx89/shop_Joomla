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

class JshoppingModelCoupons extends JModel{    

    function getAllCoupons($limitstart, $limit) {
        $db =& JFactory::getDBO(); 
        $query = "SELECT C.*, U.f_name, U.l_name  FROM `#__jshopping_coupons` as C left join #__jshopping_users as U on C.for_user_id=U.user_id ORDER BY C.used, C.coupon_id desc";
        $db->setQuery($query, $limitstart, $limit);
        return $db->loadObjectList();
    }
    
    function getCountCoupons(){
        $db =& JFactory::getDBO(); 
        $query = "SELECT count(*) FROM `#__jshopping_coupons`";
        $db->setQuery($query);
        return $db->loadResult();   
    }    
}
?>