<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewAttributesValues_list extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( _JSHOP_LIST_ATTRIBUT_VALUES, 'generic.png' );
        JToolBarHelper::custom( "back", 'back', 'back', _JSHOP_RETURN_TO_ATTRIBUTES, false);
        JToolBarHelper::addNewX();
        
        JToolBarHelper::deleteList();
        
        parent::display($tpl);
	}
}
?>