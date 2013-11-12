<?php
include(JPATH_COMPONENT_ADMINISTRATOR."/views/otherpanel/tmpl/submenu.php");
$manufacturers = $this->rows;
$count = count($manufacturers);
$i = 0;
?>
<form action = "index.php?option=com_jshopping&controller=manufacturers" method = "post" name = "adminForm">
<table class = "adminlist">
<thead>
  <tr>
    <th class = "title" width  = "10">
      #
    </th>
    <th width = "20">
      <input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo $count = count( $manufacturers );?>);" />
    </th>
    <th align = "left">
      <?php echo _JSHOP_TITLE; ?>
    </th>
    <th colspan = "3" width = "40">
      <?php echo _JSHOP_ORDERING; ?>
      <a class="saveorder" href="javascript:saveorder(<?php echo ($count-1);?>, 'saveorder')" title="Save Order"></a>
    </th>
    <th width = "50">
      <?php echo _JSHOP_PUBLISH;?>
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
 foreach($manufacturers as $man){
  ?>
  <tr class = "row<?php echo $i % 2;?>">
   <td>
     <?php echo $i+1;?>
   </td>
   <td>
     <input type = "checkbox" onclick = "isChecked(this.checked)" name = "cid[]" id = "cb<?php echo $i;?>" value = "<?php echo $man->manufacturer_id?>" />
   </td>
   <td>
     <a href = "index.php?option=com_jshopping&controller=manufacturers&task=edit&man_id=<?php echo $man->manufacturer_id; ?>"><?php echo $man->name;?></a>
   </td>
   <td align = "right" width = "20">
    <?php
        if ($i != 0) echo '<a href = "index.php?option=com_jshopping&controller=manufacturers&task=order&id='.$man->manufacturer_id.'&move=-1"><img alt="'._JSHOP_UP.'" src="components/com_jshopping/images/uparrow.png"/></a>';
    ?>
   </td>
   <td align = "left" width = "20">
    <?php
        if ($i != $count - 1) echo '<a href = "index.php?option=com_jshopping&controller=manufacturers&task=order&id='.$man->manufacturer_id.'&move=1"><img alt="'._JSHOP_DOWN.'" src="components/com_jshopping/images/downarrow.png"/></a>';
    ?>
   </td>
   <td align = "center" width = "10">
    <input type="text" name="order[]" id = "ord<?php echo $man->manufacturer_id;?>"  size="5" value="<?php echo $man->ordering; ?>" <?php echo $disabled ?> class="text_area" style="text-align: center" />    
   </td>
   <td align="center">
     <?php
       echo $published = ($man->manufacturer_publish) ? ('<a href = "javascript:void(0)" onclick = "return listItemTask(\'cb' . $i . '\', \'unpublish\')"><img src="components/com_jshopping/images/tick.png" title = "'._JSHOP_PUBLISH.'" ></a>') : ('<a href = "javascript:void(0)" onclick = "return listItemTask(\'cb' . $i . '\', \'publish\')"><img title = "'._JSHOP_UNPUBLISH.'" src="components/com_jshopping/images/publish_x.png"></a>');
     ?>
   </td>
   <td align="center">
        <a href='index.php?option=com_jshopping&controller=manufacturers&task=edit&man_id=<?php print $man->manufacturer_id?>'><img src='components/com_jshopping/images/icon-16-edit.png'></a>
   </td>
   <td align="center">
    <?php print $man->manufacturer_id;?>
   </td>
   </tr>
<?php
    $i++;
 }
?>
</table>

<input type = "hidden" name = "task" value = "" />
<input type = "hidden" name = "hidemainmenu" value = "0" />
<input type = "hidden" name = "boxchecked" value = "0" />
</form>