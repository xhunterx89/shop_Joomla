<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewOtherpanel extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( _JSHOP_OTHER_ELEMENTS, 'generic.png' ); 
        
        parent::display($tpl);
	}
}
?>