<?php
/**
* @version      2.6.0 24.11.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

class jshopTempCart {
    
    var $savedays = 30;
    
    function insertTempCart($cart) {
        
        if ($cart->type_cart!='wishlist') return 0; //not save if type == cart
        
        $patch = "/";
        if (JURI::base(true) != "") $patch = JURI::base(true);
        
        $db =& JFactory::getDBO();
        setcookie('jshopping_temp_cart', session_id() ,time() + 3600*24*$this->savedays, $patch);        
        $query = "DELETE FROM `#__jshopping_cart_temp` WHERE `id_cookie` = '".session_id()."' AND `type_cart`='".$cart->type_cart."'";
        $db->setQuery($query);
        $db->query();
        
        $query = "INSERT INTO `#__jshopping_cart_temp` SET 
                    `id_cookie` = '" . session_id() . "', 
                    `cart` = '".$db->getEscaped(serialize($cart->products))."',
                    `type_cart` = '".$cart->type_cart."' ";
        $db->setQuery($query);
        $db->query();
        return 1;
    }
        
    function getTempCart($id_cookie, $type_cart="cart") {
        
        $db =& JFactory::getDBO();
        $query = "SELECT `cart` FROM `#__jshopping_cart_temp`
                  WHERE `id_cookie` = '" . $db->getEscaped($id_cookie) . "' AND `type_cart`='".$type_cart."' LIMIT 0,1";
        $db->setQuery($query);
        $cart = $db->loadResult();
        if ($cart!="")        
            return (unserialize($cart));
        else
            return array();    
    }
}

?>