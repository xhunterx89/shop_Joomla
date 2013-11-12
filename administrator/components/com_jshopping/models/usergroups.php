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

class JshoppingModelUsergroups extends JModel{ 

    function getAllUsergroups(){
        $database =& JFactory::getDBO(); 
        $query = "SELECT * FROM `#__jshopping_usergroups`";
        $database->setQuery($query);
        return $database->loadObjectList();        
    }
    
        //Static
    function resetDefaultUsergroup(){
        $database =& JFactory::getDBO(); 
        $query = "SELECT `usergroup_id`
                  FROM `#__jshopping_usergroups`
                  WHERE `usergroup_is_default`= '1'
                  LIMIT 0,1";
        $database->setQuery($query);
        $usergroup_default = $database->loadResult();
        $query = "UPDATE `#__jshopping_usergroups`
                  SET `usergroup_is_default` = '0'";
        $database->setQuery($query);
        $database->query();
    }
    
    function setDefaultUsergroup($usergroup_id){
        $database =& JFactory::getDBO(); 
        $query = "UPDATE `#__jshopping_usergroups`
                  SET `usergroup_is_default` = '1'
                  WHERE `usergroup_id`= '" . $database->getEscaped($usergroup_id) . "'";
        $database->setQuery($query);
        $database->query();
    }
    
    function getDefaultUsergroup(){
        $database =& JFactory::getDBO(); 
        $query = "SELECT `usergroup_id`
                  FROM `#__jshopping_usergroups`
                  WHERE `usergroup_is_default`= '1'
                  LIMIT 0,1";
        $database->setQuery($query);
        return $database->loadResult();
    }
          
}

?>