<?php
/**
* @version      2.0.0 31.07.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die( 'Restricted access' );
jimport('joomla.application.component.model');

class JshoppingModelAttributValue extends JModel {
    
    function getNameValue($value_id) {
        $db =& JFactory::getDBO();
        $lang = &JSFactory::getLang();
        $query = "SELECT `".$lang->get("name")."` as name FROM `#__jshopping_attr_values` WHERE value_id = '".$db->getEscaped($value_id)."'";
        $db->setQuery($query);        
        return $db->loadResult();
    }

    function getAllValues($attr_id) {
        $db =& JFactory::getDBO(); 
        $lang = &JSFactory::getLang();
        $query = "SELECT value_id, image, `".$lang->get("name")."` as name, attr_id, value_ordering FROM `#__jshopping_attr_values` where attr_id='".$attr_id."' ORDER BY value_ordering, value_id";
        $db->setQuery($query);
        return $db->loadObjectList();
    }
    
    /**
    * get All Atribute value
    * @param $resulttype (0 - ObjectList, 1 - array {id->name}, 2 - array(id->object) )
    * 
    * @param mixed $resulttype
    */
    function getAllAttributeValues($resulttype=0){
        $db =& JFactory::getDBO();
        $lang = &JSFactory::getLang();
        $query = "SELECT value_id, image, `".$lang->get("name")."` as name, attr_id, value_ordering FROM `#__jshopping_attr_values` ORDER BY value_ordering, value_id";
        $db->setQuery($query);
        $db->setQuery($query);
        $attribs = $db->loadObjectList();

        if ($resulttype==2){
            $rows = array();
            foreach($attribs as $k=>$v){
                $rows[$v->value_id] = $v;    
            }
            return $rows;
        }elseif ($resulttype==1){
            $rows = array();
            foreach($attribs as $k=>$v){
                $rows[$v->value_id] = $v->name;    
            }
            return $rows;
        }else{
            return $attribs;
        }        
    }
    
}

?>