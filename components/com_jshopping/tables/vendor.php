<?php
/**
* @version      2.8.0 10.01.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

class jshopVendor extends JTable {
	var $id = null;
	var $shop_name = null;
	var $company_name = null;
    var $url = null;
	var $logo = null;
	var $f_name = null;
	var $l_name = null;	
	var $adress = null;
	var $city = null;
	var $zip = null;	
	var $state = null;
	var $country = null;
	var $phone = null;
	var $fax = null;
	var $email = null;
    var $user_id = null;
	var $publish = null;

    function __construct( &$_db ){
        parent::__construct( '#__jshopping_vendors', 'id', $_db );
    }   
    
	function check(){
        jimport('joomla.mail.helper');
            
	    if(trim($this->f_name) == '') {	    	
		    $this->setError(_JSHOP_REGWARN_NAME);
		    return false;
	    }
        
        if( (trim($this->email == "")) || ! JMailHelper::isEmailAddress($this->email)) {
            $this->setError(_JSHOP_REGWARN_MAIL);
            return false;
        }
        if ($this->user_id){
            $query = "SELECT id FROM #__jshopping_vendors WHERE `user_id`='".$this->_db->getEscaped($this->user_id)."' AND id != '".(int)$this->id."'";
            $this->_db->setQuery($query);
            $xid = intval($this->_db->loadResult());
            if ($xid){
                $this->setError(sprintf(_JSHOP_ERROR_SET_VENDOR_TO_MANAGER, $this->user_id));
                return false;
            }
        }
        
	return true;
	}
    
    function loadFull($id){
        if ($id){
            $this->load($id);
        }else{
            $mainvendor = &JSFactory::getMainVendor();
            foreach($mainvendor as $k=>$v){
                $this->$k = $v;
            }
        }
    }
    
    function getAllVendors($publish=1, $limitstart, $limit) {
        $db =& JFactory::getDBO();
        $where = "";
        if (isset($publish)){
            $where = "and `publish`='".$db->getEscaped($publish)."'";
        }
        $query = "SELECT * FROM `#__jshopping_vendors` where 1 ".$where." ORDER BY shop_name";
        $db->setQuery($query, $limitstart, $limit);        
        return $db->loadObjectList();
    }
    
    function getCountAllVendors($publish=1){
        $db =& JFactory::getDBO(); 
        $where = "";
        if (isset($publish)){
            $where = "and `publish`='".$db->getEscaped($publish)."'";
        }
        $query = "SELECT COUNT(id) FROM `#__jshopping_vendors` where 1 ".$where;
        $db->setQuery($query);
        return $db->loadResult();
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
        
        if ($jshopConfig->hide_product_not_avaible_stock){
            $adv_query .= " AND prod.product_quantity > 0";
        }
        
        if ($jshopConfig->product_list_show_vendor){
            $adv_result .= ", prod.vendor_id";
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
                  WHERE prod.vendor_id = '".$this->id."' AND prod.product_publish = '1' AND cat.category_publish='1' ".$adv_query."
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
                  WHERE prod.vendor_id = '".$this->id."' AND prod.product_publish = '1' AND cat.category_publish='1' ".$adv_query;
        $db->setQuery($query);
        return $db->loadResult();
    }
}
?>