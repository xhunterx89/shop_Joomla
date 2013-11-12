<?php
/**
* @version      2.7.0 20.12.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

class jshopReview extends JTable {
    var $review_id = null;
    var $product_id = null;
    var $user_id = null;
    var $user_name = null;
    var $user_email = null;
    var $time = null;
    var $review = null;
    var $mark = null;
    var $ip = null;

    function __construct( &$_db ){
        parent::__construct( '#__jshopping_products_reviews', 'review_id', $_db );
    }

    // Static method
    // $type = null - product
    // $type = other - manufacturer
    function getAllowReview($type = null) {
        $jshopConfig = &JSFactory::getConfig();
        $user = &JFactory::getUser();
        if($type) {
            if(!$jshopConfig->allow_reviews_manuf) {
                return 0;
            }
        } else {
            if(!$jshopConfig->allow_reviews_prod) {
                return 0;
            }
        }
        if($jshopConfig->allow_reviews_only_registered && !$user->id) {
            return -1;
        }
        return 1;
    }

    function getText() {
        $jshopConfig = &JSFactory::getConfig();
        // Not logged in
        if($this->getAllowReview() == -1) {
            return _JSHOP_REVIEW_NOT_LOGGED;
        } else {
            return '';
        }
    }

}

?>