<?php $order = $this->order; ?>
<div class="jshop">
<?php if ($this->config->order_send_pdf_client){?>
<div class="downlod_order_invoice">
    <a target="_blank" href="<?php print $this->config->pdf_orders_live_path."/".$order->pdf_file;?>"><?php print _JSHOP_DOWNLOAD_INVOICE?></a>
</div>
<?php } ?>
<table>
  <tr>
    <td>
      <b><?php print _JSHOP_ORDER_NUMBER ?>:</b> <?php print $order->order_number ?>
    </td>
  </tr>
  <tr>
    <td>
      <b><?php print _JSHOP_ORDER_STATUS ?>:</b> <?php print $order->status_name ?>
    </td>
  </tr>
  <tr>
    <td>
      <b><?php print _JSHOP_ORDER_DATE ?>:</b> <?php print formatdate($order->order_date, 0) ?>
    </td>
  </tr>
  <tr>
    <td>
      <b><?php print _JSHOP_PRICE_TOTAL ?>:</b> <?php print formatprice($order->order_total, $order->currency_code); ?>
    </td>
  </tr>
</table>
<br/>
<table width="100%">
<tr>
    <td width="50%" valign="top">
        <table class = "jshop">
        <tr>
          <td colspan=2><b><?php print _JSHOP_EMAIL_BILL_TO ?></b></td>
        </tr>
        <?php if ($this->config_fields['firma_name']['display']){?>
        <tr>
          <td><?php print _JSHOP_FIRMA_NAME?>:</td>
          <td><?php print $this->order->firma_name?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['f_name']['display']){?>
        <tr>
          <td width = "40%"><?php print _JSHOP_FULL_NAME?>:</td>
          <td width = "60%"><?php print $this->order->f_name?> <?php print $this->order->l_name?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['client_type']['display']){?>
        <tr>
          <td><?php print _JSHOP_CLIENT_TYPE?>:</td>
          <td><?php print $this->order->client_type_name;?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['firma_code']['display'] && $this->order->client_type==2){?>
        <tr>
          <td><?php print _JSHOP_FIRMA_CODE?>:</td>
          <td><?php print $this->order->firma_code?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['tax_number']['display'] && $this->order->client_type==2){?>
        <tr>
          <td><?php print _JSHOP_VAT_NUMBER?>:</td>
          <td><?php print $this->order->tax_number?></td>
        </tr>
        <?php } ?>
        
        <?php if ($this->config_fields['street']['display']){?>
        <tr>
          <td><?php print _JSHOP_STREET_NR?>:</td>
          <td><?php print $this->order->street?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['city']['display']){?>
        <tr>
          <td><?php print _JSHOP_CITY?>:</td>
          <td><?php print $this->order->city?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['state']['display']){?>
        <tr>
          <td><?php print _JSHOP_STATE?>:</td>
          <td><?php print $this->order->state?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['zip']['display']){?>
        <tr>
          <td><?php print _JSHOP_ZIP?>:</td>
          <td><?php print $this->order->zip?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['country']['display']){?>
        <tr>
          <td><?php print _JSHOP_COUNTRY?>:</td>
          <td><?php print $this->order->country?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['phone']['display']){?>
        <tr>
          <td><?php print _JSHOP_TELEFON?>:</td>
          <td><?php print $this->order->phone?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['mobil_phone']['display']){?>
        <tr>
          <td><?php print _JSHOP_MOBIL_PHONE?>:</td>
          <td><?php print $this->order->mobil_phone?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['fax']['display']){?>
        <tr>
          <td><?php print _JSHOP_FAX?>:</td>
          <td><?php print $this->order->fax?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['email']['display']){?>
        <tr>
          <td><?php print _JSHOP_EMAIL?>:</td>
          <td><?php print $this->order->email?></td>
        </tr>
        <?php } ?>
        
        <?php if ($this->config_fields['ext_field_1']['display']){?>
        <tr>
          <td><?php print _JSHOP_EXT_FIELD_1?>:</td>
          <td><?php print $this->order->ext_field_1?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['ext_field_2']['display']){?>
        <tr>
          <td><?php print _JSHOP_EXT_FIELD_2?>:</td>
          <td><?php print $this->order->ext_field_2?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['ext_field_3']['display']){?>
        <tr>
          <td><?php print _JSHOP_EXT_FIELD_3?>:</td>
          <td><?php print $this->order->ext_field_3?></td>
        </tr>
        <?php } ?>                        
        </table>
    </td>
    <td width="50%"  valign="top">
    <?php if ($this->count_filed_delivery >0) {?>
        <table class = "jshop">
        <tr>
          <td colspan=2><b><?php print _JSHOP_EMAIL_SHIP_TO ?></b></td>
        </tr>
        <?php if ($this->config_fields['d_firma_name']['display']){?>
        <tr>
            <td><?php print _JSHOP_FIRMA_NAME?>:</td>
            <td><?php print $this->order->d_firma_name?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['d_f_name']['display']){?>
        <tr>
            <td width = "40%"><?php print _JSHOP_FULL_NAME?> </td>
            <td width = "60%"><?php print $this->order->d_f_name?> <?php print $this->order->d_l_name?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['d_street']['display']){?>
        <tr>
            <td><?php print _JSHOP_STREET_NR?>:</td>
            <td><?php print $this->order->d_street?><br></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['d_city']['display']){?>
        <tr>
            <td><?php print _JSHOP_CITY?>:</td>
            <td><?php print $this->order->d_city?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['d_state']['display']){?>
        <tr>
            <td><?php print _JSHOP_STATE?>:</td>
            <td><?php print $this->order->d_state?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['d_zip']['display']){?>
        <tr>
            <td><?php print _JSHOP_ZIP ?>:</td>
            <td><?php print $this->order->d_zip ?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['d_country']['display']){?>
        <tr>
            <td><?php print _JSHOP_COUNTRY ?>:</td>
            <td><?php print $this->order->d_country ?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['d_phone']['display']){?>
        <tr>
            <td><?php print _JSHOP_TELEFON ?>:</td>
            <td><?php print $this->order->d_phone ?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['d_mobil_phone']['display']){?>
        <tr>
          <td><?php print _JSHOP_MOBIL_PHONE?>:</td>
          <td><?php print $this->order->d_mobil_phone?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['d_fax']['display']){?>
        <tr>
        <td><?php print _JSHOP_FAX ?>:</td>
        <td><?php print $this->order->d_fax ?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['d_email']['display']){?>
        <tr>
        <td><?php print _JSHOP_EMAIL ?>:</td>
        <td><?php print $this->order->d_email ?></td>
        </tr>
        <?php } ?>                            
        <?php if ($this->config_fields['d_ext_field_1']['display']){?>
        <tr>
          <td><?php print _JSHOP_EXT_FIELD_1?>:</td>
          <td><?php print $this->order->d_ext_field_1?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['d_ext_field_2']['display']){?>
        <tr>
          <td><?php print _JSHOP_EXT_FIELD_2?>:</td>
          <td><?php print $this->order->d_ext_field_2?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['d_ext_field_3']['display']){?>
        <tr>
          <td><?php print _JSHOP_EXT_FIELD_3?>:</td>
          <td><?php print $this->order->d_ext_field_3?></td>
        </tr>
        <?php } ?>
      </table>
    <?php } ?>  
    </td>
</tr>
</table>

<br/>
<table class = "jshop cart">
  <tr>
    <th>
      <?php print _JSHOP_ITEM?>
    </th>
    <?php if ($this->config->show_product_code_in_order){?>
    <th width = "15%">
    <?php print _JSHOP_EAN_PRODUCT?>
    </th>
    <?php }?>
    <th width = "15%">
      <?php print _JSHOP_SINGLEPRICE ?>
    </th>
    <th width = "15%">
      <?php print _JSHOP_NUMBER ?>
    </th>
    <th width = "15%">
      <?php print _JSHOP_PRICE_TOTAL ?>
    </th>
  </tr>
  <?php 
  $i=1; $countprod = count($order->items);
  foreach($order->items as $key_id=>$prod){
      $files = unserialize($prod->files);
  ?> 
  <tr class = "jshop_prod_cart <?php if ($i%2==0) print "even"; else print "odd"?>">
    <td style="text-align:left">
        <?php print $prod->product_name; ?>        
        <div>
            <?php print nl2br($prod->product_attributes).nl2br($prod->product_freeattributes);?>
        </div>
        <?php if (count($files)){?>
            <br/>
            <?php foreach($files as $file){?>
                <div><?php print $file->file_descr?> <a href="<?php print JURI::root()?>index.php?option=com_jshopping&controller=product&task=getfile&oid=<?php print $this->order->order_id?>&id=<?php print $file->id?>&hash=<?php print $this->order->file_hash;?>"><?php print _JSHOP_DOWNLOAD?></a></div>
            <?php }?>
         <?php }?>        
    </td>
    <?php if ($this->config->show_product_code_in_order){?>
    <td>
        <?php print $prod->product_ean;?>
    </td>
    <?php } ?>
    <td>
      <?php print formatprice($prod->product_item_price, $order->currency_code) ?>
      <?php if ($this->config->show_tax_product_in_cart && $prod->product_tax>0){?>
            <span class="taxinfo"><?php print productTaxInfo($prod->product_tax, $order->display_price);?></span>
        <?php }?>
    </td>
    <td>
      <?php print $prod->product_quantity; ?>
    </td>
    <td>
      <?php print formatprice($prod->product_item_price * $prod->product_quantity, $order->currency_code); ?>
      <?php if ($this->config->show_tax_product_in_cart && $prod->product_tax>0){?>
            <span class="taxinfo"><?php print productTaxInfo($prod->product_tax, $order->display_price);?></span>
        <?php }?>
    </td>
  </tr>
  <?php 
  $i++;
  } 
  ?>
  </table>
  <?php if ($this->config->show_weight_order){?>  
    <div class="weightorder">
        <?php print _JSHOP_WEIGHT_PRODUCTS?>: <span><?php print formatweight($this->order->weight);?></span> <?php print _JSHOP_WEIGHT_UNIT;?>
    </div>
  <?php }?>
  <br/>
  
  <table class = "jshop jshop_subtotal">
  <?php if (!$this->hide_subtotal){?>
  <tr>    
    <td class = "name">
      <?php print _JSHOP_SUBTOTAL ?>
    </td>
    <td class = "value">
      <?php print formatprice($order->order_subtotal, $order->currency_code); ?>
    </td>
  </tr>
  <?php } ?>
  <?php if ($order->order_discount > 0){ ?>
  <tr>
    <td class = "name">
      <?php print _JSHOP_RABATT_VALUE ?>
    </td>
    <td class = "value">
      <?php print formatprice(-$order->order_discount, $order->currency_code); ?>
    </td>
  </tr>
  <?php } ?>
  <?php if (!$this->config->without_shipping || $order->order_shipping > 0){?>
  <tr>
    <td class = "name">
         <?php print _JSHOP_SHIPPING_PRICE;?>
    </td>
    <td class = "value">
      <?php print formatprice($order->order_shipping, $order->currency_code);?>
    </td>
  </tr>
  <?php } ?>
  <?php if ($this->order->order_payment > 0){?>
  <tr>
    <td class = "name">
         <?php print $this->order->payment_name;?>
    </td>
    <td class = "value">
      <?php print formatprice($this->order->order_payment, $order->currency_code);?>
    </td>
  </tr>
  <?php } ?>  
  <?php if (!$this->config->hide_tax){ ?>
  <?php foreach($order->order_tax_list as $percent=>$value){?>
  <tr>
    <td class = "name">
      <?php print displayTotalCartTaxName($order->display_price);?>
      <?php if ($this->show_percent_tax) print formattax($percent)."%"?>
    </td>
    <td class = "value">
      <?php print formatprice($value, $order->currency_code); ?>
    </td>
  </tr>
  <?php }?>
  <?php }?>
  <tr>
    <td class = "name">
      <?php print $this->text_total; ?>
    </td>
    <td class = "value">
      <?php print formatprice($order->order_total, $order->currency_code); ?>
    </td>
  </tr>
</table>

<br/>
<?php if (!$this->config->without_shipping){?>
    <div><b><?php print _JSHOP_SHIPPING_INFORMATION ?></b></div>
    <div><?php print nl2br($order->shipping_info);?></div>
    <br/>
<?php }?>
<?php if (!$this->config->without_payment){?>
    <div><b><?php print _JSHOP_PAYMENT_INFORMATION ?></b></div>
    <div><?php print $order->payment_name;?></div>
    <div class="order_payment_params">
        <?php print nl2br($order->payment_params);?>
        <?php print $order->payment_description;?>
    </div>
    <br/>
<?php }?>

<?php if ($order->order_add_info){ ?>
<table class = "jshop" style = "margin-top:15px">
<tr>
  <td width = "100%">
    <b><?php print _JSHOP_ORDER_COMMENT ?></b><br />
    <?php print $order->order_add_info ?>
  </td>
</tr>
</table>
<?php } ?>

<table class = "jshop" style = "margin-top:15px">
<tr>
  <td width = "100%">
    <b><?php print _JSHOP_ORDER_HISTORY ?></b><br />
    <table>
    <?php foreach($order->history as $history){?>
       <tr>
         <td>
           <?php  print formatdate($history->status_date_added, 0); ?>
         </td>
         <td>
           <?php print $history->status_name ?>
         </td>
         <td>
           <?php print $history->comments ?>
         </td>
       </tr>
    <?php } ?>
    </table>
  </td>
</tr>
</table>
<br/>
<?php if ($this->allow_cancel){?>
    <a href="<?php print SEFLink('index.php?option=com_jshopping&controller=user&task=cancelorder&order_id='.$order->order_id)?>"><?php print _JSHOP_CANCEL_ORDER?></a>
<?php }?>
</div>