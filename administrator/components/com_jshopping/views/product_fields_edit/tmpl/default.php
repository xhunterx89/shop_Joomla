<?php
$row = $this->row;
JHTML::_('behavior.tooltip');
?>
<div class="jshop_edit">
<form action = "index.php?option=com_jshopping&controller=productfields" method = "post"name = "adminForm">

<div class="col100">
<fieldset class="adminform">
<table width = "100%" class="admintable">
   <?php 
    foreach($this->languages as $lang){
    $field = "name_".$lang->language;
    ?>
       <tr>
         <td class="key" style="width:250px;">
               <?php echo _JSHOP_TITLE; ?> <?php if ($this->multilang) print "(".$lang->lang.")";?>
         </td>
         <td>
               <input type = "text" class = "inputbox" id = "<?php print $field?>" name = "<?php print $field?>" value = "<?php echo $row->$field;?>" />
         </td>
       </tr>
    <?php }?>
    <tr>
     <td  class="key">
       <?php echo _JSHOP_SHOW_FOR_CATEGORY; ?>
     </td>
     <td>
       <?php echo $this->lists['allcats'];?>
     </td>
   </tr>
   <tr id="tr_categorys" <?php if ($row->allcats=="1") print "style='display:none;'";?>>
     <td  class="key">
       <?php echo _JSHOP_CATEGORIES; ?>
     </td>
     <td>
       <?php echo $this->lists['categories'];?>
     </td>
   </tr>
 </table>
</fieldset>
</div>
<div class="clr"></div>

<input type = "hidden" name = "task" value = "" />
<input type = "hidden" name = "id" value = "<?php echo $row->id?>" />
</form>
</div>