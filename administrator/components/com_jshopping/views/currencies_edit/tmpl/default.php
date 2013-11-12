<?php
$row = $this->currency;
$lists = $this->lists;
$edit = $this->edit;
?>
<form action = "index.php?option=com_jshopping&controller=currencies" method = "post"name = "adminForm">

<div class="col100">
<fieldset class="adminform">
    <table class="admintable" width = "100%" >
   <tr>
     <td class="key" width = "30%">
       <?php echo _JSHOP_PUBLISH;?>
     </td>
     <td>
       <input type = "checkbox" name = "currency_publish" value = "1" <?php if ($row->currency_publish) echo 'checked = "checked"'?> />
     </td>
   </tr>
   <tr>
     <td  class="key">
       <?php echo _JSHOP_ORDERING; ?>
     </td>
     <td id = "ordering">
       <?php echo $lists['order_currencies']?>
     </td>
   </tr>
   <tr>
     <td  class="key">
       <?php echo _JSHOP_TITLE; ?>
     </td>
     <td>
       <input type = "text" class = "inputbox" id = "currency_name" name = "currency_name" value = "<?php echo $row->currency_name;?>" />
     </td>
   </tr>
   <tr>
     <td  class="key">
       <?php echo _JSHOP_CODE; ?>
     </td>
     <td>
       <input type = "text" class = "inputbox" id = "currency_code" name = "currency_code" value = "<?php echo $row->currency_code;?>" />
     </td>
   </tr>
   <tr>
     <td  class="key">
       <?php echo _JSHOP_CODE." (ISO)"; ?>
     </td>
     <td>
       <input type = "text" class = "inputbox" name = "currency_code_iso" value = "<?php echo $row->currency_code_iso;?>" />
     </td>
   </tr>
   <tr>
     <td  class="key">
       <?php echo _JSHOP_VALUE_CURRENCY;?>
     </td>
     <td>
       <input type = "text" class = "inputbox" id = "currency_value" name = "currency_value" value = "<?php echo $row->currency_value;?>" />
     </td>
   </tr>
 </table>
</fieldset>
</div>
<div class="clr"></div>

<input type = "hidden" name = "task" value = "<?php echo JRequest::getVar('task')?>" />
<input type = "hidden" name = "edit" value = "<?php echo $edit;?>" />
<?php if ($edit) {?>
  <input type = "hidden" name = "currency_id" value = "<?php echo $row->currency_id?>" />
<?php }?>
</form>