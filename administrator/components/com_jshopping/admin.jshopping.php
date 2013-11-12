<?php
/**
* @version      3.2.1 25.01.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die('Restricted access');

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_jshopping')) {
    return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

error_reporting(E_ALL & ~E_NOTICE);
JTable::addIncludePath(JPATH_COMPONENT_SITE.DS.'tables');
require_once (JPATH_COMPONENT_SITE."/lib/factory.php");
require_once (JPATH_COMPONENT_SITE.'/lib/functions.php');
require_once (JPATH_COMPONENT_ADMINISTRATOR.'/functions.php');

$ajax = JRequest::getInt('ajax');
$adminlang = &JFactory::getLanguage();
if (!JRequest::getVar("js_nolang")){
    JSFactory::loadAdminLanguageFile();
}

$db = &JFactory::getDBO();
$jshopConfig = &JSFactory::getConfig();
$jshopConfig->cur_lang = $jshopConfig->frontend_lang;

if ($jshopConfig->adminLanguage!=$adminlang->getTag()){
	$config = new jshopConfig($db);
	$config->id = 1;	
	$config->adminLanguage = $adminlang->getTag();
	if (!$config->store()) {
		JError::raiseWarning("",_JSHOP_ERROR_SAVE_DATABASE);
		return 0;
	}
}

if (!$ajax){
    installNewLanguages();
}else{
    //header for ajax
    header('Content-Type: text/html;charset=UTF-8');
}

$document =& JFactory::getDocument();
$document->addCustomTag('<script type = "text/javascript" src = "'.$jshopConfig->live_path.'js/jquery/jquery-1.6.2.min.js"></script>');
$document->addCustomTag('<script type = "text/javascript">jQuery.noConflict();</script>');
$document->addCustomTag('<script type = "text/javascript" src = "'.$jshopConfig->live_path.'js/functions.js"></script>');
$document->addCustomTag('<script type = "text/javascript" src = "'.$jshopConfig->live_admin_path.'js/functions.js"></script>');
$document->addCustomTag('<link rel = "stylesheet" type = "text/css" href = "'.$jshopConfig->live_admin_path.'css/style.css" />');

$controller = JRequest::getCmd( 'controller' );
if (!$controller) $controller = "panel";

if (file_exists(JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php'))
    require_once( JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php' );
else
    JError::raiseError( 403, JText::_('Access Forbidden') );    

$classname    = 'JshoppingController'.$controller;
$controller   = new $classname();
$controller->execute( JRequest::getCmd( 'task' ) );
$controller->redirect();

?>