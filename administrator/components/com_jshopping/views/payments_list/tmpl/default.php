<?php
include(JPATH_COMPONENT_ADMINISTRATOR."/views/otherpanel/tmpl/submenu.php");
$payments = $this->rows;
$i = 0;
?>
<form action = "index.php?option=com_jshopping&controller=payments" method = "post" name = "adminForm">
<table class = "adminlist" width = "70%">
<thead>
  <tr>
    <th class = "title" width  = "10">
      #
    </th>
    <th width = "20">
	  <input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $payments );?>);" />
    </th>
    <th align = "left">
      <?php echo _JSHOP_TITLE;?>
    </th>
    <th width = "200" align = "left">
      <?php echo _JSHOP_CODE; ?>
    </th>
    <th width = "200" align = "left">
      <?php echo _JSHOP_ALIAS;?>
    </th>
    
    <th width = "40" colspan = "2">
      <?php echo _JSHOP_ORDERING; ?>
    </th>
    <th width = "50">
      <?php echo _JSHOP_PUBLISH; ?>
    </th>
    <th width="50">
    	<?php print _JSHOP_EDIT; ?>
    </th>
    <th width = "40">
        <?php echo _JSHOP_ID; ?>
    </th>
  </tr>
</thead>
<?php
 $count = count($payments);
 if ($count)
 foreach($payments as $payment){
  ?>
  <tr class = "row<?php echo $i % 2;?>">
   <td>
     <?php echo $i+1;?>
   </td>
   <td>
     <input type = "checkbox" onclick = "isChecked(this.checked)" name = "cid[]" id = "cb<?php echo $i;?>" value = "<?php echo $payment->payment_id?>" />
   </td>
   <td>
     <a title = "<?php echo _JSHOP_EDIT_PAYMENT;?>" href = "index.php?option=com_jshopping&controller=payments&task=edit&payment_id=<?php echo $payment->payment_id; ?>"><?php echo $payment->name;?></a>
   </td>
   <td>
     <?php echo $payment->payment_code;?>
   </td>
   <td>
     <?php echo $payment->payment_class;?>
   </td>
   <td align = "right" width = "20">
    <?php
      if ($i != 0) echo '<a href = "index.php?option=com_jshopping&controller=payments&task=order&id=' . $payment->payment_id . '&order=up&number=' . $payment->payment_ordering . '"><img alt="' . _JSHOP_UP . '" src="components/com_jshopping/images/uparrow.png"/></a>';
    ?>
   </td>
   <td align = "left" width = "20">
      <?php
        if ($i != $count - 1) echo '<a href = "index.php?option=com_jshopping&controller=payments&task=order&id=' . $payment->payment_id . '&order=down&number=' . $payment->payment_ordering . '"><img alt="' . _JSHOP_DOWN . '" src="components/com_jshopping/images/downarrow.png"/></a>';
      ?>
   </td>
   <td align = "center">
     <?php
       echo $published = ($payment->payment_publish) ? ('<a href = "javascript:void(0)" onclick = "return listItemTask(\'cb' . $i . '\', \'unpublish\')"><img src="components/com_jshopping/images/tick.png" title = "'._JSHOP_PUBLISH.'" ></a>') : ('<a href = "javascript:void(0)" onclick = "return listItemTask(\'cb' . $i . '\', \'publish\')"><img title = "'._JSHOP_UNPUBLISH.'" src="components/com_jshopping/images/publish_x.png"></a>');
     ?>
   </td>
   <td align="center">
        <?php print "<a href='index.php?option=com_jshopping&controller=payments&task=edit&payment_id=".$payment->payment_id."'><img src='components/com_jshopping/images/icon-16-edit.png'></a>"?>
   </td>
   <td align="center">
        <?php print $payment->payment_id;?>
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