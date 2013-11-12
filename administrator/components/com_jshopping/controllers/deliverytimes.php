<?php
/**
* @version      2.9.4 23.09.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerDeliveryTimes extends JController{
    
    function __construct( $config = array() ){
        parent::__construct( $config );

        $this->registerTask( 'add',   'edit' );
        $this->registerTask( 'apply', 'save' );
        
        addSubmenu("other");
    }

	function display(){
		$_deliveryTimes = &$this->getModel("deliveryTimes");
		$rows = $_deliveryTimes->getDeliveryTimes();
        
		$view=&$this->getView("deliverytimes_list", 'html');		
        $view->assign('rows', $rows);        
		$view->display();
	}
	
	function edit() {
		$id = JRequest::getInt("id");
		$deliveryTimes = &JTable::getInstance('deliveryTimes', 'jshop');
		$deliveryTimes->load($id);
		$edit = ($id)?(1):(0);
        $_lang = &$this->getModel("languages");
        $languages = $_lang->getAllLanguages(1);
        $multilang = count($languages)>1;
        
        JFilterOutput::objectHTMLSafe( $deliveryTimes, ENT_QUOTES);

		$view=&$this->getView("deliverytimes_edit", 'html');		
        $view->assign('deliveryTimes', $deliveryTimes);        
        $view->assign('edit', $edit);
        $view->assign('languages', $languages);
        $view->assign('multilang', $multilang);
		$view->display();
	}
	
	function save() {
	    $mainframe =& JFactory::getApplication();
		$id = JRequest::getInt("id");
		$deliveryTimes = &JTable::getInstance('deliveryTimes', 'jshop');
        $post = JRequest::get("post");
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeSaveDeliveryTime', array(&$post) );
        
		if (!$deliveryTimes->bind($post)) {
			JError::raiseWarning("",_JSHOP_ERROR_BIND);
			$this->setRedirect("index.php?option=com_jshopping&controller=deliverytimes");
			return 0;
		}
	
		if (!$deliveryTimes->store()) {
			JError::raiseWarning("",_JSHOP_ERROR_SAVE_DATABASE);
			$this->setRedirect("index.php?option=com_jshopping&controller=deliverytimes");
			return 0;
		}
        
        $dispatcher->trigger( 'onAfterSaveDeliveryTime', array(&$deliveryTimes) );
		
		if ($this->getTask()=='apply'){
            $this->setRedirect("index.php?option=com_jshopping&controller=deliverytimes&task=edit&id=".$deliveryTimes->id);
        }else{
            $this->setRedirect("index.php?option=com_jshopping&controller=deliverytimes");
        }	
	}
	
	function remove() {
		$db = &JFactory::getDBO();
		$text = array();
		$cid = JRequest::getVar("cid");
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeRemoveDeliveryTime', array(&$cid) );
        
		foreach ($cid as $key => $value) {
			$query = "DELETE FROM `#__jshopping_delivery_times` WHERE `id` = '" . $db->getEscaped($value) . "'";
			$db->setQuery($query);
			if ($db->query())
				$text[] = _JSHOP_DELIVERY_TIME_DELETED."<br>";
			else
				$text[] = _JSHOP_DELIVERY_TIME_DELETED_ERROR_DELETED."<br>";
		}
        
        $dispatcher->trigger( 'onAfterRemoveDeliveryTime', array(&$cid) );
        
		$this->setRedirect("index.php?option=com_jshopping&controller=deliverytimes", implode("</li><li>", $text));
	} 
    
    
}

?>