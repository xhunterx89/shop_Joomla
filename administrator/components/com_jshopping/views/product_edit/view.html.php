<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewProduct_edit extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( ($this->edit) ? (_JSHOP_EDIT_PRODUCT) : (_JSHOP_NEW_PRODUCT), 'generic.png' ); 
        JToolBarHelper::save();
        JToolBarHelper::spacer();
        JToolBarHelper::apply();
        JToolBarHelper::spacer();
        JToolBarHelper::cancel();
        
        parent::display($tpl);
	}
}
?>