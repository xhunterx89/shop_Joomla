<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewCategory_edit extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( ($this->category->category_id) ? (_JSHOP_EDIT_CATEGORY) : (_JSHOP_NEW_CATEGORY), 'generic.png' ); 
        JToolBarHelper::save();
        JToolBarHelper::spacer();
        JToolBarHelper::apply();
        JToolBarHelper::spacer();
        JToolBarHelper::cancel();
        
        parent::display($tpl);
	}
}
?>