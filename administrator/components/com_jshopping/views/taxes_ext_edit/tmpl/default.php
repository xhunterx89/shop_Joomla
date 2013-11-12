<?php
$row = $this->tax;
$edit = $this->edit;
JHTML::_('behavior.tooltip');
?>
<form action = "index.php?option=com_jshopping&controller=exttaxes&back_tax_id=<?php print $this->back_tax_id;?>" method = "post"name = "adminForm">

<div class="col100">
<fieldset class="adminform">
<table width = "100%" class="admintable">
   <tr>
     <td class="key" style="width:250px;">
       <?php echo _JSHOP_TITLE; ?>
     </td>
     <td>
       <?php print $this->lists['taxes'];?>
     </td>
   </tr>
   <tr>
    <td class="key">
        <?php echo _JSHOP_COUNTRY . "<br/><br/><span style='font-weight:normal'>"._JSHOP_MULTISELECT_INFO."</span>"; ?>
    </td>
    <td>
        <?php echo $this->lists['countries'];?>
    </td>
   </tr>
   <tr>
     <td  class="key">
       <?php echo _JSHOP_TAX; ?>
     </td>
     <td>
       <input type = "text" class = "inputbox" name = "tax" value = "<?php echo $row->tax;?>" /> %
       <?php echo JHTML::tooltip(_JSHOP_VALUE_TAX_INFO);?>
     </td>
   </tr>
   <tr>
     <td class="key">
       <?php echo _JSHOP_FIRMA_TAX; ?>
     </td>
     <td>
       <input type = "text" class = "inputbox" name = "firma_tax" value = "<?php echo $row->firma_tax;?>" /> %
       <?php echo JHTML::tooltip(_JSHOP_VALUE_TAX_INFO);?>
     </td>
   </tr>
   
 </table>
</fieldset>
</div>
<div class="clr"></div>

<input type = "hidden" name = "task" value = "" />
<input type = "hidden" name = "id" value = "<?php echo $row->id?>" />
</form>