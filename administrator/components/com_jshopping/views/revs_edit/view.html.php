<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewRevs_edit extends JView
{
    function display($tpl = null){

        JToolBarHelper::title( ($this->edit) ? (_JSHOP_EDIT_REVIEW) : (_JSHOP_NEW_REVIEW), 'generic.png' ); 
        JToolBarHelper::save();
        JToolBarHelper::spacer();
        JToolBarHelper::apply();
        JToolBarHelper::spacer();
        JToolBarHelper::cancel();
        
        parent::display($tpl);
	}
}
?>