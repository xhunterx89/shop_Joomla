<?php
/**
* @version      2.9.0 04.06.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

class jshopProduct extends JTableAvto{    

    function __construct( &$_db ){
        parent::__construct( '#__jshopping_products', 'product_id', $_db );
    }
    
    function setAttributeActive($attribs){
        $this->attribute_active = $attribs;
        if (is_array($this->attribute_active) && count($this->attribute_active)){
            
            $allattribs = &JSFactory::getAllAttributes(1);
            $dependent_attr = array();
            $independent_attr = array();            
            foreach($attribs as $k=>$v){
                if ($allattribs[$k]->independent==0){
                    $dependent_attr[$k] = $v;
                }else{
                    $independent_attr[$k] = $v;
                }
            }
            
            if (count($dependent_attr)){
                $where = "";
                foreach($dependent_attr as $k=>$v){
                    $where.=" and PA.attr_".$k." = '".$this->_db->getEscaped($v)."' ";
                }          
                $query = "select PA.* from `#__jshopping_products_attr` as PA where PA.product_id = '".$this->_db->getEscaped($this->product_id)."' ".$where; 
                $this->_db->setQuery($query);
                $this->attribute_active_data = $this->_db->loadObject();
            }
            
            if (count($independent_attr)){
                if (!isset($this->attribute_active_data->price)) $this->attribute_active_data->price = $this->product_price;
                foreach($independent_attr as $k=>$v){
                    $query = "select addprice, price_mod from #__jshopping_products_attr2 where product_id='".$this->_db->getEscaped($this->product_id)."' and attr_id='".$this->_db->getEscaped($k)."' and attr_value_id='".$this->_db->getEscaped($v)."'";
                    $this->_db->setQuery($query);
                    $attr_data2 = $this->_db->loadObject();
                    if ($attr_data2->price_mod=="+"){
                        $this->attribute_active_data->price += $attr_data2->addprice;
                    }elseif ($attr_data2->price_mod=="-"){
                        $this->attribute_active_data->price -= $attr_data2->addprice;
                    }elseif ($attr_data2->price_mod=="="){
                        $this->attribute_active_data->price =  $attr_data2->addprice;
                    }
                }
            }
            
        }else{
            $this->attribute_active_data = NULL;
        }
    }
    
    //get require attribute
    function getRequireAttribute(){
        $require = array();
        $jshopConfig = &JSFactory::getConfig();
        if (!$jshopConfig->admin_show_attributes) return $require;        

        $allattribs = &JSFactory::getAllAttributes(2);
        $dependent_attr = $allattribs['dependent'];
        $independent_attr = $allattribs['independent'];        
        
        if (count($dependent_attr)){
            $prodAttribVal = $this->getAttributes();        
            if (count($prodAttribVal)){
                $prodAtrtib = $prodAttribVal[0];
                foreach($dependent_attr as $attrib){
                    $field = "attr_".$attrib->attr_id;
                    if ($prodAtrtib->$field) $require[] = $attrib->attr_id;
                }
            }
        }
        
        if (count($independent_attr)){
            $prodAttribVal2 = $this->getAttributes2();
            foreach($prodAttribVal2 as $attrib){
                if (!in_array($attrib->attr_id, $require)){
                    $require[] = $attrib->attr_id;    
                }
            }
        }

        return $require;
    }
    
    //get dependent attributs
    function getAttributes(){
        $query = "SELECT * FROM `#__jshopping_products_attr` WHERE product_id = '".$this->product_id."' ORDER BY product_attr_id";
        $this->_db->setQuery($query);
        return $this->_db->loadObjectList();
    }
    
    //get independent attributs
    function getAttributes2(){
        $query = "SELECT * FROM `#__jshopping_products_attr2` WHERE product_id = '".$this->product_id."' ORDER BY id";
        $this->_db->setQuery($query);
        return $this->_db->loadObjectList();
    }   
    
    //get attrib values
    function getAttribValue($attr_id, $other_attr = array(), $onlyExistProduct = 0){
        $allattribs = &JSFactory::getAllAttributes(1);
        $lang = &JSFactory::getLang();
        if ($allattribs[$attr_id]->independent==0){
            $where = "";
            foreach($other_attr as $k=>$v){
                $where.=" and PA.attr_$k='$v'";
            }
            if ($onlyExistProduct) $where.=" and PA.count>0 ";
            
            $field = "attr_".$attr_id;
            $query = "SELECT distinct PA.$field as val_id, V.`".$lang->get("name")."` as value_name, V.image
                      FROM `#__jshopping_products_attr` as PA INNER JOIN #__jshopping_attr_values as V ON PA.$field=V.value_id
                      WHERE PA.product_id = '".$this->product_id."' ".$where."
                      ORDER BY V.value_ordering";
        }else{
            $query = "select PA.attr_value_id as val_id, V.`".$lang->get("name")."` as value_name, V.image, price_mod, addprice 
                      from #__jshopping_products_attr2 as PA INNER JOIN #__jshopping_attr_values as V ON PA.attr_value_id=V.value_id
                      where PA.product_id = '".$this->product_id."' and PA.attr_id='".$attr_id."'
                      ORDER BY V.value_ordering";
        }
        $this->_db->setQuery($query);
        return $this->_db->loadObjectList();
    }
    
    function getAttributesDatas($selected = array()){                        
        $jshopConfig = &JSFactory::getConfig();        
        $data = array();
        $requireAttribute = $this->getRequireAttribute();
        $actived = array();
        foreach($requireAttribute as $attr_id){            
            $options = $this->getAttribValue($attr_id, $actived, $jshopConfig->hide_product_not_avaible_stock);
            $data['attributeValues'][$attr_id] = $options;
            if (!$jshopConfig->product_attribut_first_value_empty){
                $actived[$attr_id] = $options[0]->val_id;
            }
            if ($selected[$attr_id]){
                $testActived = 0;
                foreach($options as $tmp) if ($tmp->val_id==$selected[$attr_id]) $testActived = 1;
                if ($testActived){
                    $actived[$attr_id] = $selected[$attr_id];
                }
            }
        }
        
        if (count($requireAttribute) == count($actived)){
            $data['attributeActive'] = $actived;
        }else{
            $data['attributeActive'] = array();
        }
        
        $data['attributeSelected'] = $actived;
        return $data;
    }
    
    function getListFreeAttributes(){        
        $lang = &JSFactory::getLang();
        $db =& JFactory::getDBO(); 
        $query = "SELECT FA.id, FA.required, FA.`".$lang->get("name")."` as name FROM `#__jshopping_products_free_attr` as PFA left join `#__jshopping_free_attr` as FA on FA.id=PFA.attr_id
                  WHERE PFA.product_id = '".$db->getEscaped($this->product_id)."' order by FA.ordering";
        $this->_db->setQuery($query);
        $this->freeattributes = $this->_db->loadObjectList();
        return $this->freeattributes;
    }
    
    /**
    * use after getListFreeAttributes()
    */
    function getRequireFreeAttribute(){
        $rows = array();
        if ($this->freeattributes){
            foreach($this->freeattributes as $k=>$v){
                if ($v->required){
                    $rows[] = $v->id;
                }
            }
        }
    return $rows;
    }

    function getCategories() {
        $db =& JFactory::getDBO(); 
        $query = "SELECT * FROM `#__jshopping_products_to_categories` WHERE product_id = '".$this->_db->getEscaped($this->product_id)."'";
        $this->_db->setQuery($query);
        return $this->_db->loadObjectList();
    }

    function getName() {
        $lang = &JSFactory::getLang();
        $name = $lang->get('name');
        return $this->$name;
    }

    function getPriceWithParams(){
        if (isset($this->attribute_active_data->price)){
            return $this->attribute_active_data->price;
        }else{
            return $this->product_price;
        }
    }
    
    function getEan(){   
        if (isset($this->attribute_active_data->ean)){     
            return $this->attribute_active_data->ean;
        }else{
            return $this->product_ean;
        }
    }
    
    function getQty(){
        if ($this->unlimited) return 1;
        if (isset($this->attribute_active_data->count)){
            return $this->attribute_active_data->count;
        }else{
            return $this->product_quantity;
        }
    }
    
    function getWeight(){
        if ($this->attribute_active_data->weight > 0){
            return $this->attribute_active_data->weight;
        }else{
            return $this->product_weight;
        }
    }
    
    function getWeight_volume_units(){
        if ($this->attribute_active_data->weight_volume_units > 0){
            return $this->attribute_active_data->weight_volume_units;
        }else{
            return $this->weight_volume_units;
        }
    }
    
    function getQtyInStock(){
        if ($this->unlimited) return 1;
        $qtyInStock = $this->getQty();        
        if ($qtyInStock < 0) $qtyInStock = 0;
    return $qtyInStock;
    }

    function getImages() {        
        $query = "SELECT I.*, IF(P.product_name_image=I.image_name,0,1) as sort FROM `#__jshopping_products_images` as I left join `#__jshopping_products` as P on P.product_id=I.product_id
                 WHERE I.product_id = '" . $this->_db->getEscaped($this->product_id) . "' ORDER BY sort,I.image_id";
        $this->_db->setQuery($query);
        return $this->_db->loadObjectList();
    }

    function getVideos(){
        $jshopConfig = &JSFactory::getConfig();
        if (!$jshopConfig->admin_show_product_video) return array();
        
        $query = "SELECT  video_name, video_id, video_preview FROM `#__jshopping_products_videos` WHERE product_id = '".$this->_db->getEscaped($this->product_id)."'";
        $this->_db->setQuery($query);
        return $this->_db->loadObjectList();
    }
    
    function getFiles() {        
        $jshopConfig = &JSFactory::getConfig();
        if (!$jshopConfig->admin_show_product_files) return array();
        
        $query = "SELECT * FROM `#__jshopping_products_files` WHERE product_id = '".$this->_db->getEscaped($this->product_id)."' order by `ordering` ";
        $this->_db->setQuery($query);
        return $this->_db->loadObjectList();
    }
    
    function getDemoFiles() {        
        $jshopConfig = &JSFactory::getConfig();
        if (!$jshopConfig->admin_show_product_files) return array();
        
        $query = "SELECT * FROM `#__jshopping_products_files` WHERE product_id = '".$this->_db->getEscaped($this->product_id)."' and demo!='' order by `ordering` ";
        $this->_db->setQuery($query);
        return $this->_db->loadObjectList();
    }
    
    function getSaleFiles() {
        $jshopConfig = &JSFactory::getConfig();
        if (!$jshopConfig->admin_show_product_files) return array();
        
        $query = "SELECT id, file, file_descr FROM `#__jshopping_products_files` WHERE product_id = '".$this->_db->getEscaped($this->product_id)."' and file!='' order by `ordering` ";
        $this->_db->setQuery($query);
        return $this->_db->loadObjectList();
    }
    
    function getManufacturerInfo(){        
        $manufacturers = &JSFactory::getAllManufacturer();
        if ($this->product_manufacturer_id && isset($manufacturers[$this->product_manufacturer_id])){
            return $manufacturers[$this->product_manufacturer_id];
        }else{
            return null;
        }        
    }
    
    function getVendorInfo(){        
        $vendors = &JSFactory::getAllVendor();        
        if (isset($vendors[$this->vendor_id])){
            return $vendors[$this->vendor_id];
        }else{
            return null;
        }        
    }

    /**
    * get first catagory for product
    */    
    function getCategory() {
        $query = "SELECT pr_cat.category_id FROM `#__jshopping_products_to_categories` AS pr_cat
                LEFT JOIN `#__jshopping_categories` AS cat ON pr_cat.category_id = cat.category_id
                WHERE pr_cat.product_id = '".$this->_db->getEscaped($this->product_id)."' AND cat.category_publish='1' LIMIT 0,1";
        $this->_db->setQuery($query);
        $this->category_id = $this->_db->loadResult();
        return $this->category_id;
    }
    
    function getExtendsData() {
        $this->getRelatedProducts();
        $this->getDescription();
        $this->getTax();
        $this->getPricePreview();
        $this->getDeliveryTime();
    }
    
    function getDeliveryTime(){
        $jshopConfig = &JSFactory::getConfig();
                
        if ($jshopConfig->show_delivery_time && $this->delivery_times_id){
            $deliveryTimes = &JTable::getInstance('deliveryTimes', 'jshop');
            $deliveryTimes->load($this->delivery_times_id);
            $this->delivery_time = $deliveryTimes->getName();
        }else{
            $this->delivery_time = "";    
        }
        return $this->delivery_time;
    }

    function getDescription() {
        $lang = &JSFactory::getLang();
        $name = $lang->get('name');
        $short_description = $lang->get('short_description');
        $description = $lang->get('description');
        $meta_title = $lang->get('meta_title');
        $meta_keyword = $lang->get('meta_keyword');
        $meta_description = $lang->get('meta_description');
        
        $this->name = $this->$name;
        $this->short_description = $this->$short_description;
        $this->description = $this->$description;
        $this->meta_title = $this->$meta_title;
        $this->meta_keyword = $this->$meta_keyword;
        $this->meta_description = $this->$meta_description;
    }
    
    function getPricePreview(){                
        $this->getPrice(1, 1, 1, 1);
        if ($this->product_is_add_price){
            $this->product_add_prices = array_reverse($this->product_add_prices);
        }
        $this->updateOtherPricesIncludeAllFactors();
    }
    
    function getPrice($quantity = 1, $enableCurrency = 1, $enableUserDiscount = 1, $enableParamsTax = 1) {
        $jshopConfig = &JSFactory::getConfig();
                
        $this->product_price_calculate = $this->getPriceWithParams();                
        
        if ($this->product_is_add_price){
            $this->getAddPrices();        
        }else{
            $this->product_add_prices = array();
        }
        
        if ($quantity && $this->product_is_add_price){
            foreach ($this->product_add_prices as $key=>$value){
                if ( ($quantity >= $value->product_quantity_start && $quantity <= $value->product_quantity_finish) ||  ($quantity >= $value->product_quantity_start && $value->product_quantity_finish==0) ){
                    $this->product_price_calculate = $value->price;
                    break;    
                } 
            }
        }
        
        if ($enableCurrency){
            $this->product_price_calculate = $this->product_price_calculate * $jshopConfig->currency_value;
        }
        
        if ($enableUserDiscount){
            $userShop = &JSFactory::getUserShop();
            $this->product_price_calculate = getPriceDiscount($this->product_price_calculate, $userShop->percent_discount);    
        }
        
        if ($enableParamsTax){
            $this->product_price_calculate = getPriceCalcParamsTax($this->product_price_calculate, $this->product_tax_id);
        }
        
        return $this->product_price_calculate;
    }
    
    function getPriceCalculate(){
        return $this->product_price_calculate;
    }
    
    function getBasicPriceInfo(){
        $this->product_basic_price_show = $this->weight_volume_units!=0; // && $this->weight_volume_units!=1);
        if (!$this->product_basic_price_show) return 0; 
        
        $units = &JSFactory::getAllUnits();        
        $unit = $units[$this->basic_price_unit_id];
        $this->product_basic_price_calculate = $this->product_price_calculate / $this->getWeight_volume_units() * $unit->qty;
              
        $this->product_basic_price_unit_name = $unit->name;
        $this->product_basic_price_unit_qty = $unit->qty;
        return 1;
    }
    
    function getAddPrices(){
        $jshopConfig = &JSFactory::getConfig();
        $productprice = &JTable::getInstance('productprice', 'jshop');                
        $this->product_add_prices = $productprice->getAddPrices($this->product_id);
        
        $price = $this->getPriceWithParams();        
        foreach($this->product_add_prices as $k=>$v){
            if ($jshopConfig->product_price_qty_discount == 1){
                $this->product_add_prices[$k]->price = $price - $v->discount; //discount value
            }else{
                $this->product_add_prices[$k]->price = $price - ($price * $v->discount / 100); //discount percent
            }
        }
    }
    
    function getTax(){
        $taxes = &JSFactory::getAllTaxes();    
        $this->product_tax = $taxes[$this->product_tax_id];
        return $this->product_tax;        
    }
    
    function updateOtherPricesIncludeAllFactors(){
        $jshopConfig = &JSFactory::getConfig();
        $userShop = &JSFactory::getUserShop();
        
        $this->product_old_price = $this->product_old_price * $jshopConfig->currency_value;
        $this->product_old_price = getPriceDiscount($this->product_old_price, $userShop->percent_discount);
        $this->product_old_price = getPriceCalcParamsTax($this->product_old_price, $this->product_tax_id);
        
        if (is_array($this->product_add_prices)){
            foreach ($this->product_add_prices as $key=>$value){            
                $this->product_add_prices[$key]->price = $this->product_add_prices[$key]->price * $jshopConfig->currency_value;
                $this->product_add_prices[$key]->price = getPriceDiscount($this->product_add_prices[$key]->price, $userShop->percent_discount);
                $this->product_add_prices[$key]->price = getPriceCalcParamsTax($this->product_add_prices[$key]->price, $this->product_tax_id);
            }
        }
    }
    
    function getExtraFields(){
        $_cats = $this->getCategories();
        $cats = array();
        foreach($_cats as $v){
            $cats[] = $v->category_id;    
        }
        
        $fields = array();
        $jshopConfig = &JSFactory::getConfig();
        $hide_fields = $jshopConfig->getProductHideExtraFields();
        $fieldvalues = &JSFactory::getAllProductExtraFieldValue();
        $listfield = &JSFactory::getAllProductExtraField();
        foreach($listfield as $val){
            if (in_array($val->id,$hide_fields)) continue;
            if ($val->allcats){
                $fields[] = $val->id;
            }else{
                $insert = 0;
                foreach($cats as $cat_id){
                    if (in_array($cat_id, $val->cats)) $insert = 1;
                }
                if ($insert){
                    $fields[] = $val->id;
                }
            }
        }
                
        foreach($fields as $field_id){
            $field_name = "extra_field_".$field_id;
            if ($this->$field_name!=0){
                $rows[] = array("name"=>$listfield[$field_id]->name, "value"=>$fieldvalues[$this->$field_name]);
            }
        }
        return $rows;
    }
    
    function getRelatedProducts(){
        $jshopConfig = &JSFactory::getConfig();
        if (!$jshopConfig->admin_show_product_related){
            $this->product_related = array();
            return $this->product_related;
        }
        
        $lang = &JSFactory::getLang();
        
        $advquery = "";
        if ($jshopConfig->hide_product_not_avaible_stock){
            $advquery .= " AND prod.product_quantity > 0";
        }
        if ($jshopConfig->admin_show_product_extra_field){
            $adv_result .= getQueryListProductsExtraFields();
        }
        if ($jshopConfig->show_delivery_time){            
            $adv_result .= ", prod.delivery_times_id";
        }
        if ($jshopConfig->product_list_show_vendor){
            $adv_result .= ", prod.vendor_id";
        }
        
        $query = "SELECT relation.product_related_id AS product_id, prod.`".$lang->get('name')."` as name, prod.`".$lang->get('short_description')."` as short_description, prod.product_price, pr_cat.category_id, prod.product_thumb_image, prod.product_tax_id as tax_id, prod.product_manufacturer_id, prod.product_weight, prod.min_price, prod.product_quantity, prod.different_prices $adv_result
                FROM `#__jshopping_products_relations` AS relation
                INNER JOIN `#__jshopping_products` AS prod ON relation.product_related_id = prod.product_id
                LEFT JOIN `#__jshopping_products_to_categories` AS pr_cat ON pr_cat.product_id = relation.product_related_id
                LEFT JOIN `#__jshopping_categories` AS cat ON pr_cat.category_id = cat.category_id
                WHERE relation.product_id = '" . $this->_db->getEscaped($this->product_id) . "' AND cat.category_publish='1' AND prod.product_publish = '1' ".$advquery." group by prod.product_id ";
        $this->_db->setQuery($query);        
        $this->product_related = $this->_db->loadObjectList();                
        foreach ($this->product_related as $key => $value) {
            $this->product_related[$key]->product_link = SEFLink('index.php?option=com_jshopping&controller=product&task=view&category_id='.$value->category_id.'&product_id='.$value->product_id);
        }        
        $this->product_related = listProductUpdateData($this->product_related);
        return $this->product_related;
    }
    
    function getLastProducts($count, $array_categories = null){
        $jshopConfig = &JSFactory::getConfig();             

        $db =& JFactory::getDBO();
        $lang = &JSFactory::getLang();
        $where_add = '';
        if (count($array_categories)) {
            $where_add .= "AND pr_cat.category_id IN (".implode(",", $array_categories).")";
        }
                
        if ($jshopConfig->hide_product_not_avaible_stock){
            $where_add .= " AND prod.product_quantity > 0";
        }
        if ($jshopConfig->admin_show_product_extra_field){
            $adv_result .= getQueryListProductsExtraFields();
        }
        if ($jshopConfig->show_delivery_time){            
            $adv_result .= ", prod.delivery_times_id";
        }
        if ($jshopConfig->product_list_show_vendor){
            $adv_result .= ", prod.vendor_id";
        }
 
        $query = "SELECT prod.`".$lang->get('name')."` as name, prod.`".$lang->get('short_description')."` as short_description, prod.product_id, prod.product_ean, prod.product_thumb_image, pr_cat.category_id, prod.product_price, prod.product_tax_id as tax_id, prod.product_old_price, prod.product_weight, prod.average_rating, prod.reviews_count, prod.hits, prod.weight_volume_units, prod.basic_price_unit_id, prod.label_id, prod.product_manufacturer_id, prod.product_weight, prod.min_price, prod.product_quantity, prod.different_prices $adv_result
                  FROM `#__jshopping_products` AS prod
                  INNER JOIN `#__jshopping_products_to_categories` AS pr_cat ON pr_cat.product_id = prod.product_id
                  LEFT JOIN `#__jshopping_categories` AS cat ON pr_cat.category_id = cat.category_id
                  WHERE prod.product_publish = '1' AND cat.category_publish='1' " . $where_add . "
                  GROUP BY prod.product_id ORDER BY prod.product_date_added DESC LIMIT " . $count;
        $db->setQuery($query);
        $products = $db->loadObjectList();
        $products = listProductUpdateData($products);
        return $products;
    }
    
    function getRandProducts($count, $array_categories = null) {
        $jshopConfig = &JSFactory::getConfig();             

        $db =& JFactory::getDBO();
        $lang = &JSFactory::getLang();
        $where_add = '';
        if(count($array_categories)) {
            $where_add .= "AND pr_cat.category_id IN (".implode(",", $array_categories).")";            
        }
                
        if ($jshopConfig->hide_product_not_avaible_stock){
            $where_add .= " AND prod.product_quantity > 0";
        }
        if ($jshopConfig->show_delivery_time){            
            $adv_result .= ", prod.delivery_times_id";
        }
        if ($jshopConfig->admin_show_product_extra_field){
            $adv_result .= getQueryListProductsExtraFields();
        }
        if ($jshopConfig->product_list_show_vendor){
            $adv_result .= ", prod.vendor_id";
        }
        
        $query = "SELECT count(distinct prod.product_id) FROM `#__jshopping_products` AS prod
                  INNER JOIN `#__jshopping_products_to_categories` AS pr_cat ON pr_cat.product_id = prod.product_id
                  LEFT JOIN `#__jshopping_categories` AS cat ON pr_cat.category_id = cat.category_id                  
                  WHERE prod.product_publish = '1' AND cat.category_publish='1' ".$where_add;
        $db->setQuery($query);
        $totalrow = $db->loadResult();                  
        $totalrow = $totalrow - $count;
        if ($totalrow < 0) $totalrow = 0;
        $limitstart = rand(0, $totalrow);
        
        $order = array();
        $order[] = "name asc";
        $order[] = "name desc";
        $order[] = "prod.product_price asc";
        $order[] = "prod.product_price desc";
        $orderby = $order[rand(0,3)];
                 
        $query = "SELECT prod.`".$lang->get('name')."` as name, prod.`".$lang->get('short_description')."` as short_description, prod.product_id, prod.product_ean, prod.product_thumb_image, pr_cat.category_id, prod.product_price, prod.product_tax_id as tax_id, prod.product_old_price, prod.product_weight, prod.average_rating, prod.reviews_count, prod.hits, prod.weight_volume_units, prod.basic_price_unit_id, prod.label_id, prod.product_manufacturer_id, prod.product_weight, prod.min_price, prod.product_quantity, prod.different_prices $adv_result
                  FROM `#__jshopping_products` AS prod
                  INNER JOIN `#__jshopping_products_to_categories` AS pr_cat ON pr_cat.product_id = prod.product_id
                  LEFT JOIN `#__jshopping_categories` AS cat ON pr_cat.category_id = cat.category_id
                  WHERE prod.product_publish = '1' AND cat.category_publish='1' " . $where_add . "
                  GROUP BY prod.product_id order by ".$orderby." LIMIT ".$limitstart.", ".$count;
        $db->setQuery($query);
        $products = $db->loadObjectList();
        $products = listProductUpdateData($products);        
        return $products;
    }    
    
    function getBestSellers($count, $array_categories = null){
        $jshopConfig = &JSFactory::getConfig();             

        $db =& JFactory::getDBO();
        $lang = &JSFactory::getLang();

        $where_add = '';
        if (count($array_categories)) {
            $where_add .= "AND pr_cat.category_id IN (".implode(",", $array_categories).")";
        }
        
        if ($jshopConfig->hide_product_not_avaible_stock){
            $where_add .= " AND prod.product_quantity > 0";
        }
        if ($jshopConfig->show_delivery_time){            
            $adv_result .= ", prod.delivery_times_id";
        }
        if ($jshopConfig->admin_show_product_extra_field){
            $adv_result .= getQueryListProductsExtraFields();
        }
        if ($jshopConfig->product_list_show_vendor){
            $adv_result .= ", prod.vendor_id";
        }
 
        $query = "SELECT  SUM(OI.product_quantity) as max_num, prod.`".$lang->get('name')."` as name, prod.`".$lang->get('short_description')."` as short_description, prod.product_id, prod.product_ean, prod.product_thumb_image, pr_cat.category_id, prod.product_price, prod.product_tax_id as tax_id, prod.product_old_price, prod.product_weight, prod.average_rating, prod.reviews_count, prod.hits, prod.weight_volume_units, prod.basic_price_unit_id, prod.label_id, prod.product_manufacturer_id, prod.product_weight, prod.min_price, prod.product_quantity, prod.different_prices $adv_result
                  FROM #__jshopping_order_item AS OI 
                  INNER JOIN `#__jshopping_products` AS prod   ON prod.product_id=OI.product_id
                  INNER JOIN `#__jshopping_products_to_categories` AS pr_cat ON pr_cat.product_id = prod.product_id
                  LEFT JOIN `#__jshopping_categories` AS cat ON pr_cat.category_id = cat.category_id
                  WHERE prod.product_publish = '1' AND cat.category_publish='1' " . $where_add . "
                  GROUP BY prod.product_id
                  ORDER BY max_num desc LIMIT " . $count;
        $db->setQuery($query);
        $products = $db->loadObjectList();
        $products = listProductUpdateData($products);
        return $products;
    }
    
    function getProductLabel($label_id, $count){
        $jshopConfig = &JSFactory::getConfig();             

        $db =& JFactory::getDBO();
        $lang = &JSFactory::getLang();

        $where_add = '';
        if($label_id) {
            $where_add = " AND prod.label_id='".$db->getEscaped($label_id)."'";            
        }
        
        if ($jshopConfig->hide_product_not_avaible_stock){
            $where_add .= " AND prod.product_quantity > 0";
        }
        if ($jshopConfig->show_delivery_time){            
            $adv_result .= ", prod.delivery_times_id";
        }
        if ($jshopConfig->admin_show_product_extra_field){
            $adv_result .= getQueryListProductsExtraFields();
        }
        if ($jshopConfig->product_list_show_vendor){
            $adv_result .= ", prod.vendor_id";
        }
 
        $query = "SELECT prod.`".$lang->get('name')."` as name, prod.`".$lang->get('short_description')."` as short_description, prod.product_id, prod.product_ean, prod.product_thumb_image, prod.product_price, pr_cat.category_id, prod.product_tax_id as tax_id , prod.product_old_price, prod.product_weight, prod.average_rating, prod.reviews_count, prod.hits, prod.weight_volume_units, prod.basic_price_unit_id, prod.label_id, prod.product_manufacturer_id, prod.product_weight, prod.min_price, prod.product_quantity, prod.different_prices $adv_result
                  FROM `#__jshopping_products` AS prod
                  INNER JOIN `#__jshopping_products_to_categories` AS pr_cat ON pr_cat.product_id = prod.product_id
                  LEFT JOIN `#__jshopping_categories` AS cat ON pr_cat.category_id = cat.category_id
                  WHERE prod.product_publish = '1' and prod.label_id!=0 AND cat.category_publish='1' ".$where_add."
                  GROUP BY prod.product_id ORDER BY name LIMIT ".$count;
        $db->setQuery($query);
        $products = $db->loadObjectList();
        $products = listProductUpdateData($products);
        return $products;
    }
    
    function getTopRatingProducts($count){
        $jshopConfig = &JSFactory::getConfig();

        $db =& JFactory::getDBO();
        $lang = &JSFactory::getLang();

        $where_add = '';        
        if ($jshopConfig->hide_product_not_avaible_stock){
            $where_add .= " AND prod.product_quantity > 0";
        }
        if ($jshopConfig->show_delivery_time){            
            $adv_result .= ", prod.delivery_times_id";
        }
        if ($jshopConfig->admin_show_product_extra_field){
            $adv_result .= getQueryListProductsExtraFields();
        }
        if ($jshopConfig->product_list_show_vendor){
            $adv_result .= ", prod.vendor_id";
        }
 
        $query = "SELECT prod.`".$lang->get('name')."` as name, prod.`".$lang->get('short_description')."` as short_description, prod.product_id, prod.product_ean, prod.product_thumb_image, prod.product_price, pr_cat.category_id, prod.product_tax_id as tax_id, prod.product_old_price, prod.product_weight, prod.average_rating, prod.reviews_count, prod.hits, prod.weight_volume_units, prod.basic_price_unit_id, prod.label_id, prod.product_manufacturer_id, prod.product_weight, prod.min_price, prod.product_quantity, prod.different_prices  $adv_result
                  FROM `#__jshopping_products` AS prod
                  INNER JOIN `#__jshopping_products_to_categories` AS pr_cat ON pr_cat.product_id = prod.product_id
                  LEFT JOIN `#__jshopping_categories` AS cat ON pr_cat.category_id = cat.category_id
                  WHERE prod.product_publish = '1' AND cat.category_publish='1' ".$where_add."
                  GROUP BY prod.product_id ORDER BY prod.average_rating desc LIMIT ".$count;
        $db->setQuery($query);
        $products = $db->loadObjectList();
        $products = listProductUpdateData($products);
        return $products;
    }
    
    function getTopHitsProducts($count){
        $jshopConfig = &JSFactory::getConfig();

        $db =& JFactory::getDBO();
        $lang = &JSFactory::getLang();

        $where_add = '';        
        if ($jshopConfig->hide_product_not_avaible_stock){
            $where_add .= " AND prod.product_quantity > 0";
        }
        if ($jshopConfig->show_delivery_time){            
            $adv_result .= ", prod.delivery_times_id";
        }
        if ($jshopConfig->admin_show_product_extra_field){
            $adv_result .= getQueryListProductsExtraFields();
        }
        if ($jshopConfig->product_list_show_vendor){
            $adv_result .= ", prod.vendor_id";
        }
 
        $query = "SELECT prod.`".$lang->get('name')."` as name, prod.`".$lang->get('short_description')."` as short_description, prod.product_id, prod.product_ean, prod.product_thumb_image, prod.product_price, pr_cat.category_id, prod.product_tax_id as tax_id, prod.product_old_price, prod.product_weight, prod.average_rating, prod.reviews_count, prod.hits, prod.weight_volume_units, prod.basic_price_unit_id, prod.label_id, prod.product_manufacturer_id, prod.product_weight, prod.min_price, prod.product_quantity, prod.different_prices  $adv_result
                  FROM `#__jshopping_products` AS prod
                  INNER JOIN `#__jshopping_products_to_categories` AS pr_cat ON pr_cat.product_id = prod.product_id
                  LEFT JOIN `#__jshopping_categories` AS cat ON pr_cat.category_id = cat.category_id
                  WHERE prod.product_publish = '1' AND cat.category_publish='1' ".$where_add."
                  GROUP BY prod.product_id ORDER BY prod.hits desc LIMIT ".$count;
        $db->setQuery($query);
        $products = $db->loadObjectList();
        $products = listProductUpdateData($products);
        return $products;   
    }
    
    function getAllProducts($filters, $order1 = null, $orderby1 = null, $limitstart = 0, $limit = 0){
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
        
        $order_query = "";
        if ($order1){
            $order_query .= " ORDER BY ".$order1." ".$orderby1;            
        }
        
       $query = "SELECT prod.product_id, pr_cat.category_id, prod.`".$lang->get('name')."` as name, prod.`".$lang->get('short_description')."` as short_description, prod.product_ean, prod.product_thumb_image, prod.product_price, prod.product_tax_id as tax_id, prod.product_old_price, prod.product_weight, prod.average_rating, prod.reviews_count, prod.hits, prod.weight_volume_units, prod.basic_price_unit_id, prod.label_id, prod.product_manufacturer_id, prod.product_weight, prod.min_price, prod.product_quantity, prod.different_prices $adv_result
                  FROM `#__jshopping_products` AS prod
                  LEFT JOIN `#__jshopping_products_to_categories` AS pr_cat USING (product_id)
                  LEFT JOIN `#__jshopping_categories` AS cat ON pr_cat.category_id = cat.category_id                  
                  $adv_from
                  WHERE prod.product_publish = '1' AND cat.category_publish='1' ".$adv_query."
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
    
    function getCountAllProducts($filters) {
        $jshopConfig = &JSFactory::getConfig();
        
        $adv_query = "";
        if ($jshopConfig->hide_product_not_avaible_stock){
            $adv_query .= " AND prod.product_quantity > 0";
        }
        if (is_array($filters['categorys']) && count($filters['categorys'])){
            $adv_query .= " AND cat.category_id in (".implode(",",$filters['categorys']).")";
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
        
        $db =& JFactory::getDBO(); 
        $query = "SELECT COUNT(distinct prod.product_id) FROM `#__jshopping_products` as prod
                  LEFT JOIN `#__jshopping_products_to_categories` AS pr_cat USING (product_id)
                  LEFT JOIN `#__jshopping_categories` AS cat ON pr_cat.category_id = cat.category_id
                  WHERE prod.product_publish = '1' AND cat.category_publish='1' ".$adv_query;
        $db->setQuery($query);
        return $db->loadResult();
    }
    
    
    function getReviews($limitstart = 0, $limit = 20) {
        $query = "SELECT * FROM `#__jshopping_products_reviews` WHERE product_id = '".$this->_db->getEscaped($this->product_id)."' and publish='1' order by review_id desc";
        $this->_db->setQuery($query, $limitstart, $limit);
        return $this->_db->loadObjectList();
    }
    
    function getReviewsCount(){
        $query = "SELECT count(review_id) FROM `#__jshopping_products_reviews` WHERE product_id = '".$this->_db->getEscaped($this->product_id)."' and publish='1'";
        $this->_db->setQuery($query);
        return $this->_db->loadResult();
    }

    function getAverageRating() {
        $query = "SELECT ROUND(AVG(mark),2) FROM `#__jshopping_products_reviews` WHERE product_id = '".$this->_db->getEscaped($this->product_id)."' and mark > 0 and publish='1'";
        $this->_db->setQuery($query);
        return $this->_db->loadResult();
    }
    
    function loadAverageRating(){
        $this->average_rating = $this->getAverageRating();
        if (!$this->average_rating) $this->average_rating = 0;
    }
    
    function loadReviewsCount(){
        $this->reviews_count = $this->getReviewsCount();
    }

}
?>