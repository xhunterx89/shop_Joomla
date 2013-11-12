<?php
/**
* @package Joomla
* @author Dmitry Stashenko
* @website http://nevigen.eu/
* @email support@nevigen.eu
* @copyright Copyright by Nevigen Ltd. All rights reserved.
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
**/

defined( '_JEXEC' ) or die;

class JFormFieldLabel extends JFormField {

  public $type ='Label';
  
  protected function getInput(){
        require_once (JPATH_SITE.'/modules/mod_jshopping_random_products/helper.php'); 
        $tmp = new stdClass();
        $tmp->id = "";
        $tmp->name = JText::_('JALL');
        $element_1  = array($tmp);
        $productLabel = &JTable::getInstance('productLabel', 'jshop');
        $listLabels = $productLabel->getListLabels();
        $elementes_select =array_merge($element_1 , $listLabels); 
        $ctrl  =  $this->name ;  
        $value        = empty($this->value) ? '' : $this->value; 
        
        return JHTML::_('select.genericlist', $elementes_select, $ctrl,'class="inputbox"','id', 'name', $value );
  }
}
?>
