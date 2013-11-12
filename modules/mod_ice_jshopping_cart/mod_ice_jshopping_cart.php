<?php
/**
* @version      2.5.0 18.11.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');
error_reporting(E_ALL & ~E_NOTICE); 

if (!file_exists(JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS.'jshopping.php')){
    JError::raiseError(500,"Please install component \"joomshopping\"");
}
$document = &JFactory::getDocument();
$document->addStyleSheet(JURI::base().'modules/mod_ice_jshopping_cart/assets/style.css');

jimport('joomla.application.component.model');

require_once (JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS."lib".DS."factory.php"); 
require_once (JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS."lib".DS."functions.php");        
JSFactory::loadCssFiles();
JSFactory::loadLanguageFile();
$jshopConfig = &JSFactory::getConfig();
JModel::addIncludePath(JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS.'models');
$cart = &JModel::getInstance('cart', 'jshop');
$cart->load("cart");
require(JModuleHelper::getLayoutPath('mod_ice_jshopping_cart')); 
$dropdown = $params->get('dropdown',1);
$ajax = $params->get('ajax',1);
if($ajax == 1){
?>
<script language="javascript">
jQuery(document).ready(function($){
	var ajax_url = "<?php echo JURI::base()."modules/mod_ice_jshopping_cart/ajax.php";?>";
	jQuery('.buttons a').click(function(){
		var href = jQuery(this).attr('href');
		if(href.indexOf('add') > 0){
			jQuery("body").append('<div class="lofloadding"><div class="loadddingicon" style="height:100px"></div></div>');
			var height = jQuery(window).height();
			if ( $('#ice-top').length ){
				var idDiv = 'ice-top';
			}else{
				var idDiv = 'jshop_module_cart';
			}
			$('html, body').animate({
			  scrollTop: $("#" + idDiv).offset().top
			}, 500);
			
			jQuery.ajax({
				type: "POST",
				url: ajax_url+"?time="+Math.random(),
				data: "durl="+ href+"&task=add"+"&dropdown="+<?php echo $dropdown; ?>,
				success: function(msg){
				  	jQuery(".lofloadding").remove('.lofloadding, .loadddingicon');
					endStr  = msg.indexOf('<div class="lof_jshop_top">');
					fullstr = msg.length;
					msg = msg.substr(endStr,fullstr - endStr);
					jQuery('#jshop_module_cart').html(msg);
				}
			});
			return false;
		}
	});
	jQuery('.buttons .button').click(function(){
		if(jQuery('#to').val() == "cart"){
			jQuery("body").append('<div class="lofloadding"><div class="loadddingicon"></div></div>');
			var allValue = $('form[name="product"]').serialize();
			if ( $('#ice-top').length ){
				var idDiv = 'ice-top';
			}else{
				var idDiv = 'jshop_module_cart';
			}
			$('html, body').animate({
			  scrollTop: $("#" + idDiv).offset().top
			}, 500);
			jQuery.ajax({
				type: "POST",
				url: ajax_url+"?time="+Math.random(),
				data : allValue+"&task=add"+"&dropdown="+<?php echo $dropdown; ?>,
				success: function(msg){
					jQuery(".lofloadding").remove('.lofloadding, .loadddingicon');
					endStr  = msg.indexOf('<div class="lof_jshop_top">');
					fullstr = msg.length;
					msg = msg.substr(endStr,fullstr - endStr);
					
					jQuery('#jshop_module_cart').html(msg);
				}
			});
			return false;
		}
	});
	
});
</script>
<?php } ?>