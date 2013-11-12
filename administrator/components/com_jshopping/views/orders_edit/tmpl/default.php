<?php
$order = $this->order;
$order_history = $this->order_history;
$order_item = $this->order_items;
$lists = $this->lists;
$config_fields = $this->config_fields;
?>
<form action = "index.php?option=com_jshopping" method = "post" name = "adminForm">
<?php if (!$this->display_info_only_product){?>
<table width="100%">
<tr>
    <td width="50%" valign="top">
        <table width = "100%" class = "adminlist">
        <thead>
        <tr>
          <th colspan="2" align="center"><?php print _JSHOP_BILL_TO ?></th>
        </tr>
        </thead>
        <?php if ($config_fields['firma_name']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_FIRMA_NAME?>:</b></td>
          <td><input type="text" name="firma_name" value="<?php print $order->firma_name?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['f_name']['display']){?>
        <tr>
          <td width = "40%"><b><?php print _JSHOP_FULL_NAME?>:</b></td>
          <td width = "60%"><input type="text" name="f_name" value="<?php print $order->f_name?>" /> <input type="text" name="l_name" value="<?php print $order->l_name?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['client_type']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_CLIENT_TYPE?>:</b></td>
          <td><?php print $this->select_client_types;?></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['firma_code']['display']){?>
        <tr id="tr_field_firma_code" <?php if ($order->client_type!="2"){?>style="display:none;"<?php } ?>>
          <td><b><?php print _JSHOP_FIRMA_CODE?>:</b></td>
          <td><input type="text" name="firma_code" value="<?php print $order->firma_code?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['tax_number']['display']){?>
        <tr id="tr_field_tax_number" <?php if ($order->client_type!="2"){?>style="display:none;"<?php } ?>>
          <td><b><?php print _JSHOP_VAT_NUMBER?>:</b></td>
          <td><input type="text" name="tax_number" value="<?php print $order->tax_number?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['street']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_STREET_NR?>:</b></td>
          <td><input type="text" name="street" value="<?php print $order->street?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['city']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_CITY?>:</b></td>
          <td><input type="text" name="city" value="<?php print $order->city?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['state']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_STATE?>:</b></td>
          <td><input type="text" name="state" value="<?php print $order->state?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['zip']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_ZIP?>:</b></td>
          <td><input type="text" name="zip" value="<?php print $order->zip?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['country']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_COUNTRY?>:</b></td>
          <td><?php print_r($this->select_countries)?></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['phone']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_TELEFON?>:</b></td>
          <td><input type="text" name="phone" value="<?php print $order->phone?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['mobil_phone']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_MOBIL_PHONE?>:</b></td>
          <td><input type="text" name="mobil_phone" value="<?php print $order->mobil_phone?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['fax']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_FAX?>:</b></td>
          <td><input type="text" name="fax" value="<?php print $order->fax?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['email']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_EMAIL?>:</b></td>
          <td><input type="text" name="email" value="<?php print $order->email?>" /></td>
        </tr>
        <?php } ?>
        
        <?php if ($config_fields['ext_field_1']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_EXT_FIELD_1?>:</b></td>
          <td><input type="text" name="ext_field_1" value="<?php print $order->ext_field_1?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['ext_field_2']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_EXT_FIELD_2?>:</b></td>
          <td><input type="text" name="ext_field_2" value="<?php print $order->ext_field_2?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['ext_field_3']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_EXT_FIELD_3?>:</b></td>
          <td><input type="text" name="ext_field_3" value="<?php print $order->ext_field_3?>" /></td>
        </tr>
        <?php } ?>                        
        </table>
    </td>
    <td width="50%"  valign="top">
    <?php if ($this->count_filed_delivery >0) {?>
        <table width = "100%" class = "adminlist">
        <thead>
        <tr>
          <th colspan="2" align="center"><?php print _JSHOP_SHIP_TO ?></th>
        </tr>
        </thead>
        <?php if ($config_fields['d_firma_name']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_FIRMA_NAME?>:</b></td>
          <td><input type="text" name="d_firma_name" value="<?php print $order->d_firma_name?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_f_name']['display']){?>
        <tr>
          <td width = "40%"><b><?php print _JSHOP_FULL_NAME?>:</b></td>
          <td width = "60%"><input type="text" name="d_f_name" value="<?php print $order->d_f_name?>" /> <input type="text" name="d_l_name" value="<?php print $order->d_l_name?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_street']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_STREET_NR?>:</b></td>
          <td><input type="text" name="d_street" value="<?php print $order->d_street?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_city']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_CITY?>:</b></td>
          <td><input type="text" name="d_city" value="<?php print $order->d_city?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_state']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_STATE?>:</b></td>
          <td><input type="text" name="d_state" value="<?php print $order->d_state?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_zip']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_ZIP?>:</b></td>
          <td><input type="text" name="d_zip" value="<?php print $order->d_zip?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_country']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_COUNTRY?>:</b></td>
          <td><?php print_r($this->select_d_countries)?></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_phone']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_TELEFON?>:</b></td>
          <td><input type="text" name="d_phone" value="<?php print $order->d_phone?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_mobil_phone']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_MOBIL_PHONE?>:</b></td>
          <td><input type="text" name="d_mobil_phone" value="<?php print $order->d_mobil_phone?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_fax']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_FAX?>:</b></td>
          <td><input type="text" name="d_fax" value="<?php print $order->d_fax?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_email']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_EMAIL?>:</b></td>
          <td><input type="text" name="d_email" value="<?php print $order->d_email?>" /></td>
        </tr>
        <?php } ?>
        
        <?php if ($config_fields['d_ext_field_1']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_EXT_FIELD_1?>:</b></td>
          <td><input type="text" name="d_ext_field_1" value="<?php print $order->d_ext_field_1?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_ext_field_2']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_EXT_FIELD_2?>:</b></td>
          <td><input type="text" name="d_ext_field_2" value="<?php print $order->d_ext_field_2?>" /></td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_ext_field_3']['display']){?>
        <tr>
          <td><b><?php print _JSHOP_EXT_FIELD_3?>:</b></td>
          <td><input type="text" name="d_ext_field_3" value="<?php print $order->d_ext_field_3?>" /></td>
        </tr>
        <?php } ?>                        
        </table>
    <?php } ?>  
    </td>
</tr>
</table>
<?php } ?>

<br/>
<table class = "adminlist" width = "100%">
<thead>
<tr>
 <th>
   <?php echo _JSHOP_NAME_PRODUCT?>
 </th>
 <?php if ($this->config->show_product_code_in_order){?>
 <th>
   <?php echo _JSHOP_EAN_PRODUCT?>
 </th>
 <?php }?>
 <th>
   <?php echo _JSHOP_PRICE?>
 </th>
 <th>
   <?php echo _JSHOP_QUANTITY?>
 </th> 
</tr>
</thead>
<?php 
    $subtotal = 0;
    $i = 0;
?>
<?php foreach ($order_item as $item){ $i++; ?>
<tr valign="top" align="center">
 <td align="center">
   <input type="text" name="product_name_<?php echo $i?>" value="<?php echo $item->product_name?>" /><br />
   <?php echo nl2br($item->product_attributes).nl2br($item->product_freeattributes);?>
 </td>
 <?php if ($this->config->show_product_code_in_order){?>
 <td align="center">
   <input type="text" name="product_ean_<?php echo $i?>" value="<?php echo $item->product_ean?>" />
 </td>
 <?php }?>
 <td align="center">
   <input type="text" name="product_item_price_<?php echo $i?>" value="<?php echo $item->product_item_price;?>" /><?php echo ' '.$order->currency_code;?>
 </td>
 <td align="center">
   <input type="text" name="product_quantity_<?php echo $i?>" value="<?php echo $item->product_quantity?>" />
   <input type="hidden" name="order_item_id_<?php echo $i?>" value="<?php echo $item->order_item_id?>" />
   <?php $subtotal += $item->product_quantity * $item->product_item_price; ?>
 </td> 
</tr>
<?php }?>
</table>

<table class = "adminlist" width = "100%">
<?php if ($order->order_discount > 0){?>
<tr class = "bold">
 <td colspan = "4" class = "right">
   <?php echo _JSHOP_COUPON_DISCOUNT?>
 </td>
 <td class = "left">
   <input type="text" name="order_discount" value="<?php echo -$order->order_discount;?>" /> <?php echo $order->currency_code;?>
 </td>
</tr>
<?php } ?>

<?php if (!$this->config->without_shipping || $order->order_shipping > 0){?>
<tr class = "bold">
 <td colspan = "4" class = "right">
    <?php echo _JSHOP_SUBTOTAL?>
 </td>
 <td class = "left">
   <input type="text" name="order_subtotal" value="<?php echo $order->order_subtotal;?>" /> <?php echo $order->currency_code;?>
 </td>
</tr>
<tr class = "bold">
 <td colspan = "4" class = "right">
    <?php echo _JSHOP_SHIPPING_PRICE?>
 </td>
 <td class = "left">
    <input type="text" name="order_shipping" value="<?php echo $order->order_shipping;?>" /> <?php echo $order->currency_code;?> 
 </td>
</tr>
<?php } ?>

<?php if ($order->order_payment > 0){?>
<tr class = "bold">
 <td colspan = "4" class = "right">
     <?php print $order->payment_name;?>
 </td>
 <td class = "left">
   <input type="text" name="order_payment" value="<?php echo $order->order_payment;?>" /> <?php echo $order->currency_code;?>
 </td>
</tr>
<?php } ?>

<?php 
$i = 0;
if (!$this->config->hide_tax){?>
    <?php foreach($order->order_tax_list as $percent=>$value){ $i++;?>
      <tr class="bold">
        <td  colspan = "4" class = "right">
          <?php print displayTotalCartTaxName($order->display_price);?>
          <input type="text" name="tax_percent_<?php echo $i;?>" value="<?php print $percent?>" /> <?php print "%"; ?>
        </td>
        <td  class = "left">
          <input type="text" name="tax_value_<?php echo $i;?>" value="<?php print $value; ?>" /> <?php print $order->currency_code; ?>
        </td>
      </tr>
    <?php }?>
<?php }?>
<tr class = "bold">
 <td colspan = "4" class = "right">
    <?php echo _JSHOP_TOTAL?>
 </td>
 <td class = "left">
   <input type="text" name="order_total" value="<?php echo $order->order_total;?>" /> <?php echo $order->currency_code;?>
 </td>
</tr>
</table>

<input type="hidden" name="js_nolang" value="1" />
<input type="hidden" name="order_id" value="<?php echo $this->order_id;?>" />
<input type="hidden" name="controller" value="orders" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="amount_order_items" value="<?php echo count($order_item);?>" />
<input type="hidden" name="amount_tax_items" value="<?php echo count($order->order_tax_list);?>" />

</form>