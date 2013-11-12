<?php
/**
* @version      3.0.0 12.01.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die('Restricted access');
error_reporting(E_ALL & ~E_NOTICE);

$adminlang = &JFactory::getLanguage();
if(file_exists(JPATH_SITE . '/administrator/components/com_jshopping/lang/' . $adminlang->getTag() . '.php')) {
	require_once (JPATH_SITE . '/administrator/components/com_jshopping/lang/' . $adminlang->getTag() . '.php');
} else {
	require_once (JPATH_SITE . '/administrator/components/com_jshopping/lang/en-GB.php');
}

require_once (JPATH_SITE.'/components/com_jshopping/lib/jtableauto.php');
require_once (JPATH_SITE.'/components/com_jshopping/lib/multilangfield.php');
require_once (JPATH_SITE.'/components/com_jshopping/tables/config.php');
require_once (JPATH_SITE.'/components/com_jshopping/lib/factory.php');
require_once (JPATH_SITE.'/components/com_jshopping/lib/functions.php');

$params = JComponentHelper::getParams('com_languages');
$frontend_lang = $params->get('site','en-GB');

$query = 'SELECT email FROM #__users AS U LEFT JOIN #__user_usergroup_map AS UM ON UM.user_id = U.id WHERE UM.group_id = "8" ORDER BY U.id';
$db->setQuery( $query );
$email_admin = $db->loadResult();
        
$db = &JFactory::getDBO();
$config = new jshopConfig($db);
$config->id = 1;
$config->adminLanguage = $adminlang->getTag();
$config->defaultLanguage = $frontend_lang;
if ($email_admin){
    $config->contact_email = $email_admin;
}
$config->securitykey = md5($email_admin.time().JPATH_SITE);
$config->store();

$session =& JFactory::getSession();
$checkedlanguage = array();
$session->set("jshop_checked_language", $checkedlanguage);

installNewLanguages("en-GB", 0);

@chmod(JPATH_SITE . '/components/com_jshopping/files', 0755);

@mkdir(JPATH_SITE . '/components/com_jshopping/files/img_manufs', 0755);
@mkdir(JPATH_SITE . '/components/com_jshopping/files/demo_products', 0755);
@mkdir(JPATH_SITE . '/components/com_jshopping/files/img_attributes', 0755);    
@mkdir(JPATH_SITE . '/components/com_jshopping/files/pdf_orders', 0755);	

@chmod(JPATH_SITE . '/components/com_jshopping/files/img_manufs', 0755);
@chmod(JPATH_SITE . '/components/com_jshopping/files/img_categories', 0755);
@chmod(JPATH_SITE . '/components/com_jshopping/files/img_products', 0755);
@chmod(JPATH_SITE . '/components/com_jshopping/files/img_labels', 0755);
@chmod(JPATH_SITE . '/components/com_jshopping/files/video_products', 0755);
@chmod(JPATH_SITE . '/components/com_jshopping/files/files_products', 0755);
@chmod(JPATH_SITE . '/components/com_jshopping/files/importexport', 0755);
@chmod(JPATH_SITE . '/components/com_jshopping/files/importexport/simpleexport', 0755);
@chmod(JPATH_SITE . '/components/com_jshopping/files/importexport/simpleimport', 0755);
?>