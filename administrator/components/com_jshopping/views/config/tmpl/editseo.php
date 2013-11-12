<?php
$jshopConfig = &JSFactory::getConfig();
JHTML::_('behavior.tooltip');
$lists = $this->lists;
include(dirname(__FILE__)."/submenu.php");
?>
<form action = "index.php?option=com_jshopping&controller=config" method = "post" name = "adminForm" enctype = "multipart/form-data">
<input type="hidden" name="task" value="">
<input type="hidden" name="id" value="<?php print $this->row->id?>">

<div class="col100">
<fieldset class="adminform">
    <legend><?php if (defined("_JSHP_SEOPAGE_".$this->row->alias)) print constant("_JSHP_SEOPAGE_".$this->row->alias); else print $this->row->alias;?></legend>
<table class="admintable">
<?php if (!$this->row->id){?>
<tr>
   <td class="key" style="width:220px;">
     <?php echo _JSHOP_ALIAS; ?>
   </td>
   <td>
     <input type = "text" class = "inputbox" name = "alias" size="40" value = "<?php echo $this->row->alias?>" />
   </td>
</tr>
    <?php if ($this->multilang){?>
    <tr><td>&nbsp;</td></tr>
    <?php
    }
}
foreach($this->languages as $lang){
$field = "title_".$lang->language;
?>
<tr>
   <td class="key" >
     <?php echo _JSHOP_META_TITLE; ?> <?php if ($this->multilang) print "(".$lang->lang.")";?> 
   </td>
   <td>
     <input type = "text" class = "inputbox" name = "<?php print $field?>" size="80" value = "<?php echo $this->row->$field?>" />
   </td>
</tr>
<?php }
if ($this->multilang){?>
<tr><td>&nbsp;</td></tr>
<?php     
}
foreach($this->languages as $lang){
$field = "keyword_".$lang->language;
?>
 <tr>
   <td class="key">
     <?php echo _JSHOP_META_KEYWORDS; ?> <?php if ($this->multilang) print "(".$lang->lang.")";?> 
   </td>
   <td>
    <textarea name="<?php print $field?>" cols="60" rows="3"><?php echo $this->row->$field?></textarea>
   </td>
 </tr>
<?php }
if ($this->multilang){?>
<tr><td>&nbsp;</td></tr>
<?php
}
foreach($this->languages as $lang){
$field = "description_".$lang->language;
?>
 <tr>
   <td class="key">
     <?php echo _JSHOP_META_DESCRIPTION; ?> <?php if ($this->multilang) print "(".$lang->lang.")";?> 
   </td>
   <td>
     <textarea name="<?php print $field?>" cols="60" rows="3"><?php echo $this->row->$field?></textarea>
   </td>
 </tr>
<?php } ?>

    
</table>
</fieldset>
</div>
<div class="clr"></div>
</form>