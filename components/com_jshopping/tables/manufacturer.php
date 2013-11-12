<?php
/**
* @version      2.8.0 18.12.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

class jshopManufacturer extends JTableAvto {

    function __construct( &$_db ){
        parent::__construct( '#__jshopping_manufacturers', 'manufacturer_id', $_db );
    }

	function getAllManufacturers($publish = 0, $order = "ordering", $dir ="asc" ) {
		$lang = &JSFactory::getLang();
		$db =& JFactory::getDBO();
        if ($order=="id") $orderby = "manufacturer_id";
        if ($order=="name") $orderby = "name";
        if ($order=="ordering") $orderby = "ordering";
        if (!$orderby) $orderby = "ordering"; 
		$query_where = ($publish)?("WHERE manufacturer_publish = '1'"):("");
		$query = "SELECT manufacturer_id, manufacturer_url, manufacturer_logo, manufacturer_publish, `".$lang->get('name')."` as name, `".$lang->get('description')."` as description,  `".$lang->get('short_description')."` as short_description
				  FROM `#__jshopping_manufacturers` $query_where ORDER BY ".$orderby." ".$dir;
		$db->setQuery($query);
		$list = $db->loadObjectList();
		
		foreach ($list as $key => $value){
            $list[$key]->link = SEFLink('index.php?option=com_jshopping&controller=manufacturer&task=view&manufacturer_id='.$list[$key]->manufacturer_id);
        }		
		return $list;
	}
	
	function getName() {
        $lang = &JSFactory::getLang();
        $name = $lang->get('name');
        return $this->$name;
    }
    
    function getDescription(){
        
        if (!$this->manufacturer_id){            
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
	
	function getProducts($filters, $order1 = null, $orderby1 = null, $limitstart = 0, $limit = 0){
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
        
        if (is_array($filters['categorys']) && count($filters['categorys'])){
            $adv_query .= " AND cat.category_id in (".implode(",",$filters['categorys']).")";
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
        
        $order_query = "";
        if ($order1){
        	$order_query .= " ORDER BY ".$order1." ".$orderby1;        	
        }
        
       $query = "SELECT prod.product_id, pr_cat.category_id, prod.`".$lang->get('name')."` as name, prod.`".$lang->get('short_description')."` as short_description, prod.product_ean, prod.product_thumb_image, prod.product_price, prod.product_tax_id as tax_id, prod.product_old_price, prod.product_weight, prod.average_rating, prod.reviews_count, prod.hits, prod.weight_volume_units, prod.basic_price_unit_id, prod.label_id, prod.product_manufacturer_id, prod.product_weight, prod.min_price, prod.product_quantity, prod.different_prices $adv_result
                  FROM `#__jshopping_products` AS prod
                  LEFT JOIN `#__jshopping_products_to_categories` AS pr_cat USING (product_id)
                  LEFT JOIN `#__jshopping_categories` AS cat ON pr_cat.category_id = cat.category_id                  
                  $adv_from
                  WHERE prod.product_manufacturer_id = '".$this->manufacturer_id."' AND prod.product_publish = '1' AND cat.category_publish='1' ".$adv_query."
                  GROUP BY prod.product_id ".$order_query;
        if ($limit){
            $this->_db->setQuery($query, $limitstart, $limit);
        }else{
            $this->_db->setQuery($query);
        }
        $products = $this->_db->loadObjectList();
        $products = listProductUpdateData($products);
        return $products;
    }    
	
	function getCountProducts($filters) {
		$jshopConfig = &JSFactory::getConfig();
        
        $adv_query = "";
        if ($jshopConfig->hide_product_not_avaible_stock){
            $adv_query .= " AND prod.product_quantity > 0";
        }
        if (is_array($filters['categorys']) && count($filters['categorys'])){
            $adv_query .= " AND cat.category_id in (".implode(",",$filters['categorys']).")";
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
        
		$db =& JFactory::getDBO(); 
		$query = "SELECT COUNT(distinct prod.product_id) FROM `#__jshopping_products` as prod
                  LEFT JOIN `#__jshopping_products_to_categories` AS pr_cat USING (product_id)
                  LEFT JOIN `#__jshopping_categories` AS cat ON pr_cat.category_id = cat.category_id
                  WHERE prod.product_manufacturer_id = '".$this->manufacturer_id."' AND prod.product_publish = '1' AND cat.category_publish='1' ".$adv_query;
		$db->setQuery($query);
		return $db->loadResult();
	}
    
    /**
    * get List category
    */
    function getCategorys(){
        $jshopConfig = &JSFactory::getConfig();
        $lang = &JSFactory::getLang();
        $adv_query = "";
        if ($jshopConfig->hide_product_not_avaible_stock){
            $adv_query .= " AND prod.product_quantity > 0";
        }
        $query = "SELECT distinct cat.category_id as id, cat.`".$lang->get('name')."` as name FROM `#__jshopping_products` AS prod
                  LEFT JOIN `#__jshopping_products_to_categories` AS categ USING (product_id)
                  LEFT JOIN `#__jshopping_categories` as cat on cat.category_id=categ.category_id
                  WHERE prod.product_publish = '1' AND prod.product_manufacturer_id='".$this->_db->getEscaped($this->manufacturer_id)."' AND cat.category_publish='1' ".$adv_query." order by name";
        $this->_db->setQuery($query);
        $list = $this->_db->loadObjectList();        
        return $list;
           
    } 
    
}
?>