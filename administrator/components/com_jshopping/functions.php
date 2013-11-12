<?php
/**
* @version      3.2.0 10.02.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

function messageOutput($text,$class = 'jshop_red') {
    return '<span class = "' . $class . '">' . $text . '</span><br />';
}

function quickiconButton( $link, $image, $text ) {
    ?>
    <div style="float:left;">
        <div class="icon">
            <a href="<?php echo $link; ?>">
                <?php echo JHTML::_('image.site',  $image, '/components/com_jshopping/images/', NULL, NULL, $text ); ?>
                <span><?php echo $text; ?></span>
            </a>
        </div>
    </div>
    <?php
}

function getTemplates($type, $default){

    $name = $type."_template";
    $folder = $type;

    $jshopConfig = &JSFactory::getConfig();
    $temp = array();
    $dir = $jshopConfig->path."/templates/".$jshopConfig->template."/".$folder."/";
    $dh = opendir($dir);
    while (($file = readdir($dh)) !== false) {
        if (preg_match("/".$type."_(.*)\.php/", $file, $matches)){
            $temp[] = $matches[1];
        }
    }
    closedir($dh);
    $list = array();
    foreach($temp as $val){
        $list[] = JHTML::_('select.option', $val, $val, 'id', 'value');
    }
    
    return JHTML::_('select.genericlist', $list, $name,'class = "inputbox" size = "1"','id','value', $default);
}

function getShopTemplatesSelect($default){
    $jshopConfig = &JSFactory::getConfig();
    $temp = array();
    $dir = $jshopConfig->path."/templates/";
    $dh = opendir($dir);
    while (($file = readdir($dh)) !== false) {        
        if (is_dir($dir.$file) && $file!="." && $file!=".."){
            $temp[] = $file;
        }
    }
    closedir($dh);
    $list = array();
    foreach($temp as $val){
        $list[] = JHTML::_('select.option', $val, $val, 'id', 'value');
    }
    
    return JHTML::_('select.genericlist', $list, "template",'class = "inputbox" size = "1"','id','value', $default);
}

function getFileName($name) {
    // Get Extension
    $ext_file = strtolower(substr($name,strrpos($name,".")));
    // Generate name file
    $name_file = md5(uniqid(rand(),true));
    return $name_file . $ext_file;
}

function getMainCurrencyCode(){
    $jshopConfig = &JSFactory::getConfig();
    $currency =& JTable::getInstance('currency', 'jshop');
    $currency->load($jshopConfig->mainCurrency);
    return $currency->currency_code;
}

function updateCountExtTaxRule(){
    $db = &JFactory::getDBO();
    $query = "SELECT count(id) FROM `#__jshopping_taxes_ext`";
    $db->setQuery($query);
    $count = $db->loadResult();
    
    $query = "update #__jshopping_config set use_extend_tax_rule='".$count."' where id='1'";
    $db->setQuery($query);
    $db->query();
}

function updateCountConfigDisplayPrice(){
    $db = &JFactory::getDBO();
    $query = "SELECT count(id) FROM `#__jshopping_config_display_prices`";
    $db->setQuery($query);
    $count = $db->loadResult();
    
    $query = "update #__jshopping_config set use_extend_display_price_rule='".$count."' where id='1'";
    $db->setQuery($query);
    $db->query();
}

function orderBlocked($order){
    if (!$order->order_created && time()-strtotime($order->order_date)<3600){
        return 1;
    }else{
        return 0;
    }
}

function addSubmenu($vName){
    $user = & JFactory::getUser();
    JPluginHelper::importPlugin('jshoppingmenu');
    $dispatcher =& JDispatcher::getInstance();
    
    $adminaccess = $user->authorise('core.admin', 'com_jshopping');
    $installaccess = $user->authorise('core.admin.install', 'com_jshopping');
    
    $menu = array();
    $menu['categories'] = array(_JSHOP_MENU_CATEGORIES, 'index.php?option=com_jshopping&controller=categories&catid=0', $vName == 'categories', 1);
    $menu['products'] = array(_JSHOP_MENU_PRODUCTS, 'index.php?option=com_jshopping&controller=products&category_id=0', $vName == 'products', 1);
    $menu['orders'] = array( _JSHOP_MENU_ORDERS, 'index.php?option=com_jshopping&controller=orders', $vName == 'orders', 1);
    $menu['users'] = array(_JSHOP_MENU_CLIENTS, 'index.php?option=com_jshopping&controller=users', $vName == 'users', 1);
    $menu['other'] = array(_JSHOP_MENU_OTHER, 'index.php?option=com_jshopping&controller=other', $vName == 'other', 1);
    $menu['config'] = array( _JSHOP_MENU_CONFIG, 'index.php?option=com_jshopping&controller=config', $vName == 'config', $adminaccess );
    $menu['update'] = array(_JSHOP_PANEL_UPDATE, 'index.php?option=com_jshopping&controller=update', $vName == 'update', $installaccess );
    $menu['info'] = array(_JSHOP_MENU_INFO, 'index.php?option=com_jshopping&controller=info', $vName == 'info', 1);
    
    $dispatcher->trigger( 'onBeforeAdminMenuDisplay', array(&$menu, &$vName) );
    
    foreach($menu as $item){
        if ($item[3]){
            JSubMenuHelper::addEntry( $item[0], $item[1], $item[2]);
        }
    }
}

function displayMainPanelIco(){
    $user = & JFactory::getUser();
    JPluginHelper::importPlugin('jshoppingmenu');
    $dispatcher =& JDispatcher::getInstance();
    
    $adminaccess = $user->authorise('core.admin', 'com_jshopping');
    $installaccess = $user->authorise('core.admin.install', 'com_jshopping');
    
    $menu = array();
    $menu['categories'] = array(_JSHOP_MENU_CATEGORIES, 'index.php?option=com_jshopping&controller=categories&catid=0', 'jshop_categories_b.png', 1);
    $menu['products'] = array(_JSHOP_MENU_PRODUCTS, 'index.php?option=com_jshopping&controller=products&category_id=0', 'jshop_products_b.png', 1);
    $menu['orders'] = array( _JSHOP_MENU_ORDERS, 'index.php?option=com_jshopping&controller=orders', 'jshop_orders_b.png', 1);
    $menu['users'] = array(_JSHOP_MENU_CLIENTS, 'index.php?option=com_jshopping&controller=users', 'jshop_users_b.png', 1);
    $menu['other'] = array(_JSHOP_MENU_OTHER, 'index.php?option=com_jshopping&controller=other', 'jshop_options_b.png', 1);
    $menu['config'] = array( _JSHOP_MENU_CONFIG, 'index.php?option=com_jshopping&controller=config', 'jshop_configuration_b.png', $adminaccess );
    $menu['update'] = array(_JSHOP_PANEL_UPDATE, 'index.php?option=com_jshopping&controller=update', 'jshop_update_b.png', $installaccess );
    $menu['info'] = array(_JSHOP_MENU_INFO, 'index.php?option=com_jshopping&controller=info', 'jshop_info_b.png', 1);    
    
    $dispatcher->trigger( 'onBeforeAdminMainPanelIcoDisplay', array(&$menu) );
    
    foreach($menu as $item){
        if ($item[3]){
            quickiconButton($item[1], $item[2], $item[0]);            
        }
    }
}

function displayOptionPanelIco(){
    $jshopConfig = &JSFactory::getConfig();
    $user = & JFactory::getUser();
    JPluginHelper::importPlugin('jshoppingmenu');
    $dispatcher =& JDispatcher::getInstance();
    
    $adminaccess = $user->authorise('core.admin', 'com_jshopping');
    
    $menu = array();    
    $menu['manufacturers'] = array(_JSHOP_MENU_MANUFACTURERS, 'index.php?option=com_jshopping&controller=manufacturers', 'jshop_manufacturer_b.png', 1);
    $menu['coupons'] = array(_JSHOP_MENU_COUPONS, 'index.php?option=com_jshopping&controller=coupons', 'jshop_coupons_b.png', $jshopConfig->use_rabatt_code);
    $menu['currencies'] = array(_JSHOP_PANEL_CURRENCIES, 'index.php?option=com_jshopping&controller=currencies', 'jshop_currencies_b.png', 1);
    $menu['taxes'] = array(_JSHOP_PANEL_TAXES, 'index.php?option=com_jshopping&controller=taxes', 'jshop_taxes_b.png', 1);
    $menu['payments'] = array(_JSHOP_PANEL_PAYMENTS, 'index.php?option=com_jshopping&controller=payments', 'jshop_payments_b.png', ($adminaccess && $jshopConfig->without_payment==0));
    $menu['shippings'] = array(_JSHOP_PANEL_SHIPPINGS, 'index.php?option=com_jshopping&controller=shippings', 'jshop_shipping_b.png', ($adminaccess && $jshopConfig->without_shipping==0));
    $menu['shippingsprices'] = array(_JSHOP_PANEL_SHIPPINGS_PRICES, 'index.php?option=com_jshopping&controller=shippingsprices', 'jshop_shipping_price_b.png', ($adminaccess && $jshopConfig->without_shipping==0));    
    $menu['deliverytimes'] = array(_JSHOP_PANEL_DELIVERY_TIME, 'index.php?option=com_jshopping&controller=deliverytimes', 'jshop_time_delivery_b.png', $jshopConfig->admin_show_delivery_time);
    $menu['orderstatus'] = array(_JSHOP_PANEL_ORDER_STATUS, 'index.php?option=com_jshopping&controller=orderstatus', 'jshop_order_status_b.png', 1);
    $menu['countries'] = array(_JSHOP_PANEL_COUNTRIES, 'index.php?option=com_jshopping&controller=countries', 'jshop_country_list_b.png', 1);
    $menu['attributes'] = array(_JSHOP_PANEL_ATTRIBUTES, 'index.php?option=com_jshopping&controller=attributes', 'jshop_attributes_b.png', $jshopConfig->admin_show_attributes);
    $menu['freeattributes'] = array(_JSHOP_FREE_ATTRIBUTES, 'index.php?option=com_jshopping&controller=freeattributes', 'jshop_attributes_b.png', $jshopConfig->admin_show_freeattributes);
    $menu['units'] = array(_JSHOP_PANEL_UNITS_MEASURE, 'index.php?option=com_jshopping&controller=units', 'jshop_unit_b.png', $jshopConfig->admin_show_product_basic_price);
    $menu['usergroups'] = array(_JSHOP_PANEL_USERGROUPS, 'index.php?option=com_jshopping&controller=usergroups', 'jshop_user_groups_b.png', 1);
    $menu['vendors'] = array(_JSHOP_VENDORS, 'index.php?option=com_jshopping&controller=vendors', 'jshop_vendor_b.png', $jshopConfig->admin_show_vendors && $adminaccess);
    $menu['reviews'] = array(_JSHOP_PANEL_REVIEWS, 'index.php?option=com_jshopping&controller=reviews', 'jshop_reviews_b.png', $jshopConfig->allow_reviews_prod);
    $menu['productlabels'] = array(_JSHOP_PANEL_PRODUCT_LABELS, 'index.php?option=com_jshopping&controller=productlabels', 'jshop_label_b.png', $jshopConfig->admin_show_product_labels);
    $menu['productfields'] = array(_JSHOP_PANEL_PRODUCT_EXTRA_FIELDS, 'index.php?option=com_jshopping&controller=productfields', 'jshop_charac_b.png', $jshopConfig->admin_show_product_extra_field);
    $menu['languages'] = array(_JSHOP_PANEL_LANGUAGES, 'index.php?option=com_jshopping&controller=languages', 'jshop_languages_b.png', $jshopConfig->admin_show_languages && $adminaccess);
    $menu['importexport'] = array(_JSHOP_PANEL_IMPORT_EXPORT, 'index.php?option=com_jshopping&controller=importexport', 'jshop_import_export_b.png', 1);
    $menu['statistic'] = array(_JSHOP_STATISTIC, 'index.php?option=com_jshopping&controller=statistic', 'jshop_order_status_b.png', $adminaccess);
    
    $dispatcher->trigger( 'onBeforeAdminOptionPanelIcoDisplay', array(&$menu) );
    
    foreach($menu as $item){
        if ($item[3]){
            quickiconButton($item[1], $item[2], $item[0]);            
        }
    }
}

function getItemsOptionPanelMenu(){
    $jshopConfig = &JSFactory::getConfig();
    $user = & JFactory::getUser();
    JPluginHelper::importPlugin('jshoppingmenu');
    $dispatcher =& JDispatcher::getInstance();
    
    $adminaccess = $user->authorise('core.admin', 'com_jshopping');
    
    $menu = array();    
    $menu['manufacturers'] = array(_JSHOP_MENU_MANUFACTURERS, 'index.php?option=com_jshopping&controller=manufacturers', 'jshop_manufacturer_b.png', 1);
    $menu['coupons'] = array(_JSHOP_MENU_COUPONS, 'index.php?option=com_jshopping&controller=coupons', 'jshop_coupons_b.png', $jshopConfig->use_rabatt_code);
    $menu['currencies'] = array(_JSHOP_PANEL_CURRENCIES, 'index.php?option=com_jshopping&controller=currencies', 'jshop_currencies_b.png', 1);
    $menu['taxes'] = array(_JSHOP_PANEL_TAXES, 'index.php?option=com_jshopping&controller=taxes', 'jshop_taxes_b.png', 1);
    $menu['payments'] = array(_JSHOP_PANEL_PAYMENTS, 'index.php?option=com_jshopping&controller=payments', 'jshop_payments_b.png', ($adminaccess && $jshopConfig->without_payment==0));
    $menu['shippings'] = array(_JSHOP_PANEL_SHIPPINGS, 'index.php?option=com_jshopping&controller=shippings', 'jshop_shipping_b.png', ($adminaccess && $jshopConfig->without_shipping==0));
    $menu['shippingsprices'] = array(_JSHOP_PANEL_SHIPPINGS_PRICES, 'index.php?option=com_jshopping&controller=shippingsprices', 'jshop_shipping_price_b.png', ($adminaccess && $jshopConfig->without_shipping==0));    
    $menu['deliverytimes'] = array(_JSHOP_PANEL_DELIVERY_TIME, 'index.php?option=com_jshopping&controller=deliverytimes', 'jshop_time_delivery_b.png', $jshopConfig->admin_show_delivery_time);
    $menu['orderstatus'] = array(_JSHOP_PANEL_ORDER_STATUS, 'index.php?option=com_jshopping&controller=orderstatus', 'jshop_order_status_b.png', 1);
    $menu['countries'] = array(_JSHOP_PANEL_COUNTRIES, 'index.php?option=com_jshopping&controller=countries', 'jshop_country_list_b.png', 1);
    $menu['attributes'] = array(_JSHOP_PANEL_ATTRIBUTES, 'index.php?option=com_jshopping&controller=attributes', 'jshop_attributes_b.png', $jshopConfig->admin_show_attributes);
    $menu['freeattributes'] = array(_JSHOP_FREE_ATTRIBUTES, 'index.php?option=com_jshopping&controller=freeattributes', 'jshop_attributes_b.png', $jshopConfig->admin_show_freeattributes);
    $menu['units'] = array(_JSHOP_PANEL_UNITS_MEASURE, 'index.php?option=com_jshopping&controller=units', 'jshop_unit_b.png', $jshopConfig->admin_show_product_basic_price);
    $menu['usergroups'] = array(_JSHOP_PANEL_USERGROUPS, 'index.php?option=com_jshopping&controller=usergroups', 'jshop_user_groups_b.png', 1);
    $menu['vendors'] = array(_JSHOP_VENDORS, 'index.php?option=com_jshopping&controller=vendors', 'jshop_vendor_b.png', $jshopConfig->admin_show_vendors && $adminaccess);
    $menu['reviews'] = array(_JSHOP_PANEL_REVIEWS, 'index.php?option=com_jshopping&controller=reviews', 'jshop_reviews_b.png', $jshopConfig->allow_reviews_prod);
    $menu['productlabels'] = array(_JSHOP_PANEL_PRODUCT_LABELS, 'index.php?option=com_jshopping&controller=productlabels', 'jshop_label_b.png', $jshopConfig->admin_show_product_labels);
    $menu['productfields'] = array(_JSHOP_PANEL_PRODUCT_EXTRA_FIELDS, 'index.php?option=com_jshopping&controller=productfields', 'jshop_charac_b.png', $jshopConfig->admin_show_product_extra_field);
    $menu['languages'] = array(_JSHOP_PANEL_LANGUAGES, 'index.php?option=com_jshopping&controller=languages', 'jshop_languages_b.png', $jshopConfig->admin_show_languages && $adminaccess);
    $menu['importexport'] = array(_JSHOP_PANEL_IMPORT_EXPORT, 'index.php?option=com_jshopping&controller=importexport', 'jshop_import_export_b.png', 1);
    $menu['statistic'] = array(_JSHOP_STATISTIC, 'index.php?option=com_jshopping&controller=statistic', 'jshop_order_status_b.png', $adminaccess);
    
    $dispatcher->trigger( 'onBeforeAdminOptionPanelMenuDisplay', array(&$menu) );
    
    return $menu; 
}

function displayConfigPanelIco(){
    $jshopConfig = &JSFactory::getConfig();
    $user = & JFactory::getUser();
    JPluginHelper::importPlugin('jshoppingmenu');
    $dispatcher =& JDispatcher::getInstance();
    
    $menu = array();    
    $menu['general'] = array(_JSHOP_GENERAL_PARAMETERS, 'index.php?option=com_jshopping&controller=config&task=general', 'jshop_configuration_b.png', 1);
    $menu['catprod'] = array(_JSHOP_CAT_PROD, 'index.php?option=com_jshopping&controller=config&task=catprod', 'jshop_products_b.png', 1);
    $menu['checkout'] = array(_JSHOP_CHECKOUT, 'index.php?option=com_jshopping&controller=config&task=checkout', 'jshop_orders_b.png', 1);
    $menu['fieldregister'] = array(_JSHOP_REGISTER_FIELDS, 'index.php?option=com_jshopping&controller=config&task=fieldregister', 'jshop_country_list_b.png', 1);
    $menu['currency'] = array(_JSHOP_CURRENCY_PARAMETERS, 'index.php?option=com_jshopping&controller=config&task=currency', 'jshop_currencies_b.png', 1);
    $menu['image'] = array(_JSHOP_IMAGE_VIDEO_PARAMETERS, 'index.php?option=com_jshopping&controller=config&task=image', 'jshop_image_video_b.png', 1);
    $menu['statictext'] = array(_JSHOP_STATIC_TEXT, 'index.php?option=com_jshopping&controller=config&task=statictext', 'jshop_mein_page_b.png', 1);
    $menu['seo'] = array(_JSHOP_SEO, 'index.php?option=com_jshopping&controller=config&task=seo', 'jshop_languages_b.png', 1);
    $menu['storeinfo'] = array(_JSHOP_STORE_INFO, 'index.php?option=com_jshopping&controller=config&task=storeinfo', 'jshop_store_info_b.png', 1);
    $menu['adminfunction'] = array(_JSHOP_SHOP_FUNCTION, 'index.php?option=com_jshopping&controller=config&task=adminfunction', 'jshop_options_b.png', 1);                
    
    $dispatcher->trigger( 'onBeforeAdminConfigPanelIcoDisplay', array(&$menu) );
    
    foreach($menu as $item){
        if ($item[3]){
            quickiconButton($item[1], $item[2], $item[0]);            
        }
    }
}

function getItemsConfigPanelMenu(){
    $jshopConfig = &JSFactory::getConfig();
    $user = & JFactory::getUser();
    JPluginHelper::importPlugin('jshoppingmenu');
    $dispatcher =& JDispatcher::getInstance();
    
    $menu = array();    
    $menu['general'] = array(_JSHOP_GENERAL_PARAMETERS, 'index.php?option=com_jshopping&controller=config&task=general', 'jshop_configuration_b.png', 1);
    $menu['catprod'] = array(_JSHOP_CAT_PROD, 'index.php?option=com_jshopping&controller=config&task=catprod', 'jshop_products_b.png', 1);
    $menu['checkout'] = array(_JSHOP_CHECKOUT, 'index.php?option=com_jshopping&controller=config&task=checkout', 'jshop_orders_b.png', 1);
    $menu['fieldregister'] = array(_JSHOP_REGISTER_FIELDS, 'index.php?option=com_jshopping&controller=config&task=fieldregister', 'jshop_country_list_b.png', 1);
    $menu['currency'] = array(_JSHOP_CURRENCY_PARAMETERS, 'index.php?option=com_jshopping&controller=config&task=currency', 'jshop_currencies_b.png', 1);
    $menu['image'] = array(_JSHOP_IMAGE_VIDEO_PARAMETERS, 'index.php?option=com_jshopping&controller=config&task=image', 'jshop_image_video_b.png', 1);
    $menu['statictext'] = array(_JSHOP_STATIC_TEXT, 'index.php?option=com_jshopping&controller=config&task=statictext', 'jshop_mein_page_b.png', 1);
    $menu['seo'] = array(_JSHOP_SEO, 'index.php?option=com_jshopping&controller=config&task=seo', 'jshop_languages_b.png', 1);
    $menu['storeinfo'] = array(_JSHOP_STORE_INFO, 'index.php?option=com_jshopping&controller=config&task=storeinfo', 'jshop_store_info_b.png', 1);
    $menu['adminfunction'] = array(_JSHOP_SHOP_FUNCTION, 'index.php?option=com_jshopping&controller=config&task=adminfunction', 'jshop_options_b.png', 1);                
    
    $dispatcher->trigger( 'onBeforeAdminConfigPanelMenuDisplay', array(&$menu) );
    
    return $menu;
}


function checkAccessController($name){
    $mainframe =& JFactory::getApplication();
    $user = & JFactory::getUser();
    
    $adminaccess = $user->authorise('core.admin', 'com_jshopping');
    $installaccess = $user->authorise('core.admin.install', 'com_jshopping');
    
    if ($name=="config"){
        if (!$adminaccess) {
            $mainframe->redirect('index.php', JText::_('ALERTNOTAUTH'));
            return 0;
        }
    }
    
    if ($name=="languages"){
        if (!$adminaccess) {
            $mainframe->redirect('index.php', JText::_('ALERTNOTAUTH'));
            return 0;
        }
    }
    if ($name=="payments"){
        if (!$adminaccess) {
            $mainframe->redirect('index.php', JText::_('ALERTNOTAUTH'));
            return 0;
        }
    }
    if ($name=="shippings"){
        if (!$adminaccess) {
            $mainframe->redirect('index.php', JText::_('ALERTNOTAUTH'));
            return 0;
        }
    }
    if ($name=="shippingsprices"){
        if (!$adminaccess) {
            $mainframe->redirect('index.php', JText::_('ALERTNOTAUTH'));
            return 0;
        }
    }
    if ($name=="vendors"){
        if (!$adminaccess) {
            $mainframe->redirect('index.php', JText::_('ALERTNOTAUTH'));
            return 0;
        }
    }
    if ($name=="statistic"){
        if (!$adminaccess) {
            $mainframe->redirect('index.php', JText::_('ALERTNOTAUTH'));
            return 0;
        }
    }
    if ($name=="update"){
        if (!$installaccess) {
            $mainframe->redirect('index.php', JText::_('ALERTNOTAUTH'));
            return 0;
        }
    }    
    
}

function getIdVendorForCUser(){
static $id;
$jshopConfig = &JSFactory::getConfig();

    if (!$jshopConfig->admin_show_vendors) return 0;
    if (!isset($id)){
        $user = & JFactory::getUser();
        $adminaccess = $user->authorise('core.admin', 'com_jshopping');
        if ($adminaccess){
            $id = 0;    
        }else{
            $vendors = &JModel::getInstance("vendors", "JshoppingModel");    
            $id = $vendors->getIdVendorForUserId($user->id);
        }
    }
    return $id; 
}

function checkAccessVendorToProduct($id_vendor_cuser, $product_id){
    $mainframe =& JFactory::getApplication();
    $product =& JTable::getInstance('product', 'jshop');
    $product->load($product_id);
    if ($product->vendor_id!=$id_vendor_cuser){
        $mainframe->redirect('index.php', JText::_('ALERTNOTAUTH'));
        return 0;
    }
}

?>