<div class="jshop">
<form id = "shipping_form" name = "shipping_form" action = "<?php print $this->action ?>" method = "post" onsubmit = "return validateShippingMethods()">
<table id = "table_shippings" cellspacing="0" cellpadding="0">
<?php foreach($this->shipping_methods as $shipping) {?>
  <tr>
    <td style = "padding-top:5px; padding-bottom:5px">
      <input type = "radio" name = "sh_pr_method_id" id = "shipping_method_<?php print $shipping->sh_pr_method_id ?>" value = "<?php print $shipping->sh_pr_method_id ?>" <?php if ($shipping->sh_pr_method_id==$this->active_shipping){ ?>checked = "checked"<?php } ?> />
      <label for = "shipping_method_<?php print $shipping->sh_pr_method_id ?>"><?php print $shipping->name?> (<?php print formatprice($shipping->calculeprice); ?>)</label>
      
      <?php if ($this->config->show_list_price_shipping_weight && count($shipping->shipping_price)){ ?>
          <br />
          <table class="shipping_weight_to_price">
          <?php foreach($shipping->shipping_price as $price){?>
              <tr>
                <td class="weight">
                    <?php if ($price->shipping_weight_to!=0){?>
                        <?php print formatweight($price->shipping_weight_from);?> - <?php print formatweight($price->shipping_weight_to);?> <?php print _JSHOP_WEIGHT_UNIT ?>
                    <?php }else{ ?>
                        <?php print _JSHOP_FROM." ".formatweight($price->shipping_weight_from);?> <?php print _JSHOP_WEIGHT_UNIT ?>
                    <?php } ?>    
                </td>
                <td class="price">
                    <?php print formatprice($price->shipping_price); ?>
                </td>
            </tr>
          <?php } ?>
          </table>
      <?php } ?>
      <br /><?php print $shipping->description ?></td>
  </tr>
<?php } ?>
</table>
<br/>
<input type = "submit" class = "button" value = "<?php print _JSHOP_NEXT ?>" />
</form>
</div>