<?php
/**
* @version      2.9.4 31.07.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerOrderStatus extends JController{
    
    function __construct( $config = array() ){
        parent::__construct( $config );

        $this->registerTask( 'add',   'edit' );
        $this->registerTask( 'apply', 'save' );
        
        addSubmenu("other");
    }

	function display(){
		$_order = &$this->getModel("orders");
		$rows = $_order->getAllOrderStatus();

		$view=&$this->getView("orderstatus_list", 'html');		
        $view->assign('rows', $rows);        
		$view->display();
	}
	
	function edit() {
		$status_id = JRequest::getInt("status_id");
		$order_status = &JTable::getInstance('orderStatus', 'jshop');
		$order_status->load($status_id);
		$edit = ($status_id)?($edit = 1):($edit = 0);
        $_lang = &$this->getModel("languages");
        $languages = $_lang->getAllLanguages(1);
        $multilang = count($languages)>1;
        
        JFilterOutput::objectHTMLSafe( $order_status, ENT_QUOTES);

		$view=&$this->getView("orderstatus_edit", 'html');		
        $view->assign('order_status', $order_status);        
        $view->assign('edit', $edit);
        $view->assign('languages', $languages);
        $view->assign('multilang', $multilang);
		$view->display();
	}
	
	function save() {
	    $mainframe =& JFactory::getApplication();
		$status_id = JRequest::getInt("status_id");
		$order_status = &JTable::getInstance('orderStatus', 'jshop');
        $post = JRequest::get("post");
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeSaveOrderStatus', array(&$post) );
		if (!$order_status->bind($post)) {
			JError::raiseWarning("",_JSHOP_ERROR_BIND);
			$this->setRedirect("index.php?option=com_jshopping&controller=orderstatus");
			return 0;
		}
	
		if (!$order_status->store()) {
			JError::raiseWarning("",_JSHOP_ERROR_SAVE_DATABASE);
			$this->setRedirect("index.php?option=com_jshopping&controller=orderstatus");
			return 0;
		}
        
        $dispatcher->trigger( 'onAfterSaveOrderStatus', array(&$order_status) );
		
		if ($this->getTask()=='apply'){
            $this->setRedirect("index.php?option=com_jshopping&controller=orderstatus&task=edit&status_id=".$order_status->status_id); 
        }else{
            $this->setRedirect("index.php?option=com_jshopping&controller=orderstatus");
        }
		
	}
	
	function remove() {
		$db = &JFactory::getDBO();
		$text = '';
		$query = '';
		$cid = JRequest::getVar("cid");
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeRemoveOrderStatus', array(&$cid));
		foreach ($cid as $key => $value) {
			$query = "DELETE FROM `#__jshopping_order_status`
					   WHERE `status_id` = '" . $db->getEscaped($value) . "'; ";
			$db->setQuery($query);
			if ($db->query())
				$text .= _JSHOP_ORDER_STATUS_DELETED."<br>";
			else
				$text .= _JSHOP_ORDER_STATUS_ERROR_DELETED."<br>";
		}
        
        $dispatcher->trigger( 'onAfterRemoveOrderStatus', array(&$cid));
        
		$this->setRedirect("index.php?option=com_jshopping&controller=orderstatus", $text);
	} 
    
    
}

?>