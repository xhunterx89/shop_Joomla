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
    
if (!file_exists(JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS.'jshopping.php')){
	JError::raiseError(500,"Please install component \"joomshopping\"");
} 

require_once (JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS."lib".DS."factory.php"); 
require_once (JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS."lib".DS."functions.php");        
JSFactory::loadCssFiles();
JSFactory::loadLanguageFile();
$jshopConfig = &JSFactory::getConfig();

$product = &JTable::getInstance('product', 'jshop');
$cat_str = $params->get('catids',NULL); 
$label_str = $params->get('labelid',NULL); 
if (is_array($cat_str)) {    
	$cat_arr = array();
	foreach($cat_str as $key=>$curr){
	   if (intval($curr)) $cat_arr[$key] = intval($curr);
	}  
} else {
	$cat_arr = array();
	if (intval($cat_str)) $cat_arr[] = intval($cat_str);
}
if ($label_str) {
	$filters['labels'][] = $label_str;
} else {
	$filters['labels'] = '';
}
$rand_prod = $product->getRandProducts($params->get('count_products', 5), $cat_arr, $filters);   
foreach($rand_prod as $key=>$value){
	$rand_prod[$key]->product_link = SEFLink('index.php?option=com_jshopping&controller=product&task=view&category_id='.$value->category_id.'&product_id='.$value->product_id, 1);
}
$noimage = "noimage.gif";
$show_image = $params->get('show_image',1);
require(JModuleHelper::getLayoutPath('mod_jshopping_random_products'));        
?>