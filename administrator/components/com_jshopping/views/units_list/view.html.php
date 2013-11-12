<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewUnits_list extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( _JSHOP_LIST_UNITS_MEASURE, 'generic.png' ); 
        JToolBarHelper::addNewX();
        JToolBarHelper::deleteList();
        
        parent::display($tpl);
	}
}
?>