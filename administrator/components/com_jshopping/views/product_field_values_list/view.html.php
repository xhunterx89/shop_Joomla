<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewProduct_field_values_list extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( _JSHOP_PRODUCT_EXTRA_FIELD_VALUES, 'generic.png' );
        
        JToolBarHelper::custom( "back", 'back', 'back', _JSHOP_BACK_TO_PRODUCT_EXTRA_FIELDS, false);
         
        JToolBarHelper::addNewX();
        JToolBarHelper::deleteList();
        
        parent::display($tpl);
	}
}
?>