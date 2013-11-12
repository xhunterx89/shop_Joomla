<?php
/**
* @version      2.9.0 16.12.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerVendor extends JController{

    function display(){
        $mainframe =& JFactory::getApplication();
        $params = $mainframe->getParams();
        $document =& JFactory::getDocument();
        $jshopConfig = &JSFactory::getConfig();
        
        $seo = &JTable::getInstance("seo", "jshop");
        $seodata = $seo->loadData("vendors");        
        if ($seodata->title==""){
            $seodata->title = $params->get('page_title');
        }
        setMetaData($seodata->title, $seodata->keyword, $seodata->description);
        
        $context = "jshoping.list.front.vendor";        
        $limit = $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $jshopConfig->count_products_to_page, 'int');        
        $limitstart = JRequest::getInt('limitstart');
        
        $vendor = &JTable::getInstance('vendor', 'jshop');
        $total = $vendor->getCountAllVendors();
        
        if ($limitstart>=$total) $limitstart = 0;
        
        $rows = $vendor->getAllVendors(1, $limitstart, $limit);
        
        JPluginHelper::importPlugin('jshopping');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeDisplayListVendors', array(&$rows) );
        
        jimport('joomla.html.pagination');
        $pagination = new JPagination($total, $limitstart, $limit);
        $pagenav = $pagination->getPagesLinks();
        
        if ($limitstart==0){
        $mainvendor = &JSFactory::getMainVendor();        
        $firstvendor = array($mainvendor);
        $rows = array_merge($firstvendor, $rows);
        }
        
        foreach($rows as $k=>$v){
            $rows[$k]->link = SEFLink("index.php?option=com_jshopping&controller=vendor&task=products&vendor_id=".$v->id);
            if (!$v->logo){
                $rows[$k]->logo = $jshopConfig->image_vendors_live_path."/noimage.gif";
            }
        }       

        $view_name = "vendor";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);
        $view->setLayout("vendors");
        $view->assign("rows", $rows);        
        $view->assign('count_to_row', $jshopConfig->count_category_to_row);        
        $view->assign('params', $params);        
        $view->assign('navigation_products', $pagenav);
        $view->display();        
    }  
    
    function info(){
        $jshopConfig = &JSFactory::getConfig();
        if (!$jshopConfig->product_show_vendor_detail){
            JError::raiseError( 404, _JSHOP_PAGE_NOT_FOUND);
            return;   
        }
        $vendor_id = JRequest::getInt("vendor_id");        
        $vendor = &JTable::getInstance('vendor', 'jshop');
        $vendor->loadFull($vendor_id);
        
        JPluginHelper::importPlugin('jshopping');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeDisplayVendorInfo', array(&$vendor) );
        
        $title =  $vendor->shop_name;
        $header =  $vendor->shop_name;        
        appendPathWay($title);
        
        $seo = &JTable::getInstance("seo", "jshop");
        $seodata = $seo->loadData("vendor-info-".$vendor_id);
        if ($seodata->title==""){
            $seodata->title = $title;
        }
        setMetaData($seodata->title, $seodata->keyword, $seodata->description);
        
        $lang = &JSFactory::getLang();
        $country = &JTable::getInstance('country', 'jshop');
        $country->load($vendor->country);
        $_name = $lang->get("name");
        $vendor->country = $country->$_name;
        
        $view_name = "vendor";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);        
        $view->setLayout("info");
        $view->assign('vendor', $vendor);                
        $view->assign('header', $header);
        $view->display();
        
    }
    
    function products(){
        $mainframe =& JFactory::getApplication();
        $jshopConfig = &JSFactory::getConfig();
        $session =& JFactory::getSession();
        $session->set("jshop_end_page_buy_product", $_SERVER['REQUEST_URI']);
        
        JPluginHelper::importPlugin('jshoppingproducts');
        $dispatcher =& JDispatcher::getInstance();        
        $dispatcher->trigger( 'onBeforeLoadProductList', array() );
        
        $vendor_id = JRequest::getInt("vendor_id");        
        $vendor = &JTable::getInstance('vendor', 'jshop');
        $vendor->loadFull($vendor_id);
        
        JPluginHelper::importPlugin('jshopping');        
        $dispatcher->trigger( 'onBeforeDisplayVendor', array(&$vendor) );        
        
        appendPathWay($vendor->shop_name);        
        $seo = &JTable::getInstance("seo", "jshop");
        $seodata = $seo->loadData("vendor-product-".$vendor_id);
        if ($seodata->title==""){
            $seodata->title = $vendor->shop_name;
        }
        setMetaData($seodata->title, $seodata->keyword, $seodata->description);
        
        $action = SEFLink("index.php?option=com_jshopping&controller=vendor&task=products&vendor_id=".$vendor_id);
        
        
        $products_page = $jshopConfig->count_products_to_page;
        $count_product_to_row = $jshopConfig->count_products_to_row;        
                
        $context = "jshoping.vendor.front.product";
        $orderby = $mainframe->getUserStateFromRequest( $context.'orderby', 'orderby', $jshopConfig->product_sorting_direction, 'int');
        $order = $mainframe->getUserStateFromRequest( $context.'order', 'order', $jshopConfig->product_sorting, 'int');
        $limit = $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $products_page, 'int');
        if (!$limit) $limit = $products_page;
        $limitstart = JRequest::getInt('limitstart');

        $orderbyq = getQuerySortDirection($order, $orderby);
        $image_arr = getImgSortDirection($order, $orderby);
        $field_order = $jshopConfig->sorting_products_field_s_select[$order];
        
        //$categorys = $mainframe->getUserStateFromRequest( $context.'categorys_'.$manufacturer_id, 'categorys', array());
        //$categorys = filterAllowValue($categorys, "int+");
        /*if ($jshopConfig->admin_show_product_extra_field){            
            $extra_fields = $mainframe->getUserStateFromRequest( $context.'extra_fields_'.$manufacturer_id, 'extra_fields', array());
            $extra_fields = filterAllowValue($extra_fields, "array_int_k_v+");
        }*/
        //$price_from = $mainframe->getUserStateFromRequest( $context.'price_from_'.$manufacturer_id, 'price_from');
        //$price_from = saveAsPrice($price_from);
        //$price_to = $mainframe->getUserStateFromRequest( $context.'price_to_'.$manufacturer_id, 'price_to');
        //$price_to = saveAsPrice($price_to);
        
        $filters = array();        
        //$filters['categorys'] = $categorys;        
        //$filters['price_from'] = $price_from;        
        //$filters['price_to'] = $price_to;
        //if ($jshopConfig->admin_show_product_extra_field){
            //$filters['extra_fields'] = $extra_fields;        
        //} 
                                
        $total = $vendor->getCountProducts($filters);
       
        jimport('joomla.html.pagination');
        $pagination = new JPagination($total, $limitstart, $limit);            
        $pagenav = $pagination->getPagesLinks();
        
        if ($limitstart>=$total) $limitstart = 0;
                        
        $rows = $vendor->getProducts($filters, $field_order, $orderbyq, $limitstart, $limit);
        addLinkToProducts($rows, 0, 1);        
    
        foreach ($jshopConfig->sorting_products_name_s_select as $key => $value) {            
            $sorts[] = JHTML::_('select.option', $key, $value, 'sort_id', 'sort_value' );
        }

        insertValueInArray($products_page, $jshopConfig->count_product_select); //insert products_page count
        foreach ($jshopConfig->count_product_select as $key => $value) {            
            $product_count[] = JHTML::_('select.option',$key, $value, 'count_id', 'count_value' );
        }        
        $sorting_sel = JHTML::_('select.genericlist', $sorts, 'order', 'class = "inputbox" size = "1" onchange = "submitListProductFilters()"','sort_id', 'sort_value', $order );
        $product_count_sel = JHTML::_('select.genericlist', $product_count, 'limit', 'class = "inputbox" size = "1" onchange = "submitListProductFilters()"','count_id', 'count_value', $limit );
        
        $_review = &JTable::getInstance('review', 'jshop');
        $allow_review = $_review->getAllowReview();
        
        /*if ($jshopConfig->show_product_list_filters){
            $filter_categorys = $manufacturer->getCategorys();
            $first_category = array();
            $first_category[] = JHTML::_('select.option', 0, _JSHOP_ALL, 'id', 'name' );        
            $categorys_sel = JHTML::_('select.genericlist', array_merge($first_category, $filter_categorys), 'categorys[]', 'class = "inputbox" size = "1" onchange = "submitListProductFilters()"','id', 'name', $categorys[0]);
        }*/
        
        //$display_list_products = (count($rows)>0 || willBeUseFilter($filters));        
        $display_list_products = count($rows)>0;
        
        $dispatcher->trigger( 'onBeforeDisplayProductList', array(&$rows) );        
                        
        $view_name = "vendor";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);        
        $view->setLayout("products");
        $view->assign('config', $jshopConfig);
        $view->assign("rows", $rows);
        $view->assign("image_product_path", $jshopConfig->image_product_live_path);
        $view->assign('noimage', 'noimage.gif');
        $view->assign("count_product_to_row", $count_product_to_row);
        $view->assign("vendor", $vendor);
        $view->assign('action', $action);
        $view->assign('image_path', $jshopConfig->live_path.'images');        
        $view->assign('navigation_products', $pagenav);        
        $view->assign('allow_review', $allow_review);
        
        $view->assign('orderby', $orderby);        
        $view->assign('product_count', $product_count_sel);
        $view->assign('sorting', $sorting_sel);        
        $view->assign('image_arr', $image_arr);
        $view->assign('categorys_sel', $categorys_sel);
        $view->assign('filters', $filters);
        $view->assign('display_list_products', $display_list_products);
                
        $view->assign('shippinginfo', SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=shipping'));
            
        $view->display();        
    }
    
}

?>