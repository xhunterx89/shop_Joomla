<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewOrders_list extends JView
{
    function display($tpl = null){
        
        JToolBarHelper::title( _JSHOP_ORDER_LIST, 'generic.png' );
        JToolBarHelper::deleteList();
        
        parent::display($tpl);
	}
}
?>