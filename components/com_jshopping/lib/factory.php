<?php
/**
* @version      2.9.3 22.07.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

JTable::addIncludePath(JPATH_ROOT.DS.'components'.DS.'com_jshopping'.DS.'tables');
include_once(JPATH_ROOT . "/components/com_jshopping/lib/jtableauto.php");
include_once(JPATH_ROOT . "/components/com_jshopping/lib/multilangfield.php");
include_once(JPATH_ROOT . "/components/com_jshopping/tables/config.php");

class JSFactory{
    
    function &getConfig(){
    static $config;
        if (!is_object($config)){
                        
            $db = &JFactory::getDBO();
            $config = new jshopConfig($db);
            $config->load("1");
            $config->loadCurrencyValue();
            
            $params = JComponentHelper::getParams('com_languages');
            $frontend_lang = $params->get('site', 'en-GB');
            $config->frontend_lang = $frontend_lang;
            
            $lang = &JFactory::getLanguage();
            $config->cur_lang = $lang->getTag();
            
            $config->path = JPATH_ROOT . "/components/com_jshopping/";
            $config->admin_path = JPATH_ROOT . '/administrator/components/com_jshopping/';
            
            $config->live_path = JURI::root() . 'components/com_jshopping/';
            $config->live_admin_path = JURI::root() . 'administrator/components/com_jshopping/';
            
            $config->log_path = JPATH_ROOT . "/components/com_jshopping/log/";
            
            $config->importexport_live_path = $config->live_path . "files/importexport/";
            $config->importexport_path = $config->path . "files/importexport/";

            $config->image_category_live_path = $config->live_path . "files/img_categories";
            $config->image_category_path = $config->path . "files/img_categories";

            $config->image_product_live_path = $config->live_path . "files/img_products";
            $config->image_product_path = $config->path . "files/img_products";
            
            $config->image_manufs_live_path = $config->live_path . "files/img_manufs";
            $config->image_manufs_path = $config->path . "files/img_manufs";

            $config->video_product_live_path = $config->live_path . "files/video_products";
            $config->video_product_path = $config->path . "files/video_products";
                        
            $config->demo_product_live_path = $config->live_path. "files/demo_products";
            $config->demo_product_path = $config->path . "files/demo_products";
            
            $config->files_product_live_path = $config->live_path. "files/files_products";
            $config->files_product_path = $config->path . "files/files_products";
            
            $config->pdf_orders_live_path = $config->live_path . "files/pdf_orders";
            $config->pdf_orders_path = $config->path . "files/pdf_orders";
            
            $config->image_attributes_live_path = $config->live_path . "files/img_attributes";
            $config->image_attributes_path = $config->path . "files/img_attributes";
            
            $config->image_labels_live_path = $config->live_path . "files/img_labels";
            $config->image_labels_path = $config->path . "files/img_labels";
            
            $config->image_vendors_live_path = $config->live_path . "files/img_vendors";
            $config->image_vendors_path = $config->path . "files/img_vendors";
                        
            $config->thousand_separator = (!$config->thousand_separator)?(" "):($config->thousand_separator);

            list($config->pdf_header_width, $config->pdf_header_height, $config->pdf_footer_width, $config->pdf_footer_height) = explode(":", $config->pdf_parameters);
            $config->pdf_header_width = ($config->pdf_header_width > 208) ? (208) : (intval($config->pdf_header_width));
            $config->pdf_footer_width = ($config->pdf_footer_width > 208) ? (208) : (intval($config->pdf_footer_width));

            include(dirname(__FILE__)."/static_config.php");

            $config->user_field_client_type = $c_user_field_client_type;
            $config->arr['title'] = $c_array_title;
            $config->sorting_products_field_select = $c_sorting_products_field_select;
            $config->sorting_products_name_select =  $c_sorting_products_name_select;
            $config->sorting_products_field_s_select = $c_sorting_products_field_s_select;
            $config->sorting_products_name_s_select =  $c_sorting_products_name_s_select;
            $config->format_currency = $c_format_currency;
            $config->count_product_select = $c_count_product_select;
            $config->payment_status_enable_download_sale_file = $c_payment_status_enable_download_sale_file; 
            $config->payment_status_return_product_in_stock = $c_payment_status_return_product_in_stock; 
            $config->max_number_download_sale_file = $c_max_number_download_sale_file;
            $config->payment_status_for_cancel_client = $c_payment_status_for_cancel_client;
            $config->payment_status_disable_cancel_client = $c_payment_status_disable_cancel_client;
            
            if (!$config->allow_reviews_prod){
                unset($config->sorting_products_field_select[5]);
                unset($config->sorting_products_name_select[5]);
                unset($config->sorting_products_field_s_select[5]);
                unset($config->sorting_products_name_s_select[5]);
            }

            if ($config->product_count_related_in_row<1) $config->product_count_related_in_row = 1;

            $config->product_price_qty_discount = 2; // (1 - price, 2 - percent)
            $config->rating_starparts = 2; //star is divided to {2} part

            if ($config->user_as_catalog){
                $config->show_buy_in_category = 0;
            }

            if ($config->hide_product_not_avaible_stock || $config->hide_buy_not_avaible_stock){
                $config->controler_buy_qty = 1;
            }else{
                $config->controler_buy_qty = 0;
            }
            
            $config->use_simple_sef = 0;
            $config->show_list_price_shipping_weight = 0;
                                    
            $config->display_price_front_current = $config->getDisplayPriceFront();// 0 - Brutto, 1 - Netto
            
            if ($config->template==""){
                $config->template = "default";
            }
                        
            if ($config->show_product_code || $config->show_product_code_in_cart){
                $config->show_product_code_in_order = 1;
            }else{
                $config->show_product_code_in_order = 0;
            }
            
            if ($config->admin_show_vendors==0){
                $config->vendor_order_message_type = 0; //0 - none, 1 - mesage, 2 - order if not multivendor
                $config->admin_not_send_email_order_vendor_order = 0;
                $config->product_show_vendor = 0;
                $config->product_show_vendor_detail = 0;
            }
            
            $config->image_quality = 100;
            $config->image_fill_color = 0xffffff;
            
            if ($config->image_resize_type==0){
                $config->image_cut = 1;
                $config->image_fill = 2;
            }elseif ($config->image_resize_type==1){
                $config->image_cut = 0;
                $config->image_fill = 2;
            }else{
                $config->image_cut = 0;
                $config->image_fill = 0;                
            }
            
        }
    return $config;
    }
    
    function &getUserShop(){
    static $usershop;
        if (!is_object($usershop)){
            $user = &JFactory::getUser();
            $db = &JFactory::getDBO();
            require_once(JPATH_ROOT . "/components/com_jshopping/tables/usershop.php");
            $usershop = new jshopUserShop($db);
            if($user->id){
                if(!$usershop->isUserInShop($user->id)) {
                    $usershop->addUserToTableShop($user);
                }                
                $usershop->load($user->id);
                $usershop->percent_discount = $usershop->getDiscount();
            }else{
                $usershop->percent_discount = 0;
            }
        }
    return $usershop;    
    }
    
    function &getUserShopGuest(){
    static $userguest;
        if (!is_object($userguest)){
            require_once(JPATH_ROOT . "/components/com_jshopping/models/userguest.php");
            $userguest = new jshopUserGust();
            $userguest->load();
            $userguest->percent_discount = 0;
        }
    return $userguest;
    }
    
    function loadCssFiles(){
    static $load;
        if (!$load){
            $document =& JFactory::getDocument();
            $jshopConfig = &JSFactory::getConfig();
            $document->addCustomTag('<link type = "text/css" rel = "stylesheet" href = "'.JURI::root().'components/com_jshopping/css/'.$jshopConfig->template.'.css" />');
            $load = 1;
        }
    }
    
    function loadJsFiles(){
    static $load;
        if (!$load){
            $document =& JFactory::getDocument();
            $document->addCustomTag('<script type = "text/javascript" src = "'.JURI::root().'components/com_jshopping/js/jquery/jquery-1.6.2.min.js"></script>');
            $document->addCustomTag('<script type = "text/javascript">jQuery.noConflict();</script>');
            $document->addCustomTag('<script type = "text/javascript" src = "'.JURI::root().'components/com_jshopping/js/jquery/jquery.media.js"></script>');
            $document->addCustomTag('<script type = "text/javascript" src = "'.JURI::root().'components/com_jshopping/js/functions.js"></script>');
            $document->addCustomTag('<script type = "text/javascript" src = "'.JURI::root().'components/com_jshopping/js/validateForm.js"></script>');
            $load = 1;
        }
    }
    
    function loadJsFilesRating(){
    static $load;
        if (!$load){
            $document =& JFactory::getDocument();
            $document->addCustomTag('<script type = "text/javascript" src = "'.JURI::root().'components/com_jshopping/js/jquery/jquery.MetaData.js"></script>');
            $document->addCustomTag('<script type = "text/javascript" src = "'.JURI::root().'components/com_jshopping/js/jquery/jquery.rating.pack.js"></script>');
            $document->addCustomTag('<link type = "text/css" rel = "stylesheet" href = "'.JURI::root().'components/com_jshopping/css/jquery.rating.css" />');      
            $load = 1;
        }
    }
    
    function loadJsFilesLightBox(){
    static $load;
        if (!$load){
            $document =& JFactory::getDocument();
            $document->addCustomTag('<script type = "text/javascript" src = "'.JURI::root().'components/com_jshopping/js/jquery/jquery.lightbox-0.5.pack.js"></script>');
            $document->addCustomTag('<link type = "text/css" rel = "stylesheet" href = "'.JURI::root().'components/com_jshopping/css/jquery.lightbox-0.5.css" media="screen" />');
            $document->addCustomTag('<script type = "text/javascript">jQuery(function() {
                jQuery("a.lightbox").lightBox({
                        imageLoading: "'.JURI::root().'components/com_jshopping/images/loading.gif",
                        imageBtnClose: "'.JURI::root().'components/com_jshopping/images/close.gif",
                        imageBtnPrev: "'.JURI::root().'components/com_jshopping/images/prev.gif",
                        imageBtnNext: "'.JURI::root().'components/com_jshopping/images/next.gif"
                    });
                });</script>');
            $load = 1;
        }
    }
    
    function loadLanguageFile($langtag = ""){
        $lang = &JFactory::getLanguage();
        if ($langtag==""){
            $langtag = $lang->getTag();
        }
        if(file_exists(JPATH_ROOT . '/components/com_jshopping/lang/'.$langtag.'.php'))
            require_once (JPATH_ROOT . '/components/com_jshopping/lang/'.$langtag.'.php');
        else 
            require_once (JPATH_ROOT . '/components/com_jshopping/lang/en-GB.php');
    }
    
    function loadExtLanguageFile($extname, $langtag = ""){
        $lang = &JFactory::getLanguage();
        if ($langtag==""){
            $langtag = $lang->getTag();
        }
        if(file_exists(JPATH_ROOT . '/components/com_jshopping/lang/'.$extname.'/'.$langtag.'.php'))
            require_once (JPATH_ROOT . '/components/com_jshopping/lang/'.$extname.'/'.$langtag.'.php');
        else 
            require_once (JPATH_ROOT . '/components/com_jshopping/lang/'.$extname.'/en-GB.php');
    }
    
    function loadAdminLanguageFile($langtag = ""){
        $lang = &JFactory::getLanguage();
        if ($langtag==""){
            $langtag = $lang->getTag();
        }
        if(file_exists(JPATH_ROOT . '/administrator/components/com_jshopping/lang/'.$langtag.'.php'))
            require_once (JPATH_ROOT . '/administrator/components/com_jshopping/lang/'.$langtag.'.php');
        else 
            require_once (JPATH_ROOT . '/administrator/components/com_jshopping/lang/en-GB.php');            
    }
    
    function loadExtAdminLanguageFile($extname, $langtag = ""){
        $lang = &JFactory::getLanguage();
        if ($langtag==""){
            $langtag = $lang->getTag();
        }
        if(file_exists(JPATH_ROOT . '/administrator/components/com_jshopping/lang/'.$extname.'/'.$langtag.'.php'))
            require_once (JPATH_ROOT . '/administrator/components/com_jshopping/lang/'.$extname.'/'.$langtag.'.php');
        else 
            require_once (JPATH_ROOT . '/administrator/components/com_jshopping/lang/'.$extname.'/en-GB.php');
    }
       
    function &getLang($langtag = ""){
    static $ml;
        if (!is_object($ml)){
            $jshopConfig = &JSFactory::getConfig();
            $ml = new multiLangField();
            if ($langtag==""){
                $langtag = $jshopConfig->cur_lang;
            }
            $ml->setLang($langtag);
        }
    return $ml;
    }
    
    function &getReservedFirstAlias(){
    static $alias;
        if (!is_array($alias)){
            jimport('joomla.filesystem.folder');
            $files = JFolder::files(JPATH_ROOT."/components/com_jshopping/controllers");
            $alias = array();
            foreach($files as $file){
                $alias[] = str_replace(".php","", $file);
            }
        }
    return $alias;
    }
    
    function &getAliasCategory(){
    static $alias;
        if (!is_array($alias)){
            $db = &JFactory::getDBO();
            $lang = &JSFactory::getLang();
            $dbquery = "select category_id as id, `".$lang->get('alias')."` as alias from #__jshopping_categories where `".$lang->get('alias')."`!=''"; 
            $db->setQuery($dbquery);
            $rows = $db->loadObjectList();
            $alias = array();
            foreach($rows as $row){
                $alias[$row->id] = $row->alias;
            }
            unset($rows);
        }
    return $alias;
    }
    
    function &getAliasManufacturer(){
    static $alias;
        if (!is_array($alias)){            
            $db = &JFactory::getDBO();
            $lang = &JSFactory::getLang();            
            $dbquery = "select manufacturer_id as id, `".$lang->get('alias')."` as alias from #__jshopping_manufacturers where `".$lang->get('alias')."`!=''";
            $db->setQuery($dbquery);
            $rows = $db->loadObjectList();
            $alias = array();
            foreach($rows as $row){
                $alias[$row->id] = $row->alias;
            }
            unset($rows);
        }
    return $alias;
    }
    
    function &getAliasProduct(){
    static $alias;
        if (!is_array($alias)){            
            $db = &JFactory::getDBO();
            $lang = &JSFactory::getLang();
            $dbquery = "select product_id as id, `".$lang->get('alias')."` as alias from #__jshopping_products where `".$lang->get('alias')."`!=''"; 
            $db->setQuery($dbquery);
            $rows = $db->loadObjectList();
            $alias = array();
            foreach($rows as $row){
                $alias[$row->id] = $row->alias;
                unset($rows[$k]);
            }
            unset($rows);
        }
    return $alias;
    }
    
    function &getAllAttributes($resformat = 0){
    static $attributes;
        if (!is_array($attributes)){
            $_attrib = &JTable::getInstance("attribut","jshop");    
            $attributes = $_attrib->getAllAttributes();
        }
        if ($resformat==0){
            return $attributes;    
        }
        if ($resformat==1){
            $attributes_format1 = array();
            foreach($attributes as $v){
                $attributes_format1[$v->attr_id] = $v;
            }
            return $attributes_format1;
        }
        if ($resformat==2){
            $attributes_format2 = array();
            $attributes_format2['independent']= array();
            $attributes_format2['dependent']= array();
            foreach($attributes as $v){
                if ($v->independent) $key_dependent = "independent"; else $key_dependent = "dependent";
                $attributes_format2[$key_dependent][$v->attr_id] = $v;
            }
            return $attributes_format2;
        }
    }
    
    function &getAllUnits(){
    static $rows;
        if (!is_array($rows)){
            $_unit = &JTable::getInstance("unit","jshop");    
            $rows = $_unit->getAllUnits();
        }
    return $rows;
    }
    
    function &getAllTaxes(){
    static $rows;
        if (!is_array($rows)){
            $jshopConfig = &JSFactory::getConfig();
            $_tax = &JTable::getInstance('tax', 'jshop');
            $_rows = $_tax->getAllTaxes();
            $rows = array();
            foreach($_rows as $row){
                $rows[$row->tax_id] = $row->tax_value;
            }
            unset($_rows);
            if ($jshopConfig->use_extend_tax_rule){
                $country_id = 0;
                $adv_user = &JSFactory::getUserShop();
                $country_id = $adv_user->country;
                $client_type = $adv_user->client_type;
                if (!$country_id){
                    $adv_user = &JSFactory::getUserShopGuest();
                    $country_id = $adv_user->country;
                    $client_type = $adv_user->client_type;
                }
                if ($country_id){
                    $_rowsext = $_tax->getExtTaxes();
                    foreach($_rowsext as $v){
                        if (in_array($country_id, $v->countries)){
                            if ($client_type==2){
                                $rows[$v->tax_id] = $v->firma_tax;
                            }else{
                                $rows[$v->tax_id] = $v->tax;
                            }
                        }
                    }
                    unset($_rowsext);
                }
            }
        }
    return $rows;
    }
    
    function &getAllManufacturer(){
    static $rows;
        if (!is_array($rows)){
            $db = &JFactory::getDBO();
            $lang = &JSFactory::getLang();
            $query = "select manufacturer_id as id, `".$lang->get('name')."` as name, manufacturer_logo, manufacturer_url from #__jshopping_manufacturers where manufacturer_publish='1'";
            $db->setQuery($query);
            $_rows = $db->loadObjectList();
            $rows = array();
            foreach($_rows as $row){
                $rows[$row->id] = $row;
            }
            unset($_rows);
        }
    return $rows;
    }
    
    function &getMainVendor(){
    static $row;
        if (!isset($row)){
            $jshopConfig = &JSFactory::getConfig();
            $row = new stdClass();
            $row->id = 0;
            $row->shop_name = $jshopConfig->store_name;            
            $row->l_name = $jshopConfig->contact_firstname;
            $row->f_name = $jshopConfig->contact_lastname;
            $row->company_name = $jshopConfig->store_company_name;
            $row->url = $jshopConfig->store_url;
            $row->logo = $jshopConfig->store_logo;            
            $row->adress = $jshopConfig->store_address;
            $row->city = $jshopConfig->store_city;
            $row->zip = $jshopConfig->store_zip;    
            $row->state = $jshopConfig->store_state;
            $row->country = $jshopConfig->store_country;
            $row->phone = $jshopConfig->contact_phone;
            $row->fax = $jshopConfig->contact_fax;
            $row->email = $jshopConfig->store_email;            
        }
    return $row;
    }
    
    function &getAllVendor(){
    static $rows;
        if (!is_array($rows)){
            $jshopConfig = &JSFactory::getConfig();
            $db = &JFactory::getDBO();            
            $query = "select id, shop_name, l_name, f_name from #__jshopping_vendors";
            $db->setQuery($query);
            $_rows = $db->loadObjectList();
            $rows = array();
            $mainvendor = &JSFactory::getMainVendor();
            $rows[0] = $mainvendor;
            foreach($_rows as $row){
                $rows[$row->id] = $row;
            }
            unset($_rows);
        }
    return $rows;
    }
    
    function &getAllDeliveryTime(){
    static $rows;
        if (!is_array($rows)){
            $db = &JFactory::getDBO();
            $lang = &JSFactory::getLang();
            $query = "select id, `".$lang->get('name')."` as name from #__jshopping_delivery_times";
            $db->setQuery($query);
            $_rows = $db->loadObjectList();
            $rows = array();
            foreach($_rows as $row){
                $rows[$row->id] = $row->name;
            }
            unset($_rows);
        }
    return $rows;
    }
    
    function &getAllProductExtraField(){
    static $list;
        if (!is_array($list)){            
            $productfield =& JTable::getInstance('productfield', 'jshop');
            $list = $productfield->getList();
        }
    return $list;
    }
    
    function &getAllProductExtraFieldValue(){
    static $list;
        if (!is_array($list)){            
            $productfieldvalue =& JTable::getInstance('productfieldvalue', 'jshop');
            $list = $productfieldvalue->getAllList(1);
        }
    return $list;
    }
    
    function &getAllProductExtraFieldValueDetail(){
    static $list;
        if (!is_array($list)){            
            $productfieldvalue =& JTable::getInstance('productfieldvalue', 'jshop');
            $list = $productfieldvalue->getAllList(2);
        }
    return $list;
    }
    

    function &getDisplayListProductExtraFieldForCategory($cat_id){
    static $listforcat;
        if (!isset($listforcat[$cat_id])){
            $fields = array();
            $list = &JSFactory::getAllProductExtraField();
            foreach($list as $val){
                if ($val->allcats){
                    $fields[] = $val->id;
                }else{
                    if (in_array($cat_id, $val->cats)) $fields[] = $val->id;
                }
            }
            
            $jshopConfig = &JSFactory::getConfig();
            $config_list = $jshopConfig->getProductListDisplayExtraFields();
            foreach($fields as $k=>$val){
                if (!in_array($val, $config_list)) unset($fields[$k]);
            }
            $listforcat[$cat_id] = $fields;
        }
    return $listforcat[$cat_id];
    }
    
    function &getDisplayFilterExtraFieldForCategory($cat_id){
    static $listforcat;
        if (!isset($listforcat[$cat_id])){
            $fields = array();
            $list = &JSFactory::getAllProductExtraField();
            foreach($list as $val){
                if ($val->allcats){
                    $fields[] = $val->id;
                }else{
                    if (in_array($cat_id, $val->cats)) $fields[] = $val->id;
                }
            }
            
            $jshopConfig = &JSFactory::getConfig();
            $config_list = $jshopConfig->getFilterDisplayExtraFields();
            foreach($fields as $k=>$val){
                if (!in_array($val, $config_list)) unset($fields[$k]);
            }
            $listforcat[$cat_id] = $fields;
        }
    return $listforcat[$cat_id];
    }
               
    
}

?>