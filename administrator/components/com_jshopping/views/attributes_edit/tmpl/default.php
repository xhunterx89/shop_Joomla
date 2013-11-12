<?php JHTML::_('behavior.tooltip');?>
<div class="jshop_edit">
<form action = "index.php?option=com_jshopping&controller=attributes" method = "post" name = "adminForm">

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
            <?php echo _JSHOP_TYPE_ATTRIBUT;?>
        </td>
        <td>
            <?php echo $this->type_attribut;?>
            <?php echo JHTML::tooltip(_JSHOP_INFO_TYPE_ATTRIBUT);?>
        </td>
    </tr>
    
    <tr>
        <td class="key">
            <?php echo _JSHOP_DEPENDENT;?>
        </td>
        <td>
             <?php echo $this->dependent_attribut;?>
             <?php echo JHTML::tooltip(_JSHOP_INFO_DEPENDENT_ATTRIBUT);?>
        </td>
    </tr>
</table>
</fieldset>
</div>
<div class="clr"></div>

<input type = "hidden" name = "task" value = "" />
<input type = "hidden" name = "hidemainmenu" value = "0" />
<input type = "hidden" name = "attr_id" value = "<?php echo $this->attribut->attr_id?>" />
</form>
</div>