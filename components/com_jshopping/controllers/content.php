<?php
/**
* @version      2.8.0 18.09.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerContent extends JController{

    function view(){
        $jshopConfig = &JSFactory::getConfig();
        $db = &JFactory::getDBO(); 
        
        $page = JRequest::getVar('page');  	        
        switch ($page) {
            case 'agb':
                $pathway = _JSHOP_AGB;
            break;
            case 'return_policy':
                $pathway = _JSHOP_RETURN_POLICY;
            break;
            case 'shipping':
                $pathway = _JSHOP_SHIPPING;
            break;
        }        
        appendPathWay($pathway);
        
        $seo = &JTable::getInstance("seo", "jshop");
        $seodata = $seo->loadData("content-".$page);
        if ($seodata->title==""){
            $seodata->title = $pathway;
        }
        setMetaData($seodata->title, $seodata->keyword, $seodata->description);
        
        $statictext = &JTable::getInstance("statictext","jshop");
        $row = $statictext->loadData($page);
        $text = $row->text;
        
        JPluginHelper::importPlugin('jshopping');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeDisplayContent', array($page, &$text) );
        
        echo $text;   
    }
                
}

?>