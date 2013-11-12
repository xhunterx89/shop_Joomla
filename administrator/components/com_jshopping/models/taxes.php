<?php
/**
* @version      2.6.0 25.11.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.application.component.model');

class JshoppingModelTaxes extends JModel{ 

    function getAllTaxes() {
        $db =& JFactory::getDBO(); 
        $query = "SELECT * FROM `#__jshopping_taxes`";
        $db->setQuery($query);
        return $db->loadObjectList();
    }
    
    function getExtTaxes($tax_id = 0) {
        $db =& JFactory::getDBO();
        $where = "";
        if ($tax_id) $where = " where ET.tax_id='".$tax_id."'";
        $query = "SELECT ET.*, T.tax_name FROM `#__jshopping_taxes_ext` as ET left join #__jshopping_taxes as T on T.tax_id=ET.tax_id ".$where;
        $db->setQuery($query);
        return $db->loadObjectList();
    }
      
}

?>