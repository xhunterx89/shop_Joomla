<form action = "index.php?option=com_jshopping&controller=freeattributes" method = "post" name = "adminForm">

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
         <input type = "text" class = "inputbox" name = "<?php print $field?>" value = "<?php echo $this->attribut->$field?>" />
       </td>
     </tr>
  <?php } ?>
    <tr>
       <td class="key">
         <?php echo _JSHOP_REQUIRED;?>
       </td>
       <td>
         <input type="checkbox" name="required" value="1" <?php if ($this->attribut->required) print "checked";?> />
       </td>
    </tr>
</table>
</fieldset>
</div>
<div class="clr"></div>

<input type = "hidden" name = "task" value = "" />
<input type = "hidden" name = "hidemainmenu" value = "0" />
<input type = "hidden" name = "id" value = "<?php echo $this->attribut->id?>" />
</form>