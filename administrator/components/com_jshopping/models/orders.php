<?php
/**
* @version      2.8.0 24.12.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.application.component.model');

class JshoppingModelOrders extends JModel{    

    function getCountAllOrders($filters) {
        $db =& JFactory::getDBO();
        $where = "";
        if ($filters['status_id']){
            $where .= " and O.order_status = '".$db->getEscaped($filters['status_id'])."'";
        }
        if ($filters['text_search']){
            $search = $db->getEscaped($filters['text_search']);
            $where .= " and (O.`f_name` like '%".$search."%' or O.`l_name` like '%".$search."%' or O.`email` like '%".$search."%' or O.`firma_name` like '%".$search."%' or O.`d_f_name` like '%".$search."%' or O.`d_l_name` like '%".$search."%' or O.`d_firma_name` like '%".$search."%') ";
        }
        if (!$filters['notfinished']) $where .= "and O.order_created='1' ";
        if ($filters['year']!=0) $year = $filters['year']; else $year="%";
        if ($filters['month']!=0) $month = $filters['month']; else $month="%";
        if ($filters['day']!=0) $day = $filters['day']; else $day="%";
        $where .= " and O.order_date like '".$year."-".$month."-".$day." %'";
        
        if ($filters['vendor_id']){
            $where .= " and OI.vendor_id='".$db->getEscaped($filters['vendor_id'])."'";
            $query = "SELECT COUNT(distinct O.order_id) FROM `#__jshopping_orders` as O
                  left join `#__jshopping_order_item` as OI on OI.order_id=O.order_id
                  where 1 $where ORDER BY O.order_id DESC";
        }else{
            $query = "SELECT COUNT(O.order_id) FROM `#__jshopping_orders` as O where 1 ".$where;
        }
        $db->setQuery($query);
        return $db->loadResult();
    }

    function getAllOrders($limitstart, $limit, $filters) {
        $db =& JFactory::getDBO(); 
        $where = "";
        if ($filters['status_id']){
            $where .= " and O.order_status = '".$db->getEscaped($filters['status_id'])."'";
        }
        if ($filters['text_search']){
            $search = $db->getEscaped($filters['text_search']);
            $where .= " and (O.`f_name` like '%".$search."%' or O.`l_name` like '%".$search."%' or O.`email` like '%".$search."%' or O.`firma_name` like '%".$search."%' or O.`d_f_name` like '%".$search."%' or O.`d_l_name` like '%".$search."%' or O.`d_firma_name` like '%".$search."%') ";
        }
        if (!$filters['notfinished']) $where .= "and O.order_created='1' ";
        if ($filters['year']!=0) $year = $filters['year']; else $year="%";
        if ($filters['month']!=0) $month = $filters['month']; else $month="%";
        if ($filters['day']!=0) $day = $filters['day']; else $day="%";
        $where .= " and O.order_date like '".$year."-".$month."-".$day." %'";
        
        if ($filters['vendor_id']){
            $where .= " and OI.vendor_id='".$db->getEscaped($filters['vendor_id'])."'";
            $query = "SELECT distinct O.* FROM `#__jshopping_orders` as O
                  left join `#__jshopping_order_item` as OI on OI.order_id=O.order_id
                  where 1 $where ORDER BY O.order_id DESC";
        }else{
            $query = "SELECT O.*, V.l_name as v_name,V.f_name as v_fname FROM `#__jshopping_orders` as O
                  left join `#__jshopping_vendors` as V on V.id=O.vendor_id
                  where 1 $where ORDER BY O.order_id DESC";
        }
        $db->setQuery($query, $limitstart, $limit);
        return $db->loadObjectList();
    }
    
    function getAllOrderStatus() {
        $db =& JFactory::getDBO(); 
        $lang = &JSFactory::getLang();
        $query = "SELECT status_id, status_code, `".$lang->get('name')."` as name FROM `#__jshopping_order_status` ORDER BY status_id";
        $db->setQuery($query);
        return $db->loadObjectList();
    }
    
    function getMinYear(){
        $db =& JFactory::getDBO();
        $query = "SELECT min(order_date) FROM `#__jshopping_orders`";
        $db->setQuery($query);
        $res = substr($db->loadResult(),0, 4);
        if (intval($res)==0) $res = "2010";
        return $res;
    }
    
}

?>