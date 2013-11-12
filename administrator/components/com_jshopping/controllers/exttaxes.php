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

class JshoppingControllerExtTaxes extends JController{
    
    function __construct( $config = array() ){
        parent::__construct( $config );

        $this->registerTask( 'add',   'edit' );
        $this->registerTask( 'apply', 'save' );
        
        addSubmenu("other");
    }
    
    function display(){
        $back_tax_id = JRequest::getInt("back_tax_id");
        $db = &JFactory::getDBO();
        $taxes = &$this->getModel("taxes");
        $rows = $taxes->getExtTaxes($back_tax_id);
        
        $countries = &$this->getModel("countries");
        $list = $countries->getAllCountries(0);    
        $countries_name = array();
        foreach($list as $v){
            $countries_name[$v->country_id] = $v->name;
        }
        
        foreach($rows as $k=>$v){
            $list = unserialize($v->zones);
            
            foreach($list as $k2=>$v2){
                $list[$k2] = $countries_name[$v2];
            }
            if (count($list) > 10){
                $tmp = array_slice($list, 0, 10);
                $rows[$k]->countries = implode(", ", $tmp)."...";
            }else{
                $rows[$k]->countries = implode(", ", $list);
            }
        }
        
        $view = &$this->getView("taxes_ext_list", 'html');
        $view->assign('rows', $rows); 
        $view->assign('back_tax_id', $back_tax_id); 
        $view->display();
    }
    
    function edit() {
        $back_tax_id = JRequest::getInt("back_tax_id");
        $id = JRequest::getInt("id");
        
        $tax = &JTable::getInstance('taxExt', 'jshop');
        $tax->load($id);
        
        if (!$tax->tax_id && $back_tax_id){
            $tax->tax_id = $back_tax_id;
        }
        
        $list_c = $tax->getZones();
        $zone_countries = array();        
        foreach($list_c as $v){
            $obj = new stdClass();
            $obj->country_id = $v;
            $zone_countries[] = $obj;
        }        
        
        $taxes = &$this->getModel("taxes");
        $all_taxes = $taxes->getAllTaxes();
        $list_tax = array();        
        foreach ($all_taxes as $_tax) {
            $list_tax[] = JHTML::_('select.option', $_tax->tax_id,$_tax->tax_name, 'tax_id', 'tax_name');
        }
        $lists['taxes'] = JHTML::_('select.genericlist', $list_tax, 'tax_id', '', 'tax_id', 'tax_name', $tax->tax_id);
        
        $countries = &$this->getModel("countries");
        $lists['countries'] = JHTML::_('select.genericlist', $countries->getAllCountries(0), 'countries_id[]', 'size = "10", multiple = "multiple"', 'country_id', 'name', $zone_countries);        
                
        $view = &$this->getView("taxes_ext_edit", 'html');
        JFilterOutput::objectHTMLSafe($tax, ENT_QUOTES);
        $view->assign('tax', $tax);
        $view->assign('back_tax_id', $back_tax_id);
        $view->assign('lists', $lists);
        $view->display();
    }

    function save(){    
        $back_tax_id = JRequest::getInt("back_tax_id");
        $id = JRequest::getInt("id");
        $tax = &JTable::getInstance('taxExt', 'jshop');
        $post = JRequest::get("post"); 
        $post['tax'] = saveAsPrice($post['tax']);
        $post['firma_tax'] = saveAsPrice($post['firma_tax']);
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeSaveExtTax', array(&$post) );
        
        if (!$tax->bind($post)) {
            JError::raiseWarning("",_JSHOP_ERROR_BIND);
            $this->setRedirect("index.php?option=com_jshopping&controller=exttaxes&back_tax_id=".$back_tax_id);
            return 0;
        }
        $tax->setZones($post['countries_id']);

        if (!$tax->store()){
            JError::raiseWarning("",_JSHOP_ERROR_SAVE_DATABASE);
            $this->setRedirect("index.php?option=com_jshopping&controller=exttaxes&back_tax_id=".$back_tax_id);
            return 0; 
        }
        
        updateCountExtTaxRule();
        
        $dispatcher->trigger( 'onAfterSaveExtTax', array(&$tax) );
        
        if ($this->getTask()=='apply'){
            $this->setRedirect("index.php?option=com_jshopping&controller=exttaxes&task=edit&id=".$tax->id."&back_tax_id=".$back_tax_id);
        }else{
            $this->setRedirect("index.php?option=com_jshopping&controller=exttaxes&back_tax_id=".$back_tax_id);
        }
    }

    function remove(){
        $back_tax_id = JRequest::getInt("back_tax_id");
        $cid = JRequest::getVar("cid");
        $db = &JFactory::getDBO();
        $text = array();
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeRemoveExtTax', array(&$cid) );

        foreach ($cid as $key => $value) {            
            $query = "DELETE FROM `#__jshopping_taxes_ext` WHERE `id` = '".$db->getEscaped($value)."'";
            $db->setQuery($query);
            if ($db->query()){
                $text[] = _JSHOP_ITEM_DELETED;
            }    
        }
        
        updateCountExtTaxRule();
        
        $dispatcher->trigger( 'onAfterRemoveExtTax', array(&$cid) );
        
        $this->setRedirect("index.php?option=com_jshopping&controller=exttaxes&back_tax_id=".$back_tax_id, implode("</li><li>",$text));
    }
    
    function back(){
        $this->setRedirect("index.php?option=com_jshopping&controller=taxes");
    }
    
}
?>		