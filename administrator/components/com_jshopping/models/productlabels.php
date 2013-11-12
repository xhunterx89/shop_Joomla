<?php
/**
* @version      2.4.3 03.11.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.application.component.model');

class JshoppingModelProductLabels extends JModel{    

    function getList(){
        $db =& JFactory::getDBO();            
        $query = "SELECT * FROM `#__jshopping_product_labels` ORDER BY name";
        $db->setQuery($query);
        return $db->loadObjectList();
    }
    
}
?>