<?php
$row = $this->row;
JHTML::_('behavior.tooltip');
?>
<form action = "index.php?option=com_jshopping&controller=configdisplayprice" method = "post"name = "adminForm">

<div class="col100">
<fieldset class="adminform">
<table width = "100%" class="admintable">
   <tr>
    <td class="key" style="width:250px;">
        <?php echo _JSHOP_COUNTRY . "<br/><br/><span style='font-weight:normal'>"._JSHOP_MULTISELECT_INFO."</span>"; ?>
    </td>
    <td>
        <?php echo $this->lists['countries'];?>
    </td>
   </tr>
   <tr>
     <td  class="key">
       <?php echo _JSHOP_DISPLAY_PRICE; ?>
     </td>
     <td>
       <?php echo $this->lists['display_price'];?>
     </td>
   </tr>
   <tr>
     <td class="key">
       <?php echo _JSHOP_DISPLAY_PRICE_FOR_FIRMA; ?>
     </td>
     <td>
       <?php echo $this->lists['display_price_firma'];?>
     </td>
   </tr>
   
 </table>
</fieldset>
</div>
<div class="clr"></div>

<input type = "hidden" name = "task" value = "" />
<input type = "hidden" name = "id" value = "<?php echo $row->id?>" />
</form>