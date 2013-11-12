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

class JshoppingModelManufacturers extends JModel{ 
   
    function getAllManufacturers($publish = 0) {
        $db =& JFactory::getDBO();
        $lang = &JSFactory::getLang(); 
        $query_where = ($publish)?(" WHERE manufacturer_publish = '1'"):("");
        $query = "SELECT *, `".$lang->get('name')."` as name FROM `#__jshopping_manufacturers` $query_where ORDER BY ordering";
        $db->setQuery($query);
        return $db->loadObjectList();
    } 
      
}
?>