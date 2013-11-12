<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewUnits_edit extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( $temp = ($this->edit) ? (_JSHOP_UNITS_MEASURE_EDIT) : (_JSHOP_UNITS_MEASURE_NEW), 'generic.png' ); 
        JToolBarHelper::save();
        JToolBarHelper::spacer();
        JToolBarHelper::apply();
        JToolBarHelper::spacer();
        JToolBarHelper::cancel();
        
        parent::display($tpl);
	}
}
?>