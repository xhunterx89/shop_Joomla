<?php
$order = $this->order;
?>
<html>
<title></title>
<head>
<style type = "text/css">
html{
    font-family:Tahoma;
    line-height:100%;
}
body, td{
    font-size:12px;
    font-family:Tahoma;
}
td.bg_gray, tr.bg_gray td {
    background-color: #CCCCCC;
}
table {
    border-collapse:collapse;
    border:0;
}
td{
    padding-left:3px;
    padding-right: 3px;
    padding-top:0px;
    padding-bottom:0px;
}
tr.bold td{
    font-weight:bold;
}
tr.vertical td{
    vertical-align:top;
    padding-bottom:10px;
}
h3{
    font-size:14px;
    margin:2px;
}
.jshop_cart_attribute{
    padding-top: 5px;
    font-size:11px;
}
.taxinfo{
    font-size:11px;
}
</style>
</head>
<body>
<table width="794px" align="center" border="0" cellspacing="0" cellpadding="0" style="line-height:100%;">
  <tr valign="top">
     <td colspan = "2">
       <?php print $this->info_shop;?>
     </td>
  </tr>
  <?php if ($this->client){?>
  <tr>
     <td colspan = "2" style="padding-bottom:10px;">
       <?php print $this->order_email_descr;?>
     </td>
  </tr>
  <?php }?>
  <tr class = "bg_gray">
     <td colspan = "2">
        <h3><?php print _JSHOP_EMAIL_PURCHASE_ORDER?></h3>
     </td>
  </tr>
  <tr><td style="height:10px;font-size:1px;">&nbsp;</td></tr>
  <tr>
     <td width="50%">
        <?php print _JSHOP_ORDER_NUMBER?>:
     </td>
     <td width="50%">
        <?php print $this->order->order_number?>
     </td>
  </tr>
  <tr>
     <td>
        <?php print _JSHOP_ORDER_DATE?>:
     </td>
     <td>
        <?php print $this->order->order_date?>
     </td>
  </tr>
  <tr>
     <td>
        <?php print _JSHOP_ORDER_STATUS?>:
     </td>
     <td>
        <?php print $this->order->status?>
     </td>
  </tr>
  <tr><td style="height:10px;font-size:1px;">&nbsp;</td></tr>
  <tr class="bg_gray">
    <td colspan="2" width = "50%">
       <h3><?php print _JSHOP_CUSTOMER_INFORMATION?></h3>
    </td>
  </tr>
  <tr>
    <td  style="vertical-align:top;padding-top:10px;" width = "50%">
      <table cellspacing="0" cellpadding="0" style="line-height:100%;">
        <tr>
          <td colspan="2"><b><?php print _JSHOP_EMAIL_BILL_TO?></b></td>
        </tr>
        <?php if ($this->config_fields['firma_name']['display']){?>
        <tr>
          <td width = "100"><?php print _JSHOP_FIRMA_NAME?>:</td>
          <td><?php print $this->order->firma_name?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['f_name']['display']){?>
        <tr>
          <td width = "100"><?php print _JSHOP_FULL_NAME?>:</td>
          <td><?php print $this->order->f_name?> <?php print $this->order->l_name?></td>
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
    <td style="vertical-align:top;padding-top:10px;" width = "50%">
    <?php if ($this->count_filed_delivery >0) {?>
    <table cellspacing="0" cellpadding="0" style="line-height:100%;">
        <tr>
            <td colspan=2><b><?php print _JSHOP_EMAIL_SHIP_TO?></b></td>
        </tr>      
        <?php if ($this->config_fields['d_firma_name']['display']){?>
        <tr>
            <td width="100"><?php print _JSHOP_FIRMA_NAME?>:</td>
            <td ><?php print $this->order->d_firma_name?></td>
        </tr>
        <?php } ?>
        <?php if ($this->config_fields['d_f_name']['display']){?>
        <tr>
            <td width="100"><?php print _JSHOP_FULL_NAME?> </td>
            <td><?php print $this->order->d_f_name?> <?php print $this->order->d_l_name?></td>
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
    <?php }?> 
    </td>
  </tr>
  <tr>
    <td colspan = "2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan = "2" class="bg_gray">
      <h3><?php print _JSHOP_ORDER_ITEMS ?></h3>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="padding:0px;padding-top:10px;">
       <table width="100%" cellspacing="0" cellpadding="0" class="table_items">
        <tr><td colspan="5" style="vertical-align:top;padding-bottom:5px;font-size:1px;"><div style="height:1px;border-top:1px solid #999;"></div></td></tr>
         <tr class = "bold">            
            <td width="45%" style="padding-left:10px;padding-bottom:5px;"><?php print _JSHOP_NAME_PRODUCT?></td>            
            <td width="15%" style="padding-bottom:5px;"><?php if ($this->config->show_product_code_in_order){?><?php print _JSHOP_EAN_PRODUCT?><?php } ?></td>
            <td width="10%" style="padding-bottom:5px;"><?php print _JSHOP_QUANTITY?></td>
            <td width="15%" style="padding-bottom:5px;"><?php print _JSHOP_SINGLEPRICE?></td>
            <td width="15%" style="padding-bottom:5px;"><?php print _JSHOP_PRICE_TOTAL?></td>
         </tr>
         <tr><td colspan="5" style="vertical-align:top;padding-bottom:10px;font-size:1px;"><div style="height:1px;border-top:1px solid #999;"></div></td></tr>
         <?php 
         foreach($this->order->products as $key_id=>$prod){
             $files = unserialize($prod->files);
         ?>
         <tr class = "vertical">
           <td>
                <img src="<?php print $this->config->image_product_live_path?>/<?php if ($prod->thumb_image) print $prod->thumb_image; else print $this->noimage;?>" align="left" style="margin-right:5px;">
                <?php print $prod->product_name;?>                
                <div class = "jshop_cart_attribute"><?php print nl2br($prod->product_attributes).nl2br($prod->product_freeattributes); ?></div>
           </td>           
           <td><?php if ($this->config->show_product_code_in_order){?><?php print $prod->product_ean;?><?php } ?></td>
           <td><?php print $prod->product_quantity; ?></td>
           <td>
                <?php print formatprice($prod->product_item_price, $order->currency_code) ?>
                <?php if ($this->config->show_tax_product_in_cart && $prod->product_tax>0){?>
                    <div class="taxinfo"><?php print productTaxInfo($prod->product_tax, $order->display_price);?></div>
                <?php }?>
           </td>
           <td>
                <?php print formatprice($prod->product_item_price*$prod->product_quantity, $order->currency_code); ?>
                <?php if ($this->config->show_tax_product_in_cart && $prod->product_tax>0){?>
                    <div class="taxinfo"><?php print productTaxInfo($prod->product_tax, $order->display_price);?></div>
                <?php }?>
            </td>
         </tr>
         <?php if (count($files)){?>
         <tr>
            <td colspan="5">
            <?php foreach($files as $file){?>
                <div><?php print $file->file_descr?> <a href="<?php print JURI::root()?>index.php?option=com_jshopping&controller=product&task=getfile&oid=<?php print $this->order->order_id?>&id=<?php print $file->id?>&hash=<?php print $this->order->file_hash;?>"><?php print _JSHOP_DOWNLOAD?></a></div>
            <?php }?>    
            </td>
         </tr>
         <?php }?>
         <tr><td colspan="5" style="vertical-align:top;padding-bottom:10px;font-size:1px;"><div style="height:1px;border-top:1px solid #999;"></div></td></tr>
         <?php } ?>
         <?php if ($this->config->show_weight_order){?>
         <tr>
            <td colspan="5" style="text-align:right;font-size:11px;">            
                <?php print _JSHOP_WEIGHT_PRODUCTS?>: <span><?php print formatweight($this->order->weight);?></span> <?php print _JSHOP_WEIGHT_UNIT;?>
            </td>
         </tr>   
         <?php }?>
         <tr>
           <td colspan="5">&nbsp;</td>
         </tr>
         <?php if (!$this->hide_subtotal){?>
         <tr>
           <td colspan="4" align="right" style="padding-right:15px;"><?php print _JSHOP_SUBTOTAL ?>:</td>
           <td class = "price"><?php print formatprice($this->order->order_subtotal, $order->currency_code); ?></td>
         </tr>
         <?php } ?>
         <?php if ($this->order->order_discount > 0){?>
         <tr>
           <td colspan="4" align="right" style="padding-right:15px;"><?php print _JSHOP_RABATT_VALUE ?>: </td>
           <td class = "price">-<?php print formatprice($this->order->order_discount, $order->currency_code); ?></td>
         </tr>
         <?php } ?>
         <?php if (!$this->config->without_shipping){?>
         <tr>
           <td colspan="4" align="right" style="padding-right:15px;"><?php print _JSHOP_SHIPPING_PRICE ?>:</td>
           <td class = "price"><?php print formatprice($this->order->order_shipping, $order->currency_code); ?></td>
         </tr>
         <?php } ?>
         <?php if ($this->order->order_payment > 0){?>
         <tr>
           <td colspan="4" align="right" style="padding-right:15px;"><?php print $this->order->payment_name;?>:</td>
           <td class = "price"><?php print formatprice($this->order->order_payment, $order->currency_code); ?></td>
         </tr>
         <?php } ?>
         <?php if (!$this->config->hide_tax){ ?>                           
         <?php foreach($this->order->order_tax_list as $percent=>$value){?>
         <tr>
           <td colspan="4" align="right" style="padding-right:15px;"><?php print displayTotalCartTaxName($order->display_price);?><?php if ($this->show_percent_tax) print " ".formattax($percent)."%";?>:</td>
             <td class = "price"><?php print formatprice($value, $order->currency_code); ?></td>
         </tr>
         <?php } ?>
         <?php } ?>
         <tr>
           <td colspan="4" align="right" style="padding-right:15px;"><b><?php print $this->text_total ?>:</b></td>
           <td class = "price"><?php print formatprice($this->order->order_total, $order->currency_code); ?></td>
         </tr>
         <tr>
           <td colspan="5">&nbsp;</td>
         </tr>
         <?php if (!$this->client){?>
         <tr>
           <td colspan="5" class="bg_gray"><?php print _JSHOP_CUSTOMER_NOTE ?></td>
         </tr>
         <tr>
           <td colspan="5" style="padding-top:10px;"><?php print $this->order->order_add_info ?></td>
         </tr>
         <tr><td>&nbsp;</td></tr>
         <?php } ?>         
       </table>
    </td>
  </tr>
  <?php if (!$this->config->without_payment || !$this->config->without_shipping){?>  
  <tr class = "bg_gray">
    <?php if (!$this->config->without_payment){?>
    <td>
        <h3><?php print _JSHOP_PAYMENT_INFORMATION ?></h3>
    </td>    
    <?php }?>
    <td <?php if ($this->config->without_payment){?> colspan="2" <?php }?>>
        <?php if (!$this->config->without_shipping){?>
        <h3><?php print _JSHOP_SHIPPING_INFORMATION ?></h3>
        <?php } ?>
    </td>    
  </tr>
  <tr><td style="height:5px;font-size:1px;">&nbsp;</td></tr>
  <tr>
    <?php if (!$this->config->without_payment){?>
    <td valign="top">    
        <div style="padding-bottom:4px;"><?php print $this->order->payment_name;?></div>
        <div style="font-size:11px;">
        <?php
            print nl2br($this->order->payment_information);
            print $this->order->payment_description;
        ?>
        </div>
    </td>
    <?php }?>
    <td valign="top" <?php if ($this->config->without_payment){?> colspan="2" <?php }?>>
        <?php 
        if (!$this->config->without_shipping){
            print nl2br($this->order->shipping_information);
        }
        ?>
    </td>  
  </tr>
  <?php }?>
  <?php if ($this->config->show_return_policy_in_email_order){?>
  <tr>
    <td colspan="2"><br/><br/><a class = "policy" target="_blank" href="<?php print $this->liveurlhost.SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=return_policy&tmpl=component');?>"><?php print _JSHOP_RETURN_POLICY?></a></td>
  </tr>
  <?php }?>
</table>
<br>    
</body>
</html>