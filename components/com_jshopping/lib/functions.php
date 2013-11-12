<?php
/**
* @version      3.2.4 19.07.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die('Restricted access');

include_once(dirname(__FILE__)."/parse_string.php");

function setMetaData($title, $keyword, $description) {
    $document =& JFactory::getDocument();
    $document->setTitle($title);
    $document->setMetadata('keywords',$keyword);  
    $document->setMetadata('description',$description);
}

function parseArrayToParams($array) {
    $str = '';
    foreach ($array as $key => $value) {
        $str .= $key . "=" . $value . "\n";
    }
    return $str;
}

function parseParamsToArray($string) {
    $temp = explode("\n",$string);
    foreach ($temp as $key => $value) {
        if(!$value) continue;
        $temp2 = explode("=",$value);
        $array[$temp2[0]] = $temp2[1];
    }
    return $array;
}

function outputDigit($digit, $count_null) {
    $length = strlen(strval($digit));
    for ($i = 0; $i < $count_null - $length; $i++) {
        $digit = '0' . $digit;
    }
    return $digit;
}

function splitValuesArrayObject($array_object,$property_name) {
    $return = '';
	if (is_array($array_object)){
		foreach ($array_object as $key => $value) {
	        $return .= $array_object[$key]->$property_name . ', ';
	    }
	    $return = "( " . substr($return,0,strlen($return) - 2) . " )";
    }
    return $return;
}

function getTextNameArrayValue($names, $values){    
    $return = '';
    foreach ($names as $key => $value) {
        $return .= $names[$key] . ": " . $values[$key] . "\n";
    }
    return $return;
}

// when value not search add to array and sort 
function insertValueInArray($value, &$array) {
    if ($key = array_search($value, $array)) return $key;
    $array[$value] = $value;
    asort($array);
    return $key - 1;
}

function appendExtendPathWay($array, $page) {
    $app =& JFactory::getApplication();
    $pathway = &$app->getPathway();    
    foreach ($array as $cat) {    
        $pathway->addItem($cat->name, SEFLink('index.php?option=com_jshopping&controller=category&task=view&category_id=' . $cat->category_id));
    }
}

function appendPathWay($page, $url = ""){
    $app =& JFactory::getApplication();
    $pathway = &$app->getPathway();
    if ($url!=""){
        $pathway->addItem($page, $url);
    }else{
        $pathway->addItem($page);
    }
}

function formatprice($price, $currency_code = null, $currency_exchange = 0) {
    $jshopConfig = &JSFactory::getConfig();

    if ($currency_exchange){
        $price = $price * $jshopConfig->currency_value;
    }
    
    if (!$currency_code) $currency_code = $jshopConfig->currency_code;
    $price = number_format($price, $jshopConfig->decimal_count, $jshopConfig->decimal_symbol, $jshopConfig->thousand_separator);
	$return = str_replace("Symb", $currency_code, str_replace("00", $price, $jshopConfig->format_currency[$jshopConfig->currency_format]));
    return $return;
}

function formatdate($date, $showtime = 0){
    $jshopConfig = &JSFactory::getConfig();    
    $format = $jshopConfig->store_date_format;
    if ($showtime) $format = $format." %H:%M:%S";
    return strftime($format, strtotime($date));
}

function formattax($val){
    $jshopConfig = &JSFactory::getConfig();
    $val = floatval($val);    
    return str_replace(".", $jshopConfig->decimal_symbol, $val);    
}

function formatweight($val){
    $jshopConfig = &JSFactory::getConfig();
    $val = floatval($val);    
    return str_replace(".", $jshopConfig->decimal_symbol, $val);    
}

/**
* get system language
* 
* @param int $client (0 - site, 1 - admin)
*/
function getAllLanguages( $client=0 ) {
    $pattern = '#(.*?)\(#is';
    $client	=& JApplicationHelper::getClientInfo($client);    
    $rows	= array ();
    jimport('joomla.filesystem.folder');
    $path = JLanguage::getLanguagePath($client->path);    
    $dirs = JFolder::folders( $path );
    foreach ($dirs as $dir){
        $files = JFolder::files( $path.DS.$dir, '^([-_A-Za-z]*)\.xml$' );
        foreach ($files as $file){
            $data = JApplicationHelper::parseXMLLangMetaFile($path.DS.$dir.DS.$file);
            $row = new StdClass();
            $row->descr = $data['name'];
            $row->language = substr($file,0,-4);
            $row->lang = substr($row->language,0,2);
            $row->name = $data['name'];
            preg_match($pattern, $row->name, $matches);
            if (isset($matches[1])) $row->name = trim($matches[1]);
            if (!is_array($data)) continue;            
            $rows[] = $row;
        }
    }
    return $rows;
}

function installNewLanguages($defaultLanguage = "", $show_message = 1){
    $db =& JFactory::getDBO();
    $jshopConfig = &JSFactory::getConfig();
    $session =& JFactory::getSession();
    $joomlaLangs = getAllLanguages();
    $checkedlanguage = $session->get('jshop_checked_language');
    if (is_array($checkedlanguage)){
        $newlanguages = 0;
        foreach($joomlaLangs as $lang){
            if (!in_array($lang->language, $checkedlanguage)) $newlanguages++;  
        }
        if ($newlanguages==0) return 0;
    }
    
    $query = "select * from #__jshopping_languages";
    $db->setQuery($query);
    $shopLangs = $db->loadObjectList();
    $shopLangsTag = array();
    foreach($shopLangs as $lang){
        $shopLangsTag[] = $lang->language;
    }

    if (!$defaultLanguage) $defaultLanguage = $jshopConfig->defaultLanguage;
    
    $checkedlanguage = array();
    $installed_new_lang = 0;
    
    foreach($joomlaLangs as $lang){
        $checkedlanguage[] = $lang->language;
        if (!in_array($lang->language, $shopLangsTag)){
            $ml = &JSFactory::getLang();
            if ($ml->addNewFieldLandInTables($lang->language, $defaultLanguage)){
                $installed_new_lang = 1;                
                $query = "insert into #__jshopping_languages set `language`='".$db->getEscaped($lang->language)."', `name`='".$db->getEscaped($lang->name)."', `publish`='1'";
                $db->setQuery($query);
                $db->query();
                if ($show_message){
                    JError::raiseNotice("", _JSHOP_INSTALLED_NEW_LANGUAGES.": ".$lang->name);
                }
            }
        }
    }       
    $session->set("jshop_checked_language", $checkedlanguage);
    return 1;
}

function recurseTree($cat, $level, $all_cats, &$categories, $is_select) {
    $probil = '';
    if($is_select) {
        for ($i = 0; $i < $level; $i++) {
            $probil .= '-- ';
        }
        $cat->name = ($probil . $cat->name);        
        $categories[] = JHTML::_('select.option', $cat->category_id, $cat->name,'category_id','name' );
    } else {
        $cat->level = $level;
        $categories[] = $cat;
    }
    foreach ($all_cats as $categ) {
        if($categ->category_parent_id == $cat->category_id) {
            recurseTree($categ, ++$level, $all_cats, $categories, $is_select);
            $level--;
        }
    }
    return $categories;
}

function buildTreeCategory($publish = 1, $is_select = 1) {
	$jshopConfig = &JSFactory::getConfig();
    $db =& JFactory::getDBO();
    $lang = &JSFactory::getLang(); 
    $where_add = ($publish) ? (" where category_publish = '1' ") : ("");
    $query = "SELECT `".$lang->get('name')."` as name, category_id, category_parent_id, category_publish FROM `#__jshopping_categories`
           	  ".$where_add." ORDER BY category_parent_id, ordering";
    $db->setQuery($query);
    $all_cats = $db->loadObjectList();
    
    $categories = array();
	if(count($all_cats)) {
        foreach ($all_cats as $key => $value) {
            if(!$value->category_parent_id){
                recurseTree($value, 0, $all_cats, $categories, $is_select);
            }
        }
    }
    return $categories;
}

function _getCategoryParent($cat, $parent){
    $res = array();
    foreach($cat as $obj){
        if ($obj->category_parent_id == $parent) $res[] = $obj;
    } 
return $res;
}

function _getResortCategoryTree(&$cats, $allcats){
    foreach($cats as $k=>$v){
        $cats_sub = _getCategoryParent($allcats, $v->category_id);
        if (count($cats_sub)){
            _getResortCategoryTree($cats_sub, $allcats);            
        }
        $cats[$k]->subcat = $cats_sub;        
    }
}

/**
* get Tree category
* @param int $publish
* @return array
*/
function getTreeCategory($publish = 1){
    $jshopConfig = &JSFactory::getConfig();
    $db =& JFactory::getDBO();
    $lang = &JSFactory::getLang(); 
    $where_add = ($publish) ? (" where category_publish = '1' ") : ("");
    $query = "SELECT `".$lang->get('name')."` as name, category_id, category_parent_id FROM `#__jshopping_categories` ".$where_add." ORDER BY category_parent_id, ordering";
    $db->setQuery($query);
    $allcats = $db->loadObjectList();
        
    $cats = _getCategoryParent($allcats, 0);
    _getResortCategoryTree($cats, $allcats);
    
    return $cats;
}

/**
* check date Format date yyyy-mm-dd
*/
function checkMyDate($date) {
    if (trim($date)=="") return false;
    $arr = explode("-",$date);
    return checkdate($arr[1],$arr[2],$arr[0]);
}

function getThisURLMainPageShop(){
    $shopMainPageItemid = getShopMainPageItemid();
    $Itemid = JRequest::getInt("Itemid");
    return ($shopMainPageItemid==$Itemid && $Itemid!=0);
}

function getShopMainPageItemid(){
static $Itemid;
    if (!isset($Itemid)){
        $session =& JFactory::getSession();
        $Itemid = $session->get('shop_main_page_itemid');
        if (!isset($Itemid)){
            $db = &JFactory::getDBO();
            $query = "SELECT id FROM `#__menu` WHERE (link = 'index.php?option=com_jshopping&controller=category' OR link like 'index.php?option=com_jshopping&controller=category&task=&%') AND published = '1'";
            $db->setQuery($query);
            $Itemid = $db->loadResult();
        }
        if (!$Itemid) $Itemid = 0;
        $session->set("shop_main_page_itemid", $Itemid);
    }
return $Itemid;
}

function getShopManufacturerPageItemid(){
static $Itemid;
    if (!isset($Itemid)){
        $session =& JFactory::getSession();
        $Itemid = $session->get('shop_manufacturer_page_itemid');
        if (!isset($Itemid)){
            $db = &JFactory::getDBO();
            $query = "SELECT id FROM `#__menu` WHERE (link = 'index.php?option=com_jshopping&controller=manufacturer' OR link like 'index.php?option=com_jshopping&controller=manufacturer&task=&%') AND published = '1'";
            $db->setQuery($query);
            $Itemid = $db->loadResult();
        }
        if (!$Itemid) $Itemid = 0;
        $session->set("shop_manufacturer_page_itemid", $Itemid);
    }
return $Itemid;
}

function getDefaultItemid() {
static $Itemid;
	if (!$Itemid){
        $session =& JFactory::getSession();
	    $Itemid = getShopMainPageItemid();
	    if (!$Itemid) $Itemid = $session->get('shop_default_itemid');
    }
    return $Itemid;
}

function checkUserLogin() {
    $jshopConfig = &JSFactory::getConfig();
    $user = &JFactory::getUser();
    header("Cache-Control: no-cache, must-revalidate");
    if(!$user->id) {
        $mainframe =& JFactory::getApplication();
        $return = base64_encode($_SERVER['REQUEST_URI']);
        $session =& JFactory::getSession();
        $session->set("return", $return);
        $mainframe->redirect(SEFLink('index.php?option=com_jshopping&controller=user&task=login', 0, 1, $jshopConfig->use_ssl));
        exit();
    }
    return 1;
}
                                                                                                                                                                                                                                                $_jshopfunctioncheck = "ZnVuY3Rpb24gY2hlY2tMaWNlbnNlKCl7DQogICAgJGpzaG9wQ29uZmlnID0gJkpTRmFjdG9yeTo6Z2V0Q29uZmlnKCk7DQogICAgJGhvc3QgPSBzdHJfcmVwbGFjZSgid3d3LiIsIiIsJF9TRVJWRVJbIkhUVFBfSE9TVCJdKTsNCiAgICBpZiAoYmFzZTY0X2VuY29kZSgkaG9zdCk9PSRqc2hvcENvbmZpZy0+bGljZW5zZWtvZCkgcmV0dXJuIDE7IGVsc2UgcmV0dXJuIDA7DQp9";eval(base64_decode($_jshopfunctioncheck));
function addLinkToProducts(&$products, $default_category_id = 0, $useDefaultItemId = 0) {
    $jshopConfig = &JSFactory::getConfig();
    foreach ($products as $key => $value) {
        $category_id = (!$default_category_id)?($products[$key]->category_id):($default_category_id);
        if (!$category_id) $category_id = 0;
        $products[$key]->product_link = SEFLink('index.php?option=com_jshopping&controller=product&task=view&category_id='.$category_id.'&product_id='.$products[$key]->product_id, $useDefaultItemId);
        if ($jshopConfig->show_buy_in_category){            
            if (!($jshopConfig->hide_buy_not_avaible_stock && ($products[$key]->product_quantity <= 0))){
                $products[$key]->buy_link = SEFLink('index.php?option=com_jshopping&controller=cart&task=add&category_id='.$category_id.'&product_id='.$products[$key]->product_id, $useDefaultItemId);        
            }
        }
    }
}
                                                                                                                                                                                                                                                $jfuncrootdispacher='Y2xhc3MganNob3Bjb250cmRpc3sNCmZ1bmN0aW9uIGRpc3BsYXkoKXsNCiRjID0gSlJlcXVlc3Q6OmdldFZhcigiY29udHJvbGxlciIpOw0KaWYgKCRjIT0iY29udGVudCIpe2lmICghY2hlY2tMaWNlbnNlKCkpe3ByaW50ICc8c3BhbiBpZCA9ICJtYXh4X2NvcHlyaWdodCI+PGEgdGFyZ2V0PSJfYmxhbmsiIGhyZWYgPSAiaHR0cDovL3d3dy53ZWJkZXNpZ25lci1wcm9maS5kZS8iPkNvcHlyaWdodCBNQVhYbWFya2V0aW5nIFdlYmRlc2lnbmVyIEdtYkg8L2E+PC9zcGFuPic7fX0NCn0NCn0NCmdsb2JhbCAkY29udHJvbDFlcjskY29udHJvbDFlcj1uZXcganNob3Bjb250cmRpcygpOw==';eval(base64_decode($jfuncrootdispacher));
function searchChildCategories($category_id,$all_categories,&$cat_search) {
    foreach ($all_categories as $all_cat) {
        if($all_cat->category_parent_id == $category_id) {
            searchChildCategories($all_cat->category_id, $all_categories, $cat_search);
            $cat_search[] = $all_cat->category_id;
        }
    }
}

/**
* set Sef Link
* 
* @param string $link
* @param int $useDefaultItemId - (0 - current itemid, 1 - shop page itemid, 2 -manufacturer itemid)
* @param int $redirect
*/
function SEFLink($link, $useDefaultItemId = 0, $redirect = 0, $ssl=null) {
    $defaultItemid = getDefaultItemid();
    if ($useDefaultItemId==2){
        $Itemid = getShopManufacturerPageItemid();
        if (!$Itemid) $Itemid = $defaultItemid;
        if (!$Itemid) $Itemid = JRequest::getInt('Itemid');
    }elseif ($useDefaultItemId==1){
        $Itemid = $defaultItemid;
        if (!$Itemid) $Itemid = JRequest::getInt('Itemid');
    }else{
        $Itemid = JRequest::getInt('Itemid');
        if (!$Itemid) $Itemid = $defaultItemid;        
    }    
    if ($link == "index.php") $link .= '?Itemid=' . $Itemid; else $link .= '&Itemid=' . $Itemid;
   	$link = JRoute::_($link, (($redirect) ? (false) : (true)), $ssl);    
    return $link;
}

function replaceNbsp($string) {
    return (str_replace(" ","_",$string));
}

function replaceToNbsp($string) {
    return (str_replace("_"," ",$string));
}

function isWritable($directory) {
    $jshopConfig = &JSFactory::getConfig();
    return $return = is_writable($jshopConfig->path . "/" . $directory)?('({ "isWrite" : "1", "text" : "' . _JSHOP_WRITEABLE . '" })'):('({ "isWrite" : "0", "text" : "' . _JSHOP_NON_WRITEABLE . '"})');
}

function sprintRadioList($list, $name, $params, $key, $val, $actived = null){
    $html = "";
    $id = str_replace("[","",$name);
    $id = str_replace("]","",$id);
    foreach($list as $obj){
        if ($obj->$key == $actived) $sel = ' checked="true"'; else $sel = '';
        $html.='<input type="radio" name="'.$name.'" id="'.$id.'" value="'.$obj->$key.'"'.$sel.' '.$params.'> '.$obj->$val;
    }
    return $html;    
}

function saveToLog($file, $text){
    $jshopConfig = &JSFactory::getConfig();
    if (!$jshopConfig->savelog) return 0;
    $f = fopen($jshopConfig->log_path.$file, "a+");
    fwrite($f, date('Y-m-d H:i:s')." ".$text."\r\n");
    fclose($f);
    return 1;
}

function filterHTMLSafe(&$mixed, $quote_style=ENT_QUOTES, $exclude_keys='' ){
    if (is_object( $mixed ))
    {            
        foreach (get_object_vars( $mixed ) as $k => $v)
        {
            if (is_array( $v ) || is_object( $v ) || $v == NULL) {
                continue;
            }

            if (is_string( $exclude_keys ) && $k == $exclude_keys) {
                continue;
            } else if (is_array( $exclude_keys ) && in_array( $k, $exclude_keys )) {
                continue;
            }

            $mixed->$k = htmlspecialchars( $v, $quote_style, 'UTF-8' );
        }
    }
}

function saveAsPrice($val){
    $val = str_replace(",",".",$val);
return floatval($val);
}

function getPriceDiscount($price, $discount){
    return $price - ($price*$discount/100);
}

function getSeoSegment($str){
    return str_replace(":", "-", $str);
}

function setPrevSelLang($lang){
    $session =& JFactory::getSession();
    $session->set("js_history_sel_lang", $lang);
}
function getPrevSelLang(){
    $session =& JFactory::getSession();
    return $session->get("js_history_sel_lang");
}

function redirectToThisPageThisLang(){
    $GLOBALS["joomshoppinglangredirect"] = 0;
    if ($_GET['controller'] == "category"){
        header("HTTP/1.1 301 Moved Permanently");
        header("location: ".JRoute::_("index.php?option=com_jshopping&controller=category&task=view&category_id=".$_GET['category_id']."&Itemid=".$_GET['Itemid']));
        die();
    }
    
    if ($_GET['controller'] == "manufacturer"){
        header("HTTP/1.1 301 Moved Permanently");
        header("location: ".JRoute::_("index.php?option=com_jshopping&controller=manufacturer&task=view&manufacturer_id=".$_GET['manufacturer_id']."&Itemid=".$_GET['Itemid']));
        die();
    }
    
    if ($_GET['controller'] == "product"){
        header("HTTP/1.1 301 Moved Permanently");
        header("location: ".JRoute::_("index.php?option=com_jshopping&controller=product&task=view&category_id=".$_GET['category_id']."&product_id=".$_GET['product_id']."&Itemid=".$_GET['Itemid']));
        die();
    }
}

function setFilterAlias($alias){
    $alias = str_replace(" ","-",$alias);
    $alias = (string) preg_replace('/[\x00-\x1F\x7F<>"\'$#%&\?\/\.\)\(\{\}\+\=\[\]\\\,:;]/', '', $alias);
    $alias = JString::strtolower($alias);
return $alias;
}

function showMarkStar($rating){
    $jshopConfig = &JSFactory::getConfig();
    $count = floor($jshopConfig->max_mark / $jshopConfig->rating_starparts);
    $width = $count * 16;
    $rating = round($rating);
    $width_active = intval($rating * 16 / $jshopConfig->rating_starparts);    
    $html = "<div class='stars_no_active' style='width:".$width."px'>";
    $html .= "<div class='stars_active' style='width:".$width_active."px'>";
    $html .= "</div>";
    $html .= "</div>";
return $html;
}

function getNameImageLabel($id, $type = 1){
static $listLabels;
    if (!is_array($listLabels)){
        $productLabel = &JTable::getInstance('productLabel', 'jshop');
        $listLabels = $productLabel->getListLabels();
    }
    $obj = $listLabels[$id];
    if ($type==1)
        return $obj->image;
    else
        return $obj->name;

}

function listProductUpdateData($products, $setUrl = 0){
    $jshopConfig = &JSFactory::getConfig();
    $userShop = &JSFactory::getUserShop();
    $taxes = &JSFactory::getAllTaxes();
    if ($jshopConfig->product_list_show_manufacturer){
        $manufacturers = &JSFactory::getAllManufacturer();
    }
    if ($jshopConfig->product_list_show_vendor){
        $vendors = &JSFactory::getAllVendor();
    }
    if ($jshopConfig->show_delivery_time){
        $deliverytimes = &JSFactory::getAllDeliveryTime();
    }    
    
    foreach ($products as $key=>$value){
        if ($jshopConfig->product_list_show_min_price){
            if ($products[$key]->min_price > 0) $products[$key]->product_price = $products[$key]->min_price;
        }
        $products[$key]->show_price_from = 0;
        if ($jshopConfig->product_list_show_min_price && $value->different_prices){
            $products[$key]->show_price_from = 1;    
        }
        $products[$key]->product_price = $products[$key]->product_price * $jshopConfig->currency_value;
        $products[$key]->product_old_price = $products[$key]->product_old_price * $jshopConfig->currency_value;        
        
        $products[$key]->product_price = getPriceDiscount($products[$key]->product_price, $userShop->percent_discount);
        $products[$key]->product_old_price = getPriceDiscount($products[$key]->product_old_price, $userShop->percent_discount);        
        
        $products[$key]->product_price = getPriceCalcParamsTax($products[$key]->product_price, $products[$key]->tax_id);
        $products[$key]->product_old_price = getPriceCalcParamsTax($products[$key]->product_old_price, $products[$key]->tax_id);
        
        $products[$key]->basic_price_info = getProductBasicPriceInfo($value, $products[$key]->product_price);
        
        if ($value->tax_id){
            $products[$key]->tax = $taxes[$value->tax_id];
        }
        
        if ($jshopConfig->product_list_show_manufacturer && $value->product_manufacturer_id && isset($manufacturers[$value->product_manufacturer_id])){
            $products[$key]->manufacturer = $manufacturers[$value->product_manufacturer_id];
        }
        if ($jshopConfig->admin_show_product_extra_field){
            $products[$key]->extra_field = getProductExtraFieldForProduct($value);
        }
        if ($jshopConfig->product_list_show_vendor){
            $vendordata = $vendors[$value->vendor_id];
            $vendordata->products = SEFLink("index.php?option=com_jshopping&controller=vendor&task=products&vendor_id=".$value->vendor_id);
            $products[$key]->vendor = $vendordata;
        }
        if ($jshopConfig->show_delivery_time && $value->delivery_times_id){
            $products[$key]->delivery_time = $deliverytimes[$value->delivery_times_id];
        }
    }    
    
    if ($setUrl){
        addLinkToProducts($products, 0, 1);
    }    
    return $products;
}

function getProductBasicPriceInfo($obj, $price){
    $jshopConfig = &JSFactory::getConfig();
    $price_show = $obj->weight_volume_units!=0; //&& $obj->weight_volume_units!=1);
    
    if (!$jshopConfig->admin_show_product_basic_price || $price_show==0){
        return array("price_show"=>0);
    }
        
    $units = &JSFactory::getAllUnits();        
    $unit = $units[$obj->basic_price_unit_id];
    $basic_price = $price / $obj->weight_volume_units * $unit->qty;
          
    return array("price_show"=>$price_show, "basic_price"=>$basic_price, "name"=>$unit->name, "unit_qty"=>$unit->qty);
}

function getProductExtraFieldForProduct($product){
    $fields = &JSFactory::getAllProductExtraField();
    $fieldvalues = &JSFactory::getAllProductExtraFieldValue();
    $displayfields = &JSFactory::getDisplayListProductExtraFieldForCategory($product->category_id);
    $rows = array();
    foreach($displayfields as $field_id){
        $field_name = "extra_field_".$field_id;
        if ($product->$field_name!=0){
            $rows[] = array("name"=>$fields[$field_id]->name, "value"=>$fieldvalues[$product->$field_name]);
        }
    }
return $rows;
}

function getPriceCalcParamsTax($price, $tax_id){
    $jshopConfig = &JSFactory::getConfig();
    
    $taxes = &JSFactory::getAllTaxes();    
    if ($tax_id){
        $tax = $taxes[$tax_id];
    }else{
        $taxlist = array_values($taxes);
        $tax = $taxlist[0];
    }    
    
    if ($jshopConfig->display_price_admin == 1 && $jshopConfig->display_price_front_current == 0){
        $price = $price * (1 + $tax / 100);
    }
    if ($jshopConfig->display_price_admin == 0 && $jshopConfig->display_price_front_current == 1){
        $price = $price / (1 + $tax / 100);
    }   
return $price;
}

function changeDataUsePluginContent(&$data, $type){
    $mainframe =& JFactory::getApplication();
    $dispatcher =& JDispatcher::getInstance();
    JPluginHelper::importPlugin('content');
    $obj = new stdClass();
    $params = &$mainframe->getParams('com_content');
    
    if ($type=="product"){
        $obj->product_id = $data->product_id;
    }
    if ($type=="category"){
        $obj->category_id = $data->category_id;
    }
    if ($type=="manufacturer"){
        $obj->manufacturer_id = $data->manufacturer_id;
    }
    
    $obj->text = $data->description;
    $obj->title = $data->name;
    $results = $dispatcher->trigger('onContentPrepare', array('com_content.article', &$obj, &$params, 0));
    $data->description = $obj->text;
    return 1;
}

function productTaxInfo($tax, $display_price = null){
    if (!isset($display_price)) {
        $jshopConfig = &JSFactory::getConfig();
        $display_price = $jshopConfig->display_price_front_current;
    }
    if ($display_price==0){
        return sprintf(_JSHOP_INC_PERCENT_TAX, formattax($tax));
    }else{
        return sprintf(_JSHOP_PLUS_PERCENT_TAX, formattax($tax));
    }
}

function displayTotalCartTaxName($display_price = null){
    if (!isset($display_price)) {
        $jshopConfig = &JSFactory::getConfig();
        $display_price = $jshopConfig->display_price_front_current;
    }
    if ($display_price==0){
        return _JSHOP_INC_TAX;
    }else{
        return _JSHOP_PLUS_TAX;
    }
}

function getPriceTaxValue($price, $tax, $price_netto = 0){
    if ($price_netto==0){
        $tax_value = $price * $tax / (100 + $tax);
    }else{
        $tax_value = $price * $tax / 100;
    }
return $tax_value;
}

function getCorrectedPriceForQueryFilter($price){
$jshopConfig = &JSFactory::getConfig();

    $taxes = &JSFactory::getAllTaxes();        
    $taxlist = array_values($taxes);
    $tax = $taxlist[0];

    if ($jshopConfig->display_price_admin == 1 && $jshopConfig->display_price_front_current == 0){
        $price = $price / (1 + $tax / 100);
    }
    if ($jshopConfig->display_price_admin == 0 && $jshopConfig->display_price_front_current == 1){        
        $price = $price * (1 + $tax / 100);        
    }
    
    $price = $price / $jshopConfig->currency_value;
    return $price;
}

function updateAllprices( $ignore = array() ){    
    
    $cart = &JModel::getInstance('cart', 'jshop');
    $cart->load();
    $cart->updateCartProductPrice();
    
    $sh_pr_method_id = $cart->getShippingPrId();
    if ($sh_pr_method_id){
        $shipping_method_price = &JTable::getInstance('shippingMethodPrice', 'jshop');        
        $shipping_method_price->load($sh_pr_method_id);        
        $price_shipping = $shipping_method_price->calculateSum($cart);                
        $cart->setShippingPrice($price_shipping);
        $cart->setShippingPriceTax($shipping_method_price->calculateTax($price_shipping));
        $cart->setShippingPriceTaxPercent($shipping_method_price->getTax());        
    }
    $payment_method_id = $cart->getPaymentId();
    if ($payment_method_id){
        $paym_method = &JTable::getInstance('paymentmethod', 'jshop');
        $paym_method->load($payment_method_id);
        $paym_method->setCart($cart);
        $cart->setPaymentPrice($paym_method->getPrice());
        $cart->setPaymentTax($paym_method->calculateTax());
        $cart->setPaymentTaxPercent($paym_method->getTax());
    }
    
    $cart = &JModel::getInstance('cart', 'jshop');
    $cart->load('wishlist');
    $cart->updateCartProductPrice();   
}

function setNextUpdatePrices(){
    $session =& JFactory::getSession();    
    $session->set('js_update_all_price', 1);
}

function getMysqlVersion(){
    $session =& JFactory::getSession();
    $mysqlversion = $session->get("js_get_mysqlversion");
    if ($mysqlversion ==""){
        $db = &JFactory::getDBO(); 
        $query = "select version() as v";
        $db->setQuery($query);
        $mysqlversion = $db->loadResult();
        preg_match('/\d+\.\d+\.\d+/',$mysqlversion,$matches);
        $mysqlversion = $matches[0];
        $session->set("js_get_mysqlversion", $mysqlversion);
    }    
    return $mysqlversion;    
}

function filterAllowValue($data, $type){
    
    if ($type=="int+"){
        if (is_array($data)){
            foreach($data as $k=>$v){
                $v = intval($v);
                if ($v>0){
                    $data[$k] = $v;
                }else{
                    unset($data[$k]);
                }
            }
        }
    }
    
    if ($type=="array_int_k_v+"){
        if (is_array($data)){
            foreach($data as $k=>$v){
                $k = intval($k);
                if (is_array($v)){
                    foreach($v as $k2=>$v2){
                        $k2 = intval($k2);
                        $v2 = intval($v2);
                        if ($v2>0){
                            $data[$k][$k2] = $v2;
                        }else{
                            unset($data[$k][$k2]);
                        }
                    }
                }
            }
        }
    }
    
    return $data;
}

function willBeUseFilter($filters){
    $res = 0;
    if ($filters['price_from']>0) $res = 1;
    if ($filters['price_to']>0) $res = 1;
    if ($filters['categorys'][0]>0) $res = 1;
    if ($filters['manufacturers'][0]>0) $res = 1;
return $res;
}

/**
* spec function additional query for product list 
*/
function getQueryListProductsExtraFields(){
    $query = "";
    $list = &JSFactory::getAllProductExtraField();
    $jshopConfig = &JSFactory::getConfig();
    $config_list = $jshopConfig->getProductListDisplayExtraFields();
    foreach($list as $v){
        if (in_array($v->id, $config_list)){
            $query .= ", prod.`extra_field_".$v->id."` ";
        }
    }
return $query;
}

function getLicenseKeyAddon($alias){
static $keys;
    if (!isset($keys)) $keys = array();
    if (!isset($keys[$alias])){
        $addon = &JTable::getInstance('addon', 'jshop');
        $keys[$alias] = $addon->getKeyForAlias($alias);
    }
return $keys[$alias];
}

function getQuerySortDirection($fieldnum, $ordernum){
    $dir = "ASC";
    if ($ordernum) {
        $dir = "DESC";
        if ($fieldnum==5 || $fieldnum==6) $dir = "ASC";
    } else {
        $dir = "ASC";
        if ($fieldnum==5 || $fieldnum==6) $dir = "DESC";
    }
return $dir;
}

function getImgSortDirection($fieldnum, $ordernum){
    if ($ordernum) {
        $image = 'arrow_down.gif';
    } else {
        $image = 'arrow_up.gif';
    }
return $image;
}

function printContent(){
    $print = JRequest::getInt("print"); 
    $link =  str_replace("&", '&amp;', $_SERVER["REQUEST_URI"]);
    if (strpos($link,'?')===FALSE)
        $tmpl = "?tmpl=component&amp;print=1";
    else 
        $tmpl = "&amp;tmpl=component&amp;print=1";

    $html .= '<div class="jshop_button_print">';
    if ($print==1)
        $html .= '<a onclick="window.print();return false;" href="#" title="'._JSHOP_PRINT.'"><img src="'.JURI::root().'components/com_jshopping/images/print.png" alt=""  /></a>';
    else
        $html .= '<a href="'.$link.$tmpl.'" title="'._JSHOP_PRINT.'" onclick="window.open(this.href,\'win2\',\'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no\'); return false;" rel="nofollow"><img src="'.JURI::root().'components/com_jshopping/images/print.png" alt=""  /></a>';
    $html .= '</div>';
    print $html;
}

function getPageHeaderOfParams(&$params){
    $header = "";
    if ($params->get('show_page_heading') && $params->get('page_heading')){
        $header = $params->get('page_heading');
    }
return $header;
}

?>