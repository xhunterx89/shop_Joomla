<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewAttributes_list extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( _JSHOP_LIST_ATTRIBUTES, 'generic.png' ); 
        JToolBarHelper::addNewX();
        
        JToolBarHelper::deleteList();
        
        parent::display($tpl);
	}
}
?>