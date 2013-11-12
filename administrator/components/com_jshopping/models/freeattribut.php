<?php
/**
* @version      2.8.0 31.07.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die( 'Restricted access' );
jimport('joomla.application.component.model');

class JshoppingModelFreeAttribut extends JModel {
    
    function getNameAttrib($id) {
        $db =& JFactory::getDBO();
        $lang = &JSFactory::getLang();
        $query = "SELECT `".$lang->get("name")."` as name FROM `#__jshopping_free_attr` WHERE id = '".$db->getEscaped($id)."'";
        $db->setQuery($query);
        return $db->loadResult();
    }
    
    function getAll() {
        $lang = &JSFactory::getLang();
        $db =& JFactory::getDBO(); 
        $query = "SELECT id, `".$lang->get("name")."` as name, ordering, required FROM `#__jshopping_free_attr` ORDER BY ordering";
        $db->setQuery($query);        
        return $db->loadObjectList();
    }
    
}
?>