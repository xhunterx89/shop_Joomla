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

class JshoppingControllerProductFieldValues extends JController{
    
    function __construct( $config = array() ){
        parent::__construct( $config );

        $this->registerTask( 'add',   'edit' );
        $this->registerTask( 'apply', 'save' );
        
        addSubmenu("other");
    }
    
    function display(){
        $field_id = JRequest::getInt("field_id");
        $db = &JFactory::getDBO();
        $_productfieldvalues = &$this->getModel("productFieldValues");
        $rows = $_productfieldvalues->getList($field_id);
        
        $view = &$this->getView("product_field_values_list", 'html');
        $view->assign('rows', $rows);
        $view->assign('field_id', $field_id);
        $view->display();
    }
    
    function edit(){        
        $field_id = JRequest::getInt("field_id");
        $id = JRequest::getInt("id");
        
        $productfieldvalue = &JTable::getInstance('productFieldValue', 'jshop');
        $productfieldvalue->load($id);
        
        $_lang = &$this->getModel("languages");
        $languages = $_lang->getAllLanguages(1);
        $multilang = count($languages)>1;    
                
        $view = &$this->getView("product_field_values_edit", 'html');
        JFilterOutput::objectHTMLSafe($productfieldvalue, ENT_QUOTES);
        $view->assign('row', $productfieldvalue);
        $view->assign('languages', $languages);
        $view->assign('multilang', $multilang);
        $view->assign('field_id', $field_id);
        $view->display();
    }

    function save(){
        $field_id = JRequest::getInt("field_id");        
        $productfieldvalue = &JTable::getInstance('productFieldValue', 'jshop');
        $post = JRequest::get("post");
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeSaveProductFieldValue', array(&$post) );
        
        if (!$productfieldvalue->bind($post)) {
            JError::raiseWarning("",_JSHOP_ERROR_BIND);
            $this->setRedirect("index.php?option=com_jshopping&controller=productfieldvalues");
            return 0;
        }
        
        if (!$id){
            $productfieldvalue->ordering = null;
            $productfieldvalue->ordering = $productfieldvalue->getNextOrder('field_id="'.$field_id.'"');            
        }
        
        if (!$productfieldvalue->store()) {
            JError::raiseWarning("",_JSHOP_ERROR_SAVE_DATABASE);
            $this->setRedirect("index.php?option=com_jshopping&controller=productfieldvalues");
            return 0; 
        }
        
        $dispatcher->trigger( 'onAfterSaveProductFieldValue', array(&$productfieldvalue) );
        
        if ($this->getTask()=='apply'){
            $this->setRedirect("index.php?option=com_jshopping&controller=productfieldvalues&task=edit&field_id=".$field_id."&id=".$productfieldvalue->id);
        }else{
            $this->setRedirect("index.php?option=com_jshopping&controller=productfieldvalues&field_id=".$field_id);
        }
                        
    }

    function remove(){
        $field_id = JRequest::getInt("field_id");
        $cid = JRequest::getVar("cid");
        $db = &JFactory::getDBO();
        $text = array();
        foreach ($cid as $key => $value) {            
            $query = "DELETE FROM `#__jshopping_products_extra_field_values` WHERE `id` = '".$db->getEscaped($value)."'";
            $db->setQuery($query);
            if ($db->query()){
                $text[] = _JSHOP_ITEM_DELETED;
            }    
        }
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onAfterRemoveProductFieldValue', array(&$cid) );
        
        $this->setRedirect("index.php?option=com_jshopping&controller=productfieldvalues&field_id=".$field_id, implode("</li><li>",$text));
    }
    
    function back(){
        $this->setRedirect("index.php?option=com_jshopping&controller=productfields");
    }
    
    function order(){        
        $id = JRequest::getInt("id");
        $field_id = JRequest::getInt("field_id");
        $move = JRequest::getInt("move");        
        $productfieldvalue = &JTable::getInstance('productFieldValue', 'jshop');
        $productfieldvalue->load($id);
        $productfieldvalue->move($move, 'field_id="'.$field_id.'"');
        $this->setRedirect("index.php?option=com_jshopping&controller=productfieldvalues&field_id=".$field_id);
    }
    
    function saveorder(){
        $cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
        $order = JRequest::getVar( 'order', array(), 'post', 'array' );
        $field_id = JRequest::getInt("field_id");
        
        foreach ($cid as $k=>$id){
            $table = &JTable::getInstance('productFieldValue', 'jshop');
            $table->load($id);
            if ($table->ordering!=$order[$k]){
                $table->ordering = $order[$k];
                $table->store();
            }        
        }
        
        $table = &JTable::getInstance('productFieldValue', 'jshop');
        $table->ordering = null;
        $table->reorder('field_id="'.$field_id.'"');        
                
        $this->setRedirect("index.php?option=com_jshopping&controller=productfieldvalues&field_id=".$field_id);
    }
    
}
?>		