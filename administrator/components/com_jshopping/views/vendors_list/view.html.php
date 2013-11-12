<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewVendors_list extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( _JSHOP_USER_LIST, 'generic.png' ); 
        JToolBarHelper::addNewX();
        JToolBarHelper::deleteList();
        
        parent::display($tpl);
	}
}
?>