<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewCategory_list extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( _JSHOP_TREE_CATEGORY, 'generic.png' ); 
        JToolBarHelper::addNewX();
        JToolBarHelper::publishList();
        JToolBarHelper::unpublishList();
        JToolBarHelper::deleteList();
        
        parent::display($tpl);
	}
}
?>