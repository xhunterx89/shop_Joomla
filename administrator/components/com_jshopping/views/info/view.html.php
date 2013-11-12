<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewInfo extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( _JSHOP_ABOUT_AS, 'generic.png' ); 
        
        parent::display($tpl);
	}
}
?>