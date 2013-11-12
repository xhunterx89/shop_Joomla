<?php
/**
* @version      2.3.0 27.09.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.application.component.model');

class JshoppingModelImportExport extends JModel{
    
    function getList() {
        $db = &JFactory::getDBO();                
        $query = "SELECT * FROM `#__jshopping_import_export` ORDER BY name";
        $db->setQuery($query);        
        return $db->loadObjectList();
    }
        
    
}

?>