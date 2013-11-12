<?php
/**
* @version      2.7.2 19.01.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

class jshopUserGust extends JObject {
    
    var $user_id = null;
    var $usergroup_id = null;
    var $payment_id = null;
    var $shipping_id = null;
    
    var $title = null;
    var $u_name = null;
    var $f_name = null;
    var $l_name = null;
    var $firma_name = null;
    var $client_type = null;
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
    
    var $delivery_adress = null;
    var $d_title = null;
    var $d_f_name = null;
    var $d_l_name = null;
    var $d_firma_name = null;
    var $d_email = null;
    var $d_street = null;
    var $d_city = null;
    var $d_zip = null;
    var $d_state = null;
    var $d_country = null;
    var $d_phone = null;
    var $d_mobil_phone = null;    
    var $d_fax = null;
    var $d_ext_field_1 = null;
    var $d_ext_field_2 = null;
    var $d_ext_field_3 = null;
    
    
    function load(){
        $session =& JFactory::getSession();
        $objuser = $session->get('user_shop_guest');
        if (isset($objuser) && $objuser!=''){
            $tmp = unserialize($objuser);
            foreach($tmp as $k=>$v){
                $this->$k = $v;
            }
        }
        $this->user_id = -1;
    return true;
    }
        
    function bind( $from, $ignore=array() ){
        $fromArray    = is_array( $from );
        $fromObject    = is_object( $from );

        if (!$fromArray && !$fromObject){
            return false;
        }
        
        foreach ($this->getProperties() as $k => $v){
            if (!in_array( $k, $ignore )){
                if ($fromArray && isset( $from[$k] )) {
                    $this->$k = $from[$k];
                } else if ($fromObject && isset( $from->$k )) {
                    $this->$k = $from->$k;
                }
            }
        }
        return true;
    }
    
    function store(){
        $this->user_id = -1;
        $session =& JFactory::getSession();
        $session->set('user_shop_guest', serialize($this));
    return true;
    }
    
    function check($type) {
        jimport('joomla.mail.helper');
        $db = &JFactory::getDBO();
        
        $jshopConfig = &JSFactory::getConfig();
        $tmp_fields = $jshopConfig->getListFieldsRegister();
        $config_fields = $tmp_fields[$type];
        
        if ($config_fields['title']['require']){
            if (!intval($this->title)) {
                $this->_error = addslashes(_JSHOP_REGWARN_TITLE);
                return false;
            }
        }
                        
        if ($config_fields['f_name']['require']){
            if(trim($this->f_name) == '') {
                $this->_error = addslashes(_JSHOP_REGWARN_NAME);
                return false;
            }
        }

        if ($config_fields['l_name']['require']){
            if(trim($this->l_name) == '') {
                $this->_error = addslashes(_JSHOP_REGWARN_LNAME);
                return false;
            }
        }
        
        if ($config_fields['firma_name']['require']){
            if(trim($this->firma_name) == '') {
                $this->_error = addslashes(_JSHOP_REGWARN_FIRMA_NAME);
                return false;
            }
        }
        
        if ($config_fields['client_type']['require']){
            if(trim($this->client_type) == 0) {
                $this->_error = addslashes(_JSHOP_REGWARN_CLIENT_TYPE);
                return false;
            }
        }
        
        if ($this->client_type==2){
            if ($config_fields['firma_code']['require']){
                if(trim($this->firma_code) == '') {
                    $this->_error = addslashes(_JSHOP_REGWARN_FIRMA_CODE);
                    return false;
                }
            }
            
            if ($config_fields['tax_number']['require']){
                if(trim($this->tax_number) == '') {
                    $this->_error = addslashes(_JSHOP_REGWARN_TAX_NUMBER);
                    return false;
                }
            }        
        }

        if( (trim($this->email == "")) || ! JMailHelper::isEmailAddress($this->email)) {
            $this->_error = addslashes(_JSHOP_REGWARN_MAIL);
            return false;
        }
        
        // check for existing email
        $query = "SELECT id FROM #__users WHERE email = '" . $db->getEscaped($this->email) . "' AND id != " . (int)$this->user_id;
        $db->setQuery($query);
        $xid = intval($db->loadResult());
        if($xid && $xid != intval($this->id)) {
            $this->_error = addslashes(_JSHOP_REGWARN_EMAIL_INUSE);
            return false;
        }
        
        if ($config_fields['street']['require']){
            if(trim($this->street) == '') {
                $this->_error = addslashes(_JSHOP_REGWARN_STREET);
                return false;
            }
        }
        
        if ($config_fields['zip']['require']){
            if (trim($this->zip) == ""){
                $this->_error = addslashes( _JSHOP_REGWARN_ZIP );
                return false;
            }
        }
        
        if ($config_fields['city']['require']){
            if (trim($this->city) == ''){
                $this->_error = addslashes( _JSHOP_REGWARN_CITY );
                return false;
            }
        }        
        
        if ($config_fields['state']['require']){
            if (trim($this->state) == ''){
                $this->_error = addslashes( _JSHOP_REGWARN_STATE ); //region
                return false;
            }
        }
        
        if ($config_fields['country']['require']){
            if(!intval($this->country)) {
                $this->_error = addslashes(_JSHOP_REGWARN_COUNTRY);
                return false;
            }
        }        
            
        if ($config_fields['phone']['require']){    
            if(trim($this->phone) == '') {
                $this->_error = addslashes(_JSHOP_REGWARN_PHONE);
                return false;
            }
        }
        
        if ($config_fields['mobil_phone']['require']){    
            if(trim($this->mobil_phone) == '') {
                $this->_error = addslashes(_JSHOP_REGWARN_MOBIL_PHONE);
                return false;
            }
        }
        
        if ($config_fields['fax']['require']){    
            if(trim($this->fax) == '') {
                $this->_error = addslashes(_JSHOP_REGWARN_FAX);
                return false;
            }
        }
        
        if ($config_fields['ext_field_1']['require']){
            if(trim($this->ext_field_1) == '') {
                $this->_error = addslashes(_JSHOP_REGWARN_EXT_FIELD_1);
                return false;
            }
        }
        
        if ($config_fields['ext_field_2']['require']){
            if(trim($this->ext_field_2) == '') {
                $this->_error = addslashes(_JSHOP_REGWARN_EXT_FIELD_2);
                return false;
            }
        }
        
        if ($config_fields['ext_field_3']['require']){
            if(trim($this->ext_field_3) == '') {
                $this->_error = addslashes(_JSHOP_REGWARN_EXT_FIELD_3);
                return false;
            }
        }
        
        if ($type == "address" || $type == "editaccount") {
            if ($this->delivery_adress) {
                            
                if ($config_fields['d_title']['require']){
                    if(!intval($this->d_title)) {
                        $this->_error = addslashes(_JSHOP_REGWARN_TITLE_DELIVERY);
                        return false;
                    }
                }
                
                if ($config_fields['d_f_name']['require']){
                    if(trim($this->d_f_name) == '') {
                        $this->_error = addslashes(_JSHOP_REGWARN_NAME_DELIVERY);
                        return false;
                    }
                }

                if ($config_fields['d_l_name']['require']){
                    if(trim($this->d_l_name) == '') {
                        $this->_error = addslashes(_JSHOP_REGWARN_LNAME_DELIVERY);
                        return false;
                    }
                }
                
                if ($config_fields['d_firma_name']['require']){
                    if(trim($this->d_firma_name) == '') {
                        $this->_error = addslashes(_JSHOP_REGWARN_FIRMA_NAME_DELIVERY);
                        return false;
                    }
                }
                
                if ($config_fields['d_firma_code']['require']){
                    if(trim($this->d_firma_code) == '') {
                        $this->_error = addslashes(_JSHOP_REGWARN_FIRMA_CODE_DELIVERY);
                        return false;
                    }
                }
                
                if ($config_fields['d_tax_number']['require']){
                    if(trim($this->d_tax_number) == '') {
                        $this->_error = addslashes(_JSHOP_REGWARN_TAX_NUMBER_DELIVERY);
                        return false;
                    }
                }                

                if ($config_fields['d_email']['require']){
                    if ( (trim($this->d_email) == "") || ! JMailHelper::isEmailAddress($this->d_email)) {
                        $this->_error = addslashes(_JSHOP_REGWARN_MAIL_DELIVERY);
                        return false;
                    }
                }

                if ($config_fields['d_street']['require']){
                    if(trim($this->d_street) == '') {
                        $this->_error = addslashes(_JSHOP_REGWARN_STREET_DELIVERY);
                        return false;
                    }
                }
                
                if ($config_fields['d_zip']['require']){
                    if (trim($this->d_zip) == ""){
                        $this->_error = addslashes( _JSHOP_REGWARN_ZIP_DELIVERY );
                        return false;
                    }
                }
                
                if ($config_fields['d_city']['require']){
                    if (trim($this->d_city) == ''){
                        $this->_error = addslashes( _JSHOP_REGWARN_CITY_DELIVERY );
                        return false;
                    }
                }

                if ($config_fields['d_state']['require']){
                    if (trim($this->d_state) == ''){
                        $this->_error = addslashes( _JSHOP_REGWARN_STATE_DELIVERY );
                        return false;
                    }
                }
                
                if ($config_fields['d_country']['require']){
                    if(!intval($this->d_country)) {
                        $this->_error = addslashes(_JSHOP_REGWARN_COUNTRY_DELIVERY);
                        return false;
                    }
                }                                
                
                if ($config_fields['d_phone']['require']){
                    if(trim($this->d_phone) == '') {
                        $this->_error = addslashes(_JSHOP_REGWARN_PHONE_DELIVERY);
                        return false;
                    }
                }
                
                if ($config_fields['d_mobil_phone']['require']){    
                    if(trim($this->d_mobil_phone) == '') {
                        $this->_error = addslashes(_JSHOP_REGWARN_MOBIL_PHONE_DELIVERY);
                        return false;
                    }
                }
                
                if ($config_fields['d_fax']['require']){    
                    if (trim($this->d_fax) == '') {
                        $this->_error = addslashes(_JSHOP_REGWARN_FAX_DELIVERY);
                        return false;
                    }
                }
                
                if ($config_fields['d_ext_field_1']['require']){
                    if(trim($this->d_ext_field_1) == '') {
                        $this->_error = addslashes(_JSHOP_REGWARN_EXT_FIELD_1_DELIVERY);
                        return false;
                    }
                }
                
                if ($config_fields['d_ext_field_2']['require']){
                    if(trim($this->d_ext_field_2) == '') {
                        $this->_error = addslashes(_JSHOP_REGWARN_EXT_FIELD_2_DELIVERY);
                        return false;
                    }
                }
                
                if ($config_fields['d_ext_field_3']['require']){
                    if(trim($this->d_ext_field_3) == '') {
                        $this->_error = addslashes(_JSHOP_REGWARN_EXT_FIELD_3_DELIVERY);
                        return false;
                    }
                }
                                
            }
        }

        return true;
    }
    
    function saveTypePayment($id){
        $this->payment_id = $id;
        $this->store();
        return 1;
    }
    
    function saveTypeShipping($id){
        $this->shipping_id = $id;
        $this->store();
        return 1;
    }
    
    function getError(){
        return $this->_error;
    }
    
}

?>