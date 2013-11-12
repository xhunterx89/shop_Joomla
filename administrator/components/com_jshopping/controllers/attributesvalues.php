<?php
/**
* @version      2.8.0 14.01.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access');
jimport('joomla.application.component.controller');

class JshoppingControllerAttributesValues extends JController{

    function __construct( $config = array() ){
        parent::__construct( $config );

        $this->registerTask( 'add',   'edit' );
        $this->registerTask( 'apply', 'save' );
        
        addSubmenu("other");
    }

    function display(){
		$attr_id = JRequest::getInt("attr_id");
		$db = &JFactory::getDBO();
        $jshopConfig = &JSFactory::getConfig();
        
		$attributValues = &$this->getModel("AttributValue");
		$rows = $attributValues->getAllValues($attr_id);
		$attribut = &$this->getModel("attribut");

		$attr_name = $attribut->getName($attr_id);
		$view=&$this->getView("attributesvalues_list", 'html');		
        $view->assign('rows', $rows);        
        $view->assign('attr_id', $attr_id);
        $view->assign('config', $jshopConfig);
        $view->assign('attr_name', $attr_name);
		$view->display(); 
	}
	
	function edit() {
		$value_id = JRequest::getInt("value_id");
		$attr_id = JRequest::getInt("attr_id");
        
		$jshopConfig = &JSFactory::getConfig();
		$db = &JFactory::getDBO();		
        
        $attributValue = &JTable::getInstance('attributValue', 'jshop');
        $attributValue->load($value_id);
        
        $_lang = &$this->getModel("languages");
        $languages = $_lang->getAllLanguages(1);
        $multilang = count($languages)>1;	
        
        JFilterOutput::objectHTMLSafe($attributValue, ENT_QUOTES);
		
		$view=&$this->getView("attributesvalues_edit", 'html');		
        $view->assign('attributValue', $attributValue);        
        $view->assign('attr_id', $attr_id);        
        $view->assign('config', $jshopConfig);
        $view->assign('languages', $languages);
        $view->assign('multilang', $multilang);        
		$view->display();
	}
    
	function save() {
        $jshopConfig = &JSFactory::getConfig();
        require_once ($jshopConfig->path.'lib/uploadfile.class.php');
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        
        $db = &JFactory::getDBO();
		$value_id = JRequest::getInt("value_id");
		$attr_id = JRequest::getInt("attr_id");
        
        $post = JRequest::get("post");
        $attributValue = &JTable::getInstance('attributValue', 'jshop');
        
        $dispatcher->trigger( 'onBeforeSaveAttributValue', array(&$post) );
        
        $upload = new UploadFile($_FILES['image']);
        $upload->setAllowFile(array('jpeg','jpg','gif','png'));
        $upload->setDir($jshopConfig->image_attributes_path);
        if ($upload->upload()){
            if ($post['old_image']){
                @unlink($jshopConfig->image_attributes_path . "/" . $post['old_image']);
            }
            $post['image'] = $upload->getName();
            @chmod($jshopConfig->image_attributes_path."/".$post['image'], 0777);
        }else{
            if ($upload->getError() != 4){
                JError::raiseWarning("", _JSHOP_ERROR_UPLOADING_IMAGE);
                saveToLog("error.log", "SaveAttributeValue - Error upload image. code: ".$upload->getError());
            }
        }
        
        if (!$value_id){
            $query = "SELECT MAX(value_ordering) AS value_ordering FROM `#__jshopping_attr_values` where attr_id='".$db->getEscaped($attr_id)."'";
            $db->setQuery($query);
            $row = $db->loadObject();
            $post['value_ordering'] = $row->value_ordering + 1;
        }
        
        if (!$attributValue->bind($post)) {
            JError::raiseWarning("",_JSHOP_ERROR_BIND);
            $this->setRedirect("index.php?option=com_jshopping&controller=attributesvalues&attr_id=".$attr_id);
            return 0;
        }
                
        if (!$attributValue->store()) {
            JError::raiseWarning("",_JSHOP_ERROR_SAVE_DATABASE);
            $this->setRedirect("index.php?option=com_jshopping&controller=attributesvalues&attr_id=".$attr_id);
            return 0;
        }
                
        $dispatcher->trigger( 'onAfterSaveAttributValue', array(&$attributValue) );
                
		if ($this->getTask()=='apply'){ 
            $this->setRedirect("index.php?option=com_jshopping&controller=attributesvalues&task=edit&attr_id=".$attr_id."&value_id=".$attributValue->value_id);
        }else{
            $this->setRedirect("index.php?option=com_jshopping&controller=attributesvalues&attr_id=".$attr_id);
        }
	}
	
	
	function remove(){
		$cid = JRequest::getVar("cid");
		$attr_id = JRequest::getInt("attr_id");
        $jshopConfig = &JSFactory::getConfig();
		$db = &JFactory::getDBO();
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        
        $dispatcher->trigger( 'onBeforeRemoveAttributValue', array(&$cid) );
        
		$text = '';
		foreach ($cid as $key => $value){
            $query = "SELECT image FROM `#__jshopping_attr_values` WHERE value_id = '" . $db->getEscaped($value) . "'";
            $db->setQuery($query);
            $image = $db->loadResult();
            @unlink($jshopConfig->image_attributes_path."/".$image);
            	
			$query = "DELETE FROM `#__jshopping_attr_values` WHERE `value_id` = '" . $db->getEscaped($value) . "'";
			$db->setQuery($query);
			$db->query();
			$text = _JSHOP_ATTRIBUT_VALUE_DELETED;
		}
        
        $dispatcher->trigger( 'onAfterRemoveAttributValue', array(&$cid) );
		
		$this->setRedirect("index.php?option=com_jshopping&controller=attributesvalues&attr_id=".$attr_id, $text);
	}
	
	
	function order() {
		$order = JRequest::getVar("order");
		$cid = JRequest::getInt("id");
		$number = JRequest::getInt("number");
		$attr_id = JRequest::getInt("attr_id");
		$db = &JFactory::getDBO();
		switch ($order) {
			case 'up':
				$query = "SELECT value_id, value_ordering FROM `#__jshopping_attr_values`					   
					   WHERE value_ordering < '" . $number . "' AND attr_id = '".$attr_id."' ORDER BY value_ordering DESC
					   LIMIT 1";
				break;
			case 'down':
				$query = "SELECT value_id, value_ordering FROM `#__jshopping_attr_values`					   
					   WHERE value_ordering > '" . $number . "' AND attr_id = '".$attr_id."' ORDER BY value_ordering ASC
					   LIMIT 1";
		}
		$db->setQuery($query);
		$row = $db->loadObject();
        
		$query1 = "UPDATE `#__jshopping_attr_values` SET value_ordering = '".$row->value_ordering."' WHERE value_id = '".$cid."'";
		$query2 = "UPDATE `#__jshopping_attr_values` SET value_ordering = '".$number."' WHERE value_id = '".$row->value_id."'";
        
		$db->setQuery($query1);
		$db->query();
		
		$db->setQuery($query2);
		$db->query();
		
		$this->setRedirect("index.php?option=com_jshopping&controller=attributesvalues&attr_id=".$attr_id, $text);
	}
    
    function back(){
        $this->setRedirect("index.php?option=com_jshopping&controller=attributes");
    }
    
    function delete_foto(){
        $jshopConfig = &JSFactory::getConfig();
        
        $id = JRequest::getInt("id");
        $attributValue = &JTable::getInstance('attributValue', 'jshop');
        $attributValue->load($id);
        @unlink($jshopConfig->image_attributes_path."/".$attributValue->image);
        $attributValue->image = "";
        $attributValue->store();
        die();               
    }    
}
?>