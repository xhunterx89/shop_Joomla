<?php
$row = $this->sh_method_price;
$lists = $this->lists;
$jshopConfig = &JSFactory::getConfig();
JHTML::_('behavior.tooltip');
?>
<form action = "index.php?option=com_jshopping&controller=shippingsprices&shipping_id_back=<?php echo $this->shipping_id_back;?>" method = "post" name = "adminForm">

<div class="col100">
<fieldset class="adminform">
<table class="admintable" width = "100%" >
<tr>
<td class="key">
	<?php echo _JSHOP_TITLE; ?>
</td>
<td>
	<?php echo $lists['shipping_methods']?>
</td>
</tr>
<tr>
<td class="key">
	<?php echo _JSHOP_COUNTRY . "<br/><br/><span style='font-weight:normal'>"._JSHOP_MULTISELECT_INFO."</span>"; ?>
</td>
<td>
	<?php echo $lists['countries'];?>
</td>
</tr>
<?php if (!$this->withouttax){?>
<tr>
 <td class="key">
	<?php echo _JSHOP_SELECT_TAX?>
 </td>
 <td>
 	<?php echo $lists['taxes']?>
 </td>
</tr>
<?php }?>
<tr>
<td class="key">
	<?php echo _JSHOP_PRICE ?>	
</td>
<td>
	<input type = "text" class = "inputbox" name = "shipping_stand_price" value = "<?php echo $row->shipping_stand_price?>" />
    <?php echo $this->currency->currency_code; ?>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
  <td class="key" style = "text-align:right; vertical-align:top">
	<b><?php echo _JSHOP_PRICE_DEPENCED_WEIGHT;?></b>
  </td>
  <td>
	<table class="adminlist" id="table_shipping_weight_price">
    <thead>
	   <tr>
         <th>
           <?php echo _JSHOP_MINIMAL_WEIGHT;?> (<?php print _JSHOP_WEIGHT_UNIT;?>)
         </th>
         <th>
           <?php echo _JSHOP_MAXIMAL_WEIGHT;?> (<?php print _JSHOP_WEIGHT_UNIT;?>)
         </th>
         <th>
           <?php echo _JSHOP_PRICE;?> (<?php echo $this->currency->currency_code; ?>)
         </td>
         <th>
           <?php echo _JSHOP_PACKAGE_PRICE;?> (<?php echo $this->currency->currency_code; ?>)
         </th>         
         <th>
           <?php echo _JSHOP_DELETE;?>
         </th>
       </tr>				   
       </thead>
	   <?php
       $key = 0;
       foreach ($row->prices as $key=>$value){?>
       <tr id='shipping_weight_price_row_<?php print $key?>'>
         <td>
           <input type = "text" class = "inputbox" name = "shipping_weight_from[]" value = "<?php echo $value->shipping_weight_from;?>" />
         </td>
         <td>
           <input type = "text" class = "inputbox" name = "shipping_weight_to[]" value = "<?php echo $value->shipping_weight_to;?>" />
         </td>
         <td>
           <input type = "text" class = "inputbox" name = "shipping_price[]" value = "<?php echo $value->shipping_price;?>" />
         </td>
		 <td>
           <input type = "text" class = "inputbox" name = "shipping_package_price[]" value = "<?php echo $value->shipping_package_price;?>" />
         </td>         
         <td style="text-align:center">
		    <a href="#" onclick="delete_shipping_weight_price_row(<?php print $key?>);return false;"><img src="images/publish_x.png" border="0"/></a>
		 </td>
       </tr>
       <?php }?>    
	</table>
    <table class="adminlist"> 
    <tr>
        <td style="padding-top:5px;" align="right"><input type="button" value="<?php echo _JSHOP_ADD_VALUE?>" onclick = "addFieldShPrice();"></td>
    </tr>
    </table>
    <script type="text/javascript"> 
        <?php print "var shipping_weight_price_num = $key;";?>
    </script>
</td>
</tr>
</table>
</fieldset>
</div>
<div class="clr"></div>

<input type = "hidden" name = "sh_pr_method_id" value = "<?php echo $row->sh_pr_method_id?>" />
<input type = "hidden" name = "task" value = "" />
</form>