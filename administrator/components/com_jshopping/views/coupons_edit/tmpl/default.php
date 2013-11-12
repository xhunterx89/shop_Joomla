<?php
$row = $this->coupon;
$lists = $this->lists;
$edit = $this->edit;
JHTML::_('behavior.calendar');
JHTML::_('behavior.tooltip');        
?>
<div class="jshop_edit">
<div class="col100">
<fieldset class="adminform">
<form action = "index.php?option=com_jshopping&controller=coupons" method = "post"name = "adminForm">
<table class="admintable">
   <tr>
     <td class="key" width = "30%">
       <?php echo _JSHOP_PUBLISH;?>
     </td>
     <td>
       <input type = "checkbox" name = "coupon_publish" value = "1" <?php if ($row->coupon_publish) echo 'checked = "checked"'?> />
     </td>
   </tr>
   <tr>
     <td  class="key">
       <?php echo _JSHOP_CODE; ?>
     </td>
     <td>
       <input type = "text" class = "inputbox" id = "coupon_code" name = "coupon_code" value = "<?php echo $row->coupon_code;?>" />
     </td>
   </tr>
   <tr>
     <td class="key">
       <?php echo _JSHOP_TYPE_COUPON;?>
     </td>
     <td>
       <?php echo $lists['coupon_type']; echo JHTML::tooltip( _JSHOP_COUPON_VALUE_DESCRIPTION, _JSHOP_HINT );
       ?>
     </td>
   </tr>
   <tr>
     <td class="key">
       <?php echo _JSHOP_VALUE; ?>
     </td>
     <td>
       <input type = "text" class = "inputbox" id = "coupon_value" name = "coupon_value" value = "<?php echo $row->coupon_value;?>" />
     </td>
   </tr>
   <tr>
     <td  class="key">
       <?php echo _JSHOP_START_DATE_COUPON;?>
     </td>
     <td>
       <div class="calblock"><?php echo JHTML::_('calendar', $row->coupon_start_date, 'coupon_start_date', 'coupon_start_date', '%Y-%m-%d', array('class'=>'inputbox', 'size'=>'25', 'maxlength'=>'19')); ?></div>
     </td>
   </tr>
   <tr>
     <td class="key">
       <?php echo _JSHOP_EXPIRE_DATE_COUPON;?>
     </td>
     <td>
       <div class="calblock"><?php echo JHTML::_('calendar', $row->coupon_expire_date, 'coupon_expire_date', 'coupon_expire_date', '%Y-%m-%d', array('class'=>'inputbox', 'size'=>'25', 'maxlength'=>'19')); ?></div>
     </td>
   </tr>
   <tr>
     <td class="key">
       <?php echo _JSHOP_FOR_USER_ID;?>
     </td>
     <td>
       <input type = "text" class = "inputbox" name = "for_user_id" value = "<?php echo $row->for_user_id;?>" />       
     </td>
   </tr>
   <tr>
     <td class="key">
       <?php echo _JSHOP_FINISHED_AFTER_USED;?>
     </td>
     <td>
       <input type = "checkbox" name = "finished_after_used" value = "1" <?php if ($row->finished_after_used) echo 'checked = "true"'?> />
     </td>
   </tr>
 </table>

<input type = "hidden" name = "task" value = "" />
<input type = "hidden" name = "edit" value = "<?php echo $edit;?>" />
<?php if ($edit) {?>
  <input type = "hidden" name = "coupon_id" value = "<?php echo $row->coupon_id?>" />
<?php }?>
</form>
</fieldset>
</div>
<div class="clr"></div>
</div>