<div class="jshop">

<h1><?php print $this->category->name?></h1>

<?php print $this->category->description?>

<div class="jshop_list_category">
<?php if (count($this->categories)){ ?>
<table class = "jshop">
    <?php foreach($this->categories as $k=>$category){?>
        <tr>
        <td class = "jshop_categ" width = "<?php print (100/$this->count_category_to_row)?>%">
          <table class = "category">
             <tr>
               <td>
                     <div class="img_wrapper">
                      <a href = "<?php print $category->category_link;?>"><img class = "jshop_img" src = "<?php print $this->image_category_path;?>/<?php if ($category->category_image) print $category->category_image; else print $this->noimage;?>" alt="<?php print htmlspecialchars($category->name)?>" title="<?php print htmlspecialchars($category->name)?>" /></a>
             
             		</div>
                    
                    <h3><a class = "product_link" href = "<?php print $category->category_link?>"><?php print $category->name?></a></h3>
                    
                   <p class = "category_short_description"><?php print $category->short_description?></p>
                   
                   
               </td>
             </tr>
           </table>
        </td>    
       </tr>
    <?php } ?>
</table>
<?php } ?>
</div>

<?php if ($this->display_list_products){ ?>
<div class="jshop_list_product">
    <?php include(dirname(__FILE__)."/form_filters.php")?>
    <?php if (count($this->lists_prod)){?>
    <table class = "jshop jshop2">
        <?php foreach ($this->lists_prod as $k=>$product){?>
        <?php if ($k%$this->count_product_to_row==0) print "<tr>";?>
            <td width = "<?php print 100/$this->count_product_to_row?>%" class = "jshop_categ">
                <table class = "product">
                    <tr>
                        <td>
                          
                            <h3>
                                <a href="<?php print $product->product_link?>"><?php print $product->name?></a>
                                <?php if ($this->config->product_list_show_product_code){?><span class="jshop_code_prod">(<?php print _JSHOP_EAN?>: <?php print $product->product_ean;?>)</span><?php }?></h3>
                            
                             <div class="img_wrapper clearfix">
                             	
                                  <div class="img_wrapper2">
                                  
                                  	 <div class="img_wrapper3">
                                     
                                  
                                <?php if ($product->label_id && getNameImageLabel($product->label_id)){?>
                                    <div class="product_label">
                                        <img src="<?php print $this->config->image_labels_live_path."/".getNameImageLabel($product->label_id); ?>" alt="<?php print getNameImageLabel($product->label_id, 2)?>" />
                                    </div>
                                <?php }?>
                                <a href="<?php print $product->product_link?>">
                                    <img class = "jshop_img" src = "<?php print $this->image_product_path?>/<?php if ($product->product_thumb_image) print $product->product_thumb_image; else print $this->noimage?>" alt="<?php print htmlspecialchars($product->name);?>" />
                                </a>
                                
                                		</div>
                                
                                	</div>
                                    
                            </div>
                            
                            
                             <?php if ($product->product_quantity <=0 && !$this->config->hide_text_product_not_available){?>
                                <div class = "not_available"><?php print _JSHOP_PRODUCT_NOT_AVAILABLE;?></div>
                            <?php }?>
                            <?php if ($product->product_old_price > 0){?>
                                <div class="old_price"><?php if ($this->config->product_list_show_price_description) print _JSHOP_OLD_PRICE.": ";?><?php print formatprice($product->product_old_price)?></div>
                            <?php }?>
                            <?php if ($product->product_price > 0 || !$this->config->user_as_catalog){?>
                                <div class = "jshop_price">
                                    <?php if ($this->config->product_list_show_price_description) print _JSHOP_PRICE.": ";?>
                                    <?php if ($product->show_price_from) print _JSHOP_FROM." ";?>
                                    <?php print formatprice($product->product_price);?>
                                </div>
                            <?php }?>
                            <?php if ($this->config->show_tax_in_product && $product->tax > 0){?>
                                <span class="taxinfo"><?php print productTaxInfo($product->tax);?></span>
                            <?php }?>
                            <?php if ($this->config->show_plus_shipping_in_product){?>
                                <span class="plusshippinginfo"><?php print sprintf(_JSHOP_PLUS_SHIPPING, $this->shippinginfo);?></span>
                            <?php }?>
                            <?php if ($product->basic_price_info['price_show']){?>
                                <div class="base_price"><?php print _JSHOP_BASIC_PRICE?>: <?php print formatprice($product->basic_price_info['basic_price'])?> / <?php print $product->basic_price_info['name'];?></div>
                            <?php }?>
                           
                              <div class="description">
                                <?php print $product->short_description?>
                            </div>
                            <?php if ($product->manufacturer->name){?>
                                <div class="manufacturer_name"><?php print _JSHOP_MANUFACTURER;?>: <?php print $product->manufacturer->name?></div>
                            <?php }?>
                           
                            <?php if ($this->config->product_list_show_weight && $product->product_weight > 0){?>
                                <div class="productweight"><?php print _JSHOP_WEIGHT?>: <?php print formatweight($product->product_weight)?> <?php print _JSHOP_WEIGHT_UNIT?></div>
                            <?php }?>
                            <?php if ($product->delivery_time != ''){?>
                                <div class="deliverytime"><?php print _JSHOP_DELIVERY_TIME?>: <?php print $product->delivery_time?></div>
                            <?php }?>
                            <?php if (is_array($product->extra_field)){?>
                                <div class="extra_fields">
                                <?php foreach($product->extra_field as $extra_field){?>
                                    <div><?php print $extra_field['name']; ?>: <?php print $extra_field['value']; ?></div>
                                <?php }?>
                                </div>
                            <?php }?>
                            <?php if ($product->vendor){?>
                                <div class="vendorinfo"><?php print _JSHOP_VENDOR;?>: <a href="<?php print $product->vendor->products;?>"><?php print $product->vendor->shop_name?></a></div>
                            <?php }?>
                            
                              <?php if ($this->allow_review){?>
                            <table class="review_mark"><tr><td>
                            <?php print showMarkStar($product->average_rating);?>
                            </td></tr></table>
                            
                            <div class="count_commentar">
                                <?php print sprintf(_JSHOP_X_COMENTAR, $product->reviews_count);?>
                            </div>
                            <?php }?>
                            
                            
                            <div class="buttons">
                                <?php if ($product->buy_link){?>
                                <a href="<?php print $product->buy_link?>" class="button cart"><span><?php print _JSHOP_BUY?></span></a> &nbsp;
                                <?php }?>
                                <a href="<?php print $product->product_link?>"><?php print _JSHOP_DETAIL?></a>
                            </div>
                             
                            
                            
                          
                            
                            
                        </td>
                      
                    </tr>
                </table>
            </td>
            <?php if ($k%$this->count_product_to_row==$this->count_product_to_row-1){?>
                </tr>
                <tr>
                    <td colspan = "<?php print $this->count_product_to_row?>">
                        <hr />
                    </td>
                </tr>                
            <?php } ?>            
        <?php } ?>
        <?php if ($k%$this->count_product_to_row!=$this->count_product_to_row-1) print "</tr>"; ?>
    </table>
    <?php } ?>
</div>
<?php } ?>

<?php if ($this->navigation_products){?>
<table align="center" >
    <tr>
        <td style = "text-align:center">
            <div class="pagination"><?php print $this->navigation_products?></div>
        </td>
    </tr>
</table>
<?php }?>
</div>