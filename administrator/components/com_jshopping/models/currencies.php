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

class JshoppingModelCurrencies extends JModel{ 

    function getAllCurrencies($publish = 1) {
        $database =& JFactory::getDBO(); 
        $query_where = ($publish)?("WHERE currency_publish = '1'"):("");
        $query = "SELECT * FROM `#__jshopping_currencies` $query_where ORDER BY currency_ordering";
        $database->setQuery($query);
        return $database->loadObjectList();
    }      
}
?>