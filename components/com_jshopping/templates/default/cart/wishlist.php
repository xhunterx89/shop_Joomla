
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
    <th width = "10%">
      <?php print _JSHOP_REMOVE_TO_CART ?>
    </th>
    <th width = "10%">
      <?php print _JSHOP_REMOVE ?>
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
    <td>
      <a href = "<?php print $prod['remove_to_cart'] ?>" ><img src = "<?php print $this->image_path ?>images/reload.png" alt = "<?php print _JSHOP_REMOVE_TO_CART?>" title = "<?php print _JSHOP_REMOVE_TO_CART?>" /></a>
    </td>
    <td>
      <a href = "<?php print $prod['href_delete'] ?>" onclick="return confirm('<?php print _JSHOP_REMOVE?>')"><img src = "<?php print $this->image_path ?>images/remove.png" alt = "<?php print _JSHOP_DELETE?>" title = "<?php print _JSHOP_DELETE?>" /></a>
    </td>
  </tr>
  <?php 
  $i++;
  } 
  ?>
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
         <?php print _JSHOP_GO_TO_CART ?>
         <img src = "<?php print $this->image_path ?>/images/arrow_right.gif" alt = "<?php print _JSHOP_GO_TO_CART ?>" />
       </a>
    </td>
  </tr>
</table>