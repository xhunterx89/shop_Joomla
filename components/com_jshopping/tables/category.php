<?php
/**
* @version      2.9.0 07.12.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die('Restricted access');

class jshopCategory extends JTableAvto {
    
    function __construct( &$_db ){
        parent::__construct( '#__jshopping_categories', 'category_id', $_db );
    }
    
    function getSubCategories($parentId, $order = 'id', $ordering = 'asc', $publish = 0) {
        $lang = &JSFactory::getLang(); 
        $add_where = ($publish)?(" AND category_publish = '1' "):("");        
        if ($order=="id") $orderby = "category_id";
        if ($order=="name") $orderby = "`".$lang->get('name')."`";
        if ($order=="ordering") $orderby = "ordering";
        if (!$orderby) $orderby = "ordering";
        
        $query = "SELECT `".$lang->get('name')."` as name,`".$lang->get('description')."` as description,`".$lang->get('short_description')."` as short_description, category_id, category_publish, ordering, category_image FROM `#__jshopping_categories`
                   WHERE category_parent_id = '" . $this->_db->getEscaped($parentId) . "'" . $add_where . "
                   ORDER BY ".$orderby." ".$ordering;
        $this->_db->setQuery($query);
        $categories = $this->_db->loadObjectList();
                
        foreach ($categories as $key => $value){
            $categories[$key]->category_link = SEFLink('index.php?option=com_jshopping&controller=category&task=view&category_id='.$categories[$key]->category_id, 1);
        }
                
        return $categories;
    }

    function getName() {
        $lang = &JSFactory::getLang();
        $name = $lang->get('name');
        return $this->$name;
    }
    
    function getDescription(){
        
        if (!$this->category_id){
            $this->getDescriptionMainPage();
            return 1; 
        }
        
        $lang = &JSFactory::getLang();
        $name = $lang->get('name');        
        $description = $lang->get('description');
        $short_description = $lang->get('short_description');
        $meta_title = $lang->get('meta_title');
        $meta_keyword = $lang->get('meta_keyword');
        $meta_description = $lang->get('meta_description');
        
        $this->name = $this->$name;
        $this->description = $this->$description;
        $this->short_description = $this->$short_description;
        $this->meta_title = $this->$meta_title;
        $this->meta_keyword = $this->$meta_keyword;
        $this->meta_description = $this->$meta_description;
    }    

    function getTreeChild() {
        $category_parent_id = $this->category_parent_id;
        $i = 0;
        $list_category[$i]->category_id = $this->category_id;
        $list_category[$i]->name = $this->name;
        $i++;
        while($category_parent_id) {
            $category = &JTable::getInstance('category', 'jshop');
            $category->load($category_parent_id);
            $list_category[$i]->category_id = $category->category_id;
            $list_category[$i]->name = $category->getName();
            $category_parent_id = $category->category_parent_id;
            $i++;
        }
        $list_category = array_reverse($list_category);
        return $list_category;
    }

    function getAllCategories() {
        $db =& JFactory::getDBO(); 
        $query = "SELECT category_id, category_parent_id FROM `#__jshopping_categories` WHERE category_publish = '1' ORDER BY ordering";
        $db->setQuery($query);
        return $db->loadObjectList();
    }

    function getChildCategories($order, $ordering = 'asc', $publish = 1) {
        $cats = $this->getSubCategories($this->category_id, $order, $ordering, $publish);
        return $cats;
    }

    function getSisterCategories($order, $ordering = 'asc', $publish = 1) {
        $cats = $this->getSubCategories($this->category_parent_id, $order, $ordering, $publish);
        return $cats;
    }

    function getTreeParentCategories() {
        $cats_tree = array(); 
        $category_parent = $this->category_id;
        while($category_parent) {
            $cats_tree[] = $category_parent;
            $query = "SELECT category_parent_id FROM `#__jshopping_categories` WHERE category_id = '" . $this->_db->getEscaped($category_parent) . "' AND category_publish = '1'";
            $this->_db->setQuery($query);
            $rows = $this->_db->loadObjectList();
            $category_parent = $rows[0]->category_parent_id;
        }
        return array_reverse($cats_tree);
    }

    function getProducts($filters, $order1 = null, $orderby1 = null, $limitstart = 0, $limit = 0) {
        $jshopConfig = &JSFactory::getConfig();
        $lang = &JSFactory::getLang();
        $adv_query = ""; $adv_from = ""; $adv_result = "";
        
        if ($jshopConfig->show_delivery_time){            
            $adv_result .= ", prod.delivery_times_id";
        }
        
        if ($jshopConfig->admin_show_product_extra_field){
            $adv_result .= getQueryListProductsExtraFields();
        }
        
        if ($jshopConfig->product_list_show_vendor){
            $adv_result .= ", prod.vendor_id";
        }
        
        if ($jshopConfig->hide_product_not_avaible_stock){
            $adv_query .= " AND prod.product_quantity > 0";
        }
        
        if (is_array($filters['manufacturers']) && count($filters['manufacturers'])){
            $adv_query .= " AND prod.product_manufacturer_id in (".implode(",",$filters['manufacturers']).")";
        }
        
        if (is_array($filters['extra_fields'])){
            foreach($filters['extra_fields'] as $f_id=>$vals){
                if (is_array($vals) && count($vals)){
                    $adv_query .= " AND prod.`extra_field_".$f_id."` in (".implode(",",$vals).")";
                }
            }
        }        
        
        $price_to = getCorrectedPriceForQueryFilter($filters['price_to']);
        if ($price_to) {
            if ($jshopConfig->product_list_show_min_price){
                $adv_query .= " AND (prod.product_price<=".$price_to." OR prod.min_price<=" . $price_to." )";
            }else{
                $adv_query .= " AND prod.product_price <= " . $price_to;
            }
        } 
        $price_from = getCorrectedPriceForQueryFilter($filters['price_from']);
        if ($price_from) {
            if ($jshopConfig->product_list_show_min_price){
                $adv_query .= " AND (prod.product_price >= ".$price_from." OR prod.min_price >= " . $price_from." )";
            }else{
                $adv_query .= " AND prod.product_price >= " . $price_from;
            }
        }
        
        if ($order1){
        	$adv_query .= " ORDER BY ".$order1." ".$orderby1;        	
        }
        if ($limit){
        	$adv_query .= " LIMIT " . $limitstart . ", " . $limit;
        }        

        $query = "SELECT prod.product_id, categ.category_id, prod.`".$lang->get('name')."` as name, prod.`".$lang->get('short_description')."` as short_description, prod.product_ean, prod.product_thumb_image, prod.product_price, prod.product_tax_id as tax_id, prod.product_old_price, prod.product_weight, prod.average_rating, prod.reviews_count, prod.hits, prod.weight_volume_units, prod.basic_price_unit_id, prod.label_id, prod.product_manufacturer_id, prod.product_weight, prod.min_price, prod.product_quantity, prod.different_prices $adv_result
                  FROM `#__jshopping_products` AS prod
                  LEFT JOIN `#__jshopping_products_to_categories` AS categ USING (product_id)                  
                  $adv_from                  
                  WHERE categ.category_id = '".$this->_db->getEscaped($this->category_id)."' AND prod.product_publish = '1' ".$adv_query;
        $this->_db->setQuery($query);
        $products = $this->_db->loadObjectList();                
        $products = listProductUpdateData($products);
        return $products;
    }
    
    function getCountProducts($filters, $publish = 1, $hide_product_not_avaible_stock = 0) {
        $jshopConfig = &JSFactory::getConfig();
        $adv_query = "";
        if ($publish == 1) $adv_query .= " AND prod.product_publish = '1' ";
        if ($hide_product_not_avaible_stock){
            $adv_query .= " AND prod.product_quantity > 0";
        }
        if (is_array($filters['manufacturers']) && count($filters['manufacturers'])){
            $adv_query .= " AND prod.product_manufacturer_id in (".implode(",",$filters['manufacturers']).")";
        }
        if (is_array($filters['extra_fields'])){
            foreach($filters['extra_fields'] as $f_id=>$vals){
                if (is_array($vals) && count($vals)){
                    $adv_query .= " AND prod.`extra_field_".$f_id."` in (".implode(",",$vals).")";
                }
            }
        }
       
        $price_to = getCorrectedPriceForQueryFilter($filters['price_to']);
        if ($price_to) {
            if ($jshopConfig->product_list_show_min_price){
                $adv_query .= " AND (prod.product_price<=".$price_to." OR prod.min_price<=" . $price_to." )";
            }else{
                $adv_query .= " AND prod.product_price <= " . $price_to;
            }
        } 
        $price_from = getCorrectedPriceForQueryFilter($filters['price_from']);
        if ($price_from) {
            if ($jshopConfig->product_list_show_min_price){
                $adv_query .= " AND (prod.product_price >= ".$price_from." OR prod.min_price >= " . $price_from." )";
            }else{
                $adv_query .= " AND prod.product_price >= " . $price_from;
            }
        }
        
        $query = "SELECT count(pr_cat.product_id) FROM `#__jshopping_products_to_categories` AS pr_cat
                  INNER JOIN `#__jshopping_products` AS prod ON pr_cat.product_id = prod.product_id 
                  WHERE pr_cat.category_id = '".$this->_db->getEscaped($this->category_id)."' ".$adv_query;
        $this->_db->setQuery($query);
        return $this->_db->loadResult();
    }
    
    function getDescriptionMainPage(){        
        $statictext = &JTable::getInstance("statictext","jshop");
        $row = $statictext->loadData("home");        
        $this->description = $row->text;
        
        $seo = &JTable::getInstance("seo","jshop");
        $row = $seo->loadData("category");
        $this->meta_title = $row->title;
        $this->meta_keyword = $row->keyword;
        $this->meta_description = $row->description;
    }
    
    /**
    * get List Manufacturer for this category
    */
    function getManufacturers(){
        $jshopConfig = &JSFactory::getConfig();
        $lang = &JSFactory::getLang();
        $adv_query = "";
        if ($jshopConfig->hide_product_not_avaible_stock){
            $adv_query .= " AND prod.product_quantity > 0";
        }
        $query = "SELECT distinct man.manufacturer_id as id, man.`".$lang->get('name')."` as name FROM `#__jshopping_products` AS prod
                  LEFT JOIN `#__jshopping_products_to_categories` AS categ USING (product_id)
                  LEFT JOIN `#__jshopping_manufacturers` as man on prod.product_manufacturer_id=man.manufacturer_id 
                  WHERE categ.category_id = '".$this->_db->getEscaped($this->category_id)."' AND prod.product_publish = '1' AND prod.product_manufacturer_id!=0 ".$adv_query." order by name";
        $this->_db->setQuery($query);
        $list = $this->_db->loadObjectList();        
        return $list;
           
    }    
}
?>