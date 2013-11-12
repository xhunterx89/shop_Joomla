<?php
include(JPATH_COMPONENT_ADMINISTRATOR."/views/otherpanel/tmpl/submenu.php");

$taxes = $this->rows;
$i = 0;
?>
<form action = "index.php?option=com_jshopping&controller=exttaxes&back_tax_id=<?php print $this->back_tax_id;?>" method = "post" name = "adminForm">
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
    <th>
        <?php echo _JSHOP_COUNTRY; ?>
    </th>
    <th width = "60">
        <?php echo _JSHOP_TAX; ?>
    </th>
    <th width = "60">
        <?php echo _JSHOP_FIRMA_TAX; ?>
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
     <input type = "checkbox" onclick = "isChecked(this.checked)" name = "cid[]" id = "cb<?php echo $i++;?>" value = "<?php echo $tax->id?>" />
   </td>
   <td>
     <?php echo $tax->tax_name;?></a>
   </td>
   <td>
    <?php echo $tax->countries;?></a>
   </td>
   <td>
    <?php echo $tax->tax;?> %</a>
   </td>
   <td>
    <?php echo $tax->firma_tax;?> %</a>
   </td>
   <td align="center">
        <?php print "<a href='index.php?option=com_jshopping&controller=exttaxes&task=edit&id=".$tax->id."&back_tax_id=".$this->back_tax_id."'><img src='components/com_jshopping/images/icon-16-edit.png'></a>"?>
   </td>
   <td align="center">
        <?php print $tax->id;?>
   </td>
  </tr>
  <?php
}
?>
</table>

<input type = "hidden" name = "task" value = "" />
<input type = "hidden" name = "hidemainmenu" value = "0" />
<input type = "hidden" name = "boxchecked" value = "0" />
</form>