<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewAttributesValues_edit extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( $temp = ($this->attributValue->value_id) ? (_JSHOP_EDIT_ATTRIBUT_VALUE) : (_JSHOP_NEW_ATTRIBUT_VALUE), 'generic.png' ); 
        JToolBarHelper::save();
        JToolBarHelper::spacer();
        JToolBarHelper::apply();
        JToolBarHelper::spacer();
        JToolBarHelper::cancel();
        
        parent::display($tpl);
	}
}
?>