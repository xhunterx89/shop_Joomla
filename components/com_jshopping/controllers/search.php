<?php
/**
* @version      2.9.0 18.04.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerSearch extends JController{
    
    function display(){
    	$jshopConfig = &JSFactory::getConfig();
    	JHTML::_('behavior.calendar');
        $mainframe =& JFactory::getApplication();
        $params = $mainframe->getParams();
        $Itemid = JRequest::getInt('Itemid');
        
        $seo = &JTable::getInstance("seo", "jshop");
        $seodata = $seo->loadData("search");        
        if (getThisURLMainPageShop()){
            appendPathWay(_JSHOP_SEARCH);
            if ($seodata->title==""){
                $seodata->title = _JSHOP_SEARCH;
            }
        }else{
            if ($seodata->title==""){
                $seodata->title = $params->get('page_title');
            }
        }
        setMetaData($seodata->title, $seodata->keyword, $seodata->description);
        
        $context = "jshoping.search.front";
        
        if ($jshopConfig->admin_show_product_extra_field){
            $urlsearchcaracters = SEFLink("index.php?option=com_jshopping&controller=search&task=get_html_characteristics&ajax=1",0,1);
            $change_cat_val = "onchange='updateSearchCharacteristic(\"".$urlsearchcaracters."\",this.value);'";
        }else{
            $change_cat_val = "";
        }
		$categories = buildTreeCategory(1);		
        $first = JHTML::_('select.option', 0, _JSHOP_SEARCH_ALL_CATEGORIES, 'category_id', 'name' );
		array_unshift($categories, $first);		
        $list_categories = JHTML::_('select.genericlist', $categories, 'category_id', 'class = "inputbox" size = "1" '.$change_cat_val, 'category_id', 'name' );
		
        $first = JHTML::_('select.option', 0, _JSHOP_SEARCH_ALL_MANUFACTURERS, 'manufacturer_id', 'name');
        $_manufacturers = &JTable::getInstance('manufacturer', 'jshop');
		$manufacturers = jshopManufacturer::getAllManufacturers(1);
		array_unshift($manufacturers, $first);		
        $list_manufacturers = JHTML::_('select.genericlist', $manufacturers, 'manufacturer_id', 'class = "inputbox" size = "1"','manufacturer_id','name' );
        
        if ($jshopConfig->admin_show_product_extra_field){
            $characteristic_fields = &JSFactory::getAllProductExtraField();
            $characteristic_fieldvalues = &JSFactory::getAllProductExtraFieldValueDetail();
            $characteristic_displayfields = &JSFactory::getDisplayFilterExtraFieldForCategory($category_id);
        }
        
        $characteristics = "";
        if ($jshopConfig->admin_show_product_extra_field){ 
            $view_name = "search";
            $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
            $view = &$this->getView($view_name, 'html', '', $view_config);
            $view->setLayout("characteristics");
            $view->assign('characteristic_fields', $characteristic_fields);        
            $view->assign('characteristic_fieldvalues', $characteristic_fieldvalues);        
            $view->assign('characteristic_displayfields', $characteristic_displayfields);        
            $characteristics = $view->loadTemplate();
        }
        
        $view_name = "search";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);
        $view->setLayout("form");
		$view->assign('list_categories', $list_categories);
        $view->assign('list_manufacturers', $list_manufacturers);
		$view->assign('characteristics', $characteristics);
        $view->assign('config', $jshopConfig);
        $view->assign('Itemid', $Itemid);        
		$view->assign('action', SEFLink("index.php?option=com_jshopping&controller=search&task=result"));
		$view->display();
    }
    
    function result(){
        $mainframe =& JFactory::getApplication();
        $jshopConfig = &JSFactory::getConfig();
        $db = &JFactory::getDBO();
        $lang = &JSFactory::getLang();
        $session =& JFactory::getSession();
        $session->set("jshop_end_page_buy_product", $_SERVER['REQUEST_URI']);
        $params = $mainframe->getParams();
        
        JPluginHelper::importPlugin('jshoppingproducts');
        $dispatcher =& JDispatcher::getInstance();        
        $dispatcher->trigger( 'onBeforeLoadProductList', array() );
       
        $seo = &JTable::getInstance("seo", "jshop");
        $seodata = $seo->loadData("search-result");        
        if (getThisURLMainPageShop()){
            appendPathWay(_JSHOP_SEARCH);
            if ($seodata->title==""){
                $seodata->title = _JSHOP_SEARCH;
            }
        }else{
            if ($seodata->title==""){
                $seodata->title = $params->get('page_title');
            }
        }
        setMetaData($seodata->title, $seodata->keyword, $seodata->description);
                
        $post = JRequest::get('post');
        if ($post['setsearchdata']==1){
            $session->set("jshop_end_form_data", $post);
        }else{
            $data = $session->get("jshop_end_form_data");
            if (count($data)){
                $post = $data;
            }
        }

        $category_id = intval($post['category_id']);
        $manufacturer_id = intval($post['manufacturer_id']);
        $date_to = $post['date_to'];
        $date_from = $post['date_from'];
        $price_to = saveAsPrice($post['price_to']);
        $price_from = saveAsPrice($post['price_from']);
        $include_subcat = intval($post['include_subcat']);
        $search = $post['search'];
        $context = "jshoping.searclist.front.product";
        $orderby = $mainframe->getUserStateFromRequest($context.'orderby', 'orderby', $jshopConfig->product_sorting_direction, 'int');
        $order = $mainframe->getUserStateFromRequest($context.'order', 'order', $jshopConfig->product_sorting, 'int');
        $limit = $mainframe->getUserStateFromRequest($context.'limit', 'limit', $jshopConfig->count_products_to_page, 'int');
        if (!$limit) $limit = $jshopConfig->count_products_to_page;
        $limitstart = JRequest::getInt('limitstart',0);
        if ($jshopConfig->admin_show_product_extra_field){
            $extra_fields = $post['extra_fields'];
            $extra_fields = filterAllowValue($extra_fields, "array_int_k_v+");
        }
        
        $orderbyq = getQuerySortDirection($order, $orderby);
        $image_arr = getImgSortDirection($order, $orderby);

        $where = array();
        $from = array();
        $restext = "";

        if ($date_to && checkMyDate($date_to)) {
            $where[] = " AND prod.product_date_added <= '".$db->getEscaped($date_to)."'";
        }
        if ($date_from && checkMyDate($date_from)) {
            $where[] = " AND prod.product_date_added >= '".$db->getEscaped($date_from)."'";
        }      
        
        $price_to = getCorrectedPriceForQueryFilter($price_to);
        if ($price_to) {
            if ($jshopConfig->product_list_show_min_price){
                $where[] = " AND (prod.product_price<=".$price_to." OR prod.min_price<=".$price_to." )";
            }else{
                $where[] = " AND prod.product_price <= ".$price_to;
            }
        } 
        $price_from = getCorrectedPriceForQueryFilter($price_from);
        if ($price_from) {
            if ($jshopConfig->product_list_show_min_price){
                $where[] = " AND (prod.product_price >= ".$price_from." OR prod.min_price >= " . $price_from." )";
            }else{
                $where[] = " AND prod.product_price >= " . $price_from;
            }
        }

        if ($manufacturer_id) {
            $from[] = " LEFT JOIN `#__jshopping_manufacturers` AS manuf ON prod.product_manufacturer_id = manuf.manufacturer_id ";
            $where[] = " AND prod.product_manufacturer_id = '".$manufacturer_id."'";
        }
        
        if ($jshopConfig->hide_product_not_avaible_stock){
            $where[] = " AND prod.product_quantity > 0";
        }
        
        if ($jshopConfig->admin_show_product_extra_field && is_array($extra_fields)){
            foreach($extra_fields as $f_id=>$vals){
                if (is_array($vals) && count($vals)){
                    $where[] = " AND prod.`extra_field_".$f_id."` in (".implode(",",$vals).")";
                }
            }
        }
        
        if ($jshopConfig->show_delivery_time){            
            $restext .= ", prod.delivery_times_id";
        }
        
        if ($jshopConfig->admin_show_product_extra_field){
            $restext .= getQueryListProductsExtraFields();
        }
        
        if ($jshopConfig->product_list_show_vendor){
            $restext .= ", prod.vendor_id";
        }

        if ($category_id) {
            if ($include_subcat) {
            	$_category = &JTable::getInstance('category', 'jshop');
                $all_categories = jshopCategory::getAllCategories();
                $cat_search[] = $category_id;
                searchChildCategories($category_id, $all_categories, $cat_search);
                $where_sub_cat = " AND (";
                foreach ($cat_search as $key => $value) {
                    $where_sub_cat .= "pr_cat.category_id = '" . $value . "' OR ";
                }
                $where_sub_cat = substr($where_sub_cat,0,strlen($where_sub_cat) - 3);
                $where_sub_cat .= ' )';
                $where[] = $where_sub_cat;
            } else {
                $where[] = " AND pr_cat.category_id = '" . $category_id . "'";
            }
        }
        
        $where_query = $from_query = '';
        foreach ($where as $wh) {
            $where_query .= $wh;
        }
        foreach ($from as $fr) {
            $from_query .= $fr;
        }                
                
        $words = explode(" ", $search);
        foreach($words as $word){
            $word = addcslashes($db->getEscaped($word), "_%");
            $search_word[] = "LOWER(prod.`".$lang->get('name')."`) LIKE '%" . $word . "%' OR LOWER(prod.`".$lang->get('short_description')."`) LIKE '%" . $word . "%' OR LOWER(prod.`".$lang->get('description')."`) LIKE '%" . $word . "%' OR prod.product_ean LIKE '%" . $word . "%'";
        }
        $where_search = implode(" OR ", $search_word);
        
        $query = "SELECT count(distinct prod.product_id) FROM `#__jshopping_products` AS prod
                  LEFT JOIN `#__jshopping_products_to_categories` AS pr_cat ON pr_cat.product_id = prod.product_id
                  LEFT JOIN `#__jshopping_categories` AS cat ON pr_cat.category_id = cat.category_id                  
                  $from_query
                  WHERE ($where_search) AND prod.product_publish = '1' AND cat.category_publish='1'
                  $where_query";
        $db->setQuery($query);
        $total = $db->loadResult();
        
        if (!$total) {
            $view_name = "search";
            $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
            $view = &$this->getView($view_name, 'html', '', $view_config);
            $view->setLayout("noresult");
            $view->display();            
            return 0;
        }
        
        $query = "SELECT prod.product_id, pr_cat.category_id, prod.`".$lang->get('name')."` as name, prod.`".$lang->get('short_description')."` as short_description, prod.product_ean, prod.product_thumb_image, prod.product_price, prod.product_tax_id as tax_id, prod.product_old_price, prod.product_weight, prod.average_rating, prod.reviews_count, prod.hits, prod.weight_volume_units, prod.basic_price_unit_id, prod.label_id, prod.product_manufacturer_id, prod.product_weight, prod.min_price, prod.product_quantity, prod.different_prices $restext
                  FROM `#__jshopping_products` AS prod
                  LEFT JOIN `#__jshopping_products_to_categories` AS pr_cat ON pr_cat.product_id = prod.product_id
                  LEFT JOIN `#__jshopping_categories` AS cat ON pr_cat.category_id = cat.category_id                  
                  $from_query
                  WHERE ($where_search) AND prod.product_publish = '1' AND cat.category_publish='1'
                  $where_query                  
                  GROUP BY prod.product_id";
        
        $orderbyf = $jshopConfig->sorting_products_field_s_select[$order];
        if ($orderbyf){
            $query = $query." order by ".$orderbyf." ".$orderbyq;
        }
        $db->setQuery($query, $limitstart, $limit);
        $rows = $db->loadObjectList();
        
        $rows = listProductUpdateData($rows);
        addLinkToProducts($rows,0,1);
        
        jimport('joomla.html.pagination');
        $pagination = new JPagination($total, $limitstart, $limit);            
        $pagenav = $pagination->getPagesLinks();
        
        foreach ($jshopConfig->sorting_products_name_s_select as $key => $value) {
            $sorts[] = JHTML::_('select.option', $key, $value, 'sort_id', 'sort_value' );
        }

        insertValueInArray($jshopConfig->count_products_to_page, $jshopConfig->count_product_select); //insert category count
        foreach ($jshopConfig->count_product_select as $key => $value) {            
            $product_count[] = JHTML::_('select.option',$key, $value, 'count_id', 'count_value' );
        }        
        $sorting_sel = JHTML::_('select.genericlist', $sorts, 'order', 'class = "inputbox" size = "1" onchange = "submitListProductFilters()"','sort_id', 'sort_value', $order );
        $product_count_sel = JHTML::_('select.genericlist', $product_count, 'limit', 'class = "inputbox" size = "1" onchange = "submitListProductFilters()"','count_id', 'count_value', $limit );
        
        $_review = &JTable::getInstance('review', 'jshop');
        $allow_review = $_review->getAllowReview();
        
        $action = $_SERVER['REQUEST_URI'];
        
        $dispatcher->trigger( 'onBeforeDisplayProductList', array(&$rows) );
                        
        $view_name = "search";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);
        $view->setLayout("result");
        
        $view->assign('config', $jshopConfig);
        $view->assign('product_count', $product_count_sel);
        $view->assign('sorting', $sorting_sel);
        $view->assign('image_arr', $image_arr);
        $view->assign('action', $action);
        $view->assign('orderby', $orderby);
                
        $view->assign('navigation_products', $pagenav);        
        $view->assign('count_product_to_row', $jshopConfig->count_products_to_row);
        $view->assign('lists_prod', $rows);
        $view->assign('Itemid', $Itemid);
        $view->assign('noimage','noimage.gif');
        $view->assign('image_path', $jshopConfig->live_path.'images');
        $view->assign('image_product_path', $jshopConfig->image_product_live_path);
        $view->assign('allow_review', $allow_review);
        $view->assign('shippinginfo', SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=shipping'));
        $view->display();
    }
    
    function get_html_characteristics(){
        $jshopConfig = &JSFactory::getConfig();
        $category_id = JRequest::getInt("category_id");
        if ($jshopConfig->admin_show_product_extra_field){
            $characteristic_fields = &JSFactory::getAllProductExtraField();
            $characteristic_fieldvalues = &JSFactory::getAllProductExtraFieldValueDetail();
            $characteristic_displayfields = &JSFactory::getDisplayFilterExtraFieldForCategory($category_id);
            
            $view_name = "search";
            $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
            $view = &$this->getView($view_name, 'html', '', $view_config);
            $view->setLayout("characteristics");
            $view->assign('characteristic_fields', $characteristic_fields);        
            $view->assign('characteristic_fieldvalues', $characteristic_fieldvalues);        
            $view->assign('characteristic_displayfields', $characteristic_displayfields);        
            $view->display();
        }
    die();
    }
    
}

?>