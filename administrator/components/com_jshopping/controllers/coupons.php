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

class JshoppingControllerCoupons extends JController{
    
    function __construct( $config = array() ){
        parent::__construct( $config );

        $this->registerTask( 'add',   'edit' );
        $this->registerTask( 'apply', 'save' );
        
        addSubmenu("other");
    }

    function display(){
        $mainframe =& JFactory::getApplication();
        $context = "jshoping.list.admin.coupons";
        $limit = $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
        $limitstart = $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0, 'int' );
        
        $jshopConfig = &JSFactory::getConfig();  	        		
        
        $coupons = &$this->getModel("coupons");
        $total = $coupons->getCountCoupons();
        
        jimport('joomla.html.pagination');
        $pageNav = new JPagination($total, $limitstart, $limit);
        $rows = $coupons->getAllCoupons($pageNav->limitstart, $pageNav->limit);
        
        $currency =& JTable::getInstance('currency', 'jshop');
        $currency->load($jshopConfig->mainCurrency);
                        
		$view=&$this->getView("coupons_list", 'html');		
        $view->assign('rows', $rows);        
        $view->assign('currency', $currency->currency_code);
        $view->assign('pageNav', $pageNav);        
		$view->display(); 
    }
    
    function edit() {
        $coupon_id = JRequest::getInt('coupon_id');
        $coupon = &JTable::getInstance('coupon', 'jshop'); 
        $coupon->load($coupon_id);
        $edit = ($coupon_id)?($edit = 1):($edit = 0);
        $arr_type_coupon = array();
        $arr_type_coupon[0]->coupon_type = 0;
        $arr_type_coupon[0]->coupon_value = _JSHOP_COUPON_PERCENT;

        $arr_type_coupon[1]->coupon_type = 1;
        $arr_type_coupon[1]->coupon_value = _JSHOP_COUPON_ABS_VALUE;
        
        if (!$coupon_id){
          $coupon->coupon_type = 0;  
          $coupon->finished_after_used = 1;
          $coupon->for_user_id = 0;
        }
                
        $lists['coupon_type'] = JHTML::_('select.radiolist', $arr_type_coupon, 'coupon_type', '', 'coupon_type', 'coupon_value', $coupon->coupon_type) ;    
        
        $_tax = &$this->getModel("taxes");
        $all_taxes = $_tax->getAllTaxes();
        $list_tax = array();        
        foreach ($all_taxes as $tax) {
            $list_tax[] = JHTML::_('select.option', $tax->tax_id, $tax->tax_name . ' (' . $tax->tax_value . '%)','tax_id','tax_name');
        }
        $lists['tax'] = JHTML::_('select.genericlist', $list_tax, 'tax_id', 'class = "inputbox" size = "1" ', 'tax_id', 'tax_name', $coupon->tax_id);        
        
        $view=&$this->getView("coupons_edit", 'html');        
        $view->assign('coupon', $coupon);        
        $view->assign('lists', $lists);        
        $view->assign('edit', $edit);        
        $view->display();
    }
    
    function save() {        

        $coupon_id = JRequest::getInt("coupon_id");        
        $coupon = &JTable::getInstance('coupon', 'jshop');
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();        
        
        $post = JRequest::get("post");        
        $post['coupon_code'] = JRequest::getCmd("coupon_code");
        $post['coupon_publish'] = JRequest::getInt("coupon_publish");
        $post['finished_after_used'] = JRequest::getInt("finished_after_used");
        $post['coupon_value'] = saveAsPrice($post['coupon_value']);
        
        $dispatcher->trigger( 'onBeforeSaveCoupon', array(&$post) );
        
        if (!$post['coupon_code']){
            JError::raiseWarning("",_JSHOP_ERROR_COUPON_CODE);
            $this->setRedirect("index.php?option=com_jshopping&controller=coupons&task=edit&coupon_id=".$coupon->coupon_id);
            return 0;
        }
        
        if ($post['coupon_value']<0 || ($post['coupon_value']>100 && $post['coupon_type']==0)){
            JError::raiseWarning("",_JSHOP_ERROR_COUPON_VALUE);
            $this->setRedirect("index.php?option=com_jshopping&controller=coupons&task=edit&coupon_id=".$coupon->coupon_id);    
            return 0;
        }        
        
        if(!$coupon->bind($post)) {
            JError::raiseWarning("",_JSHOP_ERROR_BIND);
            $this->setRedirect("index.php?option=com_jshopping&controller=coupons");
            return 0;
        }
        
        if ($coupon->getExistCode()){
            JError::raiseWarning("",_JSHOP_ERROR_COUPON_EXIST);
            $this->setRedirect("index.php?option=com_jshopping&controller=coupons");
            return 0;
        }

        if (!$coupon->store()) {
            JError::raiseWarning("",_JSHOP_ERROR_SAVE_DATABASE);
            $this->setRedirect("index.php?option=com_jshopping&controller=coupons");
            return 0;
        }
                
        $dispatcher->trigger( 'onAfterSaveCoupon', array(&$coupon) );
        
        if ($this->getTask()=='apply'){
            $this->setRedirect("index.php?option=com_jshopping&controller=coupons&task=edit&coupon_id=".$coupon->coupon_id); 
        }else{
            $this->setRedirect("index.php?option=com_jshopping&controller=coupons");
        }
                
    }
    
    function remove() {
        $cid = JRequest::getVar("cid");
        $db = &JFactory::getDBO();
        $text = '';
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeRemoveCoupon', array(&$cid) );

        foreach ($cid as $key => $value) {
            $query = "DELETE FROM `#__jshopping_coupons` WHERE `coupon_id` = '" . $db->getEscaped($value) . "'";
            $db->setQuery($query);
            $db->query();
        }
        
        $dispatcher->trigger( 'onAfterRemoveCoupon', array(&$cid) );
        
        $this->setRedirect("index.php?option=com_jshopping&controller=coupons", _JSHOP_COUPON_DELETED);
    }
    
    function publish(){
        $this->publishCoupon(1);
    }
    
    function unpublish(){
        $this->publishCoupon(0);
    }

    function publishCoupon($flag) {
        $db = &JFactory::getDBO();
        $cid = JRequest::getVar("cid");
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforePublishCoupon', array(&$cid,&$flag) );
        
        foreach ($cid as $key => $value) {
            $query = "UPDATE `#__jshopping_coupons`
                       SET `coupon_publish` = '" . $db->getEscaped($flag) . "'
                       WHERE `coupon_id` = '" . $db->getEscaped($value) . "'";
            $db->setQuery($query);
            $db->query();
        }
        $dispatcher->trigger( 'onAfterPublishCoupon', array(&$cid,&$flag) );
        
        $this->setRedirect("index.php?option=com_jshopping&controller=coupons");
    }
        
}
?>