<?php
/**
* @version      2.9.0 20.02.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

class jshopProductAttribut extends JTableAvto {
    
    function __construct( &$_db ){
        parent::__construct('#__jshopping_products_attr', 'product_attr_id', $_db);
    }
    
    function check(){
        return 1;
    }
    
    function deleteAttributeForProduct(){
        $db = &JFactory::getDBO();
        $query = "DELETE FROM `#__jshopping_products_attr` WHERE `product_id` = '".$db->getEscaped($this->product_id)."'";
        $db->setQuery($query);
        $db->query();    
    }
}
?>