<?php
$jshopConfig = &JSFactory::getConfig();
JHTML::_('behavior.tooltip');
$lists = $this->lists;
include(dirname(__FILE__)."/submenu.php");
$editor = &JFactory::getEditor();
?>
<form action = "index.php?option=com_jshopping&controller=config" method = "post" name = "adminForm" enctype = "multipart/form-data">
<input type="hidden" name="task" value="">
<input type="hidden" name="id" value="<?php print $this->row->id?>">

<div class="col100">
<fieldset class="adminform">
    <legend><?php if (defined("_JSHP_STPAGE_".$this->row->alias)) print constant("_JSHP_STPAGE_".$this->row->alias); else print $this->row->alias;?></legend>
<table class="admintable" width = "100%">
<?php if (!$this->row->id){?>
<tr>
   <td class="key" style="width:220px;">
     <?php echo _JSHOP_ALIAS; ?>
   </td>
   <td>
     <input type = "text" class = "inputbox" name = "alias" size="40" value = "<?php echo $this->row->alias?>" />
   </td>
</tr>
<?php }
foreach($this->languages as $lang){
$field = "text_".$lang->language;
?>
<tr>
   <td class="key" >
     <?php echo _JSHOP_DESCRIPTION; ?> <?php if ($this->multilang) print "(".$lang->lang.")";?>
     <div style="font-size:10px;"><?php if (defined("_JSHP_STPAGE_INFO_".$this->row->alias)) print constant("_JSHP_STPAGE_INFO_".$this->row->alias);?></div>
   </td>
   <td>
     <?php print $editor->display( 'text'.$lang->id,  $this->row->$field , '100%', '350', '75', '20' ); ?>
   </td>
</tr>
<?php } ?>    
</table>
</fieldset>
</div>
<div class="clr"></div>
</form>