<?php
defined('_JEXEC') or die('Restricted access');   
class pm_debit extends PaymentRoot{
    
    function showPaymentForm($params, $pmconfigs){
    	include(dirname(__FILE__)."/paymentform.php");
    }

    function int_5_8($value){
       $reg = '^[0-9]{5,8}$';
       return(ereg($reg, $value));
    }

    function checkPaymentInfo($params, $pmconfigs){        
        if (!pm_debit::int_5_8($params['bank_bic'])){
            return 0;
        } else {      
            return 1;
        }
    }    

    function getDisplayNameParams(){        
        $names = array('acc_holder' => _JSHOP_ACCOUNT_HOLDER, 'acc_number' => _JSHOP_ACCOUNT_NUMBER, 'bank_bic' => _JSHOP_BIC, 'bank' => _JSHOP_BANK );
        return $names;
    }

}
?>