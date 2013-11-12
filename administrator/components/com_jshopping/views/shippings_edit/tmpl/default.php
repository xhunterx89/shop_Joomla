<?php $row = $this->shipping; $edit = $this->edit; JHTML::_('behavior.tooltip');
?>
<form action = "index.php?option=com_jshopping&controller=shippings" method = "post" name = "adminForm">

<div class="col100">
<fieldset class="adminform">
    <table class="admintable" width = "100%" >
   	<tr>
     	<td class="key" width = "30%">
       		<?php echo _JSHOP_PUBLISH;?>
     	</td>
     	<td>
       		<input type = "checkbox" name = "shipping_publish" value = "1" <?php if ($row->shipping_publish) echo 'checked = "checked"'?> />
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
                print $editor->display('description'.$lang->id,  $row->$field , '100%', '350', '75', '20' ) ;
       		?>
     	</td>
   	</tr>
    <?php }?>
</table>
</fieldset>
</div>
<div class="clr"></div>

<input type = "hidden" name = "task" value = "<?php echo JRequest::getVar('task')?>" />
<input type = "hidden" name = "edit" value = "<?php echo $edit;?>" />
<?php if ($edit) {?>
  <input type = "hidden" name = "shipping_id" value = "<?php echo $row->shipping_id?>" />
<?php }?>
</form>