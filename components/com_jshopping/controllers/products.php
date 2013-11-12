<?php
/**
* @version      3.2.4 06.08.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerProducts extends JController{
	
	function display(){
	    $mainframe =& JFactory::getApplication();
		$jshopConfig = &JSFactory::getConfig();
        $session =& JFactory::getSession();
        $session->set("jshop_end_page_buy_product", $_SERVER['REQUEST_URI']);
        
        JPluginHelper::importPlugin('jshoppingproducts');
        $dispatcher =& JDispatcher::getInstance();        
        $dispatcher->trigger( 'onBeforeLoadProductList', array() );
        
        $product = &JTable::getInstance('product', 'jshop');
        $params = $mainframe->getParams();
                
        if ($params->get('page_title')){
            $title = $params->get('page_title');
        }
        $header = getPageHeaderOfParams($params);
        $prefix = $params->get('pageclass_sfx');        
        $seo = &JTable::getInstance("seo", "jshop");
        $seodata = $seo->loadData("all-products");
        if ($seodata->title==""){
            $seodata->title = $title;
        }
        setMetaData($seodata->title, $seodata->keyword, $seodata->description);
        
		$action = SEFLink("index.php?option=com_jshopping&controller=products");

		$products_page = $jshopConfig->count_products_to_page;         
		$count_product_to_row = $jshopConfig->count_products_to_row;        
				
		$context = "jshoping.alllist.front.product";
        $orderby = $mainframe->getUserStateFromRequest( $context.'orderby', 'orderby', $jshopConfig->product_sorting_direction, 'int');
        $order = $mainframe->getUserStateFromRequest( $context.'order', 'order', $jshopConfig->product_sorting, 'int');
        $limit = $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $products_page, 'int');
        if (!$limit) $limit = $products_page;
        $limitstart = JRequest::getInt('limitstart');

        $orderbyq = getQuerySortDirection($order, $orderby);
        $image_arr = getImgSortDirection($order, $orderby);
        $field_order = $jshopConfig->sorting_products_field_s_select[$order];
        
        $manufacturers = $mainframe->getUserStateFromRequest( $context.'manufacturers', 'manufacturers', array());
        $manufacturers = filterAllowValue($manufacturers, "int+");
        $categorys = $mainframe->getUserStateFromRequest( $context.'categorys', 'categorys', array());
        $categorys = filterAllowValue($categorys, "int+");
        if ($jshopConfig->admin_show_product_extra_field){            
            $extra_fields = $mainframe->getUserStateFromRequest( $context.'extra_fields', 'extra_fields', array());
            $extra_fields = filterAllowValue($extra_fields, "array_int_k_v+");
        }
        $price_from = $mainframe->getUserStateFromRequest( $context.'price_from', 'price_from');
        $price_from = saveAsPrice($price_from);
        $price_to = $mainframe->getUserStateFromRequest( $context.'price_to', 'price_to');
        $price_to = saveAsPrice($price_to);
        
        $filters = array();
        $filters['manufacturers'] = $manufacturers;        
        $filters['categorys'] = $categorys;        
        $filters['price_from'] = $price_from;        
        $filters['price_to'] = $price_to;
        if ($jshopConfig->admin_show_product_extra_field){
            $filters['extra_fields'] = $extra_fields;        
        } 
				                
        $total = $product->getCountAllProducts($filters);
       
        jimport('joomla.html.pagination');
        $pagination = new JPagination($total, $limitstart, $limit);            
        $pagenav = $pagination->getPagesLinks();
        
        if ($limitstart>=$total) $limitstart = 0;
                        
		$rows = $product->getAllProducts($filters, $field_order, $orderbyq, $limitstart, $limit);
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
        
        if ($jshopConfig->show_product_list_filters){
            $first_el = JHTML::_('select.option', 0, _JSHOP_ALL, 'manufacturer_id', 'name' );
            $_manufacturers = &JTable::getInstance('manufacturer', 'jshop');
            $listmanufacturers = jshopManufacturer::getAllManufacturers(1);            
            array_unshift($listmanufacturers, $first_el);
            $manufacuturers_sel = JHTML::_('select.genericlist', $listmanufacturers, 'manufacturers[]', 'class = "inputbox" size = "1" onchange = "submitListProductFilters()"','manufacturer_id','name', $manufacturers[0]);
            
            $first_el = JHTML::_('select.option', 0, _JSHOP_ALL, 'category_id', 'name' );
            $categories = buildTreeCategory(1);            
            array_unshift($categories, $first_el);        
            $categorys_sel = JHTML::_('select.genericlist', $categories, 'categorys[]', 'class = "inputbox" size = "1" onchange = "submitListProductFilters()"', 'category_id', 'name', $categorys[0] );
        }

        $display_list_products = (count($rows)>0 || willBeUseFilter($filters));
        
        $dispatcher->trigger( 'onBeforeDisplayProductList', array(&$rows) );
        				
        $view_name = "products";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);        
		$view->setLayout("listproducts");
        $view->assign('config', $jshopConfig);
        $view->assign("header", $header);
        $view->assign("prefix", $prefix);
		$view->assign("rows", $rows);
		$view->assign("image_product_path", $jshopConfig->image_product_live_path);
		$view->assign('noimage', 'noimage.gif');
		$view->assign("count_product_to_row", $count_product_to_row);		
        $view->assign('action', $action);
        $view->assign('image_path', $jshopConfig->live_path.'images');        
        $view->assign('navigation_products', $pagenav);        
        $view->assign('allow_review', $allow_review);
        
		$view->assign('orderby', $orderby);		
		$view->assign('product_count', $product_count_sel);
        $view->assign('sorting', $sorting_sel);		
        $view->assign('image_arr', $image_arr);
        $view->assign('categorys_sel', $categorys_sel);
        $view->assign('manufacuturers_sel', $manufacuturers_sel);
        $view->assign('filters', $filters);
        $view->assign('display_list_products', $display_list_products);
                
        $view->assign('shippinginfo', SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=shipping'));
        	
		$view->display();
	}
    
    function tophits(){
        $mainframe =& JFactory::getApplication();
        $jshopConfig = &JSFactory::getConfig();
        $session =& JFactory::getSession();
        $session->set("jshop_end_page_buy_product", $_SERVER['REQUEST_URI']);
        
        JPluginHelper::importPlugin('jshoppingproducts');
        $dispatcher =& JDispatcher::getInstance();        
        $dispatcher->trigger( 'onBeforeLoadProductList', array() );
        
        $product = &JTable::getInstance('product', 'jshop');
        $params = $mainframe->getParams();        
                
        if ($params->get('page_title')){
            $title = $params->get('page_title');
        }
        $header = getPageHeaderOfParams($params);
        $prefix = $params->get('pageclass_sfx');        
        $seo = &JTable::getInstance("seo", "jshop");
        $seodata = $seo->loadData("tophitsproducts");
        if ($seodata->title==""){
            $seodata->title = $title;
        }
        setMetaData($seodata->title, $seodata->keyword, $seodata->description);

        $count_product_to_row = $jshopConfig->count_products_to_row;                        
        $rows = $product->getTopHitsProducts($jshopConfig->count_products_to_page);
        addLinkToProducts($rows, 0, 1);
        
        $_review = &JTable::getInstance('review', 'jshop');
        $allow_review = $_review->getAllowReview();        
        $display_list_products = count($rows)>0;
        $jshopConfig->show_sort_product = 0;
        $jshopConfig->show_count_select_products = 0;
        $jshopConfig->show_product_list_filters = 0;
        
        $dispatcher->trigger( 'onBeforeDisplayProductList', array(&$rows) );
                        
        $view_name = "products";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);        
        $view->setLayout("listproducts");
        $view->assign('config', $jshopConfig);
        $view->assign("header", $header);
        $view->assign("prefix", $prefix);
        $view->assign("rows", $rows);
        $view->assign("image_product_path", $jshopConfig->image_product_live_path);
        $view->assign('noimage', 'noimage.gif');
        $view->assign("count_product_to_row", $count_product_to_row);        
        $view->assign('allow_review', $allow_review);
        $view->assign('display_list_products', $display_list_products);                
        $view->assign('shippinginfo', SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=shipping'));            
        $view->display();
    }
    
    function toprating(){
        $mainframe =& JFactory::getApplication();
        $jshopConfig = &JSFactory::getConfig();
        $session =& JFactory::getSession();
        $session->set("jshop_end_page_buy_product", $_SERVER['REQUEST_URI']);
        
        JPluginHelper::importPlugin('jshoppingproducts');
        $dispatcher =& JDispatcher::getInstance();        
        $dispatcher->trigger( 'onBeforeLoadProductList', array() );
        
        $product = &JTable::getInstance('product', 'jshop');
        $params = $mainframe->getParams();
                
        if ($params->get('page_title')){
            $title = $params->get('page_title');
        }
        $header = getPageHeaderOfParams($params);
        $prefix = $params->get('pageclass_sfx');        
        $seo = &JTable::getInstance("seo", "jshop");
        $seodata = $seo->loadData("topratingproducts");
        if ($seodata->title==""){
            $seodata->title = $title;
        }
        setMetaData($seodata->title, $seodata->keyword, $seodata->description);

        $count_product_to_row = $jshopConfig->count_products_to_row;                        
        $rows = $product->getTopRatingProducts($jshopConfig->count_products_to_page);
        addLinkToProducts($rows, 0, 1);
        
        $_review = &JTable::getInstance('review', 'jshop');
        $allow_review = $_review->getAllowReview();        
        $display_list_products = count($rows)>0;
        $jshopConfig->show_sort_product = 0;
        $jshopConfig->show_count_select_products = 0;
        $jshopConfig->show_product_list_filters = 0;
        
        $dispatcher->trigger( 'onBeforeDisplayProductList', array(&$rows) );
                        
        $view_name = "products";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);        
        $view->setLayout("listproducts");
        $view->assign('config', $jshopConfig);
        $view->assign("header", $header);
        $view->assign("prefix", $prefix);
        $view->assign("rows", $rows);
        $view->assign("image_product_path", $jshopConfig->image_product_live_path);
        $view->assign('noimage', 'noimage.gif');
        $view->assign("count_product_to_row", $count_product_to_row);        
        $view->assign('allow_review', $allow_review);
        $view->assign('display_list_products', $display_list_products);                
        $view->assign('shippinginfo', SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=shipping'));            
        $view->display();
    }
    
    function label(){
        $mainframe =& JFactory::getApplication();
        $jshopConfig = &JSFactory::getConfig();
        $session =& JFactory::getSession();
        $session->set("jshop_end_page_buy_product", $_SERVER['REQUEST_URI']);
        
        JPluginHelper::importPlugin('jshoppingproducts');
        $dispatcher =& JDispatcher::getInstance();        
        $dispatcher->trigger( 'onBeforeLoadProductList', array() );
        
        $product = &JTable::getInstance('product', 'jshop');               
        $params = $mainframe->getParams();
                
        if ($params->get('page_title')){
            $title = $params->get('page_title');
        }
        $header = getPageHeaderOfParams($params);
        $prefix = $params->get('pageclass_sfx');        
        $seo = &JTable::getInstance("seo", "jshop");
        $seodata = $seo->loadData("labelproducts");
        if ($seodata->title==""){
            $seodata->title = $title;
        }
        setMetaData($seodata->title, $seodata->keyword, $seodata->description);

        $label_id = JRequest::getInt("label_id");
        $count_product_to_row = $jshopConfig->count_products_to_row;                        
        $rows = $product->getProductLabel($label_id, $jshopConfig->count_products_to_page);
        addLinkToProducts($rows, 0, 1);
        
        $_review = &JTable::getInstance('review', 'jshop');
        $allow_review = $_review->getAllowReview();        
        $display_list_products = count($rows)>0;
        $jshopConfig->show_sort_product = 0;
        $jshopConfig->show_count_select_products = 0;
        $jshopConfig->show_product_list_filters = 0;
        
        $dispatcher->trigger( 'onBeforeDisplayProductList', array(&$rows) );
                        
        $view_name = "products";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);        
        $view->setLayout("listproducts");
        $view->assign('config', $jshopConfig);
        $view->assign("header", $header);
        $view->assign("prefix", $prefix);
        $view->assign("rows", $rows);
        $view->assign("image_product_path", $jshopConfig->image_product_live_path);
        $view->assign('noimage', 'noimage.gif');
        $view->assign("count_product_to_row", $count_product_to_row);        
        $view->assign('allow_review', $allow_review);
        $view->assign('display_list_products', $display_list_products);                
        $view->assign('shippinginfo', SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=shipping'));            
        $view->display();
    }
    
    function bestseller(){
        $mainframe =& JFactory::getApplication();
        $jshopConfig = &JSFactory::getConfig();
        $session =& JFactory::getSession();
        $session->set("jshop_end_page_buy_product", $_SERVER['REQUEST_URI']);
        
        JPluginHelper::importPlugin('jshoppingproducts');
        $dispatcher =& JDispatcher::getInstance();        
        $dispatcher->trigger( 'onBeforeLoadProductList', array() );
        
        $product = &JTable::getInstance('product', 'jshop');
        $params = $mainframe->getParams();
                
        if ($params->get('page_title')){
            $title = $params->get('page_title');
        }
        $header = getPageHeaderOfParams($params);
        $prefix = $params->get('pageclass_sfx');        
        $seo = &JTable::getInstance("seo", "jshop");
        $seodata = $seo->loadData("bestsellerproducts");
        if ($seodata->title==""){
            $seodata->title = $title;
        }
        setMetaData($seodata->title, $seodata->keyword, $seodata->description);

        $count_product_to_row = $jshopConfig->count_products_to_row;                        
        $rows = $product->getBestSellers($jshopConfig->count_products_to_page);
        addLinkToProducts($rows, 0, 1);
        
        $_review = &JTable::getInstance('review', 'jshop');
        $allow_review = $_review->getAllowReview();        
        $display_list_products = count($rows)>0;
        $jshopConfig->show_sort_product = 0;
        $jshopConfig->show_count_select_products = 0;
        $jshopConfig->show_product_list_filters = 0;

        $dispatcher->trigger( 'onBeforeDisplayProductList', array(&$rows) );
                        
        $view_name = "products";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);        
        $view->setLayout("listproducts");
        $view->assign('config', $jshopConfig);
        $view->assign("header", $header);
        $view->assign("prefix", $prefix);
        $view->assign("rows", $rows);
        $view->assign("image_product_path", $jshopConfig->image_product_live_path);
        $view->assign('noimage', 'noimage.gif');
        $view->assign("count_product_to_row", $count_product_to_row);        
        $view->assign('allow_review', $allow_review);
        $view->assign('display_list_products', $display_list_products);                
        $view->assign('shippinginfo', SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=shipping'));            
        $view->display();
    }
    
    function random(){
        $mainframe =& JFactory::getApplication();
        $jshopConfig = &JSFactory::getConfig();
        $session =& JFactory::getSession();
        $session->set("jshop_end_page_buy_product", $_SERVER['REQUEST_URI']);
        
        JPluginHelper::importPlugin('jshoppingproducts');
        $dispatcher =& JDispatcher::getInstance();        
        $dispatcher->trigger( 'onBeforeLoadProductList', array() );
        
        $product = &JTable::getInstance('product', 'jshop');
        $params = $mainframe->getParams();
                
        if ($params->get('page_title')){
            $title = $params->get('page_title');
        }
        $header = getPageHeaderOfParams($params);
        $prefix = $params->get('pageclass_sfx');        
        $seo = &JTable::getInstance("seo", "jshop");
        $seodata = $seo->loadData("randomproducts");
        if ($seodata->title==""){
            $seodata->title = $title;
        }
        setMetaData($seodata->title, $seodata->keyword, $seodata->description);

        $count_product_to_row = $jshopConfig->count_products_to_row;                        
        $rows = $product->getRandProducts($jshopConfig->count_products_to_page);
        addLinkToProducts($rows, 0, 1);
        
        $_review = &JTable::getInstance('review', 'jshop');
        $allow_review = $_review->getAllowReview();        
        $display_list_products = count($rows)>0;
        $jshopConfig->show_sort_product = 0;
        $jshopConfig->show_count_select_products = 0;
        $jshopConfig->show_product_list_filters = 0;

        $dispatcher->trigger( 'onBeforeDisplayProductList', array(&$rows) );
                        
        $view_name = "products";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);        
        $view->setLayout("listproducts");
        $view->assign('config', $jshopConfig);
        $view->assign("header", $header);
        $view->assign("prefix", $prefix);
        $view->assign("rows", $rows);
        $view->assign("image_product_path", $jshopConfig->image_product_live_path);
        $view->assign('noimage', 'noimage.gif');
        $view->assign("count_product_to_row", $count_product_to_row);        
        $view->assign('allow_review', $allow_review);
        $view->assign('display_list_products', $display_list_products);                
        $view->assign('shippinginfo', SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=shipping'));            
        $view->display();
    }
    
    function last(){
        $mainframe =& JFactory::getApplication();
        $jshopConfig = &JSFactory::getConfig();
        $session =& JFactory::getSession();
        $session->set("jshop_end_page_buy_product", $_SERVER['REQUEST_URI']);
        
        JPluginHelper::importPlugin('jshoppingproducts');
        $dispatcher =& JDispatcher::getInstance();        
        $dispatcher->trigger( 'onBeforeLoadProductList', array() );
        
        $product = &JTable::getInstance('product', 'jshop');
        $params = $mainframe->getParams();
                
        if ($params->get('page_title')){
            $title = $params->get('page_title');
        }
        $header = getPageHeaderOfParams($params);
        $prefix = $params->get('pageclass_sfx');        
        $seo = &JTable::getInstance("seo", "jshop");
        $seodata = $seo->loadData("lastproducts");
        if ($seodata->title==""){
            $seodata->title = $title;
        }
        setMetaData($seodata->title, $seodata->keyword, $seodata->description);

        $count_product_to_row = $jshopConfig->count_products_to_row;                        
        $rows = $product->getLastProducts($jshopConfig->count_products_to_page);
        addLinkToProducts($rows, 0, 1);
        
        $_review = &JTable::getInstance('review', 'jshop');
        $allow_review = $_review->getAllowReview();        
        $display_list_products = count($rows)>0;
        $jshopConfig->show_sort_product = 0;
        $jshopConfig->show_count_select_products = 0;
        $jshopConfig->show_product_list_filters = 0;
        
        $dispatcher->trigger( 'onBeforeDisplayProductList', array(&$rows) );
                        
        $view_name = "products";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);        
        $view->setLayout("listproducts");
        $view->assign('config', $jshopConfig);
        $view->assign("header", $header);
        $view->assign("prefix", $prefix);
        $view->assign("rows", $rows);
        $view->assign("image_product_path", $jshopConfig->image_product_live_path);
        $view->assign('noimage', 'noimage.gif');
        $view->assign("count_product_to_row", $count_product_to_row);        
        $view->assign('allow_review', $allow_review);
        $view->assign('display_list_products', $display_list_products);                
        $view->assign('shippinginfo', SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=shipping'));            
        $view->display();
    }
    	
}
?>