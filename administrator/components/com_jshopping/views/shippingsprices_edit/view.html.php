<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewShippingsPrices_edit extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( $temp = ($this->sh_method_price->sh_pr_method_id) ? (_JSHOP_EDIT_SHIPPING_PRICES) : (_JSHOP_NEW_SHIPPING_PRICES), 'generic.png' ); 
        JToolBarHelper::save();
        JToolBarHelper::spacer();
        JToolBarHelper::apply();
        JToolBarHelper::spacer();
        JToolBarHelper::cancel();
        
        parent::display($tpl);
	}
}
?>