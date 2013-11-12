<?php $attr_id = $this->attr_id; ?>
<form action = "index.php?option=com_jshopping&controller=attributesvalues&attr_id=<?php echo $attr_id?>" method = "post" name = "adminForm" enctype = "multipart/form-data">

<div class="col100">
<fieldset class="adminform">
<table class="admintable" width = "100%" >
    <?php 
    foreach($this->languages as $lang){
    $field = "name_".$lang->language;
    ?>
     <tr>
       <td class="key">
         <?php echo _JSHOP_NAME_ATTRIBUT_VALUE;?> <?php if ($this->multilang) print "(".$lang->lang.")";?> 
       </td>
       <td>
         <input type = "text" class = "inputbox" name = "<?php print $field?>" value = "<?php echo $this->attributValue->$field?>" />
       </td>
     </tr>
  <?php } ?>
  <tr>
    <td class="key"><?php print _JSHOP_IMAGE_ATTRIBUT_VALUE?></td>
    <td>
    <?php if ($this->attributValue->image) {?>
    <div id="image_attrib_value">
        <div><img src = "<?php echo $this->config->image_attributes_live_path."/".$this->attributValue->image?>" alt = ""/></div>
        <div style="padding-bottom:5px;" class="link_delete_foto"><a href="#" onclick="if (confirm('<?php print _JSHOP_DELETE_IMAGE;?>')) deleteFotoAttribValue('<?php echo $this->attributValue->value_id?>');return false;"><img src="images/publish_x.png"> <?php print _JSHOP_DELETE_IMAGE;?></a></div>
    </div>
    <?php }?>    
    <input type = "file" name = "image" />
    </td>
</table>
</fieldset>
</div>
<div class="clr"></div>

<input type = "hidden" name = "old_image" value = "<?php print $this->attributValue->image;?>" />
<input type = "hidden" name = "task" value = "" />
<input type = "hidden" name = "hidemainmenu" value = "0" />
<input type = "hidden" name = "value_id" value = "<?php echo $this->attributValue->value_id;?>" />
<input type = "hidden" name = "attr_id" value = "<?php echo $attr_id;?>" />
</form>