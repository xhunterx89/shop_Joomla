<?php $in_row = $this->config->product_count_related_in_row;?>
<?php if (count($this->related_prod)){?>
    <hr class = "jshop_line" />
    <hr class = "jshop_line" />
    <?php print _JSHOP_RELATED_PRODUCTS?>
    <table class = "jshop">
        <?php foreach($this->related_prod as $k=>$product){?>
        <?php if ($k%$in_row==0) print "<tr>";?>
            <td width = "<?php print 100/$in_row?>%" class = "jshop_related">
                <p>
                    <a href="<?php print $product->product_link?>"><?php print $product->name?></a>
                </p>
                <p>
                    <a href="<?php print $product->product_link?>">
                        <img class = "jshop_img" src = "<?php print $this->image_product_path?>/<?php if ($product->product_thumb_image) print $product->product_thumb_image; else print $this->noimage?>" alt="<?php print htmlspecialchars($product->name)?>" />
                    </a>
                </p>
                <p>
                <?php if ($product->product_price > 0 || !$this->config->user_as_catalog){?>
                    <span class="jshop_price"><?php if ($product->show_price_from) print _JSHOP_FROM." ";?><?php print formatprice($product->product_price);?></span>
                <?php }?>
                </p>
            </td>
        <?php if ($k%$in_row==$in_row-1) print "</tr>";?>
        <?php }?>
        <?php if ($k%$in_row!=$in_row-1) print "</tr>";?>
    </table>
<?php }?>