<?php
/**
* @version      2.5.3 20.11.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerLanguages extends JController{
    
    function __construct( $config = array() ){
        parent::__construct( $config );
        checkAccessController("languages");
        addSubmenu("other");
    }

    function display(){  	        		
        
        $languages = &$this->getModel("languages");
        $rows = $languages->getAllLanguages(0);
        $jshopConfig = &JSFactory::getConfig();        
                
		$view=&$this->getView("languages_list", 'html');		
        $view->assign('rows', $rows);
        $view->assign('default_front', $jshopConfig->frontend_lang);
        $view->assign('defaultLanguage', $jshopConfig->defaultLanguage);
		$view->display(); 
        
    }
    
    function publish(){
        $this->publishLanguage(1);
    }
    
    function unpublish(){
        $this->publishLanguage(0);
    }

    function publishLanguage($flag) {
        $db = &JFactory::getDBO();
        $cid = JRequest::getVar("cid");
        foreach ($cid as $key => $value) {
            $query = "UPDATE `#__jshopping_languages` SET `publish` = '" . $db->getEscaped($flag) . "' WHERE `id` = '" . $db->getEscaped($value) . "'";
            $db->setQuery($query);
            $db->query();
        }
        $this->setRedirect("index.php?option=com_jshopping&controller=languages");
    }
        
}
?>