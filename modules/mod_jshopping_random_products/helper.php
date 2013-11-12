<?php
/**
* @package Joomla
* @author Dmitry Stashenko
* @website http://nevigen.eu/
* @email support@nevigen.eu
* @copyright Copyright by Nevigen Ltd. All rights reserved.
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
**/

defined( '_JEXEC' ) or die;

require_once (JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS."lib".DS."factory.php"); 
require_once (JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS."lib".DS."functions.php");        
   
$db = &JFactory::getDBO();
$jshopConfig = &JSFactory::getConfig();
$jshopConfig->cur_lang = $jshopConfig->frontend_lang;
?>