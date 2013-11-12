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
    <input type = "hidden" name = "orderby" id = "orderby" value = "<?php print $this->orderby?>" />
</form>

<hr />