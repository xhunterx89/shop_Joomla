<?php
/**
* @version      2.8.0 20.02.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

class jshopProductVideo extends JTable {

    var $video_id = null;
    var $product_id = null;    
    var $video_name = null;
    var $video_preview = null;
    
    function __construct( &$_db ){
        parent::__construct('#__jshopping_products_videos', 'id', $_db);
    }
}
?>