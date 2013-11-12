<?php 
include(JPATH_COMPONENT_ADMINISTRATOR."/views/otherpanel/tmpl/submenu.php");
$rows = $this->rows; $count = count ($rows); $i = 0; 
?>
<form action = "index.php?option=com_jshopping&controller=attributes" method = "post" name = "adminForm">
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
      <?php echo _JSHOP_TITLE; ?>
    </th>
    <th align = "left">
      <?php echo _JSHOP_OPTIONS; ?>
    </th>
    <th colspan = "2" width = "40">
      <?php echo _JSHOP_ORDERING; ?>
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
 $count = count($rows);
 foreach ($rows as $row){
 ?>
  <tr class = "row<?php echo $i % 2;?>">
   <td>
     <?php echo $i + 1;?>
   </td>
   <td>
     <input type = "checkbox" onclick = "isChecked(this.checked)" name = "cid[]" id = "cb<?php echo $i;?>" value = "<?php echo $row->attr_id?>" />
   </td>
   <td>
    <?php if (!$row->count_values) {?><img src="components/com_jshopping/images/disabled.png" alt="" /><?php }?>
     <a href = "index.php?option=com_jshopping&controller=attributes&task=edit&attr_id=<?php echo $row->attr_id; ?>"><?php echo $row->name;?></a>
   </td>
   <td>
     <a href = "index.php?option=com_jshopping&controller=attributesvalues&task=show&attr_id=<?php echo $row->attr_id?>"><?php echo _JSHOP_OPTIONS?></a>
     <?php echo $row->values;?>
   </td>
   <td align = "right" width = "20">
   <?php
        if ($i != 0) echo '<a href = "index.php?option=com_jshopping&controller=attributes&task=order&id=' . $row->attr_id . '&order=up&number=' . $row->attr_ordering . '"><img alt="' . _JSHOP_UP . '" src="components/com_jshopping/images/uparrow.png"/></a>';
   ?>
   </td>
   <td align = "left" width = "20">
   <?php
        if ($i++ != $count - 1) echo '<a href = "index.php?option=com_jshopping&controller=attributes&task=order&id=' . $row->attr_id . '&order=down&number=' . $row->attr_ordering . '"><img alt="' . _JSHOP_DOWN . '" src="components/com_jshopping/images/downarrow.png"/></a>';
   ?>
   </td>
   <td align="center">
        <a href='index.php?option=com_jshopping&controller=attributes&task=edit&attr_id=<?php print $row->attr_id;?>'><img src='components/com_jshopping/images/icon-16-edit.png'></a>
   </td>
   <td align="center">
    <?php print $row->attr_id;?>
   </td>
  </tr>
 <?php
 }
?>
</table>

<input type = "hidden" name = "task" value = "<?php echo JRequest::getVar('task', 0)?>" />
<input type = "hidden" name = "hidemainmenu" value = "0" />
<input type = "hidden" name = "boxchecked" value = "0" />
</form>