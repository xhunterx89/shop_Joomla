<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewOrders_edit extends JView
{
    function display($tpl = null){
        JToolBarHelper::save();       
        parent::display($tpl);
	}
}
?>