<?php
/**
* @version      2.9.4 06.08.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerProducts extends JController{
    
    function __construct( $config = array() ){
        parent::__construct( $config );

        $this->registerTask( 'add',   'edit' );
        $this->registerTask( 'apply', 'save' );
        
        addSubmenu("products");
    }
    
    function display(){    
        $mainframe =& JFactory::getApplication();    
        $db = &JFactory::getDBO();
        $jshopConfig = &JSFactory::getConfig();
        $products = &$this->getModel("products");
        $id_vendor_cuser = getIdVendorForCUser();

        $context = "jshoping.list.admin.product";
        $limit = $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
        $limitstart = $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0, 'int' );
        
        if (isset($_GET['category_id']) && $_GET['category_id']==="0"){            
            $mainframe->setUserState( $context.'category_id', 0);
            $mainframe->setUserState( $context.'manufacturer_id', 0);
            $mainframe->setUserState( $context.'label_id', 0);
            $mainframe->setUserState( $context.'publish', 0);
            $mainframe->setUserState( $context.'text_search', '');
        }                
        
        $category_id = $mainframe->getUserStateFromRequest( $context.'category_id', 'category_id', 0, 'int' );
        $manufacturer_id = $mainframe->getUserStateFromRequest( $context.'manufacturer_id', 'manufacturer_id', 0, 'int' );
        $label_id = $mainframe->getUserStateFromRequest( $context.'label_id', 'label_id', 0, 'int' );
        $publish = $mainframe->getUserStateFromRequest( $context.'publish', 'publish', 0, 'int' );
        $text_search = $mainframe->getUserStateFromRequest( $context.'text_search', 'text_search', '');
        
        $filter = array("category_id"=>$category_id, "manufacturer_id"=>$manufacturer_id, "label_id"=>$label_id, "publish"=>$publish, "text_search"=>$text_search);
        if ($id_vendor_cuser){
            $filter["vendor_id"] = $id_vendor_cuser;
        }
        
        $show_vendor = $jshopConfig->admin_show_vendors;
        if ($id_vendor_cuser) $show_vendor = 0;
                
        $total = $products->getCountAllProducts($filter);
        
        jimport('joomla.html.pagination');
        $pagination = new JPagination($total, $limitstart, $limit);
        
        $rows = $products->getAllProducts($filter, $pagination->limitstart, $pagination->limit);
        
        if ($show_vendor){
            foreach($rows as $k=>$v){
                if ($v->vendor_id){
                    $rows[$k]->vendor_name = $v->v_f_name." ".$v->v_l_name;
                }else{
                    $rows[$k]->vendor_name = $jshopConfig->contact_firstname." ".$jshopConfig->contact_lastname;
                }
            }
        }
        
        $parentTop->category_id = 0;
        $parentTop->name = " - - - ";
        $categories_select = buildTreeCategory(0);
        array_unshift($categories_select, $parentTop);    
        $lists['treecategories'] = JHTML::_('select.genericlist', $categories_select,'category_id','onchange="document.adminForm.submit();"', 'category_id', 'name', $category_id );
        
        $manuf1 = array();
        $manuf1[0]->manufacturer_id = '0';
        $manuf1[0]->name = " - - - ";

        $_manufacturer =&$this->getModel('manufacturers');
        $manufs = $_manufacturer->getAllManufacturers(0);
        $manufs = array_merge($manuf1, $manufs);
        $lists['manufacturers'] = JHTML::_('select.genericlist', $manufs, 'manufacturer_id','onchange="document.adminForm.submit();"', 'manufacturer_id', 'name', $manufacturer_id);
        
        // product labels
        if ($jshopConfig->admin_show_product_labels) {
            $_labels = &$this->getModel("productLabels");
            $alllabels = $_labels->getList();
            $first = array();
            $first[] = JHTML::_('select.option', '0'," - - - ", 'id','name');        
            $lists['labels'] = JHTML::_('select.genericlist', array_merge($first, $alllabels), 'label_id','onchange="document.adminForm.submit();"','id','name', $label_id);
        }
        //
        
        $f_option = array();
        $f_option[] = JHTML::_('select.option', 0, " - - - ", 'id', 'name');
        $f_option[] = JHTML::_('select.option', 1, _JSHOP_PUBLISH, 'id', 'name');
        $f_option[] = JHTML::_('select.option', 2, _JSHOP_UNPUBLISH, 'id', 'name');
        $lists['publish'] = JHTML::_('select.genericlist', $f_option, 'publish', 'onchange="document.adminForm.submit();"', 'id', 'name', $publish);
        
        $currency =& JTable::getInstance('currency', 'jshop');
        $currency->load($jshopConfig->mainCurrency);
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeDisplayListProducts', array(&$rows) );
        
        $view=&$this->getView("product_list", 'html');
        $view->assign('rows', $rows);
        $view->assign('lists', $lists);
        $view->assign('category_id', $category_id);
        $view->assign('manufacturer_id', $manufacturer_id);
        $view->assign('pagination', $pagination);
        $view->assign('text_search', $text_search);
        $view->assign('config', $jshopConfig);
        $view->assign('currency', $currency);
        $view->assign('show_vendor', $show_vendor);
        $view->display();
                
    }
    
    function edit(){
        $jshopConfig = &JSFactory::getConfig();
        $db = &JFactory::getDBO();
        $id_vendor_cuser = getIdVendorForCUser();
        
        $product_id = JRequest::getInt('product_id');
        
        if ($id_vendor_cuser && $product_id){
            checkAccessVendorToProduct($id_vendor_cuser, $product_id);
        }
        
        $products = &$this->getModel("products");
        
        $product =& JTable::getInstance('product', 'jshop');
        $product->load($product_id);

        $_productprice =& JTable::getInstance('productPrice', 'jshop');
        $product->product_add_prices = $_productprice->getAddPrices($product_id);        
        $product->product_add_prices = array_reverse($product->product_add_prices);
        
        $_lang = &$this->getModel("languages");
        $languages = $_lang->getAllLanguages(1);
        $multilang = count($languages)>1;
        
        $nofilter = array();
        JFilterOutput::objectHTMLSafe( $product, ENT_QUOTES, $nofilter);

        $edit = intval($product_id);
        
        if (!$product_id) {
            $rows = array();
            $product->product_quantity = 1;
            $product->product_publish = 1;
        }
 
        $_tax = &$this->getModel("taxes");
        $all_taxes = $_tax->getAllTaxes();
        
        if ($edit){
            $images = $product->getImages();
            $videos = $product->getVideos();
            $files  = $product->getFiles();            
            $categories_select = $product->getCategories();
            $related_products = $products->getRelatedProducts($product_id);
        } else {
            $images = array();
            $videos = array();
            $files = array();
            $categories_select = null;
            $related_products = array();
        }
        $list_tax = array();        
        foreach ($all_taxes as $tax) {
            $list_tax[] = JHTML::_('select.option', $tax->tax_id, $tax->tax_name . ' (' . $tax->tax_value . '%)','tax_id','tax_name');
        }
        if (count($all_taxes)==0) $withouttax = 1; else $withouttax = 0;

        $categories = buildTreeCategory(0);
        if (count($categories)==0) JError::raiseNotice(0, _JSHOP_PLEASE_ADD_CATEGORY);
        $lists['images'] = $images;
        $lists['videos'] = $videos;
        $lists['files'] = $files;

        $manuf1 = array();
        $manuf1[0]->manufacturer_id = '0';
        $manuf1[0]->name = _JSHOP_NONE;

        $_manufacturer =&$this->getModel('manufacturers');
        $manufs = $_manufacturer->getAllManufacturers(0);
        $manufs = array_merge($manuf1, $manufs);

        //Attributes
        $_attribut = &$this->getModel('attribut');
        $list_all_attributes = $_attribut->getAllAttributes(2);
        $_attribut_value =&$this->getModel('attributValue');
        $lists['attribs'] = $product->getAttributes();
        $lists['ind_attribs'] = $product->getAttributes2();
        $lists['attribs_values'] = $_attribut_value->getAllAttributeValues(2);
        $all_attributes = $list_all_attributes['dependent'];
        
        $lists['ind_attribs_gr'] = array();
        foreach($lists['ind_attribs'] as $v){
            $lists['ind_attribs_gr'][$v->attr_id][] = $v;
        }
        
        $first = array();
        $first[] = JHTML::_('select.option', '0',_JSHOP_SELECT, 'value_id','name');

        foreach ($all_attributes as $key => $value){
            $values_for_attribut = $_attribut_value->getAllValues($value->attr_id);
            if (!count($values_for_attribut)) {
                unset($all_attributes[$key]);
                continue;
            }
            $all_attributes[$key]->values_select = JHTML::_('select.genericlist', array_merge($first, $values_for_attribut),'value_id['.$value->attr_id.']','class = "inputbox" size = "5" multiple="multiple" id = "value_id_'.$value->attr_id.'"','value_id','name');
            $all_attributes[$key]->values = $values_for_attribut;
        }        
        $lists['all_attributes'] = $all_attributes;
        $product_with_attribute = (count($lists['attribs']) > 0);
        
        //independent attribute
        $all_independent_attributes = $list_all_attributes['independent'];
        
        $price_modification = array();
        $price_modification[] = JHTML::_('select.option', '+','+', 'id','name');
        $price_modification[] = JHTML::_('select.option', '-','-', 'id','name');
        $price_modification[] = JHTML::_('select.option', '=','=', 'id','name');
        
        foreach ($all_independent_attributes as $key => $value){
            $values_for_attribut = $_attribut_value->getAllValues($value->attr_id);
            if (!count($values_for_attribut)) {
                unset($all_independent_attributes[$key]);
                continue;
            }
            $all_independent_attributes[$key]->values_select = JHTML::_('select.genericlist', array_merge($first, $values_for_attribut),'attr_ind_id_tmp_'.$value->attr_id.'','class = "inputbox" ','value_id','name');
            $all_independent_attributes[$key]->values = $values_for_attribut;
            $all_independent_attributes[$key]->price_modification_select = JHTML::_('select.genericlist', $price_modification,'attr_price_mod_tmp_'.$value->attr_id.'','class = "inputbox" ','id','name');
            
        }        
        $lists['all_independent_attributes'] = $all_independent_attributes;
        // End work with attributes and values

        // delivery Times
        if ($jshopConfig->admin_show_delivery_time) {
            $_deliveryTimes = &$this->getModel("deliveryTimes");
            $all_delivery_times = $_deliveryTimes->getDeliveryTimes();                
            $all_delivery_times0 = array();
            $all_delivery_times0[0]->id = '0';
            $all_delivery_times0[0]->name = _JSHOP_NONE;        
            $lists['deliverytimes'] = JHTML::_('select.genericlist', array_merge($all_delivery_times0, $all_delivery_times),'delivery_times_id','class = "inputbox" size = "1"','id','name',$product->delivery_times_id);        
        }
        //

        // units
        if ($jshopConfig->admin_show_product_basic_price) {
            $_units = &$this->getModel("units");
            $allunits = $_units->getUnits();        
            $lists['basic_price_units'] = JHTML::_('select.genericlist', $allunits, 'basic_price_unit_id','class = "inputbox" size = "1"','id','name',$product->basic_price_unit_id);
        }
        //
        
        // product labels
        if ($jshopConfig->admin_show_product_labels) {
            $_labels = &$this->getModel("productLabels");
            $alllabels = $_labels->getList();
            $first = array();
            $first[] = JHTML::_('select.option', '0',_JSHOP_SELECT, 'id','name');        
            $lists['labels'] = JHTML::_('select.genericlist', array_merge($first, $alllabels), 'label_id','class = "inputbox" size = "1"','id','name',$product->label_id);
        }
        //
        
        // vendors
        $display_vendor_select = 0;
        if ($jshopConfig->admin_show_vendors){
            $_vendors = &$this->getModel("vendors");
            $listvebdorsnames = $_vendors->getAllVendorsNames();
            $first = array();
            $first[] = JHTML::_('select.option', '0', $jshopConfig->contact_firstname." ".$jshopConfig->contact_lastname, 'id','name');
            $lists['vendors'] = JHTML::_('select.genericlist', array_merge($first, $listvebdorsnames), 'vendor_id','class = "inputbox" size = "1"', 'id', 'name', $product->vendor_id);
            
            $display_vendor_select = 1;
            if ($id_vendor_cuser > 0) $display_vendor_select = 0;            
        }
        //
        
        //product extra field
        if ($jshopConfig->admin_show_product_extra_field) {
            $categorys_id = array();
            if (is_array($categories_select)){
                foreach($categories_select as $tmp){
                    $categorys_id[] = $tmp->category_id;
                }        
            }
            $tmpl_extra_fields = $this->_getHtmlProductExtraFields($categorys_id, $product);
        }
        //
        
        //free attribute
        if ($jshopConfig->admin_show_freeattributes){
            $_freeattributes = &$this->getModel("freeattribut");        
            $listfreeattributes = $_freeattributes->getAll();
            $activeFreeAttribute = $product->getListFreeAttributes();
            $listIdActiveFreeAttribute = array();
            foreach($activeFreeAttribute as $_obj){
                $listIdActiveFreeAttribute[] = $_obj->id;
            }            
            foreach($listfreeattributes as $k=>$v){
                if (in_array($v->id, $listIdActiveFreeAttribute)){
                    $listfreeattributes[$k]->pactive = 1;
                }
            }
        }

        $lists['manufacturers'] = JHTML::_('select.genericlist', $manufs,'product_manufacturer_id','class = "inputbox" size = "1"','manufacturer_id','name',$product->product_manufacturer_id);
        
        $tax_value = 0;
        foreach ($all_taxes as $tax){
            if ($tax->tax_id == $product->product_tax_id){
                $tax_value = $tax->tax_value;
                break; 
            }
        }
        
        if ($product_id){
            if ($jshopConfig->display_price_admin==0){
                $product->product_price2 = round($product->product_price / (1 + $tax_value / 100), 2);
            }else{
                $product->product_price2 = round($product->product_price * (1 + $tax_value / 100), 2);
            }
        }
        
        
        $category_select_onclick = "";
        if ($jshopConfig->admin_show_product_extra_field) $category_select_onclick = 'onclick="reloadProductExtraField(\''.$product_id.'\')"';
        
        $lists['tax'] = JHTML::_('select.genericlist', $list_tax,'product_tax_id','class = "inputbox" size = "1" onchange = "updatePrice2('.$jshopConfig->display_price_admin.');"','tax_id','tax_name',$product->product_tax_id);
        $lists['categories'] = JHTML::_('select.genericlist', $categories, 'category_id[]', 'class="inputbox" size="10" multiple = "multiple" '.$category_select_onclick, 'category_id', 'name', $categories_select);
        $lists['writeable'] = (is_writable($jshopConfig->image_product_path))?($jshopConfig->image_product_path . '::' . messageOutput(_JSHOP_WRITEABLE,'jshop_green')):($jshopConfig->image_product_path . '::' . messageOutput(_JSHOP_NON_WRITEABLE));
        $lists['templates'] = getTemplates('product', $product->product_template);
        
        $currency =& JTable::getInstance('currency', 'jshop');
        $currency->load($jshopConfig->mainCurrency);
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeDisplayEditProduct', array(&$product, &$related_products, &$lists, &$listfreeattributes, &$tax_value, &$currency) );

        $view=&$this->getView("product_edit", 'html');
        $view->setLayout("default");
        $view->assign('product', $product);
        $view->assign('lists', $lists);
        $view->assign('related_products', $related_products);
        $view->assign('edit', $edit);
        $view->assign('product_with_attribute', $product_with_attribute);
        $view->assign('currency', $currency);
        $view->assign('tax_value', $tax_value);
        $view->assign('languages', $languages);
        $view->assign('multilang', $multilang);
        $view->assign('tmpl_extra_fields', $tmpl_extra_fields);
        $view->assign('withouttax', $withouttax);
        $view->assign('display_vendor_select', $display_vendor_select);
        $view->assign('listfreeattributes', $listfreeattributes);
        $view->display();
    }
    
    function save() {
        $jshopConfig = &JSFactory::getConfig();
        
        require_once ($jshopConfig->path.'lib/image.lib.php');
        require_once ($jshopConfig->path.'lib/uploadfile.class.php');
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();        
        
        $db = &JFactory::getDBO();
        $post = JRequest::get('post');
        $_products = &$this->getModel("products");
        $product =& JTable::getInstance('product', 'jshop');
        $_alias = &$this->getModel("alias");
        $_lang = &$this->getModel("languages");
        $id_vendor_cuser = getIdVendorForCUser();
        
        if ($id_vendor_cuser && $post['product_id']){
            checkAccessVendorToProduct($id_vendor_cuser, $post['product_id']);
        }
        
        $post['different_prices'] = 0;
        if ($post['product_is_add_price']) $post['different_prices'] = 1;
               
        if (!isset($post['product_publish'])) $post['product_publish'] = 0;
        if (!isset($post['product_is_add_price'])) $post['product_is_add_price'] = 0;        
        if (!isset($post['unlimited'])) $post['unlimited'] = 0;        
        $post['product_price'] = saveAsPrice($post['product_price']);
        $post['product_old_price'] = saveAsPrice($post['product_old_price']);
        $post['product_buy_price'] = saveAsPrice($post['product_buy_price']);
        $post['product_weight'] = saveAsPrice($post['product_weight']);
        if(!isset($post['related_products'])) $post['related_products'] = array();
        if (!$post['product_id']) $post['product_date_added'] = date("Y-m-d H:i:s");
        $post['date_modify'] = date("Y-m-d H:i:s");
        $post['edit'] = intval($post['product_id']);
        $post['min_price'] = $_products->getMinimalPrice($post['product_price'], $post['attrib_price'], array($post['attrib_ind_id'], $post['attrib_ind_price_mod'], $post['attrib_ind_price']), $post['product_is_add_price'], $post['product_add_discount']);
        if ($id_vendor_cuser){
            $post['vendor_id'] = $id_vendor_cuser;
        }
        
        if (is_array($post['attr_count'])){
            $qty = 0;
            foreach($post['attr_count'] as $_qty) {
                if ($_qty > 0) $qty += $_qty;
            }
            $post['product_quantity'] = $qty;
        }
        if ($post['unlimited']){
            $post['product_quantity'] = 1;
        }
        
        if (is_array($post['attrib_price'])){
            if (count(array_unique($post['attrib_price']))>1) $post['different_prices'] = 1;
        }
        if (is_array($post['attrib_ind_price'])){
            $tmp_attr_ind_price = array();
            foreach($post['attrib_ind_price'] as $k=>$v){
                $tmp_attr_ind_price[] = $post['attrib_ind_price_mod'][$k].$post['attrib_ind_price'][$k];
            }
            if (count(array_unique($tmp_attr_ind_price))>1) $post['different_prices'] = 1;
        }
                
        $languages = $_lang->getAllLanguages(1);
        foreach($languages as $lang){
            $post['name_'.$lang->language] = trim($post['name_'.$lang->language]);
            $post['alias_'.$lang->language] = setFilterAlias($post['alias_'.$lang->language]);
            if ($post['alias_'.$lang->language]!="" && !$_alias->checkExistAlias2Group($post['alias_'.$lang->language], $lang->language, $post['product_id'])){
                $post['alias_'.$lang->language] = "";
                JError::raiseWarning("", _JSHOP_ERROR_ALIAS_ALREADY_EXIST);
            }            
            $post['description_'.$lang->language] = JRequest::getVar('description'.$lang->id,'','post',"string", 2);
            $post['short_description_'.$lang->language] = JRequest::getVar('short_description_'.$lang->language,'','post',"string", 2);
        }
        
        $dispatcher->trigger( 'onBeforeDisplaySaveProduct', array($post) );
        
        if (!$product->bind($post)) {
            JError::raiseWarning("",_JSHOP_ERROR_BIND);
            $this->setRedirect("index.php?option=com_jshopping&controller=products");
            return 0;
        }
        
        if (($product->min_price==0 || $product->product_price==0) && !$jshopConfig->user_as_catalog){
            JError::raiseNotice("", _JSHOP_YOU_NOT_SET_PRICE);    
        }
        
        if (isset($post['set_main_image'])) {
            $image=& JTable::getInstance('image', 'jshop');
            $image->load($post['set_main_image']);
            if($image->image_id) {
                $product->product_thumb_image = $image->image_thumb;
                $product->product_name_image = $image->image_name;
                $product->product_full_image = $image->image_full;
            }
        }
        
        if (!$product->store()){
            JError::raiseWarning("",_JSHOP_ERROR_SAVE_DATABASE."<br>".$product->_error);
            $this->setRedirect("index.php?option=com_jshopping&controller=products&task=edit&product_id=".$product->product_id);
            return 0;
        }

        $product_id = $product->product_id;
        
        $dispatcher->trigger( 'onAfterSaveProduct', array(&$product) );

        //upload video
        if ($jshopConfig->admin_show_product_video) {
            for($i=0; $i<3; $i++){
                $upload = new UploadFile($_FILES['product_video_'.$i]);
                $upload->setDir($jshopConfig->video_product_path);
                if ($upload->upload()){
                    $image_prev_video = "";
                    $file_video = $upload->getName();
                    @chmod($jshopConfig->video_product_path."/".$file_video, 0777);
                    
                    $upload2 = new UploadFile($_FILES['product_video_preview_'.$i]);
                    $upload2->setAllowFile(array('jpeg','jpg','gif','png'));
                    $upload2->setDir($jshopConfig->video_product_path);
                    if ($upload2->upload()){
                        $image_prev_video = $upload2->getName();
                        @chmod($jshopConfig->video_product_path."/".$image_prev_video, 0777);
                    }else{
                        if ($upload2->getError() != 4){
                            JError::raiseWarning("", _JSHOP_ERROR_UPLOADING_VIDEO_PREVIEW);
                            saveToLog("error.log", "SaveProduct - Error upload video preview. code: ".$upload2->getError());
                        }    
                    }
                    unset($upload2);                
                    $this->addToProductVideo($product_id, $file_video, $image_prev_video);
                }else{
                    if ($upload->getError() != 4){
                        JError::raiseWarning("", _JSHOP_ERROR_UPLOADING_VIDEO);
                        saveToLog("error.log", "SaveProduct - Error upload video. code: ".$upload->getError());
                    }
                }               
                unset($upload);    
            }
        }
        
        //uploading images
        for($i=0; $i<10; $i++){
            $upload = new UploadFile($_FILES['product_image_'.$i]);
            $upload->setAllowFile(array('jpeg','jpg','gif','png'));
            $upload->setDir($jshopConfig->image_product_path);
            if ($upload->upload()){
                $name_image = $upload->getName();                
                $name_thumb = 'thumb_'.$name_image;
                $name_full = 'full_'.$name_image;
                @chmod($jshopConfig->image_product_path."/".$name_image, 0777);

                $path_image = $jshopConfig->image_product_path . "/" . $name_image;
                $path_thumb = $jshopConfig->image_product_path . "/" . $name_thumb;
                $path_full =  $jshopConfig->image_product_path . "/" . $name_full;                
                rename($path_image, $path_full);
                
                $error = 0;
                if($post['size_im_product'] == 3) {
                    copy($path_full, $path_thumb);
                    @chmod($path_thumb, 0777);
                }else{
                    if($post['size_im_product'] == 1){
                        $product_width_image = $jshopConfig->image_product_width;
                        $product_height_image = $jshopConfig->image_product_height;
                    }else{
                        $product_width_image = JRequest::getInt('product_width_image'); 
                        $product_height_image = JRequest::getInt('product_height_image');
                    }
 
                    if (!ImageLib::resizeImageMagic($path_full, $product_width_image, $product_height_image, $jshopConfig->image_cut, $jshopConfig->image_fill, $path_thumb, $jshopConfig->image_quality, $jshopConfig->image_fill_color)) {
                        JError::raiseWarning("",_JSHOP_ERROR_CREATE_THUMBAIL);
                        saveToLog("error.log", "SaveProduct - Error create thumbail");
                        $error = 1;
                    }    
                    @chmod($path_thumb, 0777);
                    unset($img);
                }
                
                if ($post['size_full_product'] == 3){
                    copy($path_full, $path_image);
                    @chmod($path_image, 0777);
                }else{
                    if ($post['size_full_product'] == 1){
                        $product_full_width_image = $jshopConfig->image_product_full_width; 
                        $product_full_height_image = $jshopConfig->image_product_full_height;
                    }else{
                        $product_full_width_image = JRequest::getInt('product_full_width_image'); 
                        $product_full_height_image = JRequest::getInt('product_full_height_image');
                    }

                    if (!ImageLib::resizeImageMagic($path_full, $product_full_width_image, $product_full_height_image, $jshopConfig->image_cut, $jshopConfig->image_fill, $path_image, $jshopConfig->image_quality, $jshopConfig->image_fill_color)) {
                        JError::raiseWarning("",_JSHOP_ERROR_CREATE_THUMBAIL);
                        $error = 1;
                    }    
                    @chmod($path_image, 0777);
                    unset($img);
                }
                                                
                if (!$error){
                    $this->addToProductImage($product_id, $name_full, $name_image, $name_thumb);
                    $dispatcher->trigger( 'onAfterSaveProductImage', array($product_id, $name_full, $name_image, $name_thumb) );
                }
                
            }else{
                if ($upload->getError() != 4){
                    JError::raiseWarning("", _JSHOP_ERROR_UPLOADING_IMAGE);
                    saveToLog("error.log", "SaveProduct - Error upload image. code: ".$upload->getError());
                }
            }
                        
            unset($upload);    
        }        
        
        if (!$product->product_name_image){
            $list_images = $product->getImages();
            if (count($list_images)){
                $product =& JTable::getInstance('product', 'jshop');
                $product->load($product_id);
                $product->product_thumb_image = $list_images[0]->image_thumb;
                $product->product_name_image = $list_images[0]->image_name;
                $product->product_full_image = $list_images[0]->image_full;
                $product->store();    
            }
        }
        
        //upload files
        if ($jshopConfig->admin_show_product_files) {
            for($i=0; $i<1; $i++){
                $upload = new UploadFile($_FILES['product_demo_file_'.$i]);
                $upload->setDir($jshopConfig->demo_product_path);
                $upload->setFileNameMd5(0);
                $upload->setFilterName(1);
                if ($upload->upload()){
                    $file_demo = $upload->getName();
                    @chmod($jshopConfig->demo_product_path."/".$file_demo, 0777);
                }else{
                    $file_demo = "";
                    if ($upload->getError() != 4){
                        JError::raiseWarning("", _JSHOP_ERROR_UPLOADING_FILE_DEMO);
                        saveToLog("error.log", "SaveProduct - Error upload demo. code: ".$upload->getError());    
                    }    
                }
                unset($upload);
                
                $upload = new UploadFile($_FILES['product_file_'.$i]);
                $upload->setDir($jshopConfig->files_product_path);
                $upload->setFileNameMd5(0);
                $upload->setFilterName(1);
                if ($upload->upload()){
                    $file_sale = $upload->getName();
                    @chmod($jshopConfig->files_product_path."/".$file_sale, 0777);
                }else{
                    $file_sale = "";
                    if ($upload->getError() != 4){
                        JError::raiseWarning("", _JSHOP_ERROR_UPLOADING_FILE_SALE);
                        saveToLog("error.log", "SaveProduct - Error upload file sale. code: ".$upload->getError());    
                    }    
                }
                unset($upload);
                
                if ($file_demo!="" || $file_sale!=""){
                    $this->addToProductFiles($product_id, $file_demo, $post['product_demo_descr_'.$i], $file_sale, $post['product_file_descr_'.$i], $post['product_file_sort_'.$i]);
                }
            }
            //Update description files
            $this->productUpdateDescriptionFiles($post['product_demo_descr'], $post['product_file_descr'], $post['product_file_sort']);
        }

        // save attributes
        $productAttribut =& JTable::getInstance('productAttribut', 'jshop');
        $productAttribut->set("product_id", $product_id);
        $productAttribut->deleteAttributeForProduct();
        
        if (is_array($post['attrib_price'])){
            foreach($post['attrib_price'] as $k=>$v){
                $a_price = saveAsPrice($post['attrib_price'][$k]);
                $a_buy_price = saveAsPrice($post['attrib_buy_price'][$k]);
                $a_count = intval($post['attr_count'][$k]);
                $a_ean = $post['attr_ean'][$k];
                $a_weight_volume_units = $post['attr_weight_volume_units'][$k];
                $a_weight = $post['attr_weight'][$k];
                
                $productAttribut->set("product_attr_id",0);
                $productAttribut->set("buy_price", $a_buy_price);
                $productAttribut->set("price", $a_price);
                $productAttribut->set("count", $a_count);
                $productAttribut->set("ean", $a_ean);
                $productAttribut->set("weight_volume_units", $a_weight_volume_units);
                $productAttribut->set("weight", $a_weight);
                foreach($post['attrib_id'] as $field_id=>$val){
                    $productAttribut->set("attr_".intval($field_id), $val[$k]);
                }
                if ($productAttribut->check()){
                    $productAttribut->store();
                }
            }
        }
        
        $productAttribut2 =& JTable::getInstance('productAttribut2', 'jshop');
        $productAttribut2->set("product_id", $product_id);
        $productAttribut2->deleteAttributeForProduct();
        
        if (is_array($post['attrib_ind_id'])){
            foreach($post['attrib_ind_id'] as $k=>$v){
                $a_id = intval($post['attrib_ind_id'][$k]);
                $a_value_id = intval($post['attrib_ind_value_id'][$k]);
                $a_price = saveAsPrice($post['attrib_ind_price'][$k]);
                $a_mod_price = $post['attrib_ind_price_mod'][$k];
                
                $productAttribut2->set("id", 0);
                $productAttribut2->set("product_id", $product_id);
                $productAttribut2->set("attr_id", $a_id);
                $productAttribut2->set("attr_value_id", $a_value_id);
                $productAttribut2->set("price_mod", $a_mod_price);
                $productAttribut2->set("addprice", $a_price);
                if ($productAttribut2->check()){
                    $productAttribut2->store();
                }
            }
        }
        
        //save free attributs
        if ($jshopConfig->admin_show_freeattributes){
            $_products->saveFreeAttributes($product_id, $post['freeattribut']);
        }
        
        if ($post['product_is_add_price']){
            $_products->saveAditionalPrice($product_id, $post['product_add_discount'], $post['quantity_start'], $post['quantity_finish']);
        }

        $_products->setCategoryToProduct($product_id, $post['category_id']);

        if ($post['edit']) {
            $query = "DELETE FROM `#__jshopping_products_relations` WHERE `product_id` = '".$db->getEscaped($product_id)."'";
            $db->setQuery($query);
            $db->query();
        }
        
        $post['related_products'] = array_unique($post['related_products']);
        foreach($post['related_products'] as $key => $value){
            if ($value!=0){
                $query = "INSERT INTO `#__jshopping_products_relations` SET `product_id` = '" . $db->getEscaped($product_id) . "', `product_related_id` = '" . $db->getEscaped($value) . "'";
                $db->setQuery($query);
                $db->query();
            }
        }
        
        $dispatcher->trigger( 'onAfterSaveProductEnd', array($product->product_id) );        
        
        if ($this->getTask()=='apply'){
            $this->setRedirect("index.php?option=com_jshopping&controller=products&task=edit&product_id=".$product->product_id, _JSHOP_PRODUCT_SAVED);
        }else{
            $this->setRedirect("index.php?option=com_jshopping&controller=products", _JSHOP_PRODUCT_SAVED);
        }        
    }
    
    function addToProductImage($product_id, $name_full, $name_image, $name_thumb) {
        $db = &JFactory::getDBO();
        $query = "INSERT INTO `#__jshopping_products_images`
                   SET `product_id` = '" . $db->getEscaped($product_id) . "', `image_full` = '" . $db->getEscaped($name_full) . "', `image_thumb` = '" . $db->getEscaped($name_thumb) . "', `image_name` = '" . $db->getEscaped($name_image) . "'";
        $db->setQuery($query);
        $db->query();
    }

    function addToProductVideo($product_id, $name_video, $preview_image = '') {
        $db = &JFactory::getDBO();
        $query = "INSERT INTO `#__jshopping_products_videos`
                   SET `product_id` = '" . $db->getEscaped($product_id) . "', `video_name` = '" . $db->getEscaped($name_video) . "', `video_preview` = '" . $db->getEscaped($preview_image) . "'";
        $db->setQuery($query);
        $db->query();
    }
    
    function addToProductFiles($product_id, $file_demo, $demo_descr, $file_sale, $file_descr, $sort){
        $db = &JFactory::getDBO();
        $query = "INSERT INTO `#__jshopping_products_files`
                   SET `product_id` = '" . $db->getEscaped($product_id) . "', `demo` = '" . $db->getEscaped($file_demo) . "',  `demo_descr` = '" . $db->getEscaped($demo_descr) . "', `file` = '" . $db->getEscaped($file_sale) . "', `file_descr` = '".$db->getEscaped($file_descr)."', `ordering`='".$db->getEscaped($sort)."'";
        $db->setQuery($query);
        $db->query();
    }
    
    function productUpdateDescriptionFiles($demo_descr, $file_descr, $ordering){
        $db = &JFactory::getDBO();
        if (is_array($demo_descr)){
            foreach($demo_descr as $file_id=>$value){
                $query = "update `#__jshopping_products_files`SET 
                            `demo_descr` = '".$db->getEscaped($demo_descr[$file_id])."', 
                            `file_descr` = '".$db->getEscaped($file_descr[$file_id])."',
                            `ordering` = '".$db->getEscaped($ordering[$file_id])."'
                            where id='".$db->getEscaped($file_id)."'";
                $db->setQuery($query);
                $db->query();    
            }
        }
    }   
    
    function publish(){        
        $this->_publishProduct(1);
        $this->setRedirect("index.php?option=com_jshopping&controller=products");
    }
    
    function unpublish(){
        $this->_publishProduct(0);
        $this->setRedirect("index.php?option=com_jshopping&controller=products");
    }    
    
    function _publishProduct($flag) {
        $jshopConfig = &JSFactory::getConfig();
        $db = &JFactory::getDBO();
        $cid = JRequest::getVar('cid');        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforePublishProduct', array(&$cid, &$flag) );
        foreach ($cid as $key => $value) {
            $query = "UPDATE `#__jshopping_products`
                       SET `product_publish` = '" . $db->getEscaped($flag) . "'
                       WHERE `product_id` = '" . $db->getEscaped($value) . "'";
            $db->setQuery($query);
            $db->query();
        }
        
        $dispatcher->trigger( 'onAfterPublishProduct', array(&$cid, &$flag) );
    }

    function copy(){
        $jshopConfig = &JSFactory::getConfig();
        $db = &JFactory::getDBO();
        $text = array();
        $cid = JRequest::getVar('cid');
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeCopyProduct', array(&$cid) );
        
        $_lang = &$this->getModel("languages");
        $languages = $_lang->getAllLanguages(1);
        // Get all data about products
        $tables = array('attr', 'attr2', 'images', 'prices', 'relations', 'to_categories', 'videos', 'files');
        foreach ($cid as $key=>$value){
            $product =& JTable::getInstance('product', 'jshop');
            $product->load($value);
            $product->product_id = null;                        
            foreach($languages as $lang){
                $name_alias = 'alias_'.$lang->language;
                $product->$name_alias = $product->$name_alias.date('ymdHis');
            }
            $product->product_date_added = date('Y-m-d H:i:s');
            $product->date_modify = "";
            $product->hits = 0;
            $product->store();

            $array = array();
            foreach ($tables as $table){
                $query = "SELECT * FROM `#__jshopping_products_" . $table . "` AS prod_table WHERE prod_table.product_id = '" . $db->getEscaped($value) . "'";
                $db->setQuery($query);
                $array[] = $db->loadAssocList();
            }

            $i = 0;
            foreach ($array as $key2=>$value2){
                if (count($value2)){
                    foreach ($value2 as $key3=>$value3){
                        $db->setQuery($this->_buildQuery($tables[$i], $value3, $product->product_id));
                        $db->query();
                    }
                }
                $i++;                
            }
            
            //change order in category
            $query = "select * from #__jshopping_products_to_categories where product_id='".$product->product_id."'";
            $db->setQuery($query);
            $list = $db->loadObjectList();
        
            foreach($list as $val){
                $query = "select max(product_ordering) as k from #__jshopping_products_to_categories where category_id='".$val->category_id."' ";
                $db->setQuery($query);
                $ordering = $db->loadResult() + 1;
                
                $query = "update #__jshopping_products_to_categories set product_ordering='".$ordering."' where category_id='".$val->category_id."' and product_id='".$product->product_id."' ";
                $db->setQuery($query);
                $db->query();
            }            
            
            $text[]= sprintf(_JSHOP_PRODUCT_COPY_TO, $value, $product->product_id)."<br>";
        }
        
        $dispatcher->trigger( 'onAfterCopyProduct', array(&$cid) );
        
        $this->setRedirect("index.php?option=com_jshopping&controller=products", implode("</li><li>",$text));
    }
    
    function _buildQuery($table, $array, $product_id){
        $db = &JFactory::getDBO();
        $query = "INSERT INTO `#__jshopping_products_" . $table . "` SET ";
        $array_keys = array('image_id', 'price_id', 'review_id', 'video_id', 'product_attr_id', 'value_id', 'id');
        foreach ($array as $key=>$value){
            if (in_array($key, $array_keys)) continue;
            if ($key=='product_id') $value = $product_id;
            $query .= "`" . $key . "` = '" . $db->getEscaped($value) . "', ";
        }
        return $query = substr($query, 0, strlen($query) - 2);
    }
    
    function order(){
        $order = JRequest::getVar("order");
        $product_id = JRequest::getInt("product_id");
        $number = JRequest::getInt("number");
        $category_id = JRequest::getInt("category_id");

        $db = &JFactory::getDBO();
        switch ($order) {
            case 'up':
                $query = "SELECT a.*
                       FROM `#__jshopping_products_to_categories` AS a
                       WHERE a.product_ordering < '" . $number . "' AND a.category_id = '" . $category_id . "'
                       ORDER BY a.product_ordering DESC
                       LIMIT 1";
                break;
            case 'down':
                $query = "SELECT a.*
                       FROM `#__jshopping_products_to_categories` AS a
                       WHERE a.product_ordering > '" . $number . "' AND a.category_id = '" . $category_id . "'
                       ORDER BY a.product_ordering ASC
                       LIMIT 1";
        }

        $db->setQuery($query);
        $row = $db->loadObject();

        $query1 = "UPDATE `#__jshopping_products_to_categories` AS a
                     SET a.product_ordering = '" . $row->product_ordering . "'
                     WHERE a.product_id = '" . $product_id . "' AND a.category_id = '" . $category_id . "'";
        $query2 = "UPDATE `#__jshopping_products_to_categories` AS a
                     SET a.product_ordering = '" . $number . "'
                     WHERE a.product_id = '" . $row->product_id . "' AND a.category_id = '" . $category_id . "'";
        $db->setQuery($query1);
        $db->query();
        $db->setQuery($query2);
        $db->query();
        $this->setRedirect("index.php?option=com_jshopping&controller=products&category_id=".$category_id); 
    }
    
    function saveorder(){
        $db = &JFactory::getDBO();
        $category_id = JRequest::getInt("category_id");
        $cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
        $order = JRequest::getVar( 'order', array(), 'post', 'array' );
        
        foreach($cid as $k=>$product_id){
            $query = "UPDATE `#__jshopping_products_to_categories`
                     SET product_ordering = '".intval($order[$k])."'
                     WHERE product_id = '".intval($product_id)."' AND category_id = '".intval($category_id)."'";
            $db->setQuery($query);
            $db->query();        
        }
        $this->setRedirect("index.php?option=com_jshopping&controller=products&category_id=".$category_id); 
    }
    
    function remove(){
        $jshopConfig = &JSFactory::getConfig();
        $db = &JFactory::getDBO();
        $text = array();
        $cid = JRequest::getVar('cid');
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeRemoveProduct', array(&$cid) );

        foreach ($cid as $key => $value) {
            $product =& JTable::getInstance('product', 'jshop');
            $product->load($value);
            $query = "DELETE FROM `#__jshopping_products` WHERE `product_id` = '" . $db->getEscaped($value) . "'";
            $db->setQuery($query);
            $db->query();

            $query = "DELETE FROM `#__jshopping_products_attr` WHERE `product_id` = '" . $db->getEscaped($value) . "'";
            $db->setQuery($query);
            $db->query();
            
            $query = "DELETE FROM `#__jshopping_products_attr2` WHERE `product_id` = '" . $db->getEscaped($value) . "'";
            $db->setQuery($query);
            $db->query();
            
            $query = "DELETE FROM `#__jshopping_products_prices` WHERE `product_id` = '".$db->getEscaped($value)."'";
            $db->setQuery($query);
            $db->query();
            
            $query = "DELETE FROM `#__jshopping_products_relations` WHERE `product_id` = '" . $db->getEscaped($value) . "' OR `product_related_id` = '" . $db->getEscaped($value) . "'";
            $db->setQuery($query);
            $db->query();

            $query = "DELETE FROM `#__jshopping_products_to_categories` WHERE `product_id` = '" . $db->getEscaped($value) . "'";
            $db->setQuery($query);
            $db->query();

            $images = $product->getImages();
            $videos = $product->getVideos();
            $files = $product->getFiles();

            if (count($images)) {
                foreach ($images as $image){
                    $query = "select count(*) as k from #__jshopping_products_images where image_name='".$db->getEscaped($image->image_name)."' and product_id!='".$db->getEscaped($value)."'";                    
                    $db->setQuery($query);
                    if (!$db->loadResult()){
                        @unlink($jshopConfig->image_product_path . "/" . $image->image_thumb);
                        @unlink($jshopConfig->image_product_path . "/" . $image->image_full);
                        @unlink($jshopConfig->image_product_path . "/" . $image->image_name);
                    }
                }
            }
            
            $query = "DELETE FROM `#__jshopping_products_images` WHERE `product_id` = '" . $db->getEscaped($value) . "'";
            $db->setQuery($query);
            $db->query();

            if (count($videos)) {
                foreach ($videos as $video) {
                    $query = "select count(*) as k from #__jshopping_products_videos where video_name='".$db->getEscaped($video->video_name)."' and product_id!='".$db->getEscaped($value)."'";                    
                    $db->setQuery($query);
                    if (!$db->loadResult()){
                        @unlink($jshopConfig->video_product_path . "/" . $video->video_name);
                        if ($video->video_preview){
                            @unlink($jshopConfig->video_product_path . "/" . $video->video_preview);
                        }
                    }
                }
            }
            
            $query = "DELETE FROM `#__jshopping_products_videos` WHERE `product_id` = '" . $db->getEscaped($value) . "'";
            $db->setQuery($query);
            $db->query();
            
            if (count($files)){
                foreach($files as $file){
                    $query = "select count(*) as k from #__jshopping_products_files where demo='".$db->getEscaped($file->demo)."' and product_id!='".$db->getEscaped($value)."'";
                    $db->setQuery($query);
                    if (!$db->loadResult()){
                        @unlink($jshopConfig->demo_product_path."/".$file->demo);
                    }
                    
                    $query = "select count(*) as k from #__jshopping_products_files where file='".$db->getEscaped($file->file)."' and product_id!='".$db->getEscaped($value)."'";
                    $db->setQuery($query);
                    if (!$db->loadResult()){
                        @unlink($jshopConfig->files_product_path."/".$file->file);
                    }            
                }
            }
            
            $query = "DELETE FROM `#__jshopping_products_files` WHERE `product_id` = '" . $db->getEscaped($value) . "'";
            $db->setQuery($query);
            $db->query();
            
            $text[]= sprintf(_JSHOP_PRODUCT_DELETED, $value)."<br>";
        }
        
        $dispatcher->trigger( 'onAfterRemoveProduct', array(&$cid) );

        $this->setRedirect("index.php?option=com_jshopping&controller=products", implode("</li><li>",$text));
    }
    
    function cancel(){
        $this->setRedirect("index.php?option=com_jshopping&controller=products");
    }
    
    function delete_foto(){
        $image_id = JRequest::getInt("id");
        $jshopConfig = &JSFactory::getConfig();
        $db = &JFactory::getDBO();
        
        $query = "SELECT * FROM `#__jshopping_products_images` WHERE image_id = '" . $db->getEscaped($image_id) . "'";
        $db->setQuery($query);
        $row = $db->loadObject();
        
        $query = "DELETE FROM `#__jshopping_products_images` WHERE `image_id` = '" . $db->getEscaped($image_id) . "'";
        $db->setQuery($query);
        $db->query();
        
        $query = "select count(*) as k from #__jshopping_products_images where image_name='".$db->getEscaped($row->image_name)."' and product_id!='".$db->getEscaped($row->product_id)."'";                    
        $db->setQuery($query);
        if (!$db->loadResult()){        
            @unlink($jshopConfig->image_product_path . '/' . $row->image_full);
            @unlink($jshopConfig->image_product_path . '/' . $row->image_name);
            @unlink($jshopConfig->image_product_path . '/' . $row->image_thumb);
        }
        
        $product =& JTable::getInstance('product', 'jshop');
        $product->load($row->product_id);
        if ($product->product_name_image==$row->image_name){
            $product->product_thumb_image = '';
            $product->product_name_image = '';
            $product->product_full_image = '';
            $list_images = $product->getImages();
            if (count($list_images)){
                $product->product_thumb_image = $list_images[0]->image_thumb;
                $product->product_name_image = $list_images[0]->image_name;
                $product->product_full_image = $list_images[0]->image_full;    
            } 
            $product->store();
        }
        
        die();
    }
    
    function delete_video(){
        $video_id = JRequest::getInt("id");
        $jshopConfig = &JSFactory::getConfig();
        $db = &JFactory::getDBO();
        
        $query = "SELECT * FROM `#__jshopping_products_videos` WHERE video_id = '" . $db->getEscaped($video_id) . "'";
        $db->setQuery($query);
        $row = $db->loadObject();
        
        $query = "select count(*) from #__jshopping_products_videos where video_name='".$db->getEscaped($row->video_name)."' and product_id!='".$db->getEscaped($row->product_id)."'";                    
        $db->setQuery($query);
        if (!$db->loadResult()){
            @unlink($jshopConfig->video_product_path . "/" . $row->video_name);
            if ($row->video_preview){
                @unlink($jshopConfig->video_product_path . "/" . $row->video_preview);
            }
        }

        $query = "DELETE FROM `#__jshopping_products_videos` WHERE `video_id` = '" . $db->getEscaped($video_id) . "'";
        $db->setQuery($query);
        $db->query();
        die();
    }
    
    function delete_file(){
        $jshopConfig = &JSFactory::getConfig();
        $db = &JFactory::getDBO();
        $id = JRequest::getInt("id");
        $type = JRequest::getVar("type");
        
        $query = "SELECT * FROM `#__jshopping_products_files` WHERE `id` = '" . $db->getEscaped($id) . "'";
        $db->setQuery($query);
        $row = $db->loadObject();
        
        $delete_row = 0;
                
        if ($type=="demo"){
            if ($row->file==""){
                $query = "DELETE FROM `#__jshopping_products_files` WHERE `id` = '" . $db->getEscaped($id) . "'";
                $db->setQuery($query);
                $db->query();
                $delete_row = 1;
            }else{
                $query = "update `#__jshopping_products_files` set `demo`='', demo_descr='' WHERE `id` = '" . $db->getEscaped($id) . "'";
                $db->setQuery($query);
                $db->query();
            }
            
            $query = "select count(*) as k from #__jshopping_products_files where demo='".$db->getEscaped($row->demo)."'";
            $db->setQuery($query);
            if (!$db->loadResult()){
                @unlink($jshopConfig->demo_product_path."/".$row->demo);
            }
        }
        
        if ($type=="file"){
            if ($row->demo==""){
                $query = "DELETE FROM `#__jshopping_products_files` WHERE `id` = '" . $db->getEscaped($id) . "'";
                $db->setQuery($query);
                $db->query();
                $delete_row = 1;
            }else{
                $query = "update `#__jshopping_products_files` set `file`='', file_descr='' WHERE `id` = '" . $db->getEscaped($id) . "'";
                $db->setQuery($query);
                $db->query();
            }
            
            $query = "select count(*) as k from #__jshopping_products_files where file='".$db->getEscaped($row->file)."'";
            $db->setQuery($query);
            if (!$db->loadResult()){
                @unlink($jshopConfig->files_product_path."/".$row->file);
            }
        }
        print $delete_row;
        die();    
    }
    
    function search_related(){
        $mainframe =& JFactory::getApplication();
    
        $db = &JFactory::getDBO();
        $jshopConfig = &JSFactory::getConfig();        
        $products = &$this->getModel("products");        
        
        $text_search = JRequest::getVar("text");
        $limitstart = JRequest::getInt("start");
        $no_id = JRequest::getInt("no_id");
        $limit = 20;
        
        $filter = array("without_product_id"=>$no_id, "text_search"=>$text_search);
        $total = $products->getCountAllProducts($filter);
        $rows = $products->getAllProducts($filter, $limitstart, $limit);
        $page = ceil($total/$limit);

        $view=&$this->getView("product_list", 'html');
        $view->setLayout("search_related");
        $view->assign('rows', $rows);
        $view->assign('pagination', $pagination);
        $view->assign('config', $jshopConfig);
        $view->assign('limit', $limit);
        $view->assign('pages', $page);
        $view->assign('no_id', $no_id);
        $view->display();
        die();
    } 
    
    function product_extra_fields(){
        
        $product_id = JRequest::getInt("product_id");
        $cat_id = JRequest::getVar("cat_id");
        $product =& JTable::getInstance('product', 'jshop');
        $product->load($product_id);
        
        $categorys = array();
        if (is_array($cat_id)){
            foreach($cat_id as $cid){
                $categorys[] = intval($cid);        
            }
        }        
        
        print $this->_getHtmlProductExtraFields($categorys, $product);
        die();    
    }
    
    function _getHtmlProductExtraFields($categorys, $product){
        $_productfields = &$this->getModel("productFields");
        $list = $_productfields->getList();
        
        $_productfieldvalues = &$this->getModel("productFieldValues");
        $listvalue = $_productfieldvalues->getAllList();
        
        $f_option = array();
        $f_option[] = JHTML::_('select.option', 0, " - - - ", 'id', 'name');
        
        $fields = array();
        foreach($list as $v){
            $insert = 0;
            if ($v->allcats==1){
                $insert = 1;
            }else{
                $cats = unserialize($v->cats);
                foreach($categorys as $catid){
                    if (in_array($catid, $cats)) $insert = 1;
                }
            }
            if ($insert){
                $obj = new stdClass();
                $obj->id = $v->id;
                $obj->name = $v->name;
                $tmp = array();
                foreach($listvalue as $lv){
                    if ($lv->field_id==$v->id) $tmp[] = $lv;
                }                
                $name = 'extra_field_'.$v->id;
                $obj->values = JHTML::_('select.genericlist', array_merge($f_option, $tmp), $name, '', 'id', 'name', $product->$name);
                $fields[] = $obj;
            }
        }
        $view=&$this->getView("product_edit", 'html');
        $view->setLayout("extrafields_inner");
        $view->assign('fields', $fields);        
        return $view->loadTemplate();        
    }    
}
?>