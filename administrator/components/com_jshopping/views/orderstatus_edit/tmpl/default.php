<?php $row = $this->order_status; $edit = $this->edit; ?>
<form action = "index.php?option=com_jshopping&controller=orderstatus" method = "post" name = "adminForm">
<div class="col100">
<fieldset class="adminform">
<table class="admintable" width = "100%" >
   <?php
   foreach($this->languages as $lang){
   $field = "name_".$lang->language;
   ?>
   <tr>
     <td class="key">
       <?php echo _JSHOP_TITLE; ?> <?php if ($this->multilang) print "(".$lang->lang.")";?>
     </td>
     <td>
       <input type = "text" class = "inputbox" id = "<?php print $field;?>" name = "<?php print $field;?>" value = "<?php echo $row->$field;?>" />
     </td>
   </tr>
   <?php }?>
   <tr>
     <td class="key">
       <?php echo _JSHOP_CODE;?>
     </td>
     <td>
       <input type = "text" class = "inputbox" id = "status_code" name = "status_code" value = "<?php echo $row->status_code;?>" />
     </td>
   </tr>
</table>
</fieldset>
</div>
<div class="clr"></div>
 
<input type = "hidden" name = "task" value = "<?php echo JRequest::getVar('task')?>" />
<input type = "hidden" name = "edit" value = "<?php echo $edit;?>" />
<?php if ($edit) {?>
  <input type = "hidden" name = "status_id" value = "<?php echo $row->status_id?>" />
<?php }?>
</form>