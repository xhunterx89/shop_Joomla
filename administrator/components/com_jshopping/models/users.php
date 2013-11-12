<?php
/**
* @version      2.5.1 12.11.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.application.component.model');

class JshoppingModelUsers extends JModel{    

    function getAllUsers($limitstart, $limit, $text_search="") {
        $db =& JFactory::getDBO();
        $where = "";
        if ($text_search){
            $search = $db->getEscaped($text_search);            
            $where .= " and (U.u_name like '%".$search."%' or U.f_name like '%".$search."%' or U.l_name like '%".$search."%' or U.email like '%".$search."%' or U.firma_name like '%".$search."%'  or U.d_f_name like '%".$search."%'  or U.d_l_name like '%".$search."%'  or U.d_firma_name like '%".$search."%') ";
        } 
        $query = "SELECT * FROM `#__jshopping_users` AS U
                 INNER JOIN `#__users` AS UM ON U.user_id = UM.id where 1 ".$where;
        $db->setQuery($query, $limitstart, $limit);        
        return $db->loadObjectList();
    }

    function getCountAllUsers($text_search = "") {
        $db =& JFactory::getDBO(); 
        $where = "";
        if ($text_search){
            $search = $db->getEscaped($text_search);            
            $where .= " and (U.u_name like '%".$search."%' or U.f_name like '%".$search."%' or U.l_name like '%".$search."%' or U.email like '%".$search."%' or U.firma_name like '%".$search."%'  or U.d_f_name like '%".$search."%'  or U.d_l_name like '%".$search."%'  or U.d_firma_name like '%".$search."%') ";
        }
        $query = "SELECT COUNT(U.user_id) FROM `#__jshopping_users` AS U
                 INNER JOIN `#__users` AS UM ON U.user_id = UM.id where 1 ".$where;
        $db->setQuery($query);
        return $db->loadResult();
    }
       
}

?>