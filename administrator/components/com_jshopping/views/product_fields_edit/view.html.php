<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewProduct_fields_edit extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( $temp = ($this->row->id) ? (_JSHOP_EDIT) : (_JSHOP_NEW), 'generic.png' );
        JToolBarHelper::save();
        JToolBarHelper::spacer();
        JToolBarHelper::apply();
        JToolBarHelper::spacer();
        JToolBarHelper::cancel();
        
        parent::display($tpl);
	}
}
?>