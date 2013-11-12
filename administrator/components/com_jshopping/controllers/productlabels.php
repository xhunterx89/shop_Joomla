<?php
/**
* @version      2.9.4 06.08.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerProductLabels extends JController{
    
    function __construct( $config = array() ){
        parent::__construct( $config );

        $this->registerTask( 'add',   'edit' );
        $this->registerTask( 'apply', 'save' );
        
        addSubmenu("other");
    }

	function display(){
        $jshopConfig = &JSFactory::getConfig();
		$_productLabels = &$this->getModel("productLabels");
		$rows = $_productLabels->getList();
        
		$view=&$this->getView("product_labels_list", 'html');		
        $view->assign('rows', $rows);
        $view->assign('config', $jshopConfig);        
		$view->display();
	}
	
	function edit() {
        $jshopConfig = &JSFactory::getConfig();
		$id = JRequest::getInt("id");
		$productLabel = &JTable::getInstance('productLabel', 'jshop');
		$productLabel->load($id);
		$edit = ($id)?(1):(0);
        
        JFilterOutput::objectHTMLSafe( $productLabel, ENT_QUOTES);

		$view=&$this->getView("product_labels_edit", 'html');		
        $view->assign('productLabel', $productLabel);        
        $view->assign('config', $jshopConfig);        
        $view->assign('edit', $edit);        
		$view->display();
	}
	
	function save() {
        $mainframe =& JFactory::getApplication();
        $jshopConfig = &JSFactory::getConfig();
        require_once ($jshopConfig->path.'lib/uploadfile.class.php');
	    
		$id = JRequest::getInt("id");
		$productLabel = &JTable::getInstance('productLabel', 'jshop');
        $post = JRequest::get("post");
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeSaveProductLabel', array(&$post) );
        
        $upload = new UploadFile($_FILES['image']);
        $upload->setAllowFile(array('jpeg','jpg','gif','png'));
        $upload->setDir($jshopConfig->image_labels_path);
        $upload->setFileNameMd5(0);
        $upload->setFilterName(1);
        if ($upload->upload()){
            if ($post['old_image']){
                @unlink($jshopConfig->image_labels_path . "/" . $post['old_image']);
            }
            $post['image'] = $upload->getName();
            @chmod($jshopConfig->image_labels_path."/".$post['image'], 0777);
        }else{
            if ($upload->getError() != 4){
                JError::raiseWarning("", _JSHOP_ERROR_UPLOADING_IMAGE);
                saveToLog("error.log", "Label - Error upload image. code: ".$upload->getError());
            }
        }
        
		if (!$productLabel->bind($post)) {
			JError::raiseWarning("",_JSHOP_ERROR_BIND);
			$this->setRedirect("index.php?option=com_jshopping&controller=productlabels");
			return 0;
		}
	
		if (!$productLabel->store()) {
			JError::raiseWarning("",_JSHOP_ERROR_SAVE_DATABASE);
			$this->setRedirect("index.php?option=com_jshopping&controller=productlabels");
			return 0;
		}
        
        $dispatcher->trigger( 'onAfterSaveProductLabel', array(&$productLabel) );
		
		if ($this->getTask()=='apply'){
            $this->setRedirect("index.php?option=com_jshopping&controller=productlabels&task=edit&id=".$productLabel->id);
        }else{
            $this->setRedirect("index.php?option=com_jshopping&controller=productlabels");
        }	
	}
	
	function remove(){
        $jshopConfig = &JSFactory::getConfig();
		$db = &JFactory::getDBO();
		$text = array();
        $productLabel = &JTable::getInstance('productLabel', 'jshop');
		$cid = JRequest::getVar("cid");
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeRemoveProductLabel', array(&$cid) );
		foreach ($cid as $key => $value) {
            $productLabel->load($value);
            @unlink($jshopConfig->image_labels_path."/".$productLabel->image);
            $productLabel->delete();			
            $text[] = _JSHOP_ITEM_DELETED."<br>";			
		}
        $dispatcher->trigger( 'onAfterRemoveProductLabel', array(&$cid) );
        
		$this->setRedirect("index.php?option=com_jshopping&controller=productlabels", implode("</li><li>", $text));
	}
    
    function delete_foto(){
        $jshopConfig = &JSFactory::getConfig();
        $id = JRequest::getInt("id");
        $productLabel = &JTable::getInstance('productLabel', 'jshop');
        $productLabel->load($id);
        @unlink($jshopConfig->image_labels_path."/".$productLabel->image);
        $productLabel->image = "";
        $productLabel->store();
        die();               
    } 
    
}
?>