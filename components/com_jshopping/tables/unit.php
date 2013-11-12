<?php
/**
* @version      2.2.3 02.11.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

class jshopUnit extends JTableAvto {
    
    function __construct( &$_db ){
        parent::__construct( '#__jshopping_unit', 'id', $_db );
    }
    
    function getName() {
        $lang = &JSFactory::getLang();
        $name = $lang->get('name');
        return $this->$name;
    }
    
    function getAllUnits(){
        $lang = &JSFactory::getLang();
        $db =& JFactory::getDBO(); 
        $query = "SELECT id, `".$lang->get("name")."` as name, qty FROM `#__jshopping_unit` ORDER BY id";
        $db->setQuery($query);
        $list = $db->loadObjectList();
        $rows = array();
        foreach($list as $row){
             $rows[$row->id] = $row;
        }
        return $rows;
    }
        
}
?>