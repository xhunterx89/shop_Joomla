<?php
include(JPATH_COMPONENT_ADMINISTRATOR."/views/otherpanel/tmpl/submenu.php");
$coupons = $this->rows;
$pageNav = $this->pageNav;
$i = 0;
?>
<form action = "index.php?option=com_jshopping&controller=coupons" method = "post" name = "adminForm">

<table class = "adminlist">
<thead>
  <tr>
    <th class = "title" width  = "10">
      #
    </th>
    <th width = "20">
      <input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $coupons );?>);" />
    </th>
    <th align = "left">
      <?php echo _JSHOP_CODE;?>
    </th>
    <th width = "200" align = "left">
      <?php echo _JSHOP_VALUE; ?>
    </th>
    <th width = "80">
      <?php echo _JSHOP_START_DATE_COUPON;?>
    </th>
    <th width = "80">
      <?php echo _JSHOP_EXPIRE_DATE_COUPON;?>
    </th>
    <th width = "80">
      <?php echo _JSHOP_FINISHED_AFTER_USED;?>
    </th>
    <th width = "80">
      <?php echo _JSHOP_FOR_USER;?>
    </th>
    <th width = "80">
      <?php echo _JSHOP_COUPON_USED;?>
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
foreach($coupons as $coupon){
    $finished = 0; $date = date('Y-m-d');
    if ($coupon->used) $finished = 1;
    if ($coupon->coupon_expire_date < $date && $coupon->coupon_expire_date!='0000-00-00' ) $finished = 1;
?>
  <tr class = "row<?php echo $i % 2;?>" <?php if ($finished) print "style='font-style:italic; color: #999;'"?>>
   <td>
     <?php echo $pageNav->getRowOffset($i);?>
   </td>
   <td>
    <input type = "checkbox" onclick = "isChecked(this.checked)" name = "cid[]" id = "cb<?php echo $i;?>" value = "<?php echo $coupon->coupon_id?>" />
   </td>
   <td>
     <a href = "index.php?option=com_jshopping&controller=coupons&task=edit&coupon_id=<?php echo $coupon->coupon_id; ?>"><?php echo $coupon->coupon_code;?></a>
   </td>
   <td>
     <?php echo $coupon->coupon_value; ?>
     <?php if ($coupon->coupon_type==0) print "%"; else print $this->currency;?>
   </td>
   <td>
    <?php if ($coupon->coupon_start_date!='0000-00-00') print formatdate($coupon->coupon_start_date);?>
   </td>
   <td>
    <?php if ($coupon->coupon_expire_date!='0000-00-00')  print formatdate($coupon->coupon_expire_date);?>
   </td>
   <td align="center">
    <?php if ($coupon->finished_after_used) print _JSHOP_YES; else print _JSHOP_NO?>
   </td>
   <td align="center">
    <?php if ($coupon->for_user_id) print $coupon->f_name." ".$coupon->l_name; else print _JSHOP_ALL;?>
   </td>
   <td align="center">
    <?php if ($coupon->used) print _JSHOP_YES; else print _JSHOP_NO?>
   </td>
   <td align="center">
     <?php
       echo $published = ($coupon->coupon_publish) ? ('<a href = "javascript:void(0)" onclick = "return listItemTask(\'cb' . $i . '\', \'unpublish\')"><img src="components/com_jshopping/images/tick.png" title = "'._JSHOP_PUBLISH.'" ></a>') : ('<a href = "javascript:void(0)" onclick = "return listItemTask(\'cb' . $i . '\', \'publish\')"><img title = "'._JSHOP_UNPUBLISH.'" src="components/com_jshopping/images/publish_x.png"></a>');
     ?>
   </td>
   <td align="center">
        <a href='index.php?option=com_jshopping&controller=coupons&task=edit&coupon_id=<?php print $coupon->coupon_id?>'><img src='components/com_jshopping/images/icon-16-edit.png'></a>
   </td>
   <td align="center">
     <?php echo $coupon->coupon_id ?>
   </td>
  </tr>
<?php
$i++;
}
?>
<tfoot>
<tr>
    <td colspan="12"><?php echo $pageNav->getListFooter();?></td>
</tr>
</tfoot>
</table>

<input type = "hidden" name = "task" value = "" />
<input type = "hidden" name = "hidemainmenu" value = "0" />
<input type = "hidden" name = "boxchecked" value = "0" />
</form>