<?php
/**
* @version      2.7.0 26.12.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die( 'Restricted access' );
jimport('joomla.application.component.model');

class jshopProductField extends JTableAvto{
    
    function __construct( &$_db ){
        parent::__construct('#__jshopping_products_extra_fields', 'id', $_db );
    }
    
    /**
    * set categorys
    * 
    * @param array $cats
    */
    function setCategorys($cats){
        $this->cats = serialize($cats);
    }
    
    /**
    * get gategoryd
    * 
    * @return array
    */    
    function getCategorys(){
        if ($this->cats!=""){
            return unserialize($this->cats);
        }else{
            return array();
        }
    }
    
    function getList(){
        $db =& JFactory::getDBO();
        $lang = &JSFactory::getLang(); 
        $query = "SELECT id, `".$lang->get("name")."` as name, allcats, cats FROM `#__jshopping_products_extra_fields` order by `ordering`";
        $db->setQuery($query);
        $rows = $db->loadObjectList();
        $list = array();        
        foreach($rows as $k=>$v){
            $list[$v->id] = $v;
            if ($v->allcats){
                $list[$v->id]->cats = array();
            }else{
                $list[$v->id]->cats = unserialize($v->cats);
            }            
        }
        unset($rows);
        return $list;
    }
    
}

?>