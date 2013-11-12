<?php
/**
* @version      2.9.4 26.12.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerProductFields extends JController{
    
    function __construct( $config = array() ){
        parent::__construct( $config );

        $this->registerTask( 'add',   'edit' );
        $this->registerTask( 'apply', 'save' );
        
        addSubmenu("other");
    }
    
    function display(){
        $db = &JFactory::getDBO();
        $_categories = &$this->getModel("categories");
        $listCats = $_categories->getAllList(1);
        
        $_productfields = &$this->getModel("productFields");
        $rows = $_productfields->getList();
        foreach($rows as $k=>$v){
            if ($v->allcats){
                $rows[$k]->printcat = _JSHOP_ALL;
            }else{
                $catsnames = array();
                $_cats = unserialize($v->cats);
                foreach($_cats as $cat_id){
                    $catsnames[] = $listCats[$cat_id];
                    $rows[$k]->printcat = implode(", ", $catsnames);
                }
            }
        }
        
        $_productfieldvalues = &$this->getModel("productFieldValues");
        $vals = $_productfieldvalues->getAllList(2);
                
        foreach($rows as $k=>$v){
            if (is_array($vals[$v->id])){
                $rows[$k]->count_option = count($vals[$v->id]);
            }else{
                $rows[$k]->count_option = 0;
            }
        }

        $view = &$this->getView("product_fields_list", 'html');
        $view->assign('rows', $rows);
        $view->assign('vals', $vals);
        $view->display();
    }
    
    function edit(){        
        $id = JRequest::getInt("id");
        
        $productfield = &JTable::getInstance('productField', 'jshop');
        $productfield->load($id);
        
        $_lang = &$this->getModel("languages");
        $languages = $_lang->getAllLanguages(1);
        $multilang = count($languages)>1;
        
        $all = array();
        $all[] = JHTML::_('select.option', 1, _JSHOP_ALL, 'id','value');
        $all[] = JHTML::_('select.option', 0, _JSHOP_SELECTED, 'id','value');
        if (!isset($productfield->allcats)) $productfield->allcats = 1;
        $lists['allcats'] = JHTML::_('select.radiolist', $all, 'allcats','onclick="PFShowHideSelectCats()"','id','value', $productfield->allcats);
        
        $categories_selected = $productfield->getCategorys();
        $categories = buildTreeCategory(0);
        $lists['categories'] = JHTML::_('select.genericlist', $categories,'category_id[]','class="inputbox" size="10" multiple = "multiple"','category_id','name', $categories_selected);
    
                
        $view = &$this->getView("product_fields_edit", 'html');
        JFilterOutput::objectHTMLSafe($productfield, ENT_QUOTES);
        $view->assign('row', $productfield);
        $view->assign('lists', $lists);
        $view->assign('languages', $languages);
        $view->assign('multilang', $multilang);
        $view->display();
    }

    function save(){
        $db = &JFactory::getDBO();
        $id = JRequest::getInt("id");
        $productfield = &JTable::getInstance('productField', 'jshop');        
        $post = JRequest::get("post");
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeSaveProductField', array(&$post) );
                
        if (!$productfield->bind($post)) {
            JError::raiseWarning("",_JSHOP_ERROR_BIND);
            $this->setRedirect("index.php?option=com_jshopping&controller=productfields");
            return 0;
        }
        
        $categorys = $post['category_id'];
        if (!is_array($categorys)) $categorys = array();
        
        $productfield->setCategorys($categorys);
        
        if (!$id){
            $productfield->ordering = null;
            $productfield->ordering = $productfield->getNextOrder();            
        }

        if (!$productfield->store()) {
            JError::raiseWarning("",_JSHOP_ERROR_SAVE_DATABASE);
            $this->setRedirect("index.php?option=com_jshopping&controller=productfields");
            return 0; 
        }
        
        if (!$id){
            $query="ALTER TABLE `#__jshopping_products` ADD `extra_field_".$productfield->id."` INT( 11 ) NOT NULL";
            $db->setQuery($query);
            $db->query();
        }
        
        $dispatcher->trigger( 'onAfterSaveProductField', array(&$productfield) );
        
        if ($this->getTask()=='apply'){
            $this->setRedirect("index.php?option=com_jshopping&controller=productfields&task=edit&id=".$productfield->id);
        }else{
            $this->setRedirect("index.php?option=com_jshopping&controller=productfields");
        }
                        
    }

    function remove(){
        $cid = JRequest::getVar("cid");
        $db = &JFactory::getDBO();
        $text = array();
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeRemoveProductField', array(&$cid) );
        foreach ($cid as $key => $value) {            
            $query = "DELETE FROM `#__jshopping_products_extra_fields` WHERE `id` = '".$db->getEscaped($value)."'";
            $db->setQuery($query);
            if ($db->query()){
                $text[] = _JSHOP_ITEM_DELETED;
            }
            
            $query="ALTER TABLE `#__jshopping_products` DROP `extra_field_".$value."`";
            $db->setQuery($query);
            $db->query();
                
        }
        $dispatcher->trigger( 'onAfterRemoveProductField', array(&$cid) );
        
        $this->setRedirect("index.php?option=com_jshopping&controller=productfields", implode("</li><li>",$text));
    }
    
    function order(){        
        $id = JRequest::getInt("id");
        $move = JRequest::getInt("move");        
        $productfield = &JTable::getInstance('productField', 'jshop');
        $productfield->load($id);
        $productfield->move($move);
        $this->setRedirect("index.php?option=com_jshopping&controller=productfields");
    }
    
    function saveorder(){
        $cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
        $order = JRequest::getVar( 'order', array(), 'post', 'array' );
        
        foreach ($cid as $k=>$id){
            $table = &JTable::getInstance('productField', 'jshop');
            $table->load($id);
            if ($table->ordering!=$order[$k]){
                $table->ordering = $order[$k];
                $table->store();
            }        
        }
        
        $table = &JTable::getInstance('productField', 'jshop');
        $table->ordering = null;
        $table->reorder();        
                
        $this->setRedirect("index.php?option=com_jshopping&controller=productfields");
    }
    
}
?>		