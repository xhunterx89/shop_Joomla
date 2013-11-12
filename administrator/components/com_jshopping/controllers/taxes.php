<?php
/**
* @version      2.9.4 25.11.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerTaxes extends JController{
    
    function __construct( $config = array() ){
        parent::__construct( $config );

        $this->registerTask( 'add',   'edit' );
        $this->registerTask( 'apply', 'save' );
        
        addSubmenu("other");
    }
    
    function display() {
        $db = &JFactory::getDBO();
        $taxes = &$this->getModel("taxes");
        $rows = $taxes->getAllTaxes();
        
        $view=&$this->getView("taxes_list", 'html');
        $view->assign('rows', $rows); 
        $view->display();
    }
    
    function edit() {
        $tax_id = JRequest::getInt("tax_id");        
        $tax = &JTable::getInstance('tax', 'jshop');
        $tax->load($tax_id);
        $edit = ($tax_id)?($edit = 1):($edit = 0);
                
        $view=&$this->getView("taxes_edit", 'html');
        JFilterOutput::objectHTMLSafe( $tax, ENT_QUOTES);
        $view->assign('tax', $tax); 
        $view->assign('edit', $edit); 
        $view->display();
    }

    function save(){    
        $tax_id = JRequest::getInt("tax_id");
        $tax = &JTable::getInstance('tax', 'jshop');
        $post = JRequest::get("post"); 
        $post['tax_value'] = saveAsPrice($post['tax_value']);
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeSaveTax', array(&$tax) );

        
        if (!$tax->bind($post)) {
            JError::raiseWarning("",_JSHOP_ERROR_BIND);
            $this->setRedirect("index.php?option=com_jshopping&controller=taxes");
            return 0;
        }

        if (!$tax->store()) {
            JError::raiseWarning("",_JSHOP_ERROR_SAVE_DATABASE);
            $this->setRedirect("index.php?option=com_jshopping&controller=taxes");
            return 0; 
        }
        
        $dispatcher->trigger( 'onAfterSaveTax', array(&$tax) );
        
        if ($this->getTask()=='apply'){
            $this->setRedirect("index.php?option=com_jshopping&controller=taxes&task=edit&tax_id=".$tax->tax_id); 
        }else{
            $this->setRedirect("index.php?option=com_jshopping&controller=taxes");
        }
                        
    }

    function remove() {
        $cid = JRequest::getVar("cid");
        $db = &JFactory::getDBO();
        $text = '';
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeRemoveTax', array(&$cid) );

        foreach ($cid as $key => $value) {
            $tax = &JTable::getInstance('tax', 'jshop');
            $tax->load($value);
            $query2 = "SELECT pr.product_id
                       FROM `#__jshopping_products` AS pr
                       WHERE pr.product_tax_id = '" . $db->getEscaped($value) . "'";
            $db->setQuery($query2);
            $res = $db->query();
            if($db->getNumRows($res)) {
                $text .= sprintf(_JSHOP_TAX_NO_DELETED, $tax->tax_name)."<br>";
                continue;
            }
            $query = "DELETE FROM `#__jshopping_taxes` WHERE `tax_id` = '" . $db->getEscaped($value) . "'";
            $db->setQuery($query);
            if ($db->query()){
                $text .= sprintf(_JSHOP_TAX_DELETED,$tax->tax_name)."<br>";
            }
            $query = "DELETE FROM `#__jshopping_taxes_ext` WHERE `tax_id` = '" . $db->getEscaped($value) . "'";
            $db->setQuery($query);
            $db->query();            
        }
        
        $dispatcher->trigger( 'onAfterRemoveTax', array(&$cid) );
        
        $this->setRedirect("index.php?option=com_jshopping&controller=taxes", $text);
    }
    
}
?>