<?php
/**
* @version      2.9.5 19.11.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

class PaymentRoot{
    
    var $_errormessage = "";
    
    /**
    * static
    * show form payment. Checkout Step3
    * @param array $params - entered params
    * @param array $pmconfigs - configs
    */    
    function showPaymentForm($params, $pmconfigs){
    }
    
    /**
    * check payment params. Checkout Step3save
    */
    function checkPaymentInfo($params, $pmconfigs){
        /*$this->setErrorMessage("error mgs");*/
        return 1;
    }
    
    /**
    * list display params name payment saved to order    
    */
    function getDisplayNameParams(){
        return array();
    }
    
    /**
    * get current params
    */
    function getParams(){
        return $this->_ps_params;
    }
    
    /**
    * set params
    */
    function setParams($params){
        $this->_ps_params = $params;
    }
    
    /**
    * Form parametrs. Edit params payment in administrator.
    * static
    */
    function showAdminFormParams($pmconfigs){
    }
    
    /**
    * Show form. Checkout Step6.
    */
    function showEndForm($pmconfigs, $order){        
    }
    
    /**
    * Check Transaction
    */
    function checkTransaction($pmconfigs, $order, $act){
        return array(1, "");
    }
    
    /**
    * get url parametr for payment. Step7
    */
    function getUrlParams($pmconfigs){
        return array();        
    }
    
    /**
    * Exec after notify. Step7.
    */
    function nofityFinish($pmconfigs, $order, $rescode){    
    }
    
    /**
    * Set message error check payment
    */
    function setErrorMessage($msg){
        $this->_errormessage = $msg;
    }
    
    /**
    * Get message error check payment. Step3
    */
    function getErrorMessage(){
        if ($this->_errormessage==""){
            $this->_errormessage = _JSHOP_ERROR_PAYMENT_DATA;
        }
    return $this->_errormessage;
    }
        
}
?>