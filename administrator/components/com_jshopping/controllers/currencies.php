<?php
/**
* @version      2.9.4 03.11.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerCurrencies extends JController{
    
    function __construct( $config = array() ){
        parent::__construct( $config );

        $this->registerTask( 'add',   'edit' );
        $this->registerTask( 'apply', 'save' );
        
        addSubmenu("other");
    }
        
    function display() {
        
        $jshopConfig = &JSFactory::getConfig();        
        $current_currency = &JTable::getInstance('currency', 'jshop');
        $current_currency->load($jshopConfig->mainCurrency);
        if ($current_currency->currency_value!=1){
            JError::raiseWarning("",_JSHOP_ERROR_MAIN_CURRENCY_VALUE);    
        }
        
        $currencies = &$this->getModel("currencies");
        $rows = $currencies->getAllCurrencies(0);
        
        $view=&$this->getView("currencies_list", 'html');        
        $view->assign('rows', $rows);        
        $view->assign('config', $jshopConfig);        
        $view->display();
    }
    
    function edit() {        
        $db = &JFactory::getDBO();        
        $currency = &JTable::getInstance('currency', 'jshop');
        $currencies = &$this->getModel("currencies");
        $currency_id = JRequest::getInt('currency_id');
        $currency->load($currency_id);
        $first[] = JHTML::_('select.option', '0',_JSHOP_ORDERING_FIRST,'currency_ordering','currency_name');
        $rows = array_merge($first, $currencies->getAllCurrencies() );
        $lists['order_currencies'] = JHTML::_('select.genericlist', $rows,'currency_ordering','class="inputbox" size="1"','currency_ordering','currency_name',$currency->currency_ordering);
        $edit = ($currency_id)?($edit = 1):($edit = 0);
        
        $view=&$this->getView("currencies_edit", 'html');
        JFilterOutput::objectHTMLSafe( $currency, ENT_QUOTES);        
        $view->assign('currency', $currency);        
        $view->assign('lists', $lists);        
        $view->assign('edit', $edit);        
        $view->display();
    }

    function save() {
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();        
        $currency_id = JRequest::getInt("currency_id");
        $apply = JRequest::getVar("apply");
        $currency = &JTable::getInstance('currency', 'jshop');
        $post = JRequest::get("post");
        $post['currency_value'] = saveAsPrice($post['currency_value']);
        $dispatcher->trigger( 'onBeforeSaveCurrencie', array(&$post) );
        if (!$currency->bind($post)) {
            JError::raiseWarning("",_JSHOP_ERROR_BIND);
            $this->setRedirect("index.php?option=com_jshopping&controller=currencies");
            return 0;
        }

        $this->_reorderCurrency($currency);
        if (!$currency->store()) {
            JError::raiseWarning("",_JSHOP_ERROR_SAVE_DATABASE);
            $this->setRedirect("index.php?option=com_jshopping&controller=currencies");
            return 0;
        }
                
        $dispatcher->trigger( 'onAfterSaveCurrencie', array(&$currency) );
        
        if ($this->getTask()=='apply'){
            $this->setRedirect("index.php?option=com_jshopping&controller=currencies&task=edit&currency_id=".$currency->currency_id); 
        }else{
            $this->setRedirect("index.php?option=com_jshopping&controller=currencies");
        }
                
    }

    function _reorderCurrency(&$currency) {
        $db = &JFactory::getDBO();
        $query = "UPDATE `#__jshopping_currencies`
                    SET `currency_ordering` = currency_ordering + 1
                    WHERE `currency_ordering` > '" . $currency->currency_ordering . "'";
        $db->setQuery($query);
        $db->query();
        $currency->currency_ordering++;
    }

    function order() {
        $db = &JFactory::getDBO();
        
        $order = JRequest::getVar("order");
        $cid = JRequest::getInt("id");
        $number = JRequest::getInt("number");
        
        $currency = &JTable::getInstance('currency', 'jshop'); 
        $currency->load($cid);
        switch ($order) {
            case 'up':
                $query = "SELECT a.currency_id, a.currency_ordering
                       FROM `#__jshopping_currencies` AS a
                       WHERE a.currency_ordering < '" . $number . "'
                       ORDER BY a.currency_ordering DESC
                       LIMIT 1";
                break;
            case 'down':
                $query = "SELECT a.currency_id, a.currency_ordering
                       FROM `#__jshopping_currencies` AS a
                       WHERE a.currency_ordering > '" . $number . "'
                       ORDER BY a.currency_ordering ASC
                       LIMIT 1";
        }

        $db->setQuery($query);
        $row = $db->loadObject();


        $query1 = "UPDATE `#__jshopping_currencies` AS a
                     SET a.currency_ordering = '" . $row->currency_ordering . "'
                     WHERE a.currency_id = '" . $cid . "'";
        $query2 = "UPDATE `#__jshopping_currencies` AS a
                     SET a.currency_ordering = '" . $number . "'
                     WHERE a.currency_id = '" . $row->currency_id . "'";
        $db->setQuery($query1);
        $db->query();
        $db->setQuery($query2);
        $db->query();
        
        $this->setRedirect("index.php?option=com_jshopping&controller=currencies");
    }

    function remove() {
        $db = &JFactory::getDBO();
        $text = '';
        $cid = JRequest::getVar("cid");
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeRemoveCurrencie', array(&$cid) );
        
        foreach ($cid as $key => $value) {
            $query = "DELETE FROM `#__jshopping_currencies` WHERE `currency_id` = '" . $db->getEscaped($value) . "'";
            $db->setQuery($query);
            if($db->query())
                $text .= _JSHOP_CURRENCY_DELETED."<br>";
            else
                $text .= _JSHOP_CURRENCY_ERROR_DELETED."<br>";

        }        
        $dispatcher->trigger( 'onAfterRemoveCurrencie', array(&$cid) );
        
        $this->setRedirect("index.php?option=com_jshopping&controller=currencies", $text); 
    }
    
    function publish(){
        $this->publishCurrency(1);
    }
    
    function unpublish(){
        $this->publishCurrency(0);
    }

    function publishCurrency($flag) {
        $cid = JRequest::getVar("cid");
        $db = &JFactory::getDBO();
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforePublishCurrencie', array(&$cid, &$flag) );
        foreach ($cid as $key => $value) {
            $query = "UPDATE `#__jshopping_currencies`
                       SET `currency_publish` = '" . $db->getEscaped($flag) . "'
                       WHERE `currency_id` = '" . $db->getEscaped($value) . "'";
            $db->setQuery($query);
            $db->query();
        }
        
        $dispatcher->trigger( 'onAfterPublishCurrencie', array(&$cid, &$flag) );
        
        $this->setRedirect("index.php?option=com_jshopping&controller=currencies");
    }
    
    function setdefault(){
        $cid = JRequest::getVar("cid");
        $db = &JFactory::getDBO();
        if ($cid[0]){
            $config = new jshopConfig($db);
            $config->id = 1;
            $config->mainCurrency = $cid[0];
            $config->store();
        }
        $this->setRedirect("index.php?option=com_jshopping&controller=currencies");
    }
        
    
}

?>		