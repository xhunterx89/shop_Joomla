<?php
/**
* @version      2.9.4 25.09.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerAttributes extends JController{
    
    function __construct( $config = array() ){
        parent::__construct( $config );

        $this->registerTask( 'add',   'edit' );
        $this->registerTask( 'apply', 'save' );
        
        addSubmenu("other");
    }

    function display(){
    	$attributes = &$this->getModel("attribut");
    	$attributesvalue = &$this->getModel("attributValue");
        $rows = $attributes->getAllAttributes();
		foreach ($rows as $key => $value){
			$rows[$key]->values = splitValuesArrayObject( $attributesvalue->getAllValues($rows[$key]->attr_id), 'name');
            $rows[$key]->count_values = count($attributesvalue->getAllValues($rows[$key]->attr_id));
		}        
        $view=&$this->getView("attributes_list", 'html');
		$view->assign('rows', $rows);
        $view->display();
    }
	
	function edit() {
		$jshopConfig = &JSFactory::getConfig();
		$db = &JFactory::getDBO();
		$attr_id = JRequest::getInt("attr_id");
	
        $attribut = &JTable::getInstance('attribut', 'jshop');
        $attribut->load($attr_id);
        
        if (!$attribut->independent) $attribut->independent = 0;
    
        $_lang = &$this->getModel("languages");
        $languages = $_lang->getAllLanguages(1);
        $multilang = count($languages)>1;
        
        JFilterOutput::objectHTMLSafe($attribut, ENT_QUOTES);
	
		$types[] = JHTML::_('select.option', '1','Select','attr_type_id','attr_type');
		$types[] = JHTML::_('select.option', '2','Radio','attr_type_id','attr_type');
		$type_attribut = JHTML::_('select.genericlist', $types, 'attr_type','class = "inputbox" size = "1"','attr_type_id','attr_type',$attribut->attr_type);
        
        
        $dependent[] = JHTML::_('select.option', '0',_JSHOP_YES,'id','name');
        $dependent[] = JHTML::_('select.option', '1',_JSHOP_NO,'id','name');
        $dependent_attribut = JHTML::_('select.radiolist', $dependent, 'independent','class = "inputbox" size = "1"','id','name', $attribut->independent);
	    
		$view=&$this->getView("attributes_edit", 'html');
		$view->assign('attribut', $attribut);
        $view->assign('type_attribut', $type_attribut);
		$view->assign('dependent_attribut', $dependent_attribut);
        $view->assign('languages', $languages);
        $view->assign('multilang', $multilang);
        $view->display();
		
	}
	
	function save() {
	
        $db = &JFactory::getDBO(); 
		$attr_id = JRequest::getInt('attr_id');
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        
        $attribut = &JTable::getInstance('attribut', 'jshop');    
        $post = JRequest::get("post");
        
        $dispatcher->trigger( 'onBeforeSaveAttribut', array(&$post) );
        
        if (!$attr_id){
            $query = "SELECT MAX(attr_ordering) AS attr_ordering FROM `#__jshopping_attr`";
            $db->setQuery($query);
            $row = $db->loadObject();
            $post['attr_ordering'] = $row->attr_ordering + 1;
        }
        
        if (!$attribut->bind($post)) {
            JError::raiseWarning("",_JSHOP_ERROR_BIND);
            $this->setRedirect("index.php?option=com_jshopping&controller=attributes");
            return 0;
        }

        if (!$attribut->store()) {
            JError::raiseWarning("",_JSHOP_ERROR_SAVE_DATABASE);
            $this->setRedirect("index.php?option=com_jshopping&controller=attributes");
            return 0;
        }
        
        if (!$attr_id){
            $query="ALTER TABLE `#__jshopping_products_attr` ADD `attr_".$attribut->attr_id."` INT( 11 ) NOT NULL";
            $db->setQuery($query);
            $db->query();
            $attr_id = $attribut->attr_id;
        }
        
        
        $dispatcher->trigger( 'onAfterSaveAttribut', array(&$attribut) );
        
		if ($this->getTask()=='apply'){
            $this->setRedirect("index.php?option=com_jshopping&controller=attributes&task=edit&attr_id=".$attr_id); 
        }else{
            $this->setRedirect("index.php?option=com_jshopping&controller=attributes");
        }
        
	}
	
	function remove() {
		$cid = JRequest::getVar("cid");
        $jshopConfig = &JSFactory::getConfig();
		$db = &JFactory::getDBO();
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        
        $dispatcher->trigger( 'onBeforeRemoveAttribut', array(&$cid) );
        
		$text = '';
		foreach ($cid as $key => $value) {
            $value = intval($value);
			$query = "DELETE FROM `#__jshopping_attr` WHERE `attr_id` = '".$db->getEscaped($value)."'";
			$db->setQuery($query);
			$db->query();
            
            $query="ALTER TABLE `#__jshopping_products_attr` DROP `attr_".$value."`";
            $db->setQuery($query);
            $db->query();
            
            $query = "select * from `#__jshopping_attr_values` where `attr_id` = '".$db->getEscaped($value)."' ";
            $db->setQuery($query);
            $attr_values = $db->loadObjectList();
            foreach ($attr_values as $attr_val){
                @unlink($jshopConfig->image_attributes_path."/".$attr_val->image);
            }
            $query = "delete from `#__jshopping_attr_values` where `attr_id` = '".$db->getEscaped($value)."' ";
            $db->setQuery($query);
            $db->query();
                                                  
            $text = _JSHOP_ATTRIBUT_DELETED;
		}
        
        $dispatcher->trigger( 'onAfterRemoveAttribut', array(&$cid) );
        
		$this->setRedirect("index.php?option=com_jshopping&controller=attributes", $text);
	}
	
	function order() {
		$order = JRequest::getVar("order");
		$cid = JRequest::getInt("id");
		$number = JRequest::getInt("number");
		$db = &JFactory::getDBO();
		switch ($order) {
			case 'up':
				$query = "SELECT a.attr_id, a.attr_ordering
					   FROM `#__jshopping_attr` AS a
					   WHERE a.attr_ordering < '" . $number . "'
					   ORDER BY a.attr_ordering DESC
					   LIMIT 1";
				break;
			case 'down':
				$query = "SELECT a.attr_id, a.attr_ordering
					   FROM `#__jshopping_attr` AS a
					   WHERE a.attr_ordering > '" . $number . "'
					   ORDER BY a.attr_ordering ASC
					   LIMIT 1";
		}
		$db->setQuery($query);
		$row = $db->loadObject();
		$query1 = "UPDATE `#__jshopping_attr` AS a
					 SET a.attr_ordering = '" . $row->attr_ordering . "'
					 WHERE a.attr_id = '" . $cid . "'";
		$query2 = "UPDATE `#__jshopping_attr` AS a
					 SET a.attr_ordering = '" . $number . "'
					 WHERE a.attr_id = '" . $row->attr_id . "'";
		$db->setQuery($query1);
		$db->query();
		$db->setQuery($query2);
		$db->query();
		
		$this->setRedirect("index.php?option=com_jshopping&controller=attributes");
	}
      
}
?>