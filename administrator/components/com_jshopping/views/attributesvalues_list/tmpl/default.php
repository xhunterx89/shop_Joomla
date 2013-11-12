<?php
include(JPATH_COMPONENT_ADMINISTRATOR."/views/otherpanel/tmpl/submenu.php");

$rows = $this->rows;
$attr_id = $this->attr_id;
$attr_name = $this->attr_name;
$count = count ($rows);
$i = 0;
?>

<form action = "index.php?option=com_jshopping&controller=attributesvalues&attr_id=<?php echo $attr_id?>" method = "post" name = "adminForm">

<table class = "adminlist">
<thead>
  <tr>
    <th class = "title" width  = "10">
      #
    </th>
    <th width = "20">
	  <input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo $count;?>);" />
    </th>
    <th width = "200" align = "left">
      <?php echo _JSHOP_NAME_ATTRIBUT_VALUE;?>
    </th>
    <th align = "left">
      <?php echo _JSHOP_IMAGE_ATTRIBUT_VALUE;?>
    </th>
    <th colspan = "2" width = "40">
    	<?php echo _JSHOP_ORDERING;?>
    </th>
	<th width = "50">
        <?php echo _JSHOP_EDIT;?>
    </th>
    <th width = "40">
        <?php echo _JSHOP_ID;?>
    </th>
  </tr>
</thead>
<?php
 foreach ($rows as $row){
 ?>
  <tr class = "row<?php echo $i % 2;?>">
   <td>
     <?php echo $i + 1;?>
   </td>
   <td>
     <input type = "checkbox" onclick = "isChecked(this.checked)" name = "cid[]" id = "cb<?php echo $i;?>" value = "<?php echo $row->value_id?>" />
   </td>
   <td>
     <a href = "index.php?option=com_jshopping&controller=attributesvalues&task=edit&value_id=<?php echo $row->value_id; ?>&attr_id=<?php echo $attr_id?>"><?php echo $row->name;?></a>
   </td>
   <td>
     <?php if ($row->image) {?>
       <img src = "<?php echo $this->config->image_attributes_live_path."/".$row->image?>"  alt = "" width="20" height="20" />
     <?php }?>
   </td>
   <td align = "right" width = "20">
    <?php
      if ($i != 0) echo '<a href = "index.php?option=com_jshopping&controller=attributesvalues&task=order&id=' . $row->value_id . '&order=up&number=' . $row->value_ordering . '&attr_id=' . $attr_id . '"><img alt="' . _JSHOP_UP . '" src="components/com_jshopping/images/uparrow.png"/></a>';
    ?>
   </td>
   <td align = "left" width = "20">
      <?php
        if ($i++ != $count - 1) echo '<a href = "index.php?option=com_jshopping&controller=attributesvalues&task=order&id=' . $row->value_id . '&order=down&number=' . $row->value_ordering . '&attr_id=' . $attr_id . '"><img alt="' . _JSHOP_DOWN . '" src="components/com_jshopping/images/downarrow.png"/></a>';
      ?>
   </td>
   <td align="center">
        <a href="index.php?option=com_jshopping&controller=attributesvalues&task=edit&value_id=<?php echo $row->value_id; ?>&attr_id=<?php echo $attr_id?>"><img src='components/com_jshopping/images/icon-16-edit.png'></a>
   </td>
   <td align="center">
    <?php print $row->value_id;?>
   </td>
 <?php
 }
?>
</table>

<input type = "hidden" name = "task" value = "" />
<input type = "hidden" name = "hidemainmenu" value = "0" />
<input type = "hidden" name = "boxchecked" value = "0" />
</form>