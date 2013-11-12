<?php
/**
* @version      2.9.2 19.07.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die( 'Restricted access' );
jimport('joomla.application.component.model');

class jshopCart{
    
    var $type_cart = "cart"; //cart,wishlist
    var $products = array();
    var $count_product = 0;
    var $price_product = 0;
    var $summ = 0;
    var $rabatt_id = 0;
    var $rabatt_value = 0;
    var $rabatt_type = 0;
    var $rabatt_summ = 0;    
    
    function load($type_cart = "cart"){
        $jshopConfig = &JSFactory::getConfig();
        $this->type_cart = $type_cart;
        
        $session =& JFactory::getSession();
        $objcart = $session->get($this->type_cart);
                
        if (isset($objcart) && $objcart!='') {        
            $temp_cart = unserialize($objcart);            
            $this->products = $temp_cart->products;
            $this->rabatt_id = $temp_cart->rabatt_id;
            $this->rabatt_value = $temp_cart->rabatt_value;
            $this->rabatt_type = $temp_cart->rabatt_type;
            $this->rabatt_summ = $temp_cart->rabatt_summ;            
        }
        
        if(isset($_COOKIE['jshopping_temp_cart']) && $this->type_cart=='wishlist' && !count($this->products)) {
            $_tempcart = &JModel::getInstance('tempcart', 'jshop');
            $products = $_tempcart->getTempCart($_COOKIE['jshopping_temp_cart'], $this->type_cart);            
            if (count($products)){
                $this->products = $products;    
                $this->saveToSession();
            }            
        }
        
        $this->loadPriceAndCountProducts();
        if ($jshopConfig->use_extend_tax_rule){
            $this->updateTaxForProducts();
            $this->saveToSession();
        }        
        
        JPluginHelper::importPlugin('jshoppingcheckout');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onAfterCartLoad', array(&$this) );
    }
    
    function loadPriceAndCountProducts(){
        $jshopConfig = &JSFactory::getConfig();
        $this->price_product = 0;
        $this->price_product_brutto = 0;
        $this->count_product = 0;
        if(count($this->products)) {
            foreach ($this->products as $prod) {
                $this->price_product += $prod['price'] * $prod['quantity'];
                if ($jshopConfig->display_price_front_current==1){
                    $this->price_product_brutto += ($prod['price']*(1+$prod['tax']/100)) * $prod['quantity'];
                }else{
                    $this->price_product_brutto += $prod['price'] * $prod['quantity'];
                }
                $this->count_product += $prod['quantity'];
            }
        }
    }
    
    function getPriceProducts(){
        return $this->price_product;
    }
    
    function getPriceBruttoProducts(){
        return $this->price_product_brutto;
    }
    
    function getCountProduct(){
        return $this->count_product;
    }
    
    function updateTaxForProducts(){
        if(count($this->products)) {
            $taxes = &JSFactory::getAllTaxes();
            foreach ($this->products as $k=>$prod) {
                $this->products[$k]['tax'] = $taxes[$prod['tax_id']];
            }
        }
    }
    
    /**
    * get cart summ price
    * @param mixed $incShiping - include price shipping
    * @param mixed $incRabatt - include discount
    * @param mixed $incPayment - include price payment
    */
    function getSum( $incShiping = 0, $incRabatt = 0, $incPayment = 0 ) {
        $jshopConfig = &JSFactory::getConfig();
        
        $this->summ = $this->price_product;
        
        if ($jshopConfig->display_price_front_current==1){            
            $this->summ = $this->summ + $this->getTax($incShiping, $incRabatt, $incPayment);
        }       
                
        if ($incShiping){
            $price_shipping = $this->getShippingPrice();
            $this->summ = $this->summ + $price_shipping;
        }
        
        if ($incPayment){
            $price_payment = $this->getPaymentPrice();
            $this->summ = $this->summ + $price_payment;
        }
        
        if ($incRabatt){
            $this->summ = $this->summ - $this->getDiscountShow();
            if ($this->summ < 0) $this->summ = 0;
        }
        
        return $this->summ;
    }
    
    function getDiscountShow(){
        $summForCalculeDiscount = $this->getSummForCalculeDiscount();
        if ($this->rabatt_summ > $summForCalculeDiscount){
            return $summForCalculeDiscount;
        }else{
            return $this->rabatt_summ;
        }
    }
    
    function getFreeDiscount(){
        $summForCalculeDiscount = $this->getSummForCalculeDiscount();
        if ($this->rabatt_summ > $summForCalculeDiscount){
            return $this->rabatt_summ - $summForCalculeDiscount;
        }else{
            return 0;
        }
    }    
   
    function getTax( $incShiping = 0, $incRabatt = 0, $incPayment = 0){        
        $taxes = $this->getTaxExt($incShiping, $incRabatt, $incPayment);        
        $tax_summ = array_sum($taxes);        
    return $tax_summ;
    }
    
    /**
    * get cart tax    
    * @param mixed $incShiping - include price shipping
    * @param mixed $incRabatt - not used
    * @param mixed $incPayment - include price payment
    */
    function getTaxExt( $incShiping = 0, $incRabatt = 0, $incPayment = 0) {
        $jshopConfig = &JSFactory::getConfig();
        
        $tax_summ = array();
        foreach ($this->products as $key => $value) {
            if ($value['tax']!=0){
                $tax_summ[$value['tax']] += $value['quantity'] * getPriceTaxValue($value['price'], $value['tax'], $jshopConfig->display_price_front_current);                
            }
        }        
                
        if ($incShiping){
            if ($this->getShippingPriceTaxPercent()!=0 && $this->getShippingPriceTax()!=0){                
                $tax_summ[$this->getShippingPriceTaxPercent()] += $this->getShippingPriceTax();
            }
        }
        
        if ($incPayment){
            if ($this->getPaymentTaxPercent()!=0 && $this->getPaymentTax()!=0){                
                $tax_summ[$this->getPaymentTaxPercent()] += $this->getPaymentTax();
            }
        }
        
        if ($incRabatt && $jshopConfig->calcule_tax_after_discount && $this->rabatt_summ>0){
            $tax_summ = $this->getTaxExtCalcAfterDiscount($incShiping, $incPayment);
        }
        
        return $tax_summ;
    }
    
    function getTaxExtCalcAfterDiscount($incShiping = 0, $incPayment = 0){
        $jshopConfig = &JSFactory::getConfig();
        
        $summ = array();

        foreach ($this->products as $key => $value) {            
            $summ[$value['tax']] += $value['quantity'] * $value['price'];            
        }
        
        if ($jshopConfig->discount_use_full_sum){
            if ($incShiping && $this->display_item_shipping){
                if ($this->getShippingPriceTaxPercent()!=0 && $this->getShippingPrice()!=0){
                    $summ[$this->getShippingPriceTaxPercent()] += $this->getShippingPrice(); 
                }
            }
            
            if ($incPayment && $this->display_item_payment){
                if ($this->getPaymentTaxPercent()!=0 && $this->getPaymentPrice()!=0){
                    $summ[$this->getPaymentTaxPercent()] += $this->getPaymentPrice(); 
                }
            }
        }
                
        $allsum = array_sum($summ);
                
        $discountsum = $this->getDiscountShow();        
        
        $calc_taxes = array();
        foreach($summ as $tax=>$val){
            $percent = $val / $allsum;            
            $pwd = $val - ($discountsum * $percent);
            if ($pwd<0) $pwd = 0;
            if ($jshopConfig->display_price_front_current==1){
                $calc_taxes[$tax] = $pwd*$tax/100;
            }else{
                $calc_taxes[$tax] = $pwd*$tax/(100+$tax);
            }
        }
        
        if (!$jshopConfig->discount_use_full_sum){
            if ($incShiping && $this->display_item_shipping){
                if ($this->getShippingPriceTaxPercent()!=0 && $this->getShippingPriceTax()!=0){                
                    $calc_taxes[$this->getShippingPriceTaxPercent()] += $this->getShippingPriceTax();
                }
            }
            
            if ($incPayment && $this->display_item_payment){
                if ($this->getPaymentTaxPercent()!=0 && $this->getPaymentTax()!=0){                
                    $calc_taxes[$this->getPaymentTaxPercent()] += $this->getPaymentTax();
                }
            }
        }
        
        return $calc_taxes;        
    }
    
    function setDisplayFreeAttributes(){
        $jshopConfig = &JSFactory::getConfig();
        if (count($this->products)){
            if ($jshopConfig->admin_show_freeattributes){
                $_freeattributes = &JTable::getInstance('freeattribut', 'jshop');
                $namesfreeattributes = $_freeattributes->getAllNames();
            }
            foreach ($this->products as $k=>$prod){
                if ($jshopConfig->admin_show_freeattributes){
                    $freeattributes = unserialize($prod['freeattributes']);
                    if (!is_array($freeattributes)) $freeattributes = array();
                    $free_attributes_value = array();
                    foreach($freeattributes as $id=>$text){
                        $obj = new stdClass();
                        $obj->attr = $namesfreeattributes[$id];
                        $obj->value = $text;
                        $free_attributes_value[] = $obj;
                    }
                    $this->products[$k]['free_attributes_value'] = $free_attributes_value;
                }else{
                    $this->products[$k]['free_attributes_value'] = array();
                }
            }
        }    
    }
    
    function setDisplayItem($shipping = 0, $payment = 0){
        $this->display_item_shipping = $shipping;
        $this->display_item_payment = $payment;
    }
    
    function setShippingId($val){
        $session =& JFactory::getSession();
        $session->set("shipping_method_id", $val);
    }
    
    function getShippingId() {
        $session =& JFactory::getSession();        
        return $session->get("shipping_method_id");
    }
    
    function setShippingPrId($val){
        $session =& JFactory::getSession();
        $session->set("sh_pr_method_id", $val);
    }
    
    function getShippingPrId() {
        $session =& JFactory::getSession();        
        return $session->get("sh_pr_method_id");
    }
    
    function setShippingPrice($price){
        $session =& JFactory::getSession();        
        $session->set("jshop_price_shipping", $price);
    }
    
    function getShippingPrice() {
        $session =& JFactory::getSession();
        $price = $session->get("jshop_price_shipping");
        return floatval($price);
    }
    
    function setShippingPriceTax($price){
        $session =& JFactory::getSession();
        $session->set("jshop_price_shipping_tax", $price);
    }
    
    function getShippingPriceTax() {
        $session =& JFactory::getSession();
        $price = $session->get("jshop_price_shipping_tax");
        return floatval($price);
    }
    
    function setShippingPriceTaxPercent($price){
        $session =& JFactory::getSession();
        $session->set("jshop_price_shipping_tax_percent", $price);
    }
    
    function getShippingPriceTaxPercent() {
        $session =& JFactory::getSession();        
        return $session->get("jshop_price_shipping_tax_percent");
    }
        
    function getShippingNettoPrice(){
        if ($jshopConfig->display_price_front_current==1){
            return $this->getShippingPrice() / (1 + $this->getShippingPriceTaxPercent() / 100);
        }else{
            return $this->getShippingPrice();
        }
    }
    
    function getShippingBruttoPrice(){
        $jshopConfig = &JSFactory::getConfig();
        if ($jshopConfig->display_price_front_current==1){
            return $this->getShippingPrice() * (1 + ($this->getShippingPriceTaxPercent()/100) );
        }else{
            return $this->getShippingPrice();
        }
    }
    
    
    function setPaymentId($val){
        $session =& JFactory::getSession();
        $session->set("payment_method_id", $val);
    }
    
    function getPaymentId(){
        $session =& JFactory::getSession();
        return $session->get("payment_method_id");
    }
    
    function setPaymentPrice($val){
        $session =& JFactory::getSession();
        $session->set("jshop_payment_price", $val);
    }
    
    function getPaymentPrice(){
        $session =& JFactory::getSession();
        $price = $session->get("jshop_payment_price");
        return floatval($price);   
    }
    
    function getPaymentBruttoPrice(){
        $jshopConfig = &JSFactory::getConfig();
        if ($jshopConfig->display_price_front_current==1){
            return $this->getPaymentPrice() * (1 + ($this->getPaymentTaxPercent()/100) );
        }else{
            return $this->getPaymentPrice();
        }
    }
    
    function setPaymentTax($val){
        $session =& JFactory::getSession();
        $session->set("jshop_payment_tax", $val);
    }
    
    function getPaymentTax(){
        $session =& JFactory::getSession();
        $price = $session->get("jshop_payment_tax");
        return $price;
    }
    
    function setPaymentTaxPercent($val){
        $session =& JFactory::getSession();
        $session->set("jshop_payment_tax_percent", $val);
    }
    
    function getPaymentTaxPercent(){
        $session =& JFactory::getSession();
        $price = $session->get("jshop_payment_tax_percent");
        return $price;
    }
    
    function setPaymentParams($val){
        $session =& JFactory::getSession();
        $session->set("pm_params", $val);
    }
    
    function getPaymentParams(){
        $session =& JFactory::getSession();
        $val = $session->get("pm_params");
        return $val;
    }    
    
    
    function getCouponId(){
        return $this->rabatt_id;
    }

    function updateCartProductPrice() {
        foreach ($this->products as $key => $value) {
            $product = &JTable::getInstance('product', 'jshop');
            $product->load($this->products[$key]['product_id']);
            $attr_id = unserialize($value['attributes']);
            $product->setAttributeActive($attr_id);
            $this->products[$key]['price'] = $product->getPrice($this->products[$key]['quantity'], 1, 1, 1);
        }
        $this->loadPriceAndCountProducts();
        $this->reloadRabatValue();
        $this->saveToSession();
    }

    function add($product_id, $quantity, $attr_id, $freeattributes){
        
        $jshopConfig = &JSFactory::getConfig();
        $attr_serialize = serialize($attr_id);
        $free_attr_serialize = serialize($freeattributes);
        $updateqty = 1;
        
        if ($quantity <= 0) return 0;
        
        JPluginHelper::importPlugin('jshoppingcheckout');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeAddProductToCart', array(&$this, &$product_id, &$quantity, &$attr_id, &$freeattributes, &$updateqty) );
        
        $currency = &JTable::getInstance('currency', 'jshop');
        $currency->load($jshopConfig->cur_currency);
        
        $product = &JTable::getInstance('product', 'jshop');
        $product->load($product_id);
        
        //check attributes
        if ( (count($product->getRequireAttribute()) > count($attr_id)) || in_array(0, $attr_id)){
            JError::raiseNotice('', _JSHOP_SELECT_PRODUCT_OPTIONS);
            return 0;
        }
        
        //check free attributes
        if ($jshopConfig->admin_show_freeattributes){
            $allfreeattributes = $product->getListFreeAttributes();
            $error = 0;
            foreach($allfreeattributes as $k=>$v){
                if ($v->required && trim($freeattributes[$v->id])==""){
                    $error = 1;                    
                    JError::raiseNotice('', sprintf(_JSHOP_PLEASE_ENTER_X, $v->name));
                }
            }            
            if ($error){
                return 0;
            }            
        }
        
        $product->setAttributeActive($attr_id);
        $qtyInStock = $product->getQtyInStock();
        
        $allattribs = &JSFactory::getAllAttributes(2);
        $alldependentattr = $allattribs['dependent'];
        $all_id_dependent_attr = array_keys($alldependentattr);
        $dependent_attr = array();
        foreach($attr_id as $k=>$v){
            if (in_array($k, $all_id_dependent_attr)){
                $dependent_attr[$k] = $v;
            }
        }
        $dependent_attr_serrialize = serialize($dependent_attr);
        
        $new_product = 1;
        if ($updateqty){
        foreach ($this->products as $key => $value){
            if ($value['product_id'] == $product_id && $value['attributes'] == $attr_serialize && $value['freeattributes']==$free_attr_serialize) {
                $product_in_cart = $this->products[$key]['quantity'];
                $save_quantity = $product_in_cart + $quantity;
                
                $sum_quantity = $save_quantity;
                foreach ($this->products as $key2 => $value2){
                    if ($key==$key2) continue;
                    if ($value2['product_id'] == $product_id && $value2['dependent_attr_serrialize'] == $dependent_attr_serrialize){
                        $sum_quantity += $value2["quantity"];
                        $product_in_cart += $value2["quantity"];
                    }
                }

                if ($jshopConfig->max_count_order_one_product && $sum_quantity > $jshopConfig->max_count_order_one_product){
                    JError::raiseNotice('', sprintf(_JSHOP_ERROR_MAX_COUNT_ORDER_ONE_PRODUCT, $jshopConfig->max_count_order_one_product));
                    return 0;
                }
                if ($jshopConfig->min_count_order_one_product && $sum_quantity < $jshopConfig->min_count_order_one_product){
                    JError::raiseNotice('', sprintf(_JSHOP_ERROR_MIN_COUNT_ORDER_ONE_PRODUCT, $jshopConfig->min_count_order_one_product));
                    return 0;
                }
                
                if (!$product->unlimited && $jshopConfig->controler_buy_qty && ($sum_quantity > $qtyInStock)){
                    $balans = $qtyInStock - $product_in_cart;
                    if ($balans < 0) $balans = 0;
                    JError::raiseWarning('', sprintf(_JSHOP_ERROR_EXIST_QTY_PRODUCT_IN_CART, $this->products[$key]['quantity'], $balans));
                    return 0;
                }
                 
                $this->products[$key]['quantity'] = $save_quantity;                
                $this->products[$key]['price'] = $product->getPrice($this->products[$key]['quantity'], 1, 1, 1);
                
                $dispatcher->trigger( 'onBeforeSaveUpdateProductToCart', array(&$this) );
                
                $new_product = 0;
                break;
            }
        }
        }

        if ($new_product){
            $product_in_cart = 0;
            foreach ($this->products as $key2 => $value2){
                if ($value2['product_id'] == $product_id && $value2['dependent_attr_serrialize'] == $dependent_attr_serrialize){
                    $product_in_cart += $value2["quantity"];
                }
            }
            $sum_quantity = $product_in_cart + $quantity;
            
            if ($jshopConfig->max_count_order_one_product && $sum_quantity > $jshopConfig->max_count_order_one_product){
                JError::raiseNotice('', sprintf(_JSHOP_ERROR_MAX_COUNT_ORDER_ONE_PRODUCT, $jshopConfig->max_count_order_one_product));
                return 0;
            }
            if ($jshopConfig->min_count_order_one_product && $sum_quantity < $jshopConfig->min_count_order_one_product){
                JError::raiseNotice('', sprintf(_JSHOP_ERROR_MIN_COUNT_ORDER_ONE_PRODUCT, $jshopConfig->min_count_order_one_product));
                return 0;
            }                                   
            
            if (!$product->unlimited && $jshopConfig->controler_buy_qty && ($sum_quantity > $qtyInStock)){
                $balans = $qtyInStock - $product_in_cart;
                if ($balans < 0) $balans = 0;
                JError::raiseWarning('', sprintf(_JSHOP_ERROR_EXIST_QTY_PRODUCT, $balans));
                return 0;
            }
            
            $product->getDescription();            
            $temp_product['quantity'] = $quantity;
            $temp_product['product_id'] = $product_id;
            $temp_product['category_id'] = $product->getCategory();
            $temp_product['price'] = $product->getPrice($quantity, 1, 1, 1);
            $temp_product['tax'] = $product->getTax();
            $temp_product['tax_id'] = $product->product_tax_id;
            $temp_product['description'] = $product->short_description;
            $temp_product['product_name'] = $product->name;
            $temp_product['thumb_image'] = $product->product_thumb_image;
            $temp_product['ean'] = $product->getEan();
            $temp_product['attributes'] = $attr_serialize;
            $temp_product['attributes_value'] = array();
            $temp_product['weight'] = $product->getWeight();
            $temp_product['vendor_id'] = $product->vendor_id;
            $temp_product['files'] = serialize($product->getSaleFiles());            
            $temp_product['freeattributes'] = $free_attr_serialize;            
            $temp_product['dependent_attr_serrialize'] = $dependent_attr_serrialize;
            $i = 0;
            if (is_array($attr_id) && count($attr_id)) {
                foreach ($attr_id as $key => $value) {
                    $attr = &JTable::getInstance('attribut', 'jshop');
                    $attr_v = &JTable::getInstance('attributvalue', 'jshop');
                    $temp_product['attributes_value'][$i]->attr = $attr->getName($key);
                    $temp_product['attributes_value'][$i++]->value = $attr_v->getName($value);                    
                }
            }
            
            $dispatcher->trigger( 'onBeforeSaveNewProductToCart', array(&$this, &$temp_product) );
            
            $this->products[] = $temp_product;
        }
        
        $this->loadPriceAndCountProducts();
        $this->reloadRabatValue();
        $this->saveToSession();
        $dispatcher->trigger( 'onAfterAddProductToCart', array(&$this, &$product_id, &$quantity, &$attr_id, &$freeattributes) );
        return 1;
    }

    function refresh($quantity){
        $jshopConfig = &JSFactory::getConfig();
        
        JPluginHelper::importPlugin('jshoppingcheckout');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeRefreshProductInCart', array(&$quantity) );
                
        if (is_array($quantity) && count($quantity)) {            
            $lang = &JSFactory::getLang();
            $name = $lang->get('name');
            foreach ($quantity as $key => $value) {
                $value = intval($value);
                if ($value < 0) $value = 0;
                $product = &JTable::getInstance('product', 'jshop');
                $product->load($this->products[$key]['product_id']);
                $attr = unserialize($this->products[$key]['attributes']);
                $free_attr = unserialize($this->products[$key]['freeattributes']);
                $product->setAttributeActive($attr);
                $qtyInStock = $product->getQtyInStock();
                $checkqty = $value;

                foreach ($this->products as $key2 => $value2){
                    if ($key2!=$key && $value2['product_id'] == $this->products[$key]['product_id'] && $value2['dependent_attr_serrialize'] == $this->products[$key]['dependent_attr_serrialize']){
                        $checkqty += $value2["quantity"]; 
                    }
                }
                
                if ($jshopConfig->max_count_order_one_product && ($checkqty > $jshopConfig->max_count_order_one_product)){
                    JError::raiseNotice('', sprintf(_JSHOP_ERROR_MAX_COUNT_ORDER_ONE_PRODUCT, $jshopConfig->max_count_order_one_product));
                    return 0;
                }
                if ($jshopConfig->min_count_order_one_product && ($checkqty < $jshopConfig->min_count_order_one_product)){
                    JError::raiseNotice('', sprintf(_JSHOP_ERROR_MIN_COUNT_ORDER_ONE_PRODUCT, $jshopConfig->min_count_order_one_product));
                    return 0;
                }                
                if (!$product->unlimited && $jshopConfig->controler_buy_qty && ($checkqty > $qtyInStock)){
                    JError::raiseWarning('', sprintf(_JSHOP_ERROR_EXIST_QTY_PRODUCT_BASKET, $product->$name, $qtyInStock));
                    continue;
                }
                                
                $this->products[$key]['price'] = $product->getPrice($value, 1, 1, 1);
                $this->products[$key]['quantity'] = $value;
                if ($this->products[$key]['quantity'] == 0){
                    unset($this->products[$key]);
                }
                unset($product);
            }
        }
        $this->loadPriceAndCountProducts();
        $this->reloadRabatValue();
        $this->saveToSession();
        $dispatcher->trigger( 'onAfterRefreshProductInCart', array(&$quantity) );        
        return 1;
    }

    function getWeightProducts() {
        $weight_sum = 0;
        foreach ($this->products as $prod) {
            $weight_sum += $prod['weight'] * $prod['quantity'];
        }
        return $weight_sum;
    }

    function setRabatt($id, $type, $value, $tax) {        
        $this->rabatt_id = $id;
        $this->rabatt_type = $type;
        $this->rabatt_value = $value;
        $this->reloadRabatValue();    
        $this->saveToSession();    
    }
    
    function getSummForCalculePlusPayment(){
        $jshopConfig = &JSFactory::getConfig();        
        $sum = $this->getPriceBruttoProducts();        
        if ($this->display_item_shipping) $sum += $this->getShippingBruttoPrice();            
        return $sum;
    }
    
    function getSummForCalculeDiscount(){
        $jshopConfig = &JSFactory::getConfig();
        
        $sum = $this->getPriceProducts();
        
        if ($jshopConfig->discount_use_full_sum && $jshopConfig->display_price_front_current==1){
            $sum = $this->getPriceBruttoProducts();
        }
        
        if ($jshopConfig->discount_use_full_sum){
            if ($this->display_item_shipping) $sum += $this->getShippingBruttoPrice();
            if ($this->display_item_payment) $sum += $this->getPaymentBruttoPrice();            
        }
        return $sum;
    }
    
    function reloadRabatValue(){
        $jshopConfig = &JSFactory::getConfig();        
        
        if($this->rabatt_type == 1) {
            $this->rabatt_summ = $this->rabatt_value * $jshopConfig->currency_value; //value
        } else {
            $this->rabatt_summ = $this->rabatt_value / 100 * $this->getSummForCalculeDiscount(); //percent
        }        
    }
    
    function updateDiscountData(){
        $this->reloadRabatValue();    
        $this->saveToSession();    
    }

    function addLinkToProducts($show_delete = 0, $type="cart") {
        foreach ($this->products as $key => $value) {
            $this->products[$key]['href'] = SEFLink('index.php?option=com_jshopping&controller=product&task=view&category_id='.$this->products[$key]['category_id'].'&product_id='.$value['product_id'], 1);
            if($show_delete){
                $this->products[$key]['href_delete'] = SEFLink('index.php?option=com_jshopping&controller='.$type.'&task=delete&number_id='.$key);
            }
            if ($type=="wishlist"){
                $this->products[$key]['remove_to_cart'] = SEFLink('index.php?option=com_jshopping&controller='.$type.'&task=remove_to_cart&number_id='.$key);                
            }
        }
    }
    
    /**
    * get vendor type
    * return (1 - multi vendors, 0 - single vendor)
    */
    function getVendorType(){
        $vendors = array();
        foreach ($this->products as $key => $value){
            $vendors[] = $value['vendor_id'];
        }
        $vendors = array_unique($vendors);
        if (count($vendors)>1){
            return 1;
        }else{
            return 0;
        }
    }
    
    /**
    * get id vendor
    * reutnr (-1) - if type == multivendors
    */
    function getVendorId(){
        $vendors = array();
        foreach ($this->products as $key => $value){
            $vendors[] = $value['vendor_id'];
        }
        $vendors = array_unique($vendors);
        if (count($vendors)==0){
            return 0;
        }elseif (count($vendors)>1){
            return -1;
        }else{
            return $vendors[0];
        }
    }
    
    function clear() {
        
        JPluginHelper::importPlugin('jshoppingcheckout');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeClearCart', array(&$this) );
        
        $session =& JFactory::getSession();
        $this->products = array();
        $this->rabatt = 0;
        $this->rabatt_value = 0;
        $this->rabatt_type = 0;
        $this->rabatt_summ = 0;
        $this->summ = 0;
        $this->count_product = 0;        
        $this->price_product = 0;        
        $session->set($this->type_cart, "");
        $session->set("pm_method", "");
        $session->set("pm_params", "");
        $session->set("payment_method_id", "");
        $session->set("shipping_method_id", "");
        $session->set("jshop_price_shipping", "");
    }

    function delete($number_id) {
        JPluginHelper::importPlugin('jshoppingcheckout');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeDeleteProductInCart', array(&$number_id, &$this) );
        
        unset($this->products[$number_id]);
        $this->loadPriceAndCountProducts();
        $this->reloadRabatValue();
        $this->saveToSession();
        
        $dispatcher->trigger( 'onAfterDeleteProductInCart', array(&$number_id, &$this) );
    }

    function saveToSession() {
        $session =& JFactory::getSession();
        $session->set($this->type_cart, serialize($this));        
        $_tempcart = &JModel::getInstance('tempcart', 'jshop');
        $_tempcart->insertTempCart($this);        
    }

}
?>