<?php
/**
* @version      2.4.3 03.11.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

class jshopCurrency extends JTable {
    
	var $currency_id = null;
	var $currency_name = null;
    var $currency_code = null;
	var $currency_code_iso = null;
	var $currency_ordering = null;
	var $currency_value = null;
	var $currency_publish = null;
    
    function __construct( &$_db ){
        parent::__construct( '#__jshopping_currencies', 'currency_id', $_db );
    }

	function getAllCurrencies($publish = 1) {
		$database =& JFactory::getDBO(); 
		$query_where = ($publish)?("WHERE currency_publish = '1'"):("");
		$query = "SELECT * FROM `#__jshopping_currencies` $query_where ORDER BY currency_ordering";
		$database->setQuery($query);
		return $database->loadObjectList();
	}
}

?>