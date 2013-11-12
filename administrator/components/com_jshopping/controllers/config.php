<?php
/**
* @version      2.9.4 22.07.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerConfig extends JController{
    
    function __construct( $config = array() ){
        parent::__construct( $config );
        $this->registerTask( 'apply', 'save' );
        $this->registerTask( 'applyseo', 'saveseo' );
        $this->registerTask( 'applystatictext', 'savestatictext' );
        checkAccessController("config");
        addSubmenu("config");        
    }

    function display(){
        
        $jshopConfig = &JSFactory::getConfig();        
        $current_currency = &JTable::getInstance('currency', 'jshop');
        $current_currency->load($jshopConfig->mainCurrency);
        if ($current_currency->currency_value!=1){
            JError::raiseWarning("",_JSHOP_ERROR_MAIN_CURRENCY_VALUE);    
        }
               
        $view=&$this->getView("configpanel", 'html'); 
        $view->display();
    }
    
    function general(){
    
	    $jshopConfig = &JSFactory::getConfig();
		$db = &JFactory::getDBO();
        $lists['languages'] = JHTML::_('select.genericlist', getAllLanguages(), 'defaultLanguage', '', 'language', 'name', $jshopConfig->defaultLanguage);
        
        $display_price_list = array();
        $display_price_list[] = JHTML::_('select.option', 0, _JSHOP_PRODUCT_BRUTTO_PRICE, 'id', 'name');
        $display_price_list[] = JHTML::_('select.option', 1, _JSHOP_PRODUCT_NETTO_PRICE, 'id', 'name');
        
        $lists['display_price_admin'] = JHTML::_('select.genericlist', $display_price_list, 'display_price_admin', '', 'id', 'name', $jshopConfig->display_price_admin);
        $lists['display_price_front'] = JHTML::_('select.genericlist', $display_price_list, 'display_price_front', '', 'id', 'name', $jshopConfig->display_price_front);
        
        $lists['template'] = getShopTemplatesSelect($jshopConfig->template);
         
    	$view=&$this->getView("config", 'html');
        $view->setLayout("general");
		$view->assign("lists", $lists);
        $view->display();
    }
    
    function catprod(){
        $jshopConfig = &JSFactory::getConfig();
        
        $catsort = array();
        $catsort[] = JHTML::_('select.option', 1, _JSHOP_SORT_MANUAL, 'id','value');
        $catsort[] = JHTML::_('select.option', 2, _JSHOP_SORT_ALPH, 'id','value');
        $lists['category_sorting'] = JHTML::_('select.genericlist', $catsort, 'category_sorting','','id','value', $jshopConfig->category_sorting);
        
        $sortd = array();
        $sortd[] = JHTML::_('select.option', 0, _JSHOP_A_Z, 'id','value');
        $sortd[] = JHTML::_('select.option', 1, _JSHOP_Z_A, 'id','value');
        $lists['product_sorting_direction'] = JHTML::_('select.genericlist', $sortd, 'product_sorting_direction','','id','value', $jshopConfig->product_sorting_direction);
        
        $select = array();        
        foreach ($jshopConfig->sorting_products_name_select as $key => $value) {
            $select[] = JHTML::_('select.option', $key, $value, 'id', 'value');            
        }
        $lists['product_sorting'] = JHTML::_('select.genericlist',$select, "product_sorting", '', 'id','value', $jshopConfig->product_sorting);
        
        if ($jshopConfig->admin_show_product_extra_field){
            $_productfields = &$this->getModel("productFields");
            $rows = $_productfields->getList();
            if ($jshopConfig->product_list_display_extra_fields!=""){
                $selected = unserialize($jshopConfig->product_list_display_extra_fields);
            }else{
                $selected = array();
            }
            $lists['product_list_display_extra_fields'] = JHTML::_('select.genericlist', $rows, "product_list_display_extra_fields[]", ' size="10" multiple = "multiple" ', 'id','name', $jshopConfig->getProductListDisplayExtraFields() );
            $lists['filter_display_extra_fields'] = JHTML::_('select.genericlist', $rows, "filter_display_extra_fields[]", ' size="10" multiple = "multiple" ', 'id','name', $jshopConfig->getFilterDisplayExtraFields() );
            $lists['product_hide_extra_fields'] = JHTML::_('select.genericlist', $rows, "product_hide_extra_fields[]", ' size="10" multiple = "multiple" ', 'id','name', $jshopConfig->getProductHideExtraFields() );
        }
            
        $view=&$this->getView("config", 'html');
        $view->setLayout("categoryproduct");
        $view->assign("lists", $lists);
        $view->display();
    }
    
    function checkout(){  
         
        $jshopConfig = &JSFactory::getConfig();
        $_orders = &$this->getModel("orders");
        $order_status = $_orders->getAllOrderStatus();
        $lists['status'] = JHTML::_('select.genericlist', $order_status,'default_status_order','class = "inputbox" size = "1"','status_id','name', $jshopConfig->default_status_order);   
        
        $currency_code = getMainCurrencyCode();
        
        $_countries = &$this->getModel("countries");
        $countries = $_countries->getAllCountries(0);    
        $first = JHTML::_('select.option', 0,_JSHOP_SELECT,'country_id','name' );
        array_unshift($countries,$first);
        $lists['default_country'] = JHTML::_('select.genericlist', $countries, 'default_country','class = "inputbox" size = "1"','country_id','name', $jshopConfig->default_country);
        
        $vendor_order_message_type = array();
        $vendor_order_message_type[] = JHTML::_('select.option', 0, _JSHOP_NOT_SEND_MESSAGE, 'id', 'name' );
        $vendor_order_message_type[] = JHTML::_('select.option', 1, _JSHOP_WE_SEND_MESSAGE, 'id', 'name' );
        $vendor_order_message_type[] = JHTML::_('select.option', 2, _JSHOP_WE_SEND_ORDER, 'id', 'name' );
        $lists['vendor_order_message_type'] = JHTML::_('select.genericlist', $vendor_order_message_type, 'vendor_order_message_type','class = "inputbox" size = "1"','id','name', $jshopConfig->vendor_order_message_type);
        
        $view=&$this->getView("config", 'html');
        $view->setLayout("checkout");
        $view->assign("lists", $lists); 
        $view->assign("currency_code", $currency_code);
        $view->display();
    }

    function fieldregister(){
        $jshopConfig = &JSFactory::getConfig();
        $view = &$this->getView("config", 'html');
        $view->setLayout("fieldregister");
        
        include($jshopConfig->path.'lib/static_config.php');

        $current_fields = $jshopConfig->getListFieldsRegister();
        $view->assign("fields", $fields_client);
        $view->assign("current_fields", $current_fields);
        $view->assign("fields_sys", $fields_client_sys);
        $view->display();
    }

    function adminfunction(){
        $jshopConfig = &JSFactory::getConfig();
        
        $shop_register_type = array();
        $shop_register_type[] = JHTML::_('select.option', 0, "-", 'id', 'name' );
        $shop_register_type[] = JHTML::_('select.option', 1, _JSHOP_MEYBY_SKIP_REGISTRATION, 'id', 'name' );
        $shop_register_type[] = JHTML::_('select.option', 2, _JSHOP_WITHOUT_REGISTRATION, 'id', 'name' );
        $lists['shop_register_type'] = JHTML::_('select.genericlist', $shop_register_type, 'shop_user_guest','class = "inputbox" size = "1"','id','name', $jshopConfig->shop_user_guest);  
            
        $view=&$this->getView("config", 'html');
        $view->setLayout("adminfunction");
        $view->assign("lists", $lists);
        $view->display();
    }

    function currency(){
    	$jshopConfig = &JSFactory::getConfig();
		$db = &JFactory::getDBO();
		$_currencies = &$this->getModel("currencies");
		$currencies = $_currencies->getAllCurrencies();
		
		$lists['currencies'] = JHTML::_('select.genericlist', $currencies,'mainCurrency','class = "inputbox" size = "1"','currency_id','currency_name',$jshopConfig->mainCurrency);
		
		$i = 0;
		foreach ($jshopConfig->format_currency as $key => $value) {
			$currenc[$i]->id_cur = $key;
			$currenc[$i]->format = $value;
			$i++;
		}
		$lists['format_currency'] = JHTML::_('select.genericlist', $currenc,'currency_format','class = "inputbox" size = "1"','id_cur','format',$jshopConfig->currency_format);
				
        $view=&$this->getView("config", 'html');
        $view->setLayout("currency");
		$view->assign("lists", $lists);
        $view->display();
		
    }
    
    function image(){
        $jshopConfig = &JSFactory::getConfig();
        
        $resize_type = array();
        $resize_type[] = JHTML::_('select.option', 0, _JSHOP_CUT, 'id', 'name' );
        $resize_type[] = JHTML::_('select.option', 1, _JSHOP_FILL, 'id', 'name' );
        $resize_type[] = JHTML::_('select.option', 2, _JSHOP_STRETCH, 'id', 'name' );
        $select_resize_type = JHTML::_('select.genericlist', $resize_type, 'image_resize_type','class = "inputbox" size = "1"','id','name', $jshopConfig->image_resize_type);
    	
    	$view=&$this->getView("config", 'html');
        $view->setLayout("image");
        $view->assign("select_resize_type", $select_resize_type);
        $view->display();
    }
    
    function storeinfo(){
    	$jshopConfig = &JSFactory::getConfig();
    	$_countries = &$this->getModel("countries");
		$countries = $_countries->getAllCountries(0);	
	    $first = JHTML::_('select.option', 0,_JSHOP_SELECT,'country_id','name' );
		array_unshift($countries,$first);
		$lists['countries'] = JHTML::_('select.genericlist', $countries,'store_country','class = "inputbox" size = "1"','country_id','name',$jshopConfig->store_country);
		
    	$view=&$this->getView("config", 'html');
        $view->setLayout("storeinfo");
		$view->assign("lists", $lists); 
        $view->display();
    }
    
    function save(){

	    $jshopConfig = &JSFactory::getConfig();
		$tab = JRequest::getVar('tab');
		$db = &JFactory::getDBO();
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
		
		$post = JRequest::get("post");
        $dispatcher->trigger( 'onBeforeSaveConfig', array(&$post) );
	
        //general
		$array = array('display_price_admin', 'display_price_front','use_ssl','savelog','savelogpaymentdata');
		if ($tab == 1){
			foreach ($array as $key => $value) {
				if (!isset($post[$value])) $post[$value] = 0;
			}	
		}
        
        //category/product
        $array = array('show_buy_in_category','show_tax_in_product','show_tax_product_in_cart','show_plus_shipping_in_product','hide_product_not_avaible_stock','hide_buy_not_avaible_stock','show_sort_product','show_count_select_products','show_delivery_time','demo_type','product_show_manufacturer_logo','product_show_weight',
                       'product_attribut_first_value_empty', 'show_hits', 'allow_reviews_prod', 'allow_reviews_only_registered','hide_text_product_not_available','use_plugin_content', 'product_list_show_weight', 'product_list_show_manufacturer','show_product_code','product_list_show_min_price', 'show_product_list_filters',
                       'product_list_show_vendor','product_show_vendor','product_show_vendor_detail','product_show_button_back','product_list_show_product_code','radio_attr_value_vertical','attr_display_addprice','product_list_show_price_description','display_button_print');
        if ($tab == 6){
            foreach ($array as $key => $value) {
                if (!isset($post[$value])) $post[$value] = 0;
            }    
        }
        
        //case
        $array = array('hide_shipping_step', 'hide_payment_step', 'order_send_pdf_client','order_send_pdf_admin','hide_tax', 'show_registerform_in_logintemplate','sorting_country_in_alphabet','show_weight_order', 'discount_use_full_sum','show_cart_all_step_checkout',"show_product_code_in_cart",'show_return_policy_in_email_order',
                        'client_allow_cancel_order', 'admin_not_send_email_order_vendor_order','not_redirect_in_cart_after_buy','calcule_tax_after_discount');
        if ($tab == 7){
            foreach ($array as $key => $value) {
                if (!isset($post[$value])) $post[$value] = 0;
            }    
        }
        
        //shop function
        $array = array('without_shipping', 'without_payment', 'enable_wishlist', 'shop_user_guest','user_as_catalog', 'use_rabatt_code', 'admin_show_product_basic_price','admin_show_attributes','admin_show_delivery_time','admin_show_languages','use_different_templates_cat_prod','admin_show_product_video','admin_show_product_related','admin_show_product_files','admin_show_product_bay_price','admin_show_product_basic_price', 'admin_show_product_labels', 'admin_show_product_extra_field','admin_show_vendors','admin_show_freeattributes');
        if ($tab == 8){
            foreach ($array as $key => $value) {
                if (!isset($post[$value])) $post[$value] = 0;
            }
            
            $post['without_shipping'] = intval(!$post['without_shipping']);
            $post['without_payment'] = intval(!$post['without_payment']);
        }
        
        if ($tab == 9){
            include($jshopConfig->path.'lib/static_config.php');
                        
            foreach($fields_client_sys as $k=>$v){
                foreach($v as $v2){
                    $post['field'][$k][$v2]['require'] = 1;
                    $post['field'][$k][$v2]['display'] = 1;
                }
            }
            foreach($post['field'] as $k=>$v){
                foreach($v as $k2=>$v2){                    
                    if (!$post['field'][$k][$k2]['display']){
                        $post['field'][$k][$k2]['require'] = 0;    
                    }
                }
            }
                        
            $post['fields_register'] = serialize($post['field']);
        }

        if ($tab != 4){
		    $config = new jshopConfig($db);
		    $config->id = 1;
		    if(!$config->bind($post)) {
			    JError::raiseWarning("",_JSHOP_ERROR_BIND);
			    $this->setRedirect('index.php?option=com_jshopping&controller=config');
			    return 0;
		    }
            
            if ($tab==6 && $jshopConfig->admin_show_product_extra_field){
                $config->setProductListDisplayExtraFields($post['product_list_display_extra_fields']);
                $config->setFilterDisplayExtraFields($post['filter_display_extra_fields']);
                $config->setProductHideExtraFields($post['product_hide_extra_fields']);
            }
		    
		    $config->transformPdfParameters();				
        	    
		    if (!$config->store()) {
			    JError::raiseWarning("",_JSHOP_ERROR_SAVE_DATABASE." ".$config->_error);
			    $this->setRedirect('index.php?option=com_jshopping&controller=config');
			    return 0;
		    }            
        }
		
		if (isset($_FILES['header'])){
			if ($_FILES['header'][size]){
				@unlink($jshopConfig->path . "images/header.jpg");
				move_uploaded_file( $_FILES['header']['tmp_name'],$jshopConfig->path . "images/header.jpg");	
			}
		}
	
		if (isset($_FILES['footer'])){
			if ($_FILES['footer'][size]){
				@unlink($jshopConfig->path . "images/footer.jpg");
				move_uploaded_file( $_FILES['footer']['tmp_name'],$jshopConfig->path . "images/footer.jpg");
			}	
		}
        
        if ($tab==6 && $post['update_count_prod_rows_all_cats']){
            $count_products_to_page = intval($post['count_products_to_page']);
            $count_products_to_row = intval($post['count_products_to_row']);
            $query = "update `#__jshopping_categories` set `products_page`='".$count_products_to_page."', `products_row`='".$count_products_to_row."'";
            $db->setQuery($query);
            $db->query();
            $query = "update `#__jshopping_manufacturers` set `products_page`='".$count_products_to_page."', `products_row`='".$count_products_to_row."'";
            $db->setQuery($query);
            $db->query();
        }
                
        $dispatcher->trigger( 'onAfterSaveConfig', array() );
        
        if ($this->getTask()=='apply'){            
            switch ($tab){
                case 1: $task = "general"; break;
                case 2: $task = "currency"; break;
                case 3: $task = "image"; break;
                case 5: $task = "storeinfo"; break;
                case 6: $task = "catprod"; break;
                case 7: $task = "checkout"; break;
                case 8: $task = "adminfunction"; break;
                case 9: $task = "fieldregister"; break;
            }
            $this->setRedirect('index.php?option=com_jshopping&controller=config&task='.$task, _JSHOP_CONFIG_SUCCESS);
        }else{
		    $this->setRedirect('index.php?option=com_jshopping&controller=config', _JSHOP_CONFIG_SUCCESS);
        }
    }
    
    function seo(){
        $jshopConfig = &JSFactory::getConfig();
        $_seo = &$this->getModel("seo");
        $rows = $_seo->getList();    
        
        $view=&$this->getView("config", 'html');
        $view->setLayout("listseo");
        $view->assign("rows", $rows); 
        $view->displayListSeo();    
    }
    
    function seoedit(){
        $jshopConfig = &JSFactory::getConfig();
        $db = &JFactory::getDBO();        
        $id = JRequest::getInt("id");
        
        $seo = &JTable::getInstance("seo","jshop");
        $seo->load($id);
        
        $_lang = &$this->getModel("languages");
        $languages = $_lang->getAllLanguages(1);
        $multilang = count($languages)>1;
        
        $nofilter = array();
        JFilterOutput::objectHTMLSafe( $seo, ENT_QUOTES, $nofilter);
        
        $view=&$this->getView("config", 'html');
        $view->setLayout("editseo");        
        $view->assign('row', $seo);
        $view->assign('languages', $languages);
        $view->assign('multilang', $multilang);
        $view->displayEditSeo();
    }
    
    function saveseo(){
        $jshopConfig = &JSFactory::getConfig();
        $db = &JFactory::getDBO();        
        $id = JRequest::getInt("id");
        $post = JRequest::get("post");
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeSaveConfigSeo', array(&$post) );
        
        $seo = &JTable::getInstance("seo","jshop");
        $seo->load($id);
        $seo->bind($post);        
        if (!$id){
            $seo->ordering = null;
            $seo->ordering = $seo->getNextOrder();            
        }        
        $seo->store($post);
              
        $dispatcher->trigger( 'onAfterSaveConfigSeo', array(&$seo) );
        
        if ($this->getTask()=='applyseo'){            
            $this->setRedirect('index.php?option=com_jshopping&controller=config&task=seoedit&id='.$seo->id, _JSHOP_CONFIG_SUCCESS);
        }else{            
            $this->setRedirect('index.php?option=com_jshopping&controller=config&task=seo', _JSHOP_CONFIG_SUCCESS);
        }
    }
    
    function statictext(){
        $jshopConfig = &JSFactory::getConfig();
        $_statictext = &$this->getModel("statictext");
        $rows = $_statictext->getList();    
        
        $view=&$this->getView("config", 'html');
        $view->setLayout("liststatictext");
        $view->assign("rows", $rows); 
        $view->displayListStatictext();    
    }
    
    function statictextedit(){
        $jshopConfig = &JSFactory::getConfig();
        $db = &JFactory::getDBO();        
        $id = JRequest::getInt("id");
        
        $statictext = &JTable::getInstance("statictext","jshop");
        $statictext->load($id);
        
        $_lang = &$this->getModel("languages");
        $languages = $_lang->getAllLanguages(1);
        $multilang = count($languages)>1;
        
        $nofilter = array();
        JFilterOutput::objectHTMLSafe( $statictext, ENT_QUOTES, $nofilter);
        
        $view=&$this->getView("config", 'html');
        $view->setLayout("editstatictext");        
        $view->assign('row', $statictext);
        $view->assign('languages', $languages);
        $view->assign('multilang', $multilang);
        $view->displayEditStatictext();
    }
    
    function savestatictext(){
        $jshopConfig = &JSFactory::getConfig();
        $db = &JFactory::getDBO();        
        $id = JRequest::getInt("id");
        $post = JRequest::get("post");
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        
        $dispatcher->trigger( 'onBeforeSaveConfigStaticPage', array(&$post) );
        
        $_lang = &$this->getModel("languages");
        $languages = $_lang->getAllLanguages(1);
        
        foreach($languages as $lang){
            $post['text_'.$lang->language] = JRequest::getVar('text'.$lang->id,'','post',"string", 2);
        }
        
        $statictext = &JTable::getInstance("statictext","jshop");
        $statictext->load($id);
        $statictext->bind($post);        
        $statictext->store($post);
                
        $dispatcher->trigger( 'onAfterSaveConfigStaticPage', array(&$statictext) );
        
        if ($this->getTask()=='applystatictext'){            
            $this->setRedirect('index.php?option=com_jshopping&controller=config&task=statictextedit&id='.$statictext->id, _JSHOP_CONFIG_SUCCESS);
        }else{            
            $this->setRedirect('index.php?option=com_jshopping&controller=config&task=statictext', _JSHOP_CONFIG_SUCCESS);
        }
    }
    
    
    function preview_pdf(){
		$jshopConfig = &JSFactory::getConfig();
        $jshopConfig->currency_code = "USD";
		require_once(JPATH_SITE . "/components/com_jshopping/lib/generete_pdf_order.php");
        $order = &JTable::getInstance('order', 'jshop');
        $order->firma_name = "Firma";
        $order->f_name = "Fname";
        $order->l_name = 'Lname';
        $order->street = 'Street';
        $order->zip = "Zip"; 
        $order->city = "City";
        $order->country = "Country";
        $order->order_number = outputDigit(0,8);
        $order->order_date = strftime($jshopConfig->store_date_format, mktime());
        $order->products = array();
        $prod = new stdClass();
        $prod->product_name = "Product name";
        $prod->product_ean = "12345678";
        $prod->product_quantity = 1;
        $prod->product_item_price = 125;
        $prod->product_tax = 19;
        $order->products[] = $prod;
        $order->order_subtotal = 125;
        $order->order_shipping = 20;        
        $display_price = $jshopConfig->display_price_front;
        if ($display_price==0){
            $order->display_price = 0;
            $order->order_tax_list = array(19 => 23.15);
            $order->order_total = 145;
        }else{
            $order->display_price = 1;
            $order->order_tax_list = array(19 => 27.55);
            $order->order_total = 172.55;
        }
        
		$order->pdf_file = generatePdf($order, $jshopConfig);
		header("Location: " . $jshopConfig->pdf_orders_live_path . "/" . $order->pdf_file);
		die();
	}
    
    function check_directory() {
        $directory = JRequest::getVar('directory');
        $jshopConfig = &JSFactory::getConfig();
        if (is_writable($jshopConfig->path . "/" . $directory)){
            print '{ "isWrite" : "1", "text" : "' . _JSHOP_WRITEABLE . '" }';
        }else{
            print '{ "isWrite" : "0", "text" : "' . _JSHOP_NON_WRITEABLE . '"}';
        }
        die();        
    }
    
    
    
}

?>