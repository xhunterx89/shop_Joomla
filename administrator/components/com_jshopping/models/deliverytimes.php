<?php
/**
* @version      2.2.6 23.09.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.application.component.model');

class JshoppingModelDeliveryTimes extends JModel{    

    function getDeliveryTimes(){
        $db =& JFactory::getDBO();    
        $lang = &JSFactory::getLang();     
        $query = "SELECT id, `".$lang->get('name')."` as name FROM `#__jshopping_delivery_times` ORDER BY name";
        $db->setQuery($query);
        return $db->loadObjectList();
    }
    
    function getCountDeliveryTimes() {
        $db =& JFactory::getDBO();         
        $query = "SELECT count(id) FROM `#__jshopping_delivery_times`";
        $db->setQuery($query);
        return $db->loadResult();
    }
    
}
?>