<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewTaxes_ext_list extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( _JSHOP_LIST_TAXES_EXT, 'generic.png' );
        JToolBarHelper::custom( "back", 'back', 'back', _JSHOP_LIST_TAXES, false);
        JToolBarHelper::addNewX();
        JToolBarHelper::deleteList();
        
        parent::display($tpl);
	}
}
?>