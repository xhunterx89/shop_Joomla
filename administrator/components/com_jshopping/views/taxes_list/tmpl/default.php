<?php
include(JPATH_COMPONENT_ADMINISTRATOR."/views/otherpanel/tmpl/submenu.php");

$taxes = $this->rows;
$i = 0;
?>
<form action = "index.php?option=com_jshopping&controller=taxes" method = "post" name = "adminForm">
<table class = "adminlist">
<thead>
  <tr>
    <th class = "title" width  = "10">
      #
    </th>
    <th width = "20">
      <input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo $count = count( $taxes );?>);" />
    </th>
    <th align = "left">
      <?php echo _JSHOP_TITLE; ?>
    </th>
    <th width = "150">
        <?php echo _JSHOP_EXTENDED_RULE_TAX; ?>
    </th>
    <th width = "50">
        <?php echo _JSHOP_EDIT; ?>
    </th>
    <th width = "40">
        <?php echo _JSHOP_ID; ?>
    </th>
  </tr>
</thead>  
<?php
 foreach($taxes as $tax){
  ?>
  <tr class = "row<?php echo $i % 2;?>">
   <td>
     <?php echo $i+1;?>
   </td>
   <td>
     <input type = "checkbox" onclick = "isChecked(this.checked)" name = "cid[]" id = "cb<?php echo $i++;?>" value = "<?php echo $tax->tax_id?>" />
   </td>
   <td>
     <a href = "index.php?option=com_jshopping&controller=taxes&task=edit&tax_id=<?php echo $tax->tax_id; ?>"><?php echo $tax->tax_name;?></a> (<?php echo $tax->tax_value;?> %)
   </td>
   <td>
    <a href="index.php?option=com_jshopping&controller=exttaxes&back_tax_id=<?php echo $tax->tax_id; ?>"><?php echo _JSHOP_EXTENDED_RULE_TAX; ?></a>
   </td>
   <td align="center">
        <?php print "<a href='index.php?option=com_jshopping&controller=taxes&task=edit&tax_id=".$tax->tax_id."'><img src='components/com_jshopping/images/icon-16-edit.png'></a>"?>
   </td>
   <td align="center">
        <?php print $tax->tax_id;?>
   </td>
  </tr>
  <?php
}
?>
</table>

<input type = "hidden" name = "task" value = "<?php echo JRequest::getVar('task')?>" />
<input type = "hidden" name = "hidemainmenu" value = "0" />
<input type = "hidden" name = "boxchecked" value = "0" />
</form>