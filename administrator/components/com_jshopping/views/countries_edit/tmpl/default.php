<?php
$row = $this->country;
$lists = $this->lists;
$edit = $this->edit;
?>
<form action = "index.php?option=com_jshopping&controller=countries" method = "post"name = "adminForm">

<div class="col100">
<fieldset class="adminform">
    <table class="admintable" width = "100%" >
   <tr>
     <td class="key" width = "30%">
       <?php echo _JSHOP_PUBLISH; ?>
     </td>
     <td>
       <input type = "checkbox" name = "country_publish" value = "1" <?php if ($row->country_publish) echo 'checked = "checked"'?> />
     </td>
   </tr>
   <tr>
     <td class="key">
       <?php echo _JSHOP_ORDERING; ?>
     </td>
     <td id = "ordering">
       <?php echo $lists['order_countries']?>
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
       <input type = "text" class = "inputbox" id = "name_<?php print $lang->language;?>" name = "name_<?php print $lang->language;?>" value = "<?php echo $row->$field;?>" />
     </td>
   </tr>
   <?php }?>
   <tr>
     <td class="key">
       <?php echo _JSHOP_CODE; ?>
     </td>
     <td>
       <input type = "text" class = "inputbox" id = "country_code" name = "country_code" value = "<?php echo $row->country_code;?>" />
     </td>
   </tr>
   <tr>
     <td class="key">
       <?php echo _JSHOP_CODE; ?> 2
     </td>
     <td>
       <input type = "text" class = "inputbox" id = "country_code_2" name = "country_code_2" value = "<?php echo $row->country_code_2;?>" />
     </td>
   </tr>
 </table>
</fieldset>
</div>
<div class="clr"></div>

<input type = "hidden" name = "task" value = "<?php echo JRequest::getVar('task')?>" />
<input type = "hidden" name = "edit" value = "<?php echo $edit;?>" />
<?php if ($edit) {?>
  <input type = "hidden" name = "country_id" value = "<?php echo $row->country_id?>" />
<?php }?>
</form>