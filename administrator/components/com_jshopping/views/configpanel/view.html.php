<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewConfigpanel extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( _JSHOP_CONFIG, 'generic.png' );
        
        JToolBarHelper::preferences('com_jshopping'); 
        
        parent::display($tpl);
	}
}
?>