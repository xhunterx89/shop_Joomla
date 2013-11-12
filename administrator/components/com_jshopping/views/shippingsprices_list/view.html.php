<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewShippingsPrices_list extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( _JSHOP_SHIPPING_PRICES_LIST, 'generic.png' ); 
        JToolBarHelper::custom( "back", 'back', 'back', _JSHOP_LIST_SHIPPINGS, false);
        JToolBarHelper::addNewX();
        JToolBarHelper::deleteList();
        
        parent::display($tpl);
	}
}
?>