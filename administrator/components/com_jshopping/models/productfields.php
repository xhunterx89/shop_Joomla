<?php
/**
* @version      2.7.0 26.12.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.application.component.model');

class JshoppingModelProductFields extends JModel{ 

    function getList(){
        $db =& JFactory::getDBO();
        $lang = &JSFactory::getLang(); 
        $query = "SELECT id, `".$lang->get("name")."` as name, allcats, cats, ordering FROM `#__jshopping_products_extra_fields` order by `ordering`";
        $db->setQuery($query);
        return $db->loadObjectList();
    }
}

?>