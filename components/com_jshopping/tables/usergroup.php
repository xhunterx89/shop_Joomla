<?php
/**
* @version      2.0.0 31.07.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

class jshopUserGroup extends JTable{
    var $usergroup_id = null;
    var $usergroup_name = null;
    var $usergroup_discount = null;
    var $usergroup_description = null;
    var $usergroup_is_default = 0;
    
    function __construct( &$_db ){
        parent::__construct( '#__jshopping_usergroups', 'usergroup_id', $_db );
    }
     
    function getDefaultUsergroup(){
        $database =& JFactory::getDBO(); 
        $query = "SELECT `usergroup_id` FROM `#__jshopping_usergroups`
                  WHERE `usergroup_is_default`= '1' LIMIT 0,1";
        $database->setQuery($query);
        return $database->loadResult();
    }
}

?>