<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewCountries_edit extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( $temp = ($this->edit) ? (_JSHOP_EDIT_COUNTRY) : (_JSHOP_NEW_COUNTRY), 'generic.png' ); 
        JToolBarHelper::save();
        JToolBarHelper::spacer();
        JToolBarHelper::apply();
        JToolBarHelper::spacer();
        JToolBarHelper::cancel();
        
        parent::display($tpl);
	}
}
?>