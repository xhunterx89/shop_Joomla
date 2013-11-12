<?php
include(JPATH_COMPONENT_ADMINISTRATOR."/views/otherpanel/tmpl/submenu.php");
$shippings = $this->rows;
$i = 0;
?>
<form action = "index.php?option=com_jshopping&controller=shippings" method = "post" name = "adminForm">

<table class = "adminlist">
<thead>
  <tr>
    <th class = "title" width  = "10">
      #
    </th>
    <th width = "20">
	  <input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $shippings );?>);" />
    </th>
    <th align = "left">
      <?php echo _JSHOP_TITLE; ?>
    </th>
    <th width="150">
        <?php echo _JSHOP_SHIPPING_PRICES; ?>    
    </th>
    <th colspan = "2" width = "40">
      <?php echo _JSHOP_ORDERING; ?>
    </th>
    <th width = "30">
      <?php echo _JSHOP_PUBLISH; ?>
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
 $count = count($shippings);
 if ($count)
 foreach($shippings as $shipping){
  ?>
  <tr class = "row<?php echo $i % 2;?>">
   <td>
     <?php echo $i+1;?>
   </td>
   <td>
     <input type = "checkbox" onclick = "isChecked(this.checked)" name = "cid[]" id = "cb<?php echo $i;?>" value = "<?php echo $shipping->shipping_id?>" />
   </td>
   <td>
     <a href = "index.php?option=com_jshopping&controller=shippings&task=edit&shipping_id=<?php echo $shipping->shipping_id; ?>">
         <?php if ($shipping->count_shipping_price==0){?>
            <img src="images/disabled.png" alt="disabled" title="<?php print _JSHOP_NOT_SET_PRICE?>" />&nbsp;
        <?php }?>
        <?php echo $shipping->name;?>             
     </a>
   </td>
   <td>
    <a href = "index.php?option=com_jshopping&controller=shippingsprices&shipping_id_back=<?php print $shipping->shipping_id;?>"><?php echo _JSHOP_SHIPPING_PRICES." (".$shipping->count_shipping_price.")"?> <img src = "components/com_jshopping/images/tree.gif" border = "0" /></a>
   </td>
   <td align = "right" width = "20">
    <?php
      if ($i != 0) echo '<a href = "index.php?option=com_jshopping&controller=shippings&task=order&id=' . $shipping->shipping_id . '&order=up&number=' . $shipping->shipping_ordering . '"><img alt="' . _JSHOP_UP . '" src="components/com_jshopping/images/uparrow.png"/></a>';
    ?>
   </td>   
   <td align = "left" width = "20">
      <?php
        if ($i != $count - 1) echo '<a href = "index.php?option=com_jshopping&controller=shippings&task=order&id=' . $shipping->shipping_id . '&order=down&number=' . $shipping->shipping_ordering . '"><img alt="' . _JSHOP_DOWN . '" src="components/com_jshopping/images/downarrow.png"/></a>';
      ?>
   </td>
   <td align = "center">
     <?php
       echo $published = ($shipping->shipping_publish) ? ('<a href = "javascript:void(0)" onclick = "return listItemTask(\'cb' . $i . '\', \'unpublish\')"><img src="components/com_jshopping/images/tick.png" title = "'._JSHOP_PUBLISH.'" ></a>') : ('<a href = "javascript:void(0)" onclick = "return listItemTask(\'cb' . $i . '\', \'publish\')"><img title = "'._JSHOP_UNPUBLISH.'" src="components/com_jshopping/images/publish_x.png"></a>');
     ?>
   </td>
	<td align="center">
        <a href='index.php?option=com_jshopping&controller=shippings&task=edit&shipping_id=<?php echo $shipping->shipping_id; ?>'><img src='components/com_jshopping/images/icon-16-edit.png'></a>
   </td>
   <td align="center">
    <?php print $shipping->shipping_id;?>
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