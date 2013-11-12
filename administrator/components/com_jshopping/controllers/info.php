<?php
/**
* @version      2.0.0 31.07.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerInfo extends JController{

    function display(){
        
        addSubmenu("info");
        
        $jshopConfig = &JSFactory::getConfig();        
        $data = JApplicationHelper::parseXMLInstallFile($jshopConfig->admin_path."jshopping.xml");
        $view=&$this->getView("info", 'html'); 
        $view->assign("data",$data);
        $view->display();
    }

}
?>