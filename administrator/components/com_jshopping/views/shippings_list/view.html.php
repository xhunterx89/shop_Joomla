<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewShippings_list extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( _JSHOP_LIST_SHIPPINGS, 'generic.png' ); 
        JToolBarHelper::addNewX();
        JToolBarHelper::publishList();
        JToolBarHelper::unpublishList();
        JToolBarHelper::deleteList();
        
        parent::display($tpl);
	}
}
?>