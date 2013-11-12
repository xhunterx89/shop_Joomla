<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewProduct_fields_list extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( _JSHOP_PRODUCT_EXTRA_FIELDS, 'generic.png' ); 
        JToolBarHelper::addNewX();
        JToolBarHelper::deleteList();
        
        parent::display($tpl);
	}
}
?>