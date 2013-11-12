<?php
/**
* @version      2.8.0 19.02.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerCart extends JController{
    
    function display(){
        $this->view();    
    }
    
    function add(){
    
        header("Cache-Control: no-cache, must-revalidate");
        $jshopConfig = &JSFactory::getConfig(); 
        if ($jshopConfig->user_as_catalog) return 0; 

        $product_id = JRequest::getInt('product_id');
        $category_id = JRequest::getInt('category_id');
        $quantity = JRequest::getInt('quantity',1);
        $to = JRequest::getVar('to',"cart");
        if ($to!="cart" && $to!="wishlist") $to = "cart"; 
        
        $jshop_attr_id = JRequest::getVar('jshop_attr_id');
        if (!is_array($jshop_attr_id)) $jshop_attr_id = array();
        foreach($jshop_attr_id as $k=>$v) $jshop_attr_id[intval($k)] = intval($v);
        
        
        $freeattribut = JRequest::getVar("freeattribut");
        if (!is_array($freeattribut)) $freeattribut = array();        
        
        $cart = &JModel::getInstance('cart', 'jshop');
        $cart->load($to);        
        if (!$cart->add($product_id, $quantity, $jshop_attr_id, $freeattribut)){
            $this->setRedirect( SEFLink('index.php?option=com_jshopping&controller=product&task=view&category_id='.$category_id.'&product_id='.$product_id,0,1) );
            return 0;
        }
        
        if ($jshopConfig->not_redirect_in_cart_after_buy){
            if ($to=="wishlist"){
                $message = _JSHOP_ADDED_TO_WISHLIST;
            }else{
                $message = _JSHOP_ADDED_TO_CART;
            }
            $this->setRedirect( $_SERVER['HTTP_REFERER'], $message);
            return 1;
        }
        
        if ($to=="wishlist")
            $this->setRedirect( SEFLink('index.php?option=com_jshopping&controller=wishlist&task=view',0,1) );
        else
            $this->setRedirect( SEFLink('index.php?option=com_jshopping&controller=cart&task=view',0,1) );
    }
    
    function view(){		
	    $jshopConfig = &JSFactory::getConfig();
        if ($jshopConfig->user_as_catalog) return 0; 
		$db = &JFactory::getDBO();
        $session =& JFactory::getSession();
        $mainframe =& JFactory::getApplication();
        $params = $mainframe->getParams();
		
		$cart = &JModel::getInstance('cart', 'jshop');        
		$cart->load();
		$cart->addLinkToProducts(1);
        $cart->setDisplayFreeAttributes();
        
        $seo = &JTable::getInstance("seo", "jshop");
        $seodata = $seo->loadData("cart");        
        if (getThisURLMainPageShop()){        
            $document =& JFactory::getDocument();            
            appendPathWay(_JSHOP_CART);
            if ($seodata->title==""){
                $seodata->title = _JSHOP_CART;
            }
        }else{
            if ($seodata->title==""){
                $seodata->title = $params->get('page_title');
            }
        }
        setMetaData($seodata->title, $seodata->keyword, $seodata->description);

        $shopurl = SEFLink('index.php?option=com_jshopping&controller=category',1);
        $endpagebuyproduct = $session->get('jshop_end_page_buy_product');
        if ($endpagebuyproduct){
            $shopurl = $endpagebuyproduct;
        }
        
        $view_name = "cart";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);
        $view->setLayout("cart");
        
        $view->assign('config', $jshopConfig);
		$view->assign('products', $cart->products);
		$view->assign('summ', $cart->getPriceProducts());
		$view->assign('image_product_path', $jshopConfig->image_product_live_path);
		$view->assign('image_path', $jshopConfig->live_path);
		$view->assign('no_image', 'noimage.gif');
		$view->assign('href_shop', $shopurl);
		if ($jshopConfig->shop_user_guest==1){
            $view->assign('href_checkout', SEFLink('index.php?option=com_jshopping&controller=checkout&task=step2&check_login=1',1, 0, $jshopConfig->use_ssl));
        }else{
            $view->assign('href_checkout', SEFLink('index.php?option=com_jshopping&controller=checkout&task=step2',1, 0, $jshopConfig->use_ssl));
        }                
        
        $tax_list = $cart->getTaxExt(0, 1);
        
        $show_percent_tax = 0;        
        if (count($tax_list)>1 || $jshopConfig->show_tax_in_product) $show_percent_tax = 1;
        if ($jshopConfig->hide_tax) $show_percent_tax = 0;
        $hide_subtotal = 0;
        if (($jshopConfig->hide_tax || count($tax_list)==0) && !$cart->rabatt_summ) $hide_subtotal = 1;
        
        JPluginHelper::importPlugin('jshoppingcheckout');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeDisplayCart', array(&$cart) );
        
        $view->assign('discount', $cart->getDiscountShow());
		$view->assign('free_discount', $cart->getFreeDiscount());
		$view->assign('use_rabatt', $jshopConfig->use_rabatt_code);        
		$view->assign('tax_list', $cart->getTaxExt(0, 1));        
        $view->assign('fullsumm', $cart->getSum(0, 1));
        $view->assign('show_percent_tax', $show_percent_tax);
        $view->assign('hide_subtotal', $hide_subtotal);
        $view->assign('weight', $cart->getWeightProducts());
        $view->assign('shippinginfo', SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=shipping'));
               
		$view->display();
    }
    
    function delete(){
        header("Cache-Control: no-cache, must-revalidate");
        $number_id = JRequest::getInt('number_id');
        $cart = &JModel::getInstance('cart', 'jshop');
        $cart->load();    
        $cart->delete($number_id);
        
        $this->setRedirect( SEFLink('index.php?option=com_jshopping&controller=cart&task=view',0,1) );
    }
    
    function refresh(){        
        $quantitys = JRequest::getVar('quantity');
        $cart = &JModel::getInstance('cart', 'jshop');
        $cart->load();
        $cart->refresh($quantitys);                                
        $this->setRedirect( SEFLink('index.php?option=com_jshopping&controller=cart&task=view',0,1) );
    }
    
    function discountsave(){

        $coupon = &JTable::getInstance('coupon', 'jshop');        
        $code = JRequest::getVar('rabatt');
        if ($coupon->getEnableCode($code)){            
            $tax = &JTable::getInstance('tax', 'jshop');
            $tax->load($coupon->tax_id);
            $cart = &JModel::getInstance('cart', 'jshop');
            $cart->load();
            $cart->setRabatt($coupon->coupon_id, $coupon->coupon_type, $coupon->coupon_value, $tax->tax_value);
            
            JPluginHelper::importPlugin('jshoppingcheckout');
            $dispatcher =& JDispatcher::getInstance();
            $dispatcher->trigger( 'onAfterDiscountSave', array(&$coupon, &$cart) );
        } else {        
            JError::raiseWarning('',$coupon->error);
        }
        
        $this->setRedirect( SEFLink('index.php?option=com_jshopping&controller=cart&task=view',0,1) );
    }
    
}

?>		