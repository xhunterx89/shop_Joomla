<?php include(dirname(__FILE__)."/load.js.php");?>
<div class="jshop productfull">
<form name = "product" method = "post" action = "<?php print $this->action?>">
	<div class="product_header">
    <h1><?php print $this->product->name?><?php if ($this->config->show_product_code){?> <span class="jshop_code_prod">(<?php print _JSHOP_EAN?>: <span id="product_code"><?php print $this->product->getEan();?></span>)</span><?php }?></h1>
    <?php if ($this->config->display_button_print) print printContent();?>
    
    <div class="ratingandhits">
    <?php include(dirname(__FILE__)."/ratingandhits.php");?>
    </div>
     
     </div>
        
    <table class = "jshop">
    <tr>
        <td width = "100" style = "vertical-align:top">
            <?php if ($this->product->label_id && getNameImageLabel($this->product->label_id)){?>
                <div class="product_label">
                    <img src="<?php print $this->config->image_labels_live_path."/".getNameImageLabel($this->product->label_id); ?>" alt="<?php print getNameImageLabel($this->product->label_id, 2)?>" />
                </div>
            <?php }?>
            <?php if (count($this->videos)){?>
                <?php foreach($this->videos as $k=>$video){?>
                    <a style = "display:none" class = "video_full" id = "hide_video_<?php print $k;?>" href = ""></a>
                <?php } ?>
            <?php }?>
            <?php if(!count($this->images)){?>
                <img id = "main_image" src = "<?php print $this->image_product_path?>/<?php print $this->noimage?>" alt = "<?php print htmlspecialchars($this->product->name)?>" />
            <?php }?>
            <?php foreach($this->images as $k=>$image){?>
            <a  class="lightbox" id="main_image_full_<?php print $image->image_id?>" href="<?php print $this->image_product_path?>/<?php print $image->image_full;?>" <?php if ($image->image_full!=$this->product->product_full_image){?>style="display:none"<?php }?>>
                <img id = "main_image_<?php print $image->image_id?>" src = "<?php print $this->image_product_path?>/<?php print $image->image_name;?>" alt = "<?php print htmlspecialchars($this->product->name)?>" />
            </a>
            <?php }?>
            
            <?php if ($this->product->manufacturer_info->manufacturer_logo!=""){?>
            <div class="manufacturer_logo">
                <a href="<?php print SEFLink('index.php?option=com_jshopping&controller=manufacturer&task=view&manufacturer_id='.$this->product->product_manufacturer_id, 2);?>">
                    <img src="<?php print $this->config->image_manufs_live_path."/".$this->product->manufacturer_info->manufacturer_logo?>" alt="<?php print htmlspecialchars($this->product->manufacturer_info->name);?>" title="<?php print htmlspecialchars($this->product->manufacturer_info->name);?>" border="0" />
                </a>
            </div>    
            <?php }?>
        </td>
        <td class = "jshop_img_description" style = "padding-left: 10px;">
            <?php if ( (count($this->images)>1) || (count($this->videos) && count($this->images)) ) {?>
                <?php foreach($this->images as $k=>$image){?>
                    <img class = "jshop_img_thumb" src = "<?php print $this->image_product_path?>/<?php print $image->image_thumb?>" alt = "<?php print htmlspecialchars($this->product->name)?>" onclick = "showImage(<?php print $image->image_id?>)" />
                <?php }?>
            <br />
            <?php }?>            
            <?php if (count($this->videos)){?>
                <?php foreach($this->videos as $k=>$video){?>                
                    <a href="<?php print $this->video_product_path?>/<?php print $video->video_name?>" id="video_<?php print $k?>" onclick = "showVideo(this.id, '<?php print $this->config->video_product_width;?>', '<?php print $this->config->video_product_height;?>'); return false;"><img class="jshop_video_thumb" src = "<?php print $this->video_image_preview_path."/"; if ($video->video_preview) print $video->video_preview; else print 'video.gif'?>" alt = "video" /></a>
                <?php } ?>
            <?php }?>
        </td>
    </tr>
    </table>
    
   
    <div class="cart_wrapper">
    
    	
        <div class="cart_wrapper_left">
    
			<?php if (count($this->attributes)){?>
            <div class = "jshop_prod_attributes">
                <table class = "jshop">
                <?php foreach($this->attributes as $attribut){?>
                <tr>
                    <td width = "50">
                        <?php print $attribut->attr_name?>:
                    </td>
                    <td>
                        <span id='block_attr_sel_<?php print $attribut->attr_id?>'>
                        <?php print $attribut->selects?>
                        </span>
                    </td>
                </tr>
                <?php }?>
                </table>
            </div>
            <br />
            <?php }?>
    
            
            <?php if (count($this->product->freeattributes)){?>
            <div class="prod_free_attribs">
                <table class = "jshop">
                <?php foreach($this->product->freeattributes as $freeattribut){?>
                <tr>
                    <td width="80"><?php print $freeattribut->name;?> <?php if ($freeattribut->required){?><span>*</span><?php }?></td>
                    <td><input type="text" class="inputbox" size="40" name="freeattribut[<?php print $freeattribut->id?>]" value="" /></td>
                </tr>
                <?php }?>
                </table>
                <?php if ($this->product->freeattribrequire) {?>
                <div class="requiredtext">* <?php print _JSHOP_REQUIRED?></div>
                <?php }?>
            </div>
            <?php }?>
            
         </div>   
            
    		
         <div class="cart_wrapper_right">   
            
            
			<?php if ($this->product->product_is_add_price){?>
            <div class="price_prod_qty_list_head"><?php print _JSHOP_PRICE_FOR_QTY?></div>
            <table class="price_prod_qty_list">
            <?php foreach($this->product->product_add_prices as $k=>$add_price){?>
                <tr>
                    <td class="qty_from" <?php if ($add_price->product_quantity_finish==0){?>colspan="3"<?php } ?>>
                        <?php if ($add_price->product_quantity_finish==0) print _JSHOP_FROM; ?>
                        <?php print $add_price->product_quantity_start." ".JSHP_ST_?>
                    </td>
                    <?php if ($add_price->product_quantity_finish > 0){?>
                    <td class="qty_line"> - </td>
                    <?php } ?>
                    <?php if ($add_price->product_quantity_finish > 0){?>
                    <td class="qty_to">
                        <?php print $add_price->product_quantity_finish." ".JSHP_ST_;?>
                    </td>
                    <?php } ?>
                    <td class="qty_price">            
                        <span id="pricelist_from_<?php print $add_price->product_quantity_start?>"><?php print formatprice($add_price->price)?></span> <span class="per_piece"><?php print _JSHOP_PER_PIECE?></span>
                    </td>
                </tr>
            <?php }?>
            </table>
            <br/>
            <?php }?>
            
            <?php if ($this->product->product_old_price > 0){?>
            <div class="old_price">
                <?php print _JSHOP_OLD_PRICE?> <span class="old_price"><?php print formatprice($this->product->product_old_price)?></span>
            </div>
            <?php }?>        
            
            <?php if ($this->product->getPriceCalculate() > 0 || !$this->config->user_as_catalog){?>
            <div class="prod_price">
                <?php print _JSHOP_PRICE?>: <span id="block_price" class="jshop_price"><?php print formatprice($this->product->getPriceCalculate())?></span>
            </div>
            <?php }?>
            
            <?php if ($this->config->show_tax_in_product && $this->product->product_tax > 0){ ?>
                <span class="taxinfo"><?php print productTaxInfo($this->product->product_tax);?></span>
            <?php }?>
            <?php if ($this->config->show_plus_shipping_in_product){?>
                <span class="plusshippinginfo"><?php print sprintf(_JSHOP_PLUS_SHIPPING, $this->shippinginfo);?></span>
            <?php }?>
            <?php if ($this->product->delivery_time != ''){?>
                <div class="deliverytime"><?php print _JSHOP_DELIVERY_TIME?>: <?php print $this->product->delivery_time?></div>
            <?php }?>
            <?php if ($this->config->product_show_weight && $this->product->product_weight > 0){?>
                <div class="productweight"><?php print _JSHOP_WEIGHT?>: <span id="block_weight"><?php print formatweight($this->product->getWeight())?></span> <?php print _JSHOP_WEIGHT_UNIT?></div>
            <?php }?>
            
            <?php if ($this->product->product_basic_price_show){?>
                <div class="prod_base_price"><?php print _JSHOP_BASIC_PRICE?>: <span id="block_basic_price"><?php print formatprice($this->product->product_basic_price_calculate)?></span> / <?php print $this->product->product_basic_price_unit_name;?></div>
            <?php }?>
            
            <?php if (is_array($this->product->extra_field)){?>
                <div class="extra_fields">
                <?php foreach($this->product->extra_field as $extra_field){?>
                    <div><?php print $extra_field['name']; ?>: <?php print $extra_field['value']; ?></div>
                <?php }?>
                </div>
            <?php }?>
            
            <?php if ($this->product->vendor_info){?>
                <div class="vendorinfo">
                    <?php print _JSHOP_VENDOR?>: <?php print $this->product->vendor_info->shop_name?> (<?php print $this->product->vendor_info->l_name." ".$this->product->vendor_info->f_name;?>),
                    ( 
                    <?php if ($this->config->product_show_vendor_detail){?><a href="<?php print $this->product->vendor_info->urlinfo?>"><?php print _JSHOP_ABOUT_VENDOR?></a>,<?php }?> 
                    <a href="<?php print $this->product->vendor_info->urllistproducts?>"><?php print _JSHOP_VIEW_OTHER_VENDOR_PRODUCTS?></a> )
                </div>
            <?php }?>
            
            <?php if (!$this->config->hide_text_product_not_available){ ?>
                <div class = "not_available" id="not_available" style="display: none"><?php print $this->available?></div>
            <?php }?>    
                                
            <?php if (!$this->hide_buy){?>                         
                <table class="prod_buttons">
                <tr>
                    <td class="prod_qty">
                        <?php print _JSHOP_QUANTITY?>:&nbsp;
                    </td>
                    <td class="prod_qty_input">
                        <input type = "text" name = "quantity" id = "quantity" onkeyup="reloadPrices();" class = "inputbox" style = "width: 20px" value = "<?php print $this->default_count_product?>" />
                    </td>        
                    <td class = "buttons">            
                        <button type="submit" class="button cart" onclick="jQuery('#to').val('cart');"><span><?php print _JSHOP_ADD_TO_CART?></span></button>
                        <?php if ($this->enable_wishlist){?>
                            <input type = "submit" class="button wishlist" value = "<?php print _JSHOP_ADD_TO_WISHLIST?>" onclick="jQuery('#to').val('wishlist');" />
                        <?php }?>
                    </td>
                    <td id = "jshop_image_loading" style = "display:none"></td>
                </tr>
                </table>
            <?php }?>
            
        </div>    
            
        <input type="hidden" name="to" id='to' value="cart" />
        <input type = "hidden" name = "product_id" id = "product_id" value = "<?php print $this->product->product_id?>" />
        <input type = "hidden" name = "category_id" id = "category_id" value = "<?php print $this->category_id?>" />
        </form>
</div>
    
    <div class = "jshop_prod_description">
        <?php print $this->product->description; ?>
    </div>        
    
    <?php if ($this->product->product_url!=""){?>
    <p class="prod_url readmore">
        <a target="_blank" href="<?php print $this->product->product_url;?>"><?php print _JSHOP_READ_MORE?></a>
    </p>
    <?php }?>
    
    
    

<?php
if (count ($this->demofiles)){?>
<div class="list_product_demo">
    <table>
        <?php foreach($this->demofiles as $demo){?>
        <tr>
            <td class="descr"><?php print $demo->demo_descr?></td>            
            <?php if ($this->config->demo_type == 1) { ?>
                <td class="download"><a target="_blank" href="<?php print $this->config->demo_product_live_path."/".$demo->demo;?>" onClick="popupWin = window.open('<?php print SEFLink("index.php?option=com_jshopping&controller=product&task=showmedia&media_id=".$demo->id);?>', 'video', 'width=<?php print $this->config->video_product_width;?>,height=<?php print $this->config->video_product_height;?>,top=0,resizable=no,location=no'); popupWin.focus(); return false;"><img src = "<?php print $this->config->live_path.'images/play.gif'; ?>" alt = "play" title = "play"/></a></td>
            <?php } else { ?>
                <td class="download"><a target="_blank" href="<?php print $this->config->demo_product_live_path."/".$demo->demo;?>"><?php print _JSHOP_DOWNLOAD;?></a></td>
            <?php }?>
        </tr>
        <?php }?>
    </table>
</div>
<?php } ?>

<?php if ($this->config->product_show_button_back){?>
<br/>
<input type="button" class = "button" value="<?php print _JSHOP_BACK;?>" onclick="history.go(-1);" />
<?php }?>

<?php
    include(dirname(__FILE__)."/related.php");
    include(dirname(__FILE__)."/review.php");
?>
</div>