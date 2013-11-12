<?php
/**
* @version      2.9.4 12.11.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerReviews extends JController{
    
    function __construct( $config = array() ){
        parent::__construct( $config );

        $this->registerTask( 'add',   'edit' );
        $this->registerTask( 'apply', 'save' );
        
        addSubmenu("other");
    }
    
    function display() {
        $mainframe =& JFactory::getApplication();
        $id_vendor_cuser = getIdVendorForCUser();
        $reviews_model = &$this->getModel("reviews");
        $products_model = &$this->getModel("products");
        $limit = $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
        $limitstart = $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0, 'int' );
        $category_id = $mainframe->getUserStateFromRequest( $context.'category_id', 'category_id', 0, 'int' );            
        $text_search = $mainframe->getUserStateFromRequest( $context.'text_search', 'text_search', '');
        if ($category_id){
            $product_id = $mainframe->getUserStateFromRequest( $context.'product_id', 'product_id', 0, 'int' );
        }
        
        $products_select = "";
        
        if ($category_id){
            $prod_filter = array("category_id"=>$category_id);
            if ($id_vendor_cuser) $prod_filter['vendor_id'] = $id_vendor_cuser;
            $products = $products_model->getAllProducts($prod_filter, 0, 100);
            if (count($products)) {
                $start_pr_option = JHTML::_('select.option', '0', _JSHOP_SELECT_PRODUCT , 'product_id', 'name');
                array_unshift($products, $start_pr_option);   
                $products_select = JHTML::_('select.genericlist', $products, 'product_id', 'class = "inputbox" onchange="document.adminForm.submit();" size = "1" ', 'product_id', 'name', $product_id);
            }
        }
        
        $total = $reviews_model->getAllReviews($category_id, $product_id, NULL, NULL, $text_search, "count", $id_vendor_cuser);
        
        jimport('joomla.html.pagination');
        $pagination = new JPagination($total, $limitstart, $limit);
    
        $reviews = $reviews_model->getAllReviews($category_id, $product_id, $pagination->limitstart, $pagination->limit, $text_search, "list", $id_vendor_cuser);
        
        $start_option = JHTML::_('select.option', '0', _JSHOP_SELECT_CATEGORY,'category_id','name'); 
        
        $categories_select = buildTreeCategory(0);
        array_unshift($categories_select, $start_option);
        
        $categories = JHTML::_('select.genericlist', $categories_select, 'category_id', 'class = "inputbox" onchange="document.adminForm.submit();" size = "1" ', 'category_id', 'name', $category_id);
        $view=&$this->getView("revs_list", 'html');
        $view->assign('categories', $categories);
        $view->assign('reviews', $reviews); 
        $view->assign('limit', $limit);
        $view->assign('limitstart', $limitstart);
        $view->assign('text_search', $text_search); 
        $view->assign('pagination', $pagination); 
        $view->assign('products_select', $products_select);            
        $view->display();
     }
     
     function remove(){
        $reviews_model = &$this->getModel("reviews");   
        $cid = JRequest::getVar('cid');
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeRemoveReview', array(&$cid) );
        
        foreach ($cid as $key => $value) {
             $review = &JTable::getInstance('review', 'jshop');
             $review->load($value);
             
             $reviews_model->deleteReview($value);             
             
             $product = &JTable::getInstance('product', 'jshop');
             $product->load($review->product_id);
             $product->loadAverageRating();
             $product->loadReviewsCount();
             $product->store();
             unset($product);
             unset($review);
        }
        $dispatcher->trigger( 'onAfterRemoveReview', array(&$cid) );
        
        $this->setRedirect("index.php?option=com_jshopping&controller=reviews");       
     }
     
     function edit(){
        $mainframe =& JFactory::getApplication();
        $reviews_model = &$this->getModel("reviews");
        $cid = JRequest::getVar('cid');
        $review = $reviews_model->getReview($cid[0]);
         
        $jshopConfig = &JSFactory::getConfig();
        $options = array();
        $options[] = JHTML::_('select.option', 0, 'none','value','text');
        for($i=1;$i<=$jshopConfig->max_mark;$i++){
             $options[] = JHTML::_('select.option', $i, $i,'value','text'); 
        }         
        
        $mark = JHTML::_('select.genericlist', $options, 'mark', 'class = "inputbox" size = "1" ', 'value', 'text', $review->mark); 
        
        $view=&$this->getView("revs_edit", 'html'); 
                
        if ($this->getTask()=='edit'){     
            $view->assign('edit', 1);
        }
             
        $view->assign('review', $review); 
        $view->assign('mark', $mark);            
        $view->display();            
     }
     
     function save(){
        $review = &JTable::getInstance('review', 'jshop');
        $post = JRequest::get('post');
        if (intval($post['review_id'])==0) $post['time'] = date("Y-m-d");
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeSaveReview', array(&$post) );

        if (!$review->bind($post)) {
            JError::raiseWarning("",_JSHOP_ERROR_BIND);
            $this->setRedirect("index.php?option=com_jshopping&controller=reviews");
            return 0;
        }
        if (!$review->store()) {
            JError::raiseWarning("",_JSHOP_ERROR_SAVE_DATABASE);
            $this->setRedirect("index.php?option=com_jshopping&controller=reviews&task=edit&cid[]=".$review->review_id);
            return 0;
        }
        
        $product = &JTable::getInstance('product', 'jshop');
        $product->load($review->product_id);
        $product->loadAverageRating();
        $product->loadReviewsCount();
        $product->store();
        
        $dispatcher->trigger( 'onAfterSaveReview', array(&$review) );
        
        if ($this->getTask()=='apply')
            $this->setRedirect("index.php?option=com_jshopping&controller=reviews&task=edit&cid[]=".$review->review_id);             
        else 
            $this->setRedirect("index.php?option=com_jshopping&controller=reviews");
    }
     
    function publish(){        
        $this->_publish(1);
        $this->setRedirect("index.php?option=com_jshopping&controller=reviews");
    }
    
    function unpublish(){
        $this->_publish(0);
        $this->setRedirect("index.php?option=com_jshopping&controller=reviews");
    }    
    
    function _publish($flag) {
        $jshopConfig = &JSFactory::getConfig();
        $db = &JFactory::getDBO();
        $cid = JRequest::getVar('cid');
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforePublishReview', array(&$cid, &$flag) );                
        foreach ($cid as $key => $value) {
            $query = "UPDATE `#__jshopping_products_reviews` SET `publish` = '".$db->getEscaped($flag)."' WHERE `review_id` = '".$db->getEscaped($value)."'";
            $db->setQuery($query);
            $db->query();
            
            $review = &JTable::getInstance('review', 'jshop');
            $review->load($value);                         
            $product = &JTable::getInstance('product', 'jshop');
            $product->load($review->product_id);
            $product->loadAverageRating();
            $product->loadReviewsCount();
            $product->store();
            unset($product);
            unset($review);
        }
        
        $dispatcher->trigger( 'onAfterPublishReview', array(&$cid, &$flag) );
    }
}
?>