<?php
/**
* @version      2.9.0 31.07.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die( 'Restricted access' );
jimport('joomla.application.component.model');

class jshopAttribut extends JTableAvto{
    
    function __construct( &$_db ){
        parent::__construct('#__jshopping_attr', 'attr_id', $_db );
    }
    
    function getName($attr_id) {
        $db =& JFactory::getDBO();
        $lang = &JSFactory::getLang();
        $query = "SELECT `".$lang->get("name")."` as name FROM `#__jshopping_attr` WHERE attr_id = '".$db->getEscaped($attr_id)."'";
        $db->setQuery($query);
        return $db->loadResult();
    }
    
    function getAllAttributes() {
        $lang = &JSFactory::getLang();
        $db =& JFactory::getDBO(); 
        $query = "SELECT attr_id, `".$lang->get("name")."` as name, attr_type, independent, attr_ordering FROM `#__jshopping_attr` ORDER BY attr_ordering";
        $db->setQuery($query);
        return $db->loadObjectList();
    }
    
    function getTypeAttribut($attr_id){
        $db =& JFactory::getDBO();
        $query = "select attr_type from #__jshopping_attr where `attr_id`='".$db->getEscaped($attr_id)."'";
        $db->setQuery($query);
        return $db->loadResult();    
    }
    
}

?>