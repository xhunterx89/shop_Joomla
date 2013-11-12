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

class JshoppingControllerUserGroups extends JController{
    
    function __construct( $config = array() ){
        parent::__construct( $config );

        $this->registerTask( 'add',   'edit' );
        $this->registerTask( 'apply', 'save' );
        
        addSubmenu("other");
    }

    function display(){
        
		$usergroups = &$this->getModel("usergroups");
		$rows = $usergroups->getAllUsergroups();
		        
        $view=&$this->getView("usergroups_list", 'html'); 
        $view->assign("rows", $rows);
        $view->display();
    }
    
	function edit(){
		$usergroup_id = JRequest::getInt("usergroup_id");
		$usergroup = &JTable::getInstance('userGroup', 'jshop');
		$usergroup->load($usergroup_id);
	
        JFilterOutput::objectHTMLSafe( $usergroup, ENT_QUOTES, "usergroup_description");
        
		$view=&$this->getView("usergroups_edit", 'html'); 
        $view->assign("usergroup", $usergroup);
        $view->display();
	}
	
	function save(){
	    $mainframe =& JFactory::getApplication();
		$usergroup_id = JRequest::getInt("usergroup_id");
		$usergroup = &JTable::getInstance('userGroup', 'jshop');
		$usergroups = &$this->getModel("usergroups");        
        JPluginHelper::importPlugin('jshoppingadmin');        
		
        $post = JRequest::get("post");
        $post['usergroup_description'] = JRequest::getVar('usergroup_description','','post',"string",4);
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeSaveUserGroup', array(&$post) );
        
		if (!$usergroup->bind($post)) {
			JError::raiseWarning("", _JSHOP_ERROR_BIND);
			$this->setRedirect("index.php?option=com_jshopping&controller=usergroups");
		}
		if ($usergroup->usergroup_is_default){
			$default_usergroup_id = $usergroups->resetDefaultUsergroup();
		}

		if (!$usergroup->store()) {
			JError::raiseWarning("", _JSHOP_ERROR_SAVE_DATABASE);
			$usergroups->setDefaultUsergroup($default_usergroup_id);
			$this->setRedirect("index.php?option=com_jshopping&controller=usergroups");
		}
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onAfterSaveUserGroup', array(&$usergroup) );
        
		if ($this->getTask()=='apply'){
            $this->setRedirect("index.php?option=com_jshopping&controller=usergroups&task=edit&usergroup_id=".$usergroup->usergroup_id); 
        }else{
            $this->setRedirect("index.php?option=com_jshopping&controller=usergroups");
        }
		
	}
	
	function remove(){
		$cid = JRequest::getVar("cid");		
		$db = &JFactory::getDBO();
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeRemoveUserGroup', array(&$cid) );
		$text = "";
		foreach ($cid as $key=>$value){
			$query = "SELECT `usergroup_name` FROM `#__jshopping_usergroups` WHERE `usergroup_id` = '".$db->getEscaped($value)."'";
			$db->setQuery($query);
			$usergroup_name = $db->loadResult();			
			$query = "DELETE FROM `#__jshopping_usergroups` WHERE `usergroup_id` = '".$db->getEscaped($value)."'";
			$db->setQuery($query);
			if ($db->query()){
				$text .= sprintf(_JSHOP_USERGROUP_DELETED, $usergroup_name)."<br>"; 
			}			
		}
        $dispatcher->trigger( 'onAfterRemoveUserGroup', array(&$cid) );
        
		$this->setRedirect("index.php?option=com_jshopping&controller=usergroups", $text);		
	}
       
}
?>