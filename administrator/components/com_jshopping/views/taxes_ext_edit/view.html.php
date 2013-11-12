<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewTaxes_ext_edit extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( $temp = ($this->tax->id) ? (_JSHOP_EDIT_TAX_EXT) : (_JSHOP_NEW_TAX_EXT), 'generic.png' ); 
        JToolBarHelper::save();
        JToolBarHelper::spacer();
        JToolBarHelper::apply();
        JToolBarHelper::spacer();
        JToolBarHelper::cancel();
        
        parent::display($tpl);
	}
}
?>