<?php
$row = $this->payment;
$edit = $this->edit;
$params = $this->params;
$lists = $this->lists;
?>
<div class="jshop_edit">
<form action = "index.php?option=com_jshopping&controller=payments" method = "post"name = "adminForm">
<?php
jimport('joomla.html.pane');
$pane =& JPane::getInstance('Tabs');
echo $pane->startPane('myPane');
echo $pane->startPanel(_JSHOP_PAYMENT_GENERAL, 'first-tab');
JHTML::_('behavior.tooltip');
?>
<div class="col100">
<fieldset class="adminform">
    <table class="admintable" width = "100%" >
   <tr>
     <td class="key" width = "30%">
       <?php echo _JSHOP_PUBLISH; ?>
     </td>
     <td>
       <input type = "checkbox" name = "payment_publish" value = "1" <?php if ($row->payment_publish) echo 'checked = "checked"'?> />
     </td>
   </tr>
   <tr>
     <td class="key">
       <?php echo _JSHOP_CODE; ?>
     </td>
     <td>
       <input type = "text" class = "inputbox" id = "payment_code" name = "payment_code" value = "<?php echo $row->payment_code;?>" />
     </td>
   </tr>
   <?php
   foreach($this->languages as $lang){
   $field = "name_".$lang->language;
   ?>
   <tr>
     <td class="key">
       <?php echo _JSHOP_TITLE; ?> <?php if ($this->multilang) print "(".$lang->lang.")";?>
     </td>
     <td>
       <input type = "text" class = "inputbox" id = "<?php print $field?>" name = "<?php print $field?>" value = "<?php echo $row->$field;?>" />
     </td>
   </tr>
   <?php }?>
   <tr>
     <td class="key">
       <?php
          echo _JSHOP_ALIAS;          
       ?>
     </td>
     <td>
       <input type = "text" class = "inputbox" id = "payment_class" name = "payment_class" value = "<?php echo $row->payment_class;?>" />
       <?php echo JHTML::tooltip(_JSHOP_ALIAS_PAYMENT_INFO, _JSHOP_HINT);?>
     </td>
   </tr>
   <tr>
     <td class="key">
       <?php echo _JSHOP_TYPE_PAYMENT;?>
     </td>
     <td>
       <?php echo $lists['type_payment'];?>
     </td>
   </tr>
   <?php if (!$this->withouttax){?>
   <tr>
     <td class="key">
       <?php echo _JSHOP_SELECT_TAX;?>
     </td>
     <td>
       <?php echo $lists['tax'];?>
     </td>
   </tr>   
   <?php }?>
   <tr>
     <td class="key">
       <?php echo _JSHOP_PRICE;?>
     </td>
     <td>
       <input type = "text" class = "inputbox" name = "price" value = "<?php echo $row->price;?>" />
       <?php echo $lists['price_type'];?>
     </td>
   </tr>
   <?php
   foreach($this->languages as $lang){
   $field = "description_".$lang->language;
   ?>
   <tr>
     <td class="key">
       <?php echo _JSHOP_DESCRIPTION; ?> <?php if ($this->multilang) print "(".$lang->lang.")";?>
     </td>
     <td>
       <?php                 
         $editor = &JFactory::getEditor();
         print $editor->display("description".$lang->id,  $row->$field , '100%', '350', '75', '20' ) ;
       ?>
     </td>
   </tr>
   <?php }?>
   <tr>
     <td class="key">
       <?php echo _JSHOP_SHOW_DESCR_IN_EMAIL;?>
     </td>
     <td>
       <input type = "checkbox" name = "show_descr_in_email" value = "1" <?php if ($row->show_descr_in_email) echo 'checked = "checked"'?> />
     </td>
   </tr> 
 </table>
</fieldset>
</div>
<div class="clr"></div>
<?php
	echo $pane->endPanel();
	if ($lists['html']!=""){
	   	echo $pane->startPanel(_JSHOP_PAYMENT_CONFIG, 'second-tab');
	   	echo $lists['html'];
	  	echo $pane->endPanel();
  	}
   	echo $pane->endPane();
?>

<input type = "hidden" name = "task" value = "<?php echo JRequest::getVar('task')?>" />
<input type = "hidden" name = "edit" value = "<?php echo $edit;?>" />
<?php if ($edit) {?>
  <input type = "hidden" name = "payment_id" value = "<?php echo $row->payment_id?>" />
<?php }?>
</form>
</div>