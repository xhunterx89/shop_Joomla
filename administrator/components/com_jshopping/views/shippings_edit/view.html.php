<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewShippings_edit extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( $temp = ($this->edit) ? (_JSHOP_EDIT_SHIPPING) : (_JSHOP_NEW_SHIPPING), 'generic.png' ); 
        JToolBarHelper::save();
        JToolBarHelper::spacer();
        JToolBarHelper::apply();
        JToolBarHelper::spacer();
        JToolBarHelper::cancel();
        
        parent::display($tpl);
	}
}
?>