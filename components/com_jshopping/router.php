<?php
/**
* @version      2.5.0 05.11.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die('Restricted access');
error_reporting(E_ALL & ~E_NOTICE);
include_once(JPATH_ROOT . "/components/com_jshopping/lib/factory.php");
include_once(JPATH_ROOT . "/components/com_jshopping/lib/functions.php");

function jshoppingBuildRoute(&$query){
    $segments = array();
    JSFactory::loadLanguageFile();
    $jshopConfig = &JSFactory::getConfig();
    
	if (isset($query['controller'])){
	    $controller = $query['controller'];
    }else{
        $controller = "";
    }
    
    if ($jshopConfig->use_simple_sef==0 && $controller=="category" && isset($query['task']) && $query['task']=="view" && $query['category_id']){
        $catalias = &JSFactory::getAliasCategory();
        if (isset($catalias[$query['category_id']])){
            $segments[] = $catalias[$query['category_id']];
            unset( $query['controller'] );
            unset( $query['task'] ); 
            unset( $query['category_id'] ); 
        }
    }
    
    if ($jshopConfig->use_simple_sef==0 && $controller=="manufacturer" && isset($query['task']) && $query['task']=="view" && $query['manufacturer_id']){
        $manalias = &JSFactory::getAliasManufacturer();
        if (isset($manalias[$query['manufacturer_id']])){
            $segments[] = $manalias[$query['manufacturer_id']];
            unset( $query['controller'] );
            unset( $query['task'] ); 
            unset( $query['manufacturer_id'] ); 
        }
    }
    
    if ($jshopConfig->use_simple_sef==0 && $controller=="product" && isset($query['task']) && $query['task']=="view" && $query['category_id'] && $query['product_id']){
        $catalias = &JSFactory::getAliasCategory();
        $prodalias = &JSFactory::getAliasProduct();
        if (isset($catalias[$query['category_id']]) && isset($prodalias[$query['product_id']])){
            $segments[] = $catalias[$query['category_id']];
            $segments[] = $prodalias[$query['product_id']];
            unset( $query['controller'] );
            unset( $query['task'] ); 
            unset( $query['category_id'] ); 
            unset( $query['product_id'] ); 
        }
    }    
        
    if(isset($query['controller'])) {                  
        $segments[] = $query['controller'];
        unset( $query['controller'] );        
    }
    
    if(isset($query['task'])) {
        $segments[] = $query['task'];
        unset( $query['task'] ); 
    }
	
	if ($controller=="category" || $controller=="product"){
		if(isset($query['category_id'])) {
	        $segments[] = $query['category_id'];
	        unset( $query['category_id'] ); 
	    } 
		
		if(isset($query['product_id'])) {
	        $segments[] = $query['product_id'];
	        unset( $query['product_id'] ); 
	    }   
    }
        
    if ($controller=="manufacturer"){
        if(isset($query['manufacturer_id'])) {
            $segments[] = $query['manufacturer_id'];
            unset( $query['manufacturer_id'] ); 
        } 
    }
    
    if ($controller=="content"){
        if(isset($query['page'])) {
            $segments[] = $query['page'];
            unset( $query['page'] ); 
        } 
    }    
    
    return $segments;
}

function jshoppingParseRoute($segments){
    $vars = array();
    
    JSFactory::loadLanguageFile();
    $jshopConfig = &JSFactory::getConfig();
    $db = &JFactory::getDBO();
    $lang = &JSFactory::getLang();
    $reservedFirstAlias = &JSFactory::getReservedFirstAlias();
    $prev_lang = getPrevSelLang();
    $current_lang = $jshopConfig->cur_lang;
    
    if ($segments[0] && !in_array($segments[0], $reservedFirstAlias)){
        
        $segments[0] = getSeoSegment($segments[0]);
        if (isset($segments[1])){
            $segments[1] = getSeoSegment($segments[1]);
        }else{
            $segments[1] = "";
        }
        
        $manufacturer_id = 0;
        $product_id = 0;
        
        $catalias = &JSFactory::getAliasCategory();
        $category_id = array_search($segments[0], $catalias);        
                    
        if (!$category_id && $prev_lang && $prev_lang!=$current_lang){
            $dbquery = "select category_id from #__jshopping_categories where `alias_".$prev_lang."` = '".$db->getEscaped($segments[0])."'";
            $db->setQuery($dbquery);
            $category_id = $db->loadResult();
            if ($category_id){
                $GLOBALS["joomshoppinglangredirect"] = 1;
            }
        }
        
        if ($category_id && $segments[1]!=""){
            $prodalias = &JSFactory::getAliasProduct();
            $product_id = array_search($segments[1], $prodalias);
            if (!$product_id && $prev_lang && $prev_lang!=$current_lang){
                $dbquery = "select product_id from #__jshopping_products where `alias_".$prev_lang."` = '".$db->getEscaped($segments[1])."'";
                $db->setQuery($dbquery);
                $product_id = $db->loadResult();
                if ($product_id){
                    $GLOBALS["joomshoppinglangredirect"] = 1;
                }
            }            
        }
        
        if (!$category_id && $segments[1]==""){
            $manalias = &JSFactory::getAliasManufacturer();
            $manufacturer_id = array_search($segments[0], $manalias);
            if (!$manufacturer_id && $prev_lang && $prev_lang!=$current_lang){
                $dbquery = "select manufacturer_id from #__jshopping_manufacturers where `alias_".$prev_lang."` = '".$db->getEscaped($segments[0])."'";
                $db->setQuery($dbquery);
                $manufacturer_id = $db->loadResult();
                if ($manufacturer_id){
                    $GLOBALS["joomshoppinglangredirect"] = 1;
                }                        
            }
        }
        
        if ($category_id && $product_id){
            $vars['controller'] = "product";
            $vars['task'] = "view";
            $vars['category_id'] = $category_id;
            $vars['product_id'] = $product_id;
        }elseif ($category_id){
            $vars['controller'] = "category";
            $vars['task'] = "view";
            $vars['category_id'] = $category_id;
        }
        
        if ($manufacturer_id){
            $vars['controller'] = "manufacturer";
            $vars['task'] = "view";
            $vars['manufacturer_id'] = $manufacturer_id;
        }
                
        if (!$category_id && !$manufacturer_id){
            $vars['controller'] = "category";
        } 
                
    }else{
       
        $vars['controller'] = $segments[0];
        $vars['task'] = $segments[1];
        
        if ($vars['controller']=="category" && $vars['task']=="view"){
    	    $vars['category_id'] = $segments[2];
        }    
        
        if ($vars['controller']=="product" && $vars['task']=="view"){
    	    $vars['category_id'] = $segments[2];
    	    $vars['product_id'] = $segments[3];    	
        }
        
        if ($vars['controller']=="product" && $vars['task']=="ajax_attrib_select_and_price"){        
            $vars['product_id'] = $segments[2];
        }
            
        if ($vars['controller']=="manufacturer"){
            $vars['manufacturer_id'] = $segments[2];
        }
        
        if ($vars['controller']=="content"){
            $vars['page'] = $segments[2];         
        }
    }
    
return $vars;
}

?>