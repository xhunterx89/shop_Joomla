<?php
include(JPATH_COMPONENT_ADMINISTRATOR."/views/otherpanel/tmpl/submenu.php");
$shipping_prices = $this->rows;
$i = 0;
?>
<form name = "adminForm" action = "index.php?option=com_jshopping&controller=shippingsprices" method = "post">

<table class = "adminlist">
<thead>
	<tr class = "row<?php echo $i % 2;?>">
    	<th class = "title" width  = "10">
      		#
    	</th>
    	<th width = "20">
	  		<input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $shipping_prices );?>);" />
    	</th>
    	<th align = "left">
      		<?php echo _JSHOP_TITLE; ?>
    	</th>
        <th>
            <?php echo _JSHOP_COUNTRIES; ?>
        </th>
        <th width="100">
            <?php echo _JSHOP_PRICE; ?>
        </th>
    	<th width = "70">
	        <?php echo _JSHOP_EDIT; ?>
	    </th>
        <th width = "40">
            <?php echo _JSHOP_ID; ?>
        </th>
  	</tr>
</thead>
<?php
$count = count($shipping_prices);
if ($count)
	foreach ($shipping_prices as $sh_price) { ?>
  	<tr>
		<td>
			<?php echo $i + 1;?>
		</td>
		<td>
			<input type = "checkbox" onclick = "isChecked(this.checked)" name = "cid[]" id = "cb<?php echo $i++;?>" value = "<?php echo $sh_price->sh_pr_method_id?>" />
		</td>
		<td>
			<a href = "index.php?option=com_jshopping&controller=shippingsprices&task=edit&sh_pr_method_id=<?php echo $sh_price->sh_pr_method_id?>&shipping_id_back=<?php print $this->shipping_id_back?>"><?php echo $sh_price->name;?></a>
		</td>
        <td>
            <?php print $sh_price->countries; ?>
        </td>
        <td>
            <?php print formatprice($sh_price->shipping_stand_price);?>
        </td>
		<td align="center">
            <a href='index.php?option=com_jshopping&controller=shippingsprices&task=edit&sh_pr_method_id=<?php echo $sh_price->sh_pr_method_id?>&shipping_id_back=<?php print $this->shipping_id_back?>'><img src='components/com_jshopping/images/icon-16-edit.png'></a>
	   </td>
       <td align="center">
        <?php print  $sh_price->sh_pr_method_id;?>
       </td>  
	</tr>
	<?php } ?>
</table>

<input type = "hidden" name = "task" value = "" />
<input type = "hidden" name = "shipping_id_back" value = "<?php echo $this->shipping_id_back;?>" />
<input type = "hidden" name = "hidemainmenu" value = "0" />
<input type = "hidden" name = "boxchecked" value = "0" />
</form>