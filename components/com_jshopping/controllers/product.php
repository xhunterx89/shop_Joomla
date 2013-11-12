<?php
/**
* @version      2.9.1 04.07.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerProduct extends JController{

    function display(){
        $mainframe =& JFactory::getApplication();
        $db =& JFactory::getDBO();    
        $jshopConfig = &JSFactory::getConfig();
        $user = &JFactory::getUser();
        JSFactory::loadJsFilesLightBox();
        $session =& JFactory::getSession();
        $tmpl = JRequest::getVar("tmpl");
        if ($tmpl!="component"){
            $session->set("jshop_end_page_buy_product", $_SERVER['REQUEST_URI']);
        }

        $Itemid = JRequest::getInt('Itemid');
        $product_id = JRequest::getInt('product_id');
        $category_id = JRequest::getInt('category_id');
        
        JPluginHelper::importPlugin('jshoppingproducts');        
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeLoadProduct', array() );
        $dispatcher->trigger( 'onBeforeLoadProductList', array() );
        
        $product = &JTable::getInstance('product', 'jshop');
        $product->load($product_id);
        
        $attributesDatas = $product->getAttributesDatas();
        $product->setAttributeActive($attributesDatas['attributeActive']);        
        $attributeValues = $attributesDatas['attributeValues'];
        
        $attributes = $this->_buildSelectAttributes($attributeValues, $attributesDatas['attributeSelected']);
        if (count($attributes)){
            $_attributevalue = &JTable::getInstance('AttributValue', 'jshop');
            $all_attr_values = $_attributevalue->getAllAttributeValues();
        }else{
            $all_attr_values = array();
        }        

        $product->getExtendsData();        
            
        $category = &JTable::getInstance('category', 'jshop');
        $category->load($category_id);
        $category->name = $category->getName();
        
        if ($category->category_publish==0 || $product->product_publish==0){
            JError::raiseError( 404, _JSHOP_PAGE_NOT_FOUND);
            return;
        }
        
        if (getShopMainPageItemid()==JRequest::getInt('Itemid')){
            appendExtendPathway($category->getTreeChild(), 'product');
        }
        appendPathWay($product->name);        
        if ($product->meta_title=="") $product->meta_title = $product->name;
        setMetaData($product->meta_title, $product->meta_keyword, $product->meta_description);
        
        $product->hit();
        
        $product->product_basic_price_unit_qty = 1;
        if ($jshopConfig->admin_show_product_basic_price){
            $product->getBasicPriceInfo();        
        }
        
        $view_name = "product";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);
        
        if ($product->product_template=="") $product->product_template = "default";
        $view->setLayout("product_".$product->product_template);
        
        $_review = &JTable::getInstance('review', 'jshop');
        if(($allow_review = $_review->getAllowReview()) > 0) {
            $arr_marks = array();        
            $arr_marks[] = JHTML::_('select.option',  '0', _JSHOP_NOT, 'mark_id', 'mark_value' );
            for ($i = 1; $i <= $jshopConfig->max_mark; $i++) {            
                $arr_marks[] = JHTML::_('select.option', $i, $i, 'mark_id', 'mark_value' );
            }
            $text_review = '';        
            $select_review = JHTML::_('select.genericlist', $arr_marks, 'mark', 'class="inputbox" size="1"','mark_id', 'mark_value' );
        } else {
            $select_review = '';
            $text_review = $_review->getText();
        }
        if ($allow_review){
            JSFactory::loadJsFilesRating();
        }
                
        if ($jshopConfig->product_show_manufacturer_logo){
            $product->manufacturer_info = $product->getManufacturerInfo();
        }else{
            $product->manufacturer_info = null;
        }
        
        if ($jshopConfig->product_show_vendor){
            $vendorinfo = $product->getVendorInfo();
            $vendorinfo->urllistproducts = SEFLink("index.php?option=com_jshopping&controller=vendor&task=products&vendor_id=".$vendorinfo->id);
            $vendorinfo->urlinfo = SEFLink("index.php?option=com_jshopping&controller=vendor&task=info&vendor_id=".$vendorinfo->id);
            $product->vendor_info = $vendorinfo;
        }else{
            $product->vendor_info = null;
        }        
        
        if ($jshopConfig->admin_show_product_extra_field){
            $product->extra_field = $product->getExtraFields();
        }else{
            $product->extra_field = null;
        }
        
        if ($jshopConfig->admin_show_freeattributes){
            $product->getListFreeAttributes();
            $attrrequire = $product->getRequireFreeAttribute();            
            $product->freeattribrequire = count($attrrequire);
        }else{
            $product->freeattributes = null;
            $product->freeattribrequire = 0;
        }
        
        $hide_buy = 0;
        if ($jshopConfig->user_as_catalog) $hide_buy = 1;
        if ($jshopConfig->hide_buy_not_avaible_stock && $product->product_quantity <= 0) $hide_buy = 1;
        
        $available = "";
        if ( ($product->getQty() <= 0) && $product->product_quantity >0 ){
            $available = _JSHOP_PRODUCT_NOT_AVAILABLE_THIS_OPTION;
        }elseif ($product->product_quantity <= 0){
            $available = _JSHOP_PRODUCT_NOT_AVAILABLE;
        }
        
        $default_count_product = 1;
        if ($jshopConfig->min_count_order_one_product>1){
            $default_count_product = $jshopConfig->min_count_order_one_product;
        }
        
        if (trim($product->description)=="") $product->description = $product->short_description;
        
        if ($jshopConfig->use_plugin_content){        
            changeDataUsePluginContent($product, "product");
        }
                
        $dispatcher->trigger( 'onBeforeDisplayProductList', array(&$product->product_related) );
        $dispatcher->trigger( 'onBeforeDisplayProduct', array(&$product) );
        
        $view->assign('config', $jshopConfig);        
        $view->assign('image_path', $jshopConfig->live_path . '/images');
        $view->assign('noimage', 'noimage.gif');
        $view->assign('image_product_path', $jshopConfig->image_product_live_path);
        $view->assign('video_product_path', $jshopConfig->video_product_live_path);
        $view->assign('video_image_preview_path', $jshopConfig->video_product_live_path);
        $view->assign('product', $product);
        $view->assign('category_id', $category_id);
        $view->assign('images', $product->getImages());
        $view->assign('videos', $product->getVideos());
        $view->assign('demofiles', $product->getDemoFiles());
        $view->assign('attributes', $attributes);
        $view->assign('all_attr_values', $all_attr_values);
        $view->assign('related_prod', $product->product_related);        
        $view->assign('path_to_image', $jshopConfig->live_path . 'images/');
        $view->assign('live_path', JURI::root());
        $view->assign('enable_wishlist', $jshopConfig->enable_wishlist);
        $view->assign('action', SEFLink('index.php?option=com_jshopping&controller=cart&task=add'));
        $view->assign('urlupdateprice', SEFLink('index.php?option=com_jshopping&controller=product&task=ajax_attrib_select_and_price&product_id='.$product_id.'&ajax=1',0,1));
        
        if ($allow_review){
            $context = "jshoping.list.front.product.review";
            $limit = $mainframe->getUserStateFromRequest( $context.'limit', 'limit', 20, 'int');
            $limitstart = JRequest::getInt('limitstart');
            $total =  $product->getReviewsCount();
            $view->assign('reviews', $product->getReviews($limitstart, $limit));
            jimport('joomla.html.pagination');
            $pagination = new JPagination($total, $limitstart, $limit);            
            $view->assign('navigation_reviews', $pagination);
        } 
        
        $view->assign('allow_review', $allow_review);
        $view->assign('select_review', $select_review);
        $view->assign('text_review', $text_review);
        $view->assign('stars_count', floor($jshopConfig->max_mark / $jshopConfig->rating_starparts));
        $view->assign('parts_count', $jshopConfig->rating_starparts);
                
        $view->assign('user', $user);        
        $view->assign('shippinginfo', SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=shipping'));
        $view->assign('hide_buy', $hide_buy);
        $view->assign('available', $available);
        $view->assign('default_count_product', $default_count_product);
                
        $view->display();
        
        $dispatcher->trigger( 'onAfterDisplayProduct', array(&$product) );
    }
    
    function getfile(){
    
        $jshopConfig = &JSFactory::getConfig();
        $db = &JFactory::getDBO();
        
        $id = JRequest::getInt('id'); 
        $oid = JRequest::getInt('oid');
        $hash = JRequest::getVar('hash');
        
        $order = &JTable::getInstance('order', 'jshop');
        $order->load($oid);
        if ($order->file_hash!=$hash){
            JError::raiseError(500, "Error download file");
            return 0;
        }
        
        if (!in_array($order->order_status, $jshopConfig->payment_status_enable_download_sale_file)){
            JError::raiseWarning(500, _JSHOP_FOR_DOWNLOAD_ORDER_MUST_BE_PAID);
            return 0;    
        }
        
        $items = $order->getAllItems(); 
        $filesid = array();
        foreach($items as $item){
            $arrayfiles = unserialize($item->files);
            foreach($arrayfiles as $_file){
                $filesid[] = $_file->id;    
            }
        }
        
        if (!in_array($id, $filesid)){
            JError::raiseError(500, "Error download file");
            return 0;
        }
        
        $stat_download = $order->getFilesStatDownloads();
        
        if ($stat_download[$id] >= $jshopConfig->max_number_download_sale_file){
            JError::raiseWarning(500, _JSHOP_NUMBER_DOWNLOADS_FILE_RESTRICTED);
            return 0;
        }
        
        $file = &JTable::getInstance('productFiles', 'jshop');
        $file->load($id);
        $downloadFile = $file->file;
        if ($downloadFile==""){
            JError::raiseWarning('', "Error download file");
            return 0;        
        }
        $file_name = $jshopConfig->files_product_path."/".$downloadFile;
        if (!file_exists($file_name)){
            JError::raiseWarning('', "Error. File not exist");
            return 0;
        }
        
        $stat_download[$id] = intval($stat_download[$id]) + 1;
        $order->setFilesStatDownloads($stat_download);
        $order->store();
        
        ob_end_clean();        
        @set_time_limit(0);        
        $fp = fopen($file_name, "rb");        
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-Type: application/octet-stream");
        header("Content-Length: " . (string)(filesize($file_name)));
        header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');
        header("Content-Transfer-Encoding: binary");
        
        while( (!feof($fp)) && (connection_status()==0) ){
            print(fread($fp, 1024*8));
            flush();
        }
        fclose($fp);
        die();
    }
    
    function reviewsave(){
        $mainframe =& JFactory::getApplication();
        $jshopConfig = &JSFactory::getConfig();
        $db = &JFactory::getDBO();
        $user = &JFactory::getUser(); 
        $post = JRequest::get('post');
        $backlink = JRequest::getVar('back_link');
        $product_id = JRequest::getInt('product_id');
        
        JPluginHelper::importPlugin('jshoppingproducts');
        $dispatcher =& JDispatcher::getInstance();
        
        $review = &JTable::getInstance('review', 'jshop');
        
        if ($review->getAllowReview() <= 0) {
            JError::raiseWarning('', jshopReview::getText());
            $this->setRedirect($backlink);
            return 0;
        }
                
        $review->bind($post);
        $review->time = date("Y-m-d H:i:s",mktime());
        $review->user_id = $user->id;
        $review->ip = $_SERVER['REMOTE_ADDR'];
                                                         
        $dispatcher->trigger( 'onBeforeSaveReview', array(&$review) );

        if (!$review->check()) {            
            JError::raiseWarning('', _JSHOP_ENTER_CORRECT_INFO_REVIEW);
            $this->setRedirect($backlink);
            return 0;
        }
        if (!$review->store()) {
            JError::raiseWarning('', "Error DB");
            $this->setRedirect($backlink);
            return 0;
        }
        
        $dispatcher->trigger( 'onAfterSaveReview', array(&$review) );
        
        $product = &JTable::getInstance('product', 'jshop');
        $product->load($product_id);
        $product->loadAverageRating();
        $product->loadReviewsCount();
        $product->store();

        $lang = &JSFactory::getLang();
        $name = $lang->get("name");
        
        $view_name = "product";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);
        $view->setLayout("commentemail");
        $view->assign('product_name', $product->$name);
        $view->assign('user_name', $review->user_name);
        $view->assign('user_email', $review->user_email);
        $view->assign('mark', $review->mark);
        $view->assign('review', $review->review);
        $message = $view->loadTemplate();
        
        $mailfrom = $mainframe->getCfg( 'mailfrom' );
        $fromname = $mainframe->getCfg( 'fromname' );
        
        $mailer =& JFactory::getMailer();
        $mailer->setSender(array($mailfrom, $fromname));
        $mailer->addRecipient($jshopConfig->contact_email);
        $mailer->setSubject(_JSHOP_NEW_COMMENT);
        $mailer->setBody($message);        
        $mailer->isHTML(true);
        $send =& $mailer->Send();
                
        $this->setRedirect($backlink, _JSHOP_YOUR_REVIEW_SAVE);
    }

    function _buildSelectAttributes($attributeValues, $attributeActive){
        $jshopConfig = &JSFactory::getConfig();
        if (!$jshopConfig->admin_show_attributes) return array();
        $attrib = &JSFactory::getAllAttributes();
        $selects = array();
        foreach($attrib as $k=>$v){
            $attr_id = $v->attr_id;
            if ($attributeValues[$attr_id]){
                $selects[$attr_id]->attr_id = $attr_id;
                $selects[$attr_id]->attr_name = $v->name;
                $selects[$attr_id]->firstval = $attributeActive[$attr_id];
                $options = $attributeValues[$attr_id];
                $attrimage = array();                
                foreach($options as $k2=>$v2){
                    $attrimage[$v2->val_id] = $v2->image;
                }

                if ($v->attr_type==1){
                // attribut type select
                    
                    if ($jshopConfig->attr_display_addprice){
                        foreach($options as $k2=>$v2){
                            if (($v2->price_mod=="+" || $v2->price_mod=="-") && $v2->addprice>0){ 
                                $ext_price_info = " (".$v2->price_mod.formatprice($v2->addprice,null,1).")";
                                $options[$k2]->value_name .=$ext_price_info;
                            }
                        }
                    }

                    if ($jshopConfig->product_attribut_first_value_empty){
                        $first = array();
                        $first[] = JHTML::_('select.option', '0', _JSHOP_SELECT, 'val_id','value_name');
                        $options = array_merge($first, $options);
                    }

                    $selects[$attr_id]->selects = JHTML::_('select.genericlist', $options, 'jshop_attr_id['.$attr_id.']','class = "inputbox" size = "1" onchange="setAttrValue(\''.$attr_id.'\', this.value);"','val_id','value_name', $attributeActive[$attr_id])."<span class='prod_attr_img'>".$this->_displayProdAttrImg($attr_id, $attrimage[$attributeActive[$attr_id]])."</span>";
                }else{
                // attribut type radio
                
                    foreach($options as $k2=>$v2){
                        if ($v2->image) $options[$k2]->value_name = "<img src='".$jshopConfig->image_attributes_live_path."/".$v2->image."' /> ".$v2->value_name;                        
                    }

                    if ($jshopConfig->attr_display_addprice){
                        foreach($options as $k2=>$v2){
                            if (($v2->price_mod=="+" || $v2->price_mod=="-") && $v2->addprice>0){ 
                                $ext_price_info = " (".$v2->price_mod.formatprice($v2->addprice,null,1).")";
                                $options[$k2]->value_name .=$ext_price_info;
                            }
                        }
                    }

                    $radioseparator = "";
                    if ($jshopConfig->radio_attr_value_vertical) $radioseparator = "<br/>"; 
                    foreach($options as $k2=>$v2){
                        $options[$k2]->value_name = "<span class='radio_attr_label'>".$v2->value_name."</span>".$radioseparator;
                    }

                    $selects[$attr_id]->selects = sprintRadioList($options, 'jshop_attr_id['.$attr_id.']','onclick="setAttrValue(\''.$attr_id.'\', this.value);"','val_id','value_name', $attributeActive[$attr_id]);
                }
            }
        }
    return $selects;
    }

    function _displayProdAttrImg($attr_id, $img){
        $jshopConfig = &JSFactory::getConfig();
        if ($img){
            $path = $jshopConfig->image_attributes_live_path;
        }else{
            $path = $jshopConfig->live_path."images";
            $img = "blank.gif";
        }
        $urlimg = $path."/".$img;
        
        $html = "<img align='top' id='prod_attr_img_".$attr_id."' src='".$urlimg."' />";
        return $html;
    }
    
    /**
    * get attributes html selects, price for select attribute 
    */
    function ajax_attrib_select_and_price(){
        $db = &JFactory::getDBO();        
        $jshopConfig = &JSFactory::getConfig();
                
        $product_id = JRequest::getInt('product_id');
        $change_attr = JRequest::getInt('change_attr');
        $qty = JRequest::getInt('qty');
        if ($qty < 0) $qty = 0;
        $attribs = JRequest::getVar('attr');
        if (!is_array($attribs)) $attribs = array();
        
        $product = &JTable::getInstance('product', 'jshop'); 
        $product->load($product_id);
        
        $attributesDatas = $product->getAttributesDatas($attribs);
        $product->setAttributeActive($attributesDatas['attributeActive']);        
        $attributeValues = $attributesDatas['attributeValues'];
        
        $attributes = $this->_buildSelectAttributes($attributeValues, $attributesDatas['attributeSelected']);

        $rows = array();
        foreach($attributes as $k=>$v){
            $v->selects = str_replace(array("\n","\r","\t"), "", $v->selects);
            $rows[] = '"id_'.$k.'":"'.str_replace('"','\"',$v->selects).'"';
        }

        $pricefloat = $product->getPrice($qty, 1, 1, 1);
        $price = formatprice($pricefloat);
        $available = intval($product->getQty() > 0);
        $ean = $product->getEan();
        $weight = formatweight($product->getWeight());
        $weight_volume_units = $product->getWeight_volume_units();
        
        $rows[] = '"price":"'.$price.'"';
        $rows[] = '"pricefloat":"'.$pricefloat.'"';
        $rows[] = '"available":"'.$available.'"';
        $rows[] = '"ean":"'.$ean.'"';
        if ($jshopConfig->admin_show_product_basic_price){
            $rows[] = '"wvu":"'.$weight_volume_units.'"';
        }
        if ($jshopConfig->product_show_weight){
            $rows[] = '"weight":"'.$weight.'"';
        }
        
        $product->updateOtherPricesIncludeAllFactors();
        
        if (is_array($product->product_add_prices)){
            foreach($product->product_add_prices as $k=>$v){
                $rows[] = '"pq_'.$v->product_quantity_start.'":"'.str_replace('"','\"',formatprice($v->price)).'"';
            }            
        }
        
        print '{'.implode(",",$rows).'}';        
        die();
    }
    
    function showmedia() {
        $jshopConfig = &JSFactory::getConfig();
        $media_id = JRequest::getInt('media_id');
        $file = &JTable::getInstance('productfiles', 'jshop');
        $file->load($media_id);
        $view_name = "product";
        
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);
        $view->setLayout("playmedia");
        $view->assign('config', $jshopConfig);
        $view->assign('filename', $file->demo);
        $view->assign('description', $file->demo_descr);
        $view->display(); 
        die();
    }
    
}

?>