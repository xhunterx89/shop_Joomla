<?php
/**
* @version      2.0.0 31.07.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

class jshopImage extends JTable {
    var $image_id = null;
    var $product_id = null;
    var $image_thumb = null;
    var $image_name = null;
    var $image_full = null;
    
    function __construct( &$_db ){
        parent::__construct( '#__jshopping_products_images', 'image_id', $_db );
    }
}
?>