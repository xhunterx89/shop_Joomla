<?php
/**
* @version      2.8.0 18.12.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.application.component.model');

class JshoppingModelProducts extends JModel{
    
    function _getAllProductsQueryForFilter($filter){
        $lang = &JSFactory::getLang();
        $db =& JFactory::getDBO();
        $where = "";
        if ($filter['without_product_id']){
            $where .= " AND pr.product_id <> '".$db->getEscaped($filter['without_product_id'])."' ";    
        }
        if ($filter['category_id']){
            $category_id = $filter['category_id'];
            $where .= " AND pr_cat.category_id = '".$db->getEscaped($filter['category_id'])."' ";    
        }
        if ($filter['text_search']){
            $text_search = $filter['text_search'];
            $word = addcslashes($db->getEscaped($text_search), "_%");
            $where .=  "AND (LOWER(pr.`".$lang->get('name')."`) LIKE '%" . $word . "%' OR LOWER(pr.`".$lang->get('short_description')."`) LIKE '%" . $word . "%' OR LOWER(pr.`".$lang->get('description')."`) LIKE '%" . $word . "%' OR pr.product_ean LIKE '%" . $word . "%' OR pr.product_id LIKE '%" . $word . "%')";            
        }
        if ($filter['manufacturer_id']){
            $where .= " AND pr.product_manufacturer_id = '".$db->getEscaped($filter['manufacturer_id'])."' ";    
        }
        if ($filter['label_id']){
            $where .= " AND pr.label_id = '".$db->getEscaped($filter['label_id'])."' ";    
        }
        if ($filter['publish']){
            if ($filter['publish']==1) $_publish = 1; else $_publish = 0;            
            $where .= " AND pr.product_publish = '".$db->getEscaped($_publish)."' ";
        }
        if ($filter['vendor_id']){
            $where .= " AND pr.vendor_id = '".$db->getEscaped($filter['vendor_id'])."' ";
        }
    return $where;
    }
    
    function getAllProducts($filter, $limitstart = null, $limit = null){
        $jshopConfig = &JSFactory::getConfig();
        $lang = &JSFactory::getLang();
        $db =& JFactory::getDBO(); 
        if($limit > 0){
            $limit = " LIMIT ".$limitstart." , ".$limit;
        }else{
            $limit = "";
        }        
        $category_id = $filter['category_id'];
        $where = $this->_getAllProductsQueryForFilter($filter);
        
        $query_filed = ""; $query_join = "";
        if ($jshopConfig->admin_show_vendors){
            $query_filed .= ", pr.vendor_id, V.f_name as v_f_name, V.l_name as v_l_name";
            $query_join .= " left join `#__jshopping_vendors` as V on pr.vendor_id=V.id ";
        }

        if ($category_id) {
            $query = "SELECT pr.product_id, pr.product_publish, pr_cat.product_ordering, pr.`".$lang->get('name')."` as name, pr.`".$lang->get('short_description')."` as short_description, man.`".$lang->get('name')."` as man_name, pr.product_ean as ean, pr.product_quantity as qty, pr.product_thumb_image as image, pr.product_price, pr.hits, pr.unlimited, pr.product_date_added $query_filed FROM `#__jshopping_products` AS pr
                      LEFT JOIN `#__jshopping_products_to_categories` AS pr_cat USING (product_id)
                      LEFT JOIN `#__jshopping_manufacturers` AS man ON pr.product_manufacturer_id=man.manufacturer_id
                      $query_join
                      WHERE 1 ".$where." ORDER BY pr_cat.product_ordering ASC ".$limit;
        } else {
            $mysqlversion = getMysqlVersion();
            if ($mysqlversion < "4.1.0"){
                $spec_where = "cat.`".$lang->get('name')."` AS namescats";
            }else{
                $spec_where = "GROUP_CONCAT(cat.`".$lang->get('name')."` SEPARATOR '<br>') AS namescats";
            }
            
            $query = "SELECT pr.product_id, pr.product_publish, pr.`".$lang->get('name')."` as name, pr.`".$lang->get('short_description')."` as short_description, man.`".$lang->get('name')."` as man_name, ".$spec_where.", pr.product_ean as ean, pr.product_quantity as qty, pr.product_thumb_image as image, pr.product_price, pr.hits, pr.unlimited, pr.product_date_added $query_filed FROM `#__jshopping_products` AS pr 
                      LEFT JOIN `#__jshopping_products_to_categories` AS pr_cat USING (product_id)
                      LEFT JOIN `#__jshopping_categories` AS cat ON pr_cat.category_id=cat.category_id
                      LEFT JOIN `#__jshopping_manufacturers` AS man ON pr.product_manufacturer_id=man.manufacturer_id
                      $query_join
                      WHERE 1 ".$where." GROUP BY pr.product_id ORDER BY pr.product_id ".$limit;
        }        
        $db->setQuery($query);        
        return $db->loadObjectList();
    }
    
    function getCountAllProducts($filter){
        $lang = &JSFactory::getLang();
        $db =& JFactory::getDBO();                
        $category_id = $filter['category_id'];
        $where = $this->_getAllProductsQueryForFilter($filter);
        if ($category_id) {
            $query = "SELECT count(pr.product_id) FROM `#__jshopping_products` AS pr
                      LEFT JOIN `#__jshopping_products_to_categories` AS pr_cat USING (product_id)
                      LEFT JOIN `#__jshopping_manufacturers` AS man ON pr.product_manufacturer_id=man.manufacturer_id
                      WHERE 1 ".$where;
        } else {
            $query = "SELECT count(pr.product_id) FROM `#__jshopping_products` AS pr
                      LEFT JOIN `#__jshopping_manufacturers` AS man ON pr.product_manufacturer_id=man.manufacturer_id
                      WHERE 1 ".$where;
        }        
        $db->setQuery($query);        
        return $db->loadResult();
    }
    
    function productInCategory($product_id, $category_id) {
        $db =& JFactory::getDBO();
        $query = "SELECT prod_cat.category_id FROM `#__jshopping_products_to_categories` AS prod_cat
                   WHERE prod_cat.product_id = '".$db->getEscaped($product_id)."' AND prod_cat.category_id = '".$db->getEscaped($category_id)."'";
        $db->setQuery($query);
        $res = $db->query();
        return $db->getNumRows($res);
    }
    
    function getMaxOrderingInCategory($category_id) {
        $db =& JFactory::getDBO();
        $query = "SELECT MAX(product_ordering) as k FROM `#__jshopping_products_to_categories` WHERE category_id = '".$db->getEscaped($category_id)."'";
        $db->setQuery($query);
        return $db->loadResult();
    }
    
    function setCategoryToProduct($product_id, $categories = array()){
        $db =& JFactory::getDBO();
        foreach ($categories as $cat_id) {
            if(!$this->productInCategory($product_id, $cat_id)){
                $ordering = $this->getMaxOrderingInCategory($cat_id)+1;
                $query = "INSERT INTO `#__jshopping_products_to_categories`
                      SET `product_id` = '".$db->getEscaped($product_id)."', `category_id` = '".$db->getEscaped($cat_id)."', `product_ordering` = '".$db->getEscaped($ordering)."'";
                $db->setQuery($query);
                $db->query();
            }
        }

        //delete other cat for product        
        $query = "select `category_id` from `#__jshopping_products_to_categories` where `product_id` = '".$db->getEscaped($product_id)."'";
        $db->setQuery($query);
        $listcat = $db->loadObjectList();
        foreach($listcat as $val){
            if (!in_array($val->category_id, $categories)){
                $query = "delete from `#__jshopping_products_to_categories` where `product_id` = '".$db->getEscaped($product_id)."' and `category_id` = '".$db->getEscaped($val->category_id)."'";
                $db->setQuery($query);
                $db->query();
            }
        }
                    
    }
    
    function getRelatedProducts($product_id){
        $db =& JFactory::getDBO();
        $lang = &JSFactory::getLang();
        $query = "SELECT relation.product_related_id AS product_id, prod.`".$lang->get('name')."` as name, prod.product_thumb_image as image 
                FROM `#__jshopping_products_relations` AS relation
                LEFT JOIN `#__jshopping_products` AS prod ON prod.product_id=relation.product_related_id
                WHERE relation.product_id = '".$db->getEscaped($product_id)."'";
        $db->setQuery($query);
        return $db->loadObjectList();
    }
    
    function saveAditionalPrice($product_id, $product_add_discount, $quantity_start, $quantity_finish){
        $db =& JFactory::getDBO();
        $query = "DELETE FROM `#__jshopping_products_prices` WHERE `product_id` = '".$db->getEscaped($product_id)."'";
        $db->setQuery($query);
        $db->query();
        
        $counter = 0;
        if (count($product_add_discount)){
            foreach ($product_add_discount as $key=>$value){
                
                if ((!$quantity_start[$key] && !$quantity_finish[$key])) continue;
                
                $query = "INSERT INTO `#__jshopping_products_prices` SET 
                            `product_id` = '" . $db->getEscaped($product_id) . "',
                            `discount` = '" . $db->getEscaped(saveAsPrice($product_add_discount[$key])) . "',
                            `product_quantity_start` = '" . intval($quantity_start[$key]) . "',
                            `product_quantity_finish` = '" . intval($quantity_finish[$key]) . "'";
                $db->setQuery($query);
                $db->query();
                $counter++;
            }
        }
        $product =& JTable::getInstance('product', 'jshop');
        $product->load($product_id);
        $product->product_is_add_price = ($counter>0) ? (1) : (0);
        $product->store();
    }
    
    function saveFreeAttributes($product_id, $attribs){
        $db =& JFactory::getDBO();
        $query = "DELETE FROM `#__jshopping_products_free_attr` WHERE `product_id` = '".$db->getEscaped($product_id)."'";
        $db->setQuery($query);
        $db->query();
        
        if (is_array($attribs)){
            foreach($attribs as $attr_id=>$v){
                $query = "insert into `#__jshopping_products_free_attr` set `product_id` = '".$db->getEscaped($product_id)."', attr_id='".$db->getEscaped($attr_id)."'";
                $db->setQuery($query);
                $db->query();
            }
        }
    }
    
    function getMinimalPrice($price, $attrib_prices, $attrib_ind_price_data, $is_add_price, $add_discounts){
        $minprice = $price;
        if (is_array($attrib_prices)){            
            $minprice = min($attrib_prices);            
        }
        
        if (is_array($attrib_ind_price_data[0])){
            $attr_ind_id = array_unique($attrib_ind_price_data[0]);
            $startprice = $minprice;
            foreach($attr_ind_id as $attr_id){
                $tmpprice = array();
                foreach($attrib_ind_price_data[0] as $k=>$tmp_attr_id){
                    if ($tmp_attr_id==$attr_id){
                        if ($attrib_ind_price_data[1][$k]=="+"){
                            $tmpprice[] = $startprice + $attrib_ind_price_data[2][$k];
                        }elseif ($attrib_ind_price_data[1][$k]=="-"){
                            $tmpprice[] = $startprice - $attrib_ind_price_data[2][$k];
                        }elseif ($attrib_ind_price_data[1][$k]=="="){
                            $tmpprice[] = $attrib_ind_price_data[2][$k];
                        }
                    }
                }
                $startprice = min($tmpprice);
            }
            $minprice = $startprice;
        }
        
        if ($is_add_price && is_array($add_discounts)){
            $jshopConfig = &JSFactory::getConfig();
            $max_discount = max($add_discounts);
            if ($jshopConfig->product_price_qty_discount == 1){
                $minprice = $minprice - $max_discount; //discount value
            }else{
                $minprice = $minprice - ($minprice * $max_discount / 100); //discount percent
            }            
        }
        return $minprice;
    }
    
    
}
?>