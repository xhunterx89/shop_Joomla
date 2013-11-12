<?php
/**
* @version      2.9.0 01.04.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerCategory extends JController{

    function display(){
        $mainframe =& JFactory::getApplication();
        $db =& JFactory::getDBO();
        $jshopConfig = &JSFactory::getConfig();
        $params = $mainframe->getParams();
        $category_id = 0;        
        
        $ordering = $jshopConfig->category_sorting==1 ? "ordering" : "name";
        $category = &JTable::getInstance('category', 'jshop');        
        $category->load($category_id);
        $categories = $category->getChildCategories($ordering, 'asc', 1);
        $category->getDescription();
        
        JPluginHelper::importPlugin('jshopping');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeDisplayMainCategory', array(&$category, &$categories) );
             
        if ($category->meta_title==""){
            $category->meta_title = $params->get('page_title');
        }
        setMetaData($category->meta_title, $category->meta_keyword, $category->meta_description);
        
        if ($jshopConfig->use_plugin_content){        
            changeDataUsePluginContent($category, "category");
        }

        $view_name = "category";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);
        $view->setLayout("mainpage");
        $view->assign('category', $category);
        $view->assign('image_category_path', $jshopConfig->image_category_live_path);        
        $view->assign('noimage', 'noimage.gif');
        $view->assign('categories', $categories);        
        $view->assign('count_category_to_row', $jshopConfig->count_category_to_row);
        $view->assign('params', $params);
        
        $view->display();
    }
    
    
    function view(){
    
        $mainframe =& JFactory::getApplication();
        $db =& JFactory::getDBO();    
        $jshopConfig = &JSFactory::getConfig();
        $session =& JFactory::getSession();
        $session->set("jshop_end_page_buy_product", $_SERVER['REQUEST_URI']);
        
        JPluginHelper::importPlugin('jshoppingproducts');
        JPluginHelper::importPlugin('jshopping');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeLoadProductList', array() );

        $category_id = JRequest::getInt('category_id');
        $category = &JTable::getInstance('category', 'jshop');
        $category->load($category_id);
        $category->getDescription();        
        
        if ($category->category_publish==0){
            JError::raiseError( 404, _JSHOP_PAGE_NOT_FOUND);
            return;
        }
        
        $view_name = "category";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);
		if ($category->category_template=="") $category->category_template="default";		            
        $view->setLayout("category_".$category->category_template);        

        $jshopConfig->count_products_to_page = $category->products_page;

        $context = "jshoping.list.front.product";
        $orderby = $mainframe->getUserStateFromRequest( $context.'orderby', 'orderby', $jshopConfig->product_sorting_direction, 'int');
        $order = $mainframe->getUserStateFromRequest( $context.'order', 'order', $jshopConfig->product_sorting, 'int');
        $limit = $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $category->products_page, 'int');
        if (!$limit) $limit = $category->products_page;
        $limitstart = JRequest::getInt('limitstart');
        
        $orderbyq = getQuerySortDirection($order, $orderby);
        $image_arr = getImgSortDirection($order, $orderby);
        $field_order = $jshopConfig->sorting_products_field_select[$order];
        
        $manufacturers = $mainframe->getUserStateFromRequest( $context.'manufacturers_'.$category_id, 'manufacturers', array());
        $manufacturers = filterAllowValue($manufacturers, "int+");
        
        if ($jshopConfig->admin_show_product_extra_field){
            $extra_fields = $mainframe->getUserStateFromRequest( $context.'extra_fields_'.$category_id, 'extra_fields', array());
            $extra_fields = filterAllowValue($extra_fields, "array_int_k_v+");
        }
        
        $price_from = $mainframe->getUserStateFromRequest( $context.'price_from_'.$category_id, 'price_from');
        $price_from = saveAsPrice($price_from);
        $price_to = $mainframe->getUserStateFromRequest( $context.'price_to_'.$category_id, 'price_to');
        $price_to = saveAsPrice($price_to);

        if (getShopMainPageItemid()==JRequest::getInt('Itemid')){
            appendExtendPathWay($category->getTreeChild(), 'category');
        }
        
        $orderfield = $jshopConfig->category_sorting==1 ? "ordering" : "name";        
        $sub_categories = $category->getChildCategories($orderfield, 'asc', $publish = 1);        
        $dispatcher->trigger( 'onBeforeDisplayCategory', array(&$category, &$sub_categories) );

        if ($category->meta_title=="") $category->meta_title = $category->name;
        setMetaData($category->meta_title, $category->meta_keyword, $category->meta_description);
        
        $filters = array();        
        $filters['manufacturers'] = $manufacturers;
        $filters['price_from'] = $price_from;        
        $filters['price_to'] = $price_to;
        if ($jshopConfig->admin_show_product_extra_field){
            $filters['extra_fields'] = $extra_fields;        
        }
        
        $total = $category->getCountProducts($filters, 1, $jshopConfig->hide_product_not_avaible_stock);
        $action = SEFLink("index.php?option=com_jshopping&controller=category&task=view&category_id=".$category_id);
                
        if ($limitstart>=$total) $limitstart = 0;

        $products = $category->getProducts($filters, $field_order, $orderbyq, $limitstart, $limit);
		addLinkToProducts($products, $category_id);

        jimport('joomla.html.pagination');
        $pagination = new JPagination($total, $limitstart, $limit);            
        $pagenav = $pagination->getPagesLinks();        
        
        foreach ($jshopConfig->sorting_products_name_select as $key => $value) {            
            $sorts[] = JHTML::_('select.option', $key, $value, 'sort_id', 'sort_value' );
        }
        
        insertValueInArray($category->products_page, $jshopConfig->count_product_select); //insert category count
        foreach ($jshopConfig->count_product_select as $key => $value) {            
            $product_count[] = JHTML::_('select.option',$key, $value, 'count_id', 'count_value' );
        }        
        $sorting_sel = JHTML::_('select.genericlist', $sorts, 'order', 'class = "inputbox" size = "1" onchange = "submitListProductFilters()"','sort_id', 'sort_value', $order );
        $product_count_sel = JHTML::_('select.genericlist', $product_count, 'limit', 'class = "inputbox" size = "1" onchange = "submitListProductFilters()"','count_id', 'count_value', $limit );
        
        $_review = &JTable::getInstance('review', 'jshop');
        $allow_review = $_review->getAllowReview();        
        
        if (!$category->category_ordertype) $category->category_ordertype = 1;        
        
        if ($jshopConfig->show_product_list_filters){
            $filter_manufactures = $category->getManufacturers();
            $first_manufacturer = array();
            $first_manufacturer[] = JHTML::_('select.option', 0, _JSHOP_ALL, 'id', 'name' );        
            $manufacuturers_sel = JHTML::_('select.genericlist', array_merge($first_manufacturer, $filter_manufactures), 'manufacturers[]', 'class = "inputbox" size = "1" onchange = "submitListProductFilters()"','id', 'name', $manufacturers[0]);
        }
        
        if ($jshopConfig->use_plugin_content){        
            changeDataUsePluginContent($category, "category");
        }

        $display_list_products = (count($products)>0 || willBeUseFilter($filters));
                
        $dispatcher->trigger( 'onBeforeDisplayProductList', array(&$products) );
        
        $view->assign('config', $jshopConfig);
        $view->assign('navigation_products', $pagenav);
        $view->assign('lists_prod', $products);
        $view->assign('count_product_to_row', $category->products_row);
        $view->assign('image_product_path', $jshopConfig->image_product_live_path);
        $view->assign('image_category_path', $jshopConfig->image_category_live_path);
        $view->assign('image_path', $jshopConfig->live_path.'images');
        $view->assign('noimage', 'noimage.gif');
        $view->assign('category', $category);
        $view->assign('categories', $sub_categories);
        $view->assign('count_category_to_row', $jshopConfig->count_category_to_row);        
        $view->assign('allow_review', $allow_review);
        
        $view->assign('product_count', $product_count_sel);
        $view->assign('sorting', $sorting_sel);
        $view->assign('image_arr', $image_arr);
        $view->assign('action', $action);
        $view->assign('orderby', $orderby);
        $view->assign('manufacuturers_sel', $manufacuturers_sel);
        $view->assign('filters', $filters);
        $view->assign('display_list_products', $display_list_products);
        
        $view->assign('shippinginfo', SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=shipping'));                
        
        $view->display();        
    }
    
}

?>