<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewConfig_display_price_list extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( _JSHOP_CONFIG_DISPLAY_PRICE_LIST, 'generic.png' );
        JToolBarHelper::custom( "back", 'back', 'back', _JSHOP_CONFIG, false);
        JToolBarHelper::addNewX();
        JToolBarHelper::deleteList();
        
        parent::display($tpl);
	}
}
?>