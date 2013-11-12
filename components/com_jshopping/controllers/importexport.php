<?php
/**
* @version      2.7.0 16.12.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
include_once(JPATH_COMPONENT_ADMINISTRATOR."/importexport/iecontroller.php");

class JshoppingControllerImportExport extends JController{

    function start(){
        
        $jshopConfig = &JSFactory::getConfig();
        $key = JRequest::getVar("key");
        if ($key!=$jshopConfig->securitykey){            
            die();
        }
        
        $_GET['noredirect'] = 1; $_POST['noredirect'] = 1; $_REQUEST['noredirect'] = 1;
        
        $db = &JFactory::getDBO();
        $time = time();                
        $query = "SELECT * FROM `#__jshopping_import_export` where `steptime`>0 and (endstart + steptime < $time)  ORDER BY id";
        $db->setQuery($query);        
        $list = $db->loadObjectList();        
        
        foreach($list as $ie){
            $alias = $ie->alias;
            if (!file_exists(JPATH_COMPONENT_ADMINISTRATOR."/importexport/".$alias."/".$alias.".php")){
                print sprintf(_JSHOP_ERROR_FILE_NOT_EXIST, "/importexport/".$alias."/".$alias.".php");
                return 0;
            }
            include_once(JPATH_COMPONENT_ADMINISTRATOR."/importexport/".$alias."/".$alias.".php");
            $classname    = 'Ie'.$alias;
            $controller   = new $classname($ie->id);
            $controller->set('ie_id', $ie->id);
            $controller->set('alias', $alias);
            $controller->save();
            print $alias."\n";
        }
        
        die();
    }		      
}
?>