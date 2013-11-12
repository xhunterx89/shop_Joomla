<?php
/**
* @version      2.8.0 20.02.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die('Restricted access');
error_reporting(E_ALL & ~E_NOTICE);
JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');
jimport('joomla.application.component.model'); 
JModel::addIncludePath(JPATH_COMPONENT.DS.'models');
require_once (JPATH_COMPONENT_SITE."/lib/factory.php");
require_once (JPATH_COMPONENT_SITE.'/lib/functions.php');
require("loadparams.php");

$controller = JRequest::getCmd('controller');
if (!$controller) $controller = "category";

if (file_exists(JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php'))
    require_once( JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php' );
else
    JError::raiseError( 403, JText::_('Access Forbidden') );    

$classname = 'JshoppingController'.$controller;
$controller = new $classname();
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
$control1er->display();
?>