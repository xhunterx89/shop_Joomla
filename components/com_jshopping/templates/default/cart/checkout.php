<div class="jshop">
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
      <?php print _JSHOP_NUMBER ?>
    </th>
    <th width = "15%">
      <?php print _JSHOP_PRICE_TOTAL ?>
    </th>
  </tr>
  <?php 
  $i=1; $countprod = count($this->products);
  foreach($this->products as $key_id=>$prod){?> 
  <tr class = "jshop_prod_cart <?php if ($i%2==0) print "even"; else print "odd"?>">
    <td class = "jshop_img_description_center">
      <a href = "<?php print $prod['href']; ?>">
        <img src = "<?php print $this->image_product_path ?>/<?php if ($prod['thumb_image']) print $prod['thumb_image']; else print $this->no_image; ?>" alt = "<?php print htmlspecialchars($prod['product_name']);?>" class = "jshop_img" />
      </a>
    </td>
    <td style="text-align:left">
        <?php print $prod['product_name']; ?>
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
      <?php print $prod['quantity'] ?>
    </td>
    <td>
      <?php print formatprice($prod['price']*$prod['quantity']); ?>
      <?php if ($this->config->show_tax_product_in_cart && $prod['tax']>0){?>
            <span class="taxinfo"><?php print productTaxInfo($prod['tax']);?></span>
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
        <?php print _JSHOP_WEIGHT_PRODUCTS?>: <span><?php print formatweight($this->weight);?></span> <?php print _JSHOP_WEIGHT_UNIT;?>
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
  <?php if (isset($this->summ_delivery)){ ?>
  <tr>
    <td class = "name">
         <?php print _JSHOP_SHIPPING_PRICE;?>
    </td>
    <td class = "value">
      <?php print formatprice($this->summ_delivery);?>
    </td>
  </tr>
  <?php } ?>
  <?php if ($this->summ_payment > 0){ ?>
  <tr>
    <td class = "name">
         <?php print $this->payment_name;?>
    </td>
    <td class = "value">
      <?php print formatprice($this->summ_payment);?>
    </td>
  </tr>
  <?php } ?>  
  <?php if (!$this->config->hide_tax){ ?>
  <?php foreach($this->tax_list as $percent=>$value){?>
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
      <?php print $this->text_total; ?>
    </td>
    <td class = "value">
      <?php print formatprice($this->fullsumm) ?>
    </td>
  </tr>
  <?php if ($this->free_discount > 0){?>  
  <tr>
    <td colspan="2" align="right">    
        <span class="free_discount"><?php print _JSHOP_FREE_DISCOUNT;?>: <?php print formatprice($this->free_discount); ?></span>  
    </td>
  </tr>
  <?php }?>  
</table>
</div>