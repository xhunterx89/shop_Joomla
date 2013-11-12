<?php
/**
* @version      2.9.0 10.02.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

class jshopOrder extends JTable {
    
    var $order_id = null;
    var $order_number = null;
    var $user_id = null;
    var $order_total = null;
    var $order_subtotal = null;
    var $order_tax = null;
    var $order_tax_ext = null;
    var $order_shipping = null;
    var $order_payment = null;
    var $order_discount = null;
    var $currency_code = null;
    var $currency_code_iso = null;
    var $currency_exchange = null;
    var $order_status = null;
    var $order_created = null;
    var $order_date = null;
    var $order_m_date = null;
    var $shipping_method_id = null;
    var $payment_method_id = null;
    var $payment_params = null;
    var $payment_params_data = null;
    var $ip_address = null;
    var $order_add_info = null;
    
    var $title = null;
    var $f_name = null;
    var $l_name = null;
    var $firma_name = null;
    var $client_type = null;
    var $client_type_name = null;
    var $firma_code = null;
    var $tax_number = null;
    var $email = null;
    var $street = null;
    var $zip = null;
    var $city = null;
    var $state = null;
    var $country = null;
    var $phone = null;
    var $mobil_phone = null;
    var $fax = null;
    var $ext_field_1 = null;
    var $ext_field_2 = null;
    var $ext_field_3 = null;

    var $d_title = null;
    var $d_f_name = null;
    var $d_l_name = null;
    var $d_firma_name = null;
    var $d_email = null;
    var $d_street = null;
    var $d_zip = null;
    var $d_city = null;
    var $d_state = null;
    var $d_country = null;
    var $d_phone = null;
    var $d_mobil_phone = null;    
    var $d_fax = null;
    var $d_ext_field_1 = null;
    var $d_ext_field_2 = null;
    var $d_ext_field_3 = null;
        
    var $pdf_file = null;
    var $order_hash = null;
    var $file_hash = null;
    var $file_stat_downloads = null;
    var $order_custom_info = null;
    var $display_price = null;    
    var $vendor_type = null; 
    var $vendor_id = null;     
    var $lang = null;
    var $transaction = null;

    function __construct( &$_db ){
        parent::__construct( '#__jshopping_orders', 'order_id', $_db );
    }

    function getAllItems() {
        if (!isset($this->items)){
            $query = "SELECT OI.*, P.product_thumb_image as thumb_image FROM `#__jshopping_order_item` as OI left join #__jshopping_products as P on OI.product_id=P.product_id
                      WHERE OI.order_id = '".$this->_db->getEscaped($this->order_id)."'";
            $this->_db->setQuery($query);
            $this->items = $this->_db->loadObjectList();
        }
        return $this->items;
    }
    
    function getWeightItems(){
        $items = $this->getAllItems();
        $weight = 0;
        foreach($items as $row){
            $weight += $row->product_quantity * $row->weight;
        }
    return $weight;
    }

    function getHistory() {
        $lang = &JSFactory::getLang();
        $query = "SELECT history.*, status.*, status.`".$lang->get('name')."` as status_name  FROM `#__jshopping_order_history` AS history
                  INNER JOIN `#__jshopping_order_status` AS status ON history.order_status_id = status.status_id
                  WHERE history.order_id = '" . $this->_db->getEscaped($this->order_id) . "'
                  ORDER BY history.status_date_added";
        $this->_db->setQuery($query);        
        return $this->_db->loadObjectList();
    }

    function getStatus() {
        $lang = &JSFactory::getLang();
        $query = "SELECT `".$lang->get('name')."` as name FROM `#__jshopping_order_status` WHERE status_id = '" . $this->_db->getEscaped($this->order_status) . "'";
        $this->_db->setQuery($query);
        return $this->_db->loadResult();
    }

    function copyDeliveryData(){    
        $this->d_title = $this->title;
        $this->d_f_name = $this->f_name;
        $this->d_l_name = $this->l_name;
        $this->d_firma_name = $this->firma_name;
        $this->d_street = $this->street;
        $this->d_zip = $this->zip;
        $this->d_city = $this->city;
        $this->d_state = $this->state;
        $this->d_email = $this->email;
        $this->d_country = $this->country;
        $this->d_phone = $this->phone;
        $this->d_mobil_phone = $this->mobil_phone;
        $this->d_fax = $this->fax;
        $this->d_ext_field_1 = $this->ext_field_1;
        $this->d_ext_field_2 = $this->ext_field_2;
        $this->d_ext_field_3 = $this->ext_field_3;
    }

    function getOrdersForUser($id_user) {
        $db =& JFactory::getDBO();
        $lang = &JSFactory::getLang(); 
        $query = "SELECT orders.*, order_status.`".$lang->get('name')."` as status_name, COUNT(order_item.order_id) AS count_products
                  FROM `#__jshopping_orders` AS orders
                  INNER JOIN `#__jshopping_order_status` AS order_status ON orders.order_status = order_status.status_id
                  INNER JOIN `#__jshopping_order_item` AS order_item ON order_item.order_id = orders.order_id
                  WHERE orders.user_id = '".$db->getEscaped($id_user)."' and orders.order_created='1'
                  GROUP BY order_item.order_id 
                  ORDER BY orders.order_date DESC";
        $db->setQuery($query);
        return $db->loadObjectList();
    }

    /**
    * Next order id    
    */
    function getLastOrderId() {
        $db =& JFactory::getDBO(); 
        $query = "SELECT MAX(orders.order_id) AS max_order_id FROM `#__jshopping_orders` AS orders";
        $db->setQuery($query);
        return $db->loadResult() + 1;
    }
    
    /*function generateNextOrderNumber(){
        $db =& JFactory::getDBO(); 
        $query = "SELECT MAX(order_number) AS end_number FROM `#__jshopping_orders`";
        $db->setQuery($query);
        $end_number = $db->loadResult();
        $next = intval($end_number)+1;
        $number = outputDigit($next, 8);        
        return $number;
    }*/
    
    function formatOrderNumber($num){
        $number = outputDigit($num, 8);        
        return $number;
    }

    /**
    * save name pdf from order
    */
    function insertPDF() {
        $query = "UPDATE `#__jshopping_orders` SET pdf_file = '".$this->_db->getEscaped($this->pdf_file)."' WHERE order_id = '".$this->_db->getEscaped($this->order_id)."'";
        $this->_db->setQuery($query);
        $this->_db->query();
    }
    
    function getFilesStatDownloads(){
        if ($this->file_stat_downloads == "") return array();
        return unserialize($this->file_stat_downloads);
    }
    
    function setFilesStatDownloads($array){
        $this->file_stat_downloads = serialize($array);    
    }
    
    function getTaxExt(){
        if ($this->order_tax_ext == "") return array();
        return unserialize($this->order_tax_ext);
    }
    
    function setTaxExt($array){
        $this->order_tax_ext = serialize($array);    
    }
    
    function getPaymentParamsData(){
        if ($this->payment_params_data == "") return array();
        return unserialize($this->payment_params_data);
    }
    
    function setPaymentParamsData($array){
        $this->payment_params_data = serialize($array);    
    }
    
    function getLang(){
        $lang = $this->lang;
        if ($lang=="") $lang = "en-GB";        
        return $lang;
    }
    
    function saveOrderItem($items) {
        JPluginHelper::importPlugin('jshoppingorder');
        $dispatcher =& JDispatcher::getInstance();
        
        foreach ($items as $key => $value){
            $order_item = &JTable::getInstance('orderItem', 'jshop');            
            $order_item->order_id = $this->order_id;
            $order_item->product_id = $value['product_id'];
            $order_item->product_ean = $value['ean'];
            $order_item->product_name = $value['product_name'];
            $order_item->product_quantity = $value['quantity'];
            $order_item->product_item_price = $value['price'];
            $order_item->product_tax = $value['tax'];
            $order_item->product_attributes = $attributes_value = '';
            $order_item->product_freeattributes = $free_attributes_value = '';
            $order_item->attributes = $value['attributes'];
            $order_item->files = $value['files'];
            $order_item->freeattributes = $value['freeattributes'];
            $order_item->weight = $value['weight'];
            $order_item->vendor_id = $value['vendor_id'];
            
            if (isset($value['attributes_value'])){
                foreach ($value['attributes_value'] as $attr){
                    $attributes_value .= $attr->attr.": ".$attr->value . "\n";
                }
            }
            $order_item->product_attributes = $attributes_value;
            
            if (isset($value['free_attributes_value'])){
                foreach ($value['free_attributes_value'] as $attr){
                    $free_attributes_value .= $attr->attr.": ".$attr->value . "\n";
                }
            }
            $order_item->product_freeattributes = $free_attributes_value;
            
            $dispatcher->trigger( 'onBeforeSaveOrderItem', array(&$order_item, &$value) );
            
            $order_item->store();
        }
        return 1;
    }
    
    /**
    * get or return product in Stock
    * @param $change ("-" - get, "+" - return) 
    */
    function changeProductQTYinStock($change = "-"){
        $db =& JFactory::getDBO();
        
        $query = "SELECT OI.*, P.unlimited FROM `#__jshopping_order_item` as OI left join `#__jshopping_products` as P on P.product_id=OI.product_id
                  WHERE order_id = '".$db->getEscaped($this->order_id)."'";
        $db->setQuery($query);
        $items = $db->loadObjectList();

        foreach($items as $item){
            
            if ($item->unlimited) continue;
            
            if ($item->attributes!=""){
                $attributes = unserialize($item->attributes);
            }else{
                $attributes = array();
            }            
            if (!is_array($attributes)) $attributes = array();
            
            $allattribs = &JSFactory::getAllAttributes(1);
            $dependent_attr = array();            
            foreach($attributes as $k=>$v){
                if ($allattribs[$k]->independent==0){
                    $dependent_attr[$k] = $v;
                }
            }
            
            if (count($dependent_attr)){                
                $where="";
                foreach($dependent_attr as $k=>$v){
                    $where.=" and `attr_$k`='".intval($v)."'";        
                }
                $query = "update `#__jshopping_products_attr` set `count`=`count`  ".$change." ".intval($item->product_quantity)." where product_id='".intval($item->product_id)."' ".$where;
                $db->setQuery($query);
                $db->query();
                
                $query="select sum(count) as qty from `#__jshopping_products_attr` where product_id='".intval($item->product_id)."' and `count`>0 ";
                $db->setQuery($query);
                $qty = $db->loadResult();
                
                $query = "UPDATE `#__jshopping_products` SET product_quantity = '".intval($qty)."' WHERE product_id = '".intval($item->product_id)."'";
                $db->setQuery($query);
                $db->query();
                
            }else{
                $query = "UPDATE `#__jshopping_products` SET product_quantity = product_quantity ".$change." ".intval($item->product_quantity)." WHERE product_id = '".intval($item->product_id)."'";
                $db->setQuery($query);
                $db->query();
            }
        }
    }
    
    /**    
    * get list vendors for order
    */
    function getVendors(){
        $db =& JFactory::getDBO();
        
        $query = "SELECT distinct V.* FROM `#__jshopping_order_item` as OI
                  left join `#__jshopping_vendors` as V on V.id = OI.vendor_id
                  WHERE order_id = '".$db->getEscaped($this->order_id)."' and vendor_id!='0' ";
        $db->setQuery($query);
        $vendors = $db->loadObjectList();
    return $vendors;
    }
    
    function getVendorItems($vendor_id){
        $items = $this->getAllItems($vendor_id);
        foreach($items as $k=>$v){
            if ($v->vendor_id!=$vendor_id){
                unset($items[$k]);
            }
        }
    return $items;
    }
    
    function getVendorInfo(){
        $jshopConfig = &JSFactory::getConfig();
        $vendor_id = $this->vendor_id;
        if ($vendor_id==-1) $vendor_id = 0;
        if ($jshopConfig->vendor_order_message_type!=2) $vendor_id = 0;        
        $vendor = &JTable::getInstance('vendor', 'jshop');
        $vendor->loadFull($vendor_id);
        $vendor->country_id = $vendor->country;
        $lang = &JSFactory::getLang($this->getLang());
        $country = &JTable::getInstance('country', 'jshop');
        $country->load($vendor->country_id);
        $field_country_name = $lang->get("name");
        $vendor->country = $country->$field_country_name;        
    return $vendor;
    }
    
}
?>