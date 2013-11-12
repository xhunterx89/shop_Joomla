<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewAttributes_edit extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( $temp = ($this->attribut->attr_id) ? (_JSHOP_EDIT_ATTRIBUT) : (_JSHOP_NEW_ATTRIBUT), 'generic.png' ); 
        JToolBarHelper::save();
        JToolBarHelper::spacer();
        JToolBarHelper::apply();
        JToolBarHelper::spacer();
        JToolBarHelper::cancel();
        
        parent::display($tpl);
	}
}
?>