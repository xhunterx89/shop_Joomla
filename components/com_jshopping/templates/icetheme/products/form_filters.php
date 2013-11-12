<form action = "<?php print $this->action;?>" method = "post" name = "sort_count" id = "sort_count">
    <table class  = "jshop">
    <tr>
        <td>
            <?php if ($this->config->show_sort_product){?>
                <span class="box_products_sorting"><?php print _JSHOP_ORDER_BY.": ".$this->sorting?><img src = "<?php print $this->image_path."/".$this->image_arr?>" alt = "orderby" onclick = "submitListProductFilterSortDirection()" /></span>
            <?php }?>
            <?php if ($this->config->show_count_select_products){?>
                <span class="box_products_count_to_page"><?php print _JSHOP_DISPLAY_NUMBER.": ".$this->product_count?></span>
            <?php }?>                
        </td>
    </tr>
    </table>
    
    <?php if ($this->config->show_product_list_filters){?>
        <?php if ($this->config->show_sort_product || $this->config->show_count_select_products){?>
        <div class="margin_filter"></div>
        <?php }?>
        
        <table class  = "jshop filters">
        <tr>
            <td>
                <span class="box_category"><?php print _JSHOP_CATEGORY.": ".$this->categorys_sel?></span>
                <span class="box_manufacrurer"><?php print _JSHOP_MANUFACTURER.": ".$this->manufacuturers_sel?></span>
                
                <span class="filter_price"><?php print _JSHOP_PRICE?>:
                    <span class="box_price_from"><?php print _JSHOP_FROM?> <input type = "text" class = "inputbox" name = "price_from" id="price_from" size="7" value="<?php if ($this->filters['price_from']>0) print $this->filters['price_from']?>" /></span>
                    <span class="box_price_to"><?php print _JSHOP_TO?> <input type = "text" class = "inputbox" name = "price_to"  id="price_to" size="7" value="<?php if ($this->filters['price_to']>0) print $this->filters['price_to']?>" /></span>
                    <?php print $this->config->currency_code?>
                </span>
                
                <input type="button" class="button" value="<?php print _JSHOP_GO?>" onclick="submitListProductFilters();" />
                
                <span class="clear_filter"><a href="#" onclick="clearProductListFilter();return false;"><?php print _JSHOP_CLEAR_FILTERS?></a></span>
                
            </td>
        </tr>
        </table>
    <?php }?>
    
    <input type = "hidden" name = "orderby" id = "orderby" value = "<?php print $this->orderby?>" />
</form>