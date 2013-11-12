<div class="jshop">
<form action = "<?php print SEFLink('index.php?option=com_jshopping&controller=cart&task=refresh')?>" method = "post" name = "updateCart">
<table class = "jshop cart">
  <tr>
    <th width = "20%">
      <?php print _JSHOP_IMAGE?>
    </th>
    <th>
      <?php print _JSHOP_ITEM?>
    </th>    
    <th width = "15%">
      <?php print _JSHOP_SINGLEPRICE ?>
    </th>
    <th width = "15%">
      <table align="center">
        <tr>
            <th><?php print _JSHOP_NUMBER ?></th>
            <th>&nbsp;<img style = "cursor:pointer" src = "<?php print $this->image_path ?>/images/save.png" title = "<?php print _JSHOP_UPDATE_CART ?>" alt = "<?php print _JSHOP_UPDATE_CART ?>" onclick = "document.updateCart.submit();" /></th>
        </tr>
        </table>
    </th>
    <th width = "15%">
      <?php print _JSHOP_PRICE_TOTAL ?>
    </th>
    <th width = "10%">
      <?php print _JSHOP_REMOVE ?>
    </th>
  </tr>
  <?php 
  $i=1; 
  $countprod = count($this->products);
  foreach($this->products as $key_id=>$prod){
  ?> 
  <tr class = "jshop_prod_cart <?php if ($i%2==0) print "even"; else print "odd"?>">
    <td class = "jshop_img_description_center">
      <a href = "<?php print $prod['href']; ?>">
        <img src = "<?php print $this->image_product_path ?>/<?php if ($prod['thumb_image']) print $prod['thumb_image']; else print $this->no_image; ?>" alt = "<?php print htmlspecialchars($prod['product_name']);?>" class = "jshop_img" />
      </a>
    </td>
    <td style="text-align:left">
        <?php print $prod['product_name'];?>
        <?php if ($this->config->show_product_code_in_cart) print "<span class='jshop_code_prod'>(".$prod['ean'].")</span>";?>
        
        <?php foreach($prod['attributes_value'] as $attr){ ?>
          <p class = "jshop_cart_attribute"><?php print $attr->attr ?> : <?php print $attr->value ?></p>
        <?php } ?>
        
        <?php foreach($prod['free_attributes_value'] as $attr){ ?>
          <p class = "jshop_cart_attribute"><?php print $attr->attr ?> : <?php print $attr->value ?></p>
        <?php } ?>
    </td>    
    <td>
        <?php print formatprice($prod['price']) ?>
        <?php if ($this->config->show_tax_product_in_cart && $prod['tax']>0){?>
            <span class="taxinfo"><?php print productTaxInfo($prod['tax']);?></span>
        <?php }?>
    </td>
    <td>
      <input type = "text" name = "quantity[<?php print $key_id ?>]" value = "<?php print $prod['quantity'] ?>" class = "inputbox" style = "width: 25px" />
    </td>
    <td>
        <?php print formatprice($prod['price']*$prod['quantity']); ?>
        <?php if ($this->config->show_tax_product_in_cart && $prod['tax']>0){?>
            <span class="taxinfo"><?php print productTaxInfo($prod['tax']);?></span>
        <?php }?>
    </td>
    <td>
      <a href = "<?php print $prod['href_delete'] ?>" onclick="return confirm('<?php print _JSHOP_CONFIRM_REMOVE?>')"><img src = "<?php print $this->image_path ?>images/remove.png" alt = "<?php print _JSHOP_DELETE?>" title = "<?php print _JSHOP_DELETE?>" /></a>
    </td>
  </tr>
  <?php 
  $i++;
  } 
  ?>
  </table>
  
  <?php if ($this->config->show_weight_order){?>  
    <div class="weightorder">
        <?php print _JSHOP_WEIGHT_PRODUCTS?>: <span><?php print formatweight($this->weight);?></span> <?php print _JSHOP_WEIGHT_UNIT;?>
    </div>
  <?php }?>
  
  <?php if ($this->config->summ_null_shipping>0){?>
    <div class="shippingfree">
        <?php printf(_JSHOP_FROM_PRICE_SHIPPING_FREE, formatprice($this->config->summ_null_shipping, null, 1));?>
    </div>
  <?php } ?> 
  
  <br/>
<table class = "jshop jshop_subtotal">
  <?php if (!$this->hide_subtotal){?>
  <tr>
    <td class = "name">
      <?php print _JSHOP_SUBTOTAL ?>
    </td>
    <td class = "value">
      <?php print formatprice($this->summ); ?>
    </td>
  </tr>
  <?php } ?>
  <?php if ($this->discount > 0){ ?>
  <tr>
    <td class = "name">
      <?php print _JSHOP_RABATT_VALUE ?>
    </td>
    <td class = "value">
      <?php print formatprice(-$this->discount); ?>
    </td>
  </tr>
  <?php } ?>
  <?php if (!$this->config->hide_tax){ ?>
  <?php foreach($this->tax_list as $percent=>$value){ ?>
  <tr>
    <td class = "name">
      <?php print displayTotalCartTaxName();?>
      <?php if ($this->show_percent_tax) print formattax($percent)."%"?>
    </td>
    <td class = "value">
      <?php print formatprice($value); ?>
    </td>
  </tr>
  <?php } ?>
  <?php } ?>
  <tr>
    <td class = "name">
      <?php print _JSHOP_PRICE_TOTAL ?>
    </td>
    <td class = "value">
      <?php print formatprice($this->fullsumm) ?>
    </td>
  </tr>
  <?php if ($this->config->show_plus_shipping_in_product){?>  
  <tr>
    <td colspan="2" align="right">    
        <span class="plusshippinginfo"><?php print sprintf(_JSHOP_PLUS_SHIPPING, $this->shippinginfo);?></span>  
    </td>
  </tr>
  <?php }?>
  <?php if ($this->free_discount > 0){?>  
  <tr>
    <td colspan="2" align="right">    
        <span class="free_discount"><?php print _JSHOP_FREE_DISCOUNT;?>: <?php print formatprice($this->free_discount); ?></span>  
    </td>
  </tr>
  <?php }?>  
</table>

<table class = "jshop" style = "margin-top:10px">
  <tr id = "checkout">
    <td width = "50%" class = "td_1">
       <a href = "<?php print $this->href_shop ?>">
         <img src = "<?php print $this->image_path ?>/images/arrow_left.gif" alt = "<?php print _JSHOP_BACK_TO_SHOP ?>" />
         <?php print _JSHOP_BACK_TO_SHOP ?>
       </a>
    </td>
    <td width = "50%" class = "td_2">
       <a href = "<?php print $this->href_checkout ?>">
         <?php print _JSHOP_CHECKOUT ?>
         <img src = "<?php print $this->image_path ?>/images/arrow_right.gif" alt = "<?php print _JSHOP_CHECKOUT ?>" />
       </a>
    </td>
  </tr>
</table>

</form>

<?php if ($this->use_rabatt){ ?>
<br /><br />
<form name = "rabatt" method = "post" action = "<?php print SEFLink('index.php?option=com_jshopping&controller=cart&task=discountsave')?>">
<table class = "jshop">
  <tr>
    <td>
      <?php print _JSHOP_RABATT ?>
      <input type = "text" class = "inputbox" name = "rabatt" value = "" />
      <input type = "submit" class = "button" value = "<?php print _JSHOP_RABATT_ACTIVE ?>" />
    </td>
  </tr>
</table>
</form>
<?php }?>
</div>