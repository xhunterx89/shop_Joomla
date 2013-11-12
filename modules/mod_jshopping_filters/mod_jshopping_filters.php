<?php
/**
* @version      2.7.0 12.01.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

    defined('_JEXEC') or die('Restricted access');
    error_reporting(E_ALL & ~E_NOTICE);
    
    if (!file_exists(JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS.'jshopping.php')){
        JError::raiseError(500,"Please install component \"joomshopping\"");
    } 
    
    $display_fileters = 0;
    if (JRequest::getVar("controller")=="category" && JRequest::getInt("category_id")) $display_fileters = 1;
    if (JRequest::getVar("controller")=="manufacturer" && JRequest::getInt("manufacturer_id")) $display_fileters = 1;
    if (!$display_fileters) return "";
    
    require_once (JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS."lib".DS."factory.php"); 
    require_once (JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS."lib".DS."functions.php");        
    JSFactory::loadCssFiles();
    JSFactory::loadLanguageFile();
    $jshopConfig = &JSFactory::getConfig();
    $mainframe = &JFactory::getApplication(); 
    $show_manufacturers = $params->get('show_manufacturers');         
    $show_categorys = $params->get('show_categorys');         
    $show_prices = $params->get('show_prices');         
    $show_characteristics = $params->get('show_characteristics');
    
    $context = "jshoping.list.front.product";
        
    $category_id = JRequest::getInt('category_id');
    if ($category_id && $show_manufacturers){
        $category = &JTable::getInstance('category', 'jshop');
        $category->load($category_id);
        
        $manufacturers = $mainframe->getUserStateFromRequest( $context.'manufacturers_'.$category_id, 'manufacturers', array());
        $manufacturers = filterAllowValue($manufacturers, "int+");    
        
        $filter_manufactures = $category->getManufacturers();
    }
    
    $manufacturer_id = JRequest::getInt('manufacturer_id');
    if ($manufacturer_id && $show_categorys){
        $manufacturer = &JTable::getInstance('manufacturer', 'jshop');        
        $manufacturer->load($manufacturer_id);
        
        $categorys = $mainframe->getUserStateFromRequest( $context.'categorys_'.$manufacturer_id, 'categorys', array());
        $categorys = filterAllowValue($categorys, "int+");
        
        $filter_categorys = $manufacturer->getCategorys();
    }
    
    if ($show_prices){
        $price_from = $mainframe->getUserStateFromRequest( $context.'price_from_'.$category_id, 'price_from');
        $price_from = saveAsPrice($price_from);
        $price_to = $mainframe->getUserStateFromRequest( $context.'price_to_'.$category_id, 'price_to');
        $price_to = saveAsPrice($price_to);
    }
    
    if ($show_characteristics && $jshopConfig->admin_show_product_extra_field){
        $characteristic_fields = &JSFactory::getAllProductExtraField();
        $characteristic_fieldvalues = &JSFactory::getAllProductExtraFieldValueDetail();
        $characteristic_displayfields = &JSFactory::getDisplayFilterExtraFieldForCategory($category_id);
        if ($category_id){
            $context_ef = $context.'extra_fields_'.$category_id;    
        }else{
            $context_ef = $context.'extra_fields_mf'.$manufacturer_id;
        }
        
        $extra_fields_active = $mainframe->getUserStateFromRequest( $context_ef, 'extra_fields', array());
        $extra_fields_active = filterAllowValue($extra_fields_active, "array_int_k_v+");        
    }
        
    require(JModuleHelper::getLayoutPath('mod_jshopping_filters'));        
?>