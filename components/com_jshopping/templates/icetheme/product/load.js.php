<script type="text/javascript">
    <?php if ($this->product->product_quantity >0){?>
    var translate_not_available = "<?php print addslashes(_JSHOP_PRODUCT_NOT_AVAILABLE_THIS_OPTION)?>";
    <?php }else{?>
    var translate_not_available = "<?php print addslashes(_JSHOP_PRODUCT_NOT_AVAILABLE)?>";
    <?php }?>
    var product_basic_price_volume = <?php print $this->product->weight_volume_units;?>;
    var product_basic_price_unit_qty = <?php print $this->product->product_basic_price_unit_qty;?>;
    var currency_code = "<?php print $this->config->currency_code;?>";
    var format_currency = "<?php print $this->config->format_currency[$this->config->currency_format];?>";
    var attr_value = new Object();
    var attr_list = new Array();
    var attr_img = new Object();
    <?php if (count($this->attributes)){?>
        <?php $i=0;foreach($this->attributes as $attribut){?>
        attr_value["<?php print $attribut->attr_id?>"] = "<?php print $attribut->firstval?>";
        attr_list[<?php print $i++;?>] = "<?php print $attribut->attr_id?>";
        <?php } ?>
    <?php } ?>
    <?php foreach($this->all_attr_values as $attrval){ if ($attrval->image){?>attr_img[<?php print $attrval->value_id?>] = "<?php print $attrval->image?>";<?php } }?>
    var liveurl = '<?php print JURI::root()?>';
    var liveattrpath = '<?php print $this->config->image_attributes_live_path;?>';
    var liveimgpath = '<?php print $this->config->live_path."images";?>';
    var urlupdateprice = '<?php print $this->urlupdateprice;?>';
</script>