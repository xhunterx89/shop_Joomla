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
  <tr>
    <td colspan = "2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan = "2" class="bg_gray">
      <h3><?php print _JSHOP_ORDER_ITEMS?></h3>
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
         foreach($this->products as $key_id=>$prod){
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
         <tr>
           <td colspan="5">&nbsp;</td>
         </tr>
         <?php /*if (!$this->client){?>
         <tr>
           <td colspan="5" class="bg_gray"><?php print _JSHOP_CUSTOMER_NOTE ?></td>
         </tr>
         <tr>
           <td colspan="5" style="padding-top:10px;"><?php print $this->order->order_add_info ?></td>
         </tr>
         <tr><td>&nbsp;</td></tr>
         <?php }*/ ?>         
       </table>
    </td>
  </tr>
  <?php if ($this->config->show_return_policy_in_email_order){?>
  <tr>
    <td colspan="2"><br/><br/><a class = "policy" target="_blank" href="<?php print $this->liveurlhost.SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=return_policy&tmpl=component');?>"><?php print _JSHOP_RETURN_POLICY?></a></td>
  </tr>
  <?php }?>
</table>
<br>    
</body>
</html>