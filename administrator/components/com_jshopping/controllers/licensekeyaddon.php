<?php
/**
* @version      2.7.3 20.01.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerLicenseKeyAddon extends JController{
    
    function __construct( $config = array() ){
        parent::__construct( $config );

        $this->registerTask( 'add',   'edit' );
        $this->registerTask( 'apply', 'save' );
        
        addSubmenu("other");        
    }

	function display(){
        $alias = JRequest::getVar("alias");
		$back = JRequest::getVar("back");
		$addon = &JTable::getInstance('addon', 'jshop');
		$addon->loadAlias($alias);		

		$view = &$this->getView("addonkey", 'html');
        $view->assign('row', $addon);
        $view->assign('back', $back);
		$view->display();
	}
	
	function save() {
        $addon = &JTable::getInstance('addon', 'jshop');
        $post = JRequest::get("post");
		if (!$addon->bind($post)) {
			JError::raiseWarning("",_JSHOP_ERROR_BIND);
			$this->setRedirect("index.php?option=com_jshopping");
			return 0;
		}
	
		if (!$addon->store()) {
			JError::raiseWarning("",_JSHOP_ERROR_SAVE_DATABASE);
			$this->setRedirect("index.php?option=com_jshopping");
			return 0;
		}
		
        $this->setRedirect(base64_decode($post['back']));
	}
    
    function cancel(){
        $post = JRequest::get("post");
        $this->setRedirect(base64_decode($post['back']));
    }
}
?>