<?php
/**
* @version      2.8.0 24.12.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

$session =& JFactory::getSession();
$shop_default_itemid = $session->get('shop_default_itemid');
$ajax = JRequest::getInt('ajax');

if (JRequest::getInt('Itemid') && !$shop_default_itemid){
	$session->set('shop_default_itemid', JRequest::getInt('Itemid'));
}

if ($GLOBALS["joomshoppinglangredirect"]){
    redirectToThisPageThisLang(); //redirect after change language
}

if (!JRequest::getInt('no_lang')){
    JSFactory::loadLanguageFile();
}
$jshopConfig = &JSFactory::getConfig();
setPrevSelLang($jshopConfig->cur_lang);
global $control1er;

//reload price for new currency
if (JRequest::getInt('id_currency')){
    updateAllprices();
    $back = JRequest::getVar('back');
    $mainframe =& JFactory::getApplication();
    if ($back!='') $mainframe->redirect($back);        
}

$user = &JFactory::getUser();

$js_update_all_price = $session->get('js_update_all_price');
$js_prev_user_id = $session->get('js_prev_user_id');
if ($js_update_all_price || ($js_prev_user_id!=$user->id)){
    updateAllprices();
    $session->set('js_update_all_price', 0);
}
$session->set("js_prev_user_id", $user->id);

if (!$ajax){
    installNewLanguages();
    JSFactory::loadCssFiles();
    JSFactory::loadJsFiles();
}else{
    //header for ajax
    header('Content-Type: text/html;charset=UTF-8');
}
?>