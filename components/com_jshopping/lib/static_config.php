<?php

$c_user_field_client_type = array(0=>_JSHOP_REG_SELECT, 1=>_JSHOP_PRIVAT_CLIENT, 2=>_JSHOP_FIRMA_CLIENT);
$c_array_title = array(0=>_JSHOP_REG_SELECT, 1=>_JSHOP_MR, 2=>_JSHOP_MS);
$c_sorting_products_field_select = array(1 => 'name',           2=>'prod.product_price',        3=>'prod.product_date_added', 5=>'prod.average_rating', 6=>'prod.hits',         4=>'categ.product_ordering');
$c_sorting_products_name_select =  array(1=>_JSHOP_SORT_ALPH,   2=>_JSHOP_SORT_PRICE,           3=>_JSHOP_SORT_DATE,          5=>_JSHOP_SORT_RATING,    6=>_JSHOP_SORT_POPULAR, 4=>_JSHOP_SORT_MANUAL);
$c_sorting_products_field_s_select = array(1 => 'name',         2=>'prod.product_price',        3=>'prod.product_date_added', 5=>'prod.average_rating', 6=>'prod.hits');
$c_sorting_products_name_s_select =  array(1=>_JSHOP_SORT_ALPH, 2=>_JSHOP_SORT_PRICE,           3=>_JSHOP_SORT_DATE,          5=>_JSHOP_SORT_RATING,    6=>_JSHOP_SORT_POPULAR);
$c_format_currency = array('1' => '00Symb', '00 Symb', 'Symb00', 'Symb 00');
$c_count_product_select = array('5'=>5, '10' => 10, '15' => 15, '20' => 20, '25' => 25, '50' => 50);                                    
$c_payment_status_enable_download_sale_file = array(5, 6, 7);
$c_payment_status_return_product_in_stock = array(3, 4);
$c_max_number_download_sale_file = 3;
$c_payment_status_for_cancel_client = 3;
$c_payment_status_disable_cancel_client = array(7);

$fields_client_sys = array();
$fields_client_sys['register'][] = "f_name";
$fields_client_sys['register'][] = "email";
$fields_client_sys['register'][] = "u_name";
$fields_client_sys['register'][] = "password";
$fields_client_sys['register'][] = "password_2";

$fields_client = array();        
$fields_client['register'][] = "title";
$fields_client['register'][] = "f_name";
$fields_client['register'][] = "l_name";
$fields_client['register'][] = "client_type";
$fields_client['register'][] = "firma_name";
$fields_client['register'][] = "firma_code";
$fields_client['register'][] = "tax_number";
$fields_client['register'][] = "email";
$fields_client['register'][] = "email2";
$fields_client['register'][] = "street";
$fields_client['register'][] = "zip";
$fields_client['register'][] = "city";
$fields_client['register'][] = "state";
$fields_client['register'][] = "country";
$fields_client['register'][] = "phone";
$fields_client['register'][] = "mobil_phone";
$fields_client['register'][] = "fax";
$fields_client['register'][] = "ext_field_1";
$fields_client['register'][] = "ext_field_2";
$fields_client['register'][] = "ext_field_3";
$fields_client['register'][] = "u_name";
$fields_client['register'][] = "password";
$fields_client['register'][] = "password_2";


$fields_client_sys['address'][] = "f_name";
$fields_client_sys['address'][] = "email";
       
$fields_client['address'][] = "title";
$fields_client['address'][] = "f_name";
$fields_client['address'][] = "l_name";
$fields_client['address'][] = "client_type";
$fields_client['address'][] = "firma_name";
$fields_client['address'][] = "firma_code";
$fields_client['address'][] = "tax_number";
$fields_client['address'][] = "email";
$fields_client['address'][] = "street";
$fields_client['address'][] = "zip";
$fields_client['address'][] = "city";
$fields_client['address'][] = "state";
$fields_client['address'][] = "country";
$fields_client['address'][] = "phone";
$fields_client['address'][] = "mobil_phone";
$fields_client['address'][] = "fax";
$fields_client['address'][] = "ext_field_1";
$fields_client['address'][] = "ext_field_2";
$fields_client['address'][] = "ext_field_3";

$fields_client['address'][] = "d_title";
$fields_client['address'][] = "d_f_name";
$fields_client['address'][] = "d_l_name";
$fields_client['address'][] = "d_firma_name";
$fields_client['address'][] = "d_email";
$fields_client['address'][] = "d_street";
$fields_client['address'][] = "d_zip";
$fields_client['address'][] = "d_city";
$fields_client['address'][] = "d_state";
$fields_client['address'][] = "d_country";
$fields_client['address'][] = "d_phone";
$fields_client['address'][] = "d_mobil_phone";
$fields_client['address'][] = "d_fax";
$fields_client['address'][] = "d_ext_field_1";
$fields_client['address'][] = "d_ext_field_2";
$fields_client['address'][] = "d_ext_field_3";

$fields_client_sys['editaccount'][] = "f_name";
$fields_client_sys['editaccount'][] = "email";
       
$fields_client['editaccount'][] = "title";
$fields_client['editaccount'][] = "f_name";
$fields_client['editaccount'][] = "l_name";
$fields_client['editaccount'][] = "client_type";
$fields_client['editaccount'][] = "firma_name";
$fields_client['editaccount'][] = "firma_code";
$fields_client['editaccount'][] = "tax_number";
$fields_client['editaccount'][] = "email";
$fields_client['editaccount'][] = "street";
$fields_client['editaccount'][] = "zip";
$fields_client['editaccount'][] = "city";
$fields_client['editaccount'][] = "state";
$fields_client['editaccount'][] = "country";
$fields_client['editaccount'][] = "phone";
$fields_client['editaccount'][] = "mobil_phone";
$fields_client['editaccount'][] = "fax";
$fields_client['editaccount'][] = "ext_field_1";
$fields_client['editaccount'][] = "ext_field_2";
$fields_client['editaccount'][] = "ext_field_3";

$fields_client['editaccount'][] = "d_title";
$fields_client['editaccount'][] = "d_f_name";
$fields_client['editaccount'][] = "d_l_name";
$fields_client['editaccount'][] = "d_firma_name";
$fields_client['editaccount'][] = "d_email";
$fields_client['editaccount'][] = "d_street";
$fields_client['editaccount'][] = "d_zip";
$fields_client['editaccount'][] = "d_city";
$fields_client['editaccount'][] = "d_state";
$fields_client['editaccount'][] = "d_country";
$fields_client['editaccount'][] = "d_phone";
$fields_client['editaccount'][] = "d_mobil_phone";
$fields_client['editaccount'][] = "d_fax";
$fields_client['editaccount'][] = "d_ext_field_1";
$fields_client['editaccount'][] = "d_ext_field_2";
$fields_client['editaccount'][] = "d_ext_field_3";


?>