<?php
$jshopConfig = &JSFactory::getConfig();
JHTML::_('behavior.tooltip');
include(dirname(__FILE__)."/submenu.php");
?>
<form action = "index.php?option=com_jshopping&controller=config" method = "post" name = "adminForm" enctype = "multipart/form-data">
<input type="hidden" name="task" value="">
<input type="hidden" name="tab" value="6">

<div class="col100">
<fieldset class="adminform">
    <legend><?php echo _JSHOP_LIST_PRODUCTS." / "._JSHOP_PRODUCT ?></legend>
<table class="admintable">
<tr>
    <td class="key">
        <?php echo _JSHOP_SHOW_TAX?>
    </td>
    <td>
        <input type = "checkbox" name = "show_tax_in_product" value = "1" <?php if ($jshopConfig->show_tax_in_product) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_SHOW_TAX_IN_CART?>
    </td>
    <td>
        <input type = "checkbox" name = "show_tax_product_in_cart" value = "1" <?php if ($jshopConfig->show_tax_product_in_cart) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_SHOW_PLUS_SHIPPING?>
    </td>
    <td>
        <input type = "checkbox" name = "show_plus_shipping_in_product" value = "1" <?php if ($jshopConfig->show_plus_shipping_in_product) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_HIDE_PRODUCT_NOT_AVAIBLE_STOCK?>
    </td>
    <td>
        <input type = "checkbox" id = "hide_product_not_avaible_stock" name = "hide_product_not_avaible_stock" value = "1" <?php if ($jshopConfig->hide_product_not_avaible_stock) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_HIDE_BUY_PRODUCT_NOT_AVAIBLE_STOCK?>
    </td>
    <td>
        <input type = "checkbox" name = "hide_buy_not_avaible_stock" value = "1" <?php if ($jshopConfig->hide_buy_not_avaible_stock) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_HIDE_HIDE_TEXT_PRODUCT_NOT_AVAILABLE?>
    </td>
    <td>
        <input type = "checkbox" name = "hide_text_product_not_available" value = "1" <?php if ($jshopConfig->hide_text_product_not_available) echo 'checked = "checked"';?> />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_SHOW_DELIVERY_TIME?>
    </td>
    <td>
        <input type = "checkbox" name = "show_delivery_time" value = "1" <?php if ($jshopConfig->show_delivery_time) echo 'checked = "checked"';?> />
    </td>
</tr>
	
</table>
</fieldset>
</div>
<div class="clr"></div>


<div class="col100">
<fieldset class="adminform">
    <legend><?php echo _JSHOP_LIST_PRODUCTS;?></legend>
<table class="admintable" width = "100%" >
<tr>
    <td class="key" style="width:220px;">
        <?php echo _JSHOP_COUNT_PRODUCTS_PAGE;?>
    </td>
    <td>
        <input type = "text" name = "count_products_to_page" class = "inputbox" id = "count_products_to_page" value = "<?php echo $jshopConfig->count_products_to_page;?>" />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_COUNT_PRODUCTS_ROW;?>
    </td>
    <td>
        <input type = "text" name = "count_products_to_row" class = "inputbox" id = "count_products_to_row" value = "<?php echo $jshopConfig->count_products_to_row;?>" />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_CHANGE_COUNTS_PROD_ROWS_FOR_ALL_CATS?>
    </td>
    <td>
        <input type = "checkbox" name = "update_count_prod_rows_all_cats" value = "1" />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_COUNT_CATEGORY_ROW;?>
    </td>
    <td>
        <input type = "text" name = "count_category_to_row" class = "inputbox" id = "count_category_to_row" value = "<?php echo $jshopConfig->count_category_to_row;?>" />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_ORDERING_CATEGORY;?>
    </td>
    <td>
        <?php print $this->lists['category_sorting'];?>
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_PRODUCT_SORTING;?>
    </td>
    <td>
        <?php print $this->lists['product_sorting'];?>
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_PRODUCT_SORTING_DIRECTION;?>
    </td>
    <td>
        <?php print $this->lists['product_sorting_direction'];?>
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_SHOW_BAY_BUT_IN_CAT?>
    </td>
    <td>
        <input type = "checkbox" name = "show_buy_in_category" value = "1" <?php if ($jshopConfig->show_buy_in_category) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_ABILITY_TO_SORT_PRODUCTS?>
    </td>
    <td>
        <input type = "checkbox" name = "show_sort_product" value = "1" <?php if ($jshopConfig->show_sort_product) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_SHOW_SELECTBOX_COUNT_PRODUCTS_TO_PAGE?>
    </td>
    <td>
        <input type = "checkbox" name = "show_count_select_products" value = "1" <?php if ($jshopConfig->show_count_select_products) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_SHOW_FILTERS?>
    </td>
    <td>
        <input type = "checkbox" name = "show_product_list_filters" value = "1" <?php if ($jshopConfig->show_product_list_filters) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_SHOW_WEIGHT_PRODUCT?>
    </td>
    <td>
        <input type = "checkbox" name = "product_list_show_weight" value = "1" <?php if ($jshopConfig->product_list_show_weight) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_SHOW_MANUFACTURER?>
    </td>
    <td>
        <input type = "checkbox" name = "product_list_show_manufacturer" value = "1" <?php if ($jshopConfig->product_list_show_manufacturer) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_SHOW_EAN_PRODUCT?>
    </td>
    <td>
        <input type = "checkbox" name = "product_list_show_product_code" value = "1" <?php if ($jshopConfig->product_list_show_product_code) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_SHOW_MIN_PRICE?>
    </td>
    <td>
        <input type = "checkbox" name = "product_list_show_min_price" value = "1" <?php if ($jshopConfig->product_list_show_min_price) echo 'checked = "checked"';?> />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_SHOW_PRICE_DESCRIPTION?>
    </td>
    <td>
        <input type = "checkbox" name = "product_list_show_price_description" value = "1" <?php if ($jshopConfig->product_list_show_price_description) echo 'checked = "checked"';?> />
    </td>
</tr>

<?php if ($jshopConfig->admin_show_vendors){?>
<tr>
    <td class="key">
      <?php echo _JSHOP_SHOW_VENDOR;?>
    </td>
    <td>
      <input type = "checkbox" name = "product_list_show_vendor" value = "1" <?php if ($jshopConfig->product_list_show_vendor) echo 'checked = "checked"';?> />
    </td>
</tr>
<?php }?>

<?php if ($jshopConfig->admin_show_product_extra_field){?>
<tr>
    <td class="key">
        <?php echo _JSHOP_SHOW_EXTRA_FIELDS?>
    </td>
    <td>
        <?php print $this->lists['product_list_display_extra_fields'];?>
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_SHOW_EXTRA_FIELDS_FILTER?>
    </td>
    <td>
        <?php print $this->lists['filter_display_extra_fields'];?>
    </td>
</tr>
<?php }?>

   
</table>
    
</fieldset>
</div>
<div class="clr"></div>

<div class="col100">
<fieldset class="adminform">
    <legend><?php echo _JSHOP_PRODUCT;?></legend>
<table class="admintable" width = "100%" >

<tr>
    <td class="key" style="width:220px;">
        <?php echo _JSHOP_SHOW_DEMO_TYPE_AS_MEDIA?>
    </td>
    <td>
        <input type = "checkbox" name = "demo_type" value = "1" <?php if ($jshopConfig->demo_type) echo 'checked = "checked"';?> />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_SHOW_MANUFACTURER_LOGO?>
    </td>
    <td>
        <input type = "checkbox" name = "product_show_manufacturer_logo" value = "1" <?php if ($jshopConfig->product_show_manufacturer_logo) echo 'checked = "checked"';?> />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_SHOW_WEIGHT_PRODUCT?>
    </td>
    <td>
        <input type = "checkbox" name = "product_show_weight" value = "1" <?php if ($jshopConfig->product_show_weight) echo 'checked = "checked"';?> />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_PRODUCT_ATTRIBUT_FIRST_VALUE_EMPTY?>
    </td>
    <td>
        <input type = "checkbox" name = "product_attribut_first_value_empty" value = "1" <?php if ($jshopConfig->product_attribut_first_value_empty) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_PRODUCT_ATTRIBUT_RADIO_VALUE_DISPLAY_VERTICAL?>
    </td>
    <td>
        <input type = "checkbox" name = "radio_attr_value_vertical" value = "1" <?php if ($jshopConfig->radio_attr_value_vertical) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_PRODUCT_ATTRIBUT_ADD_PRICE_DISPLAY?>
    </td>
    <td>
        <input type = "checkbox" name = "attr_display_addprice" value = "1" <?php if ($jshopConfig->attr_display_addprice) echo 'checked = "checked"';?> />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_HITS?>
    </td>
    <td>
        <input type = "checkbox" name = "show_hits" value = "1" <?php if ($jshopConfig->show_hits) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_SHOW_EAN_PRODUCT?>
    </td>
    <td>
        <input type = "checkbox" name = "show_product_code" value = "1" <?php if ($jshopConfig->show_product_code) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_USE_PLUGIN_CONTENT?>
    </td>
    <td>
        <input type = "checkbox" name = "use_plugin_content" value = "1" <?php if ($jshopConfig->use_plugin_content) echo 'checked = "checked"';?> />
    </td>
</tr>

<tr>
    <td class="key">
      <?php echo _JSHOP_ALLOW_REVIEW_PRODUCT;?>
    </td>
    <td>
      <input type = "checkbox" name = "allow_reviews_prod" value = "1" <?php if ($jshopConfig->allow_reviews_prod) echo 'checked = "checked"';?> />
    </td>
</tr> 
<tr>
    <td class="key">
      <?php echo _JSHOP_ALLOW_REVIEW_ONLY_REGISTERED;?>
    </td>
    <td>
      <input type = "checkbox" name = "allow_reviews_only_registered" value = "1" <?php if ($jshopConfig->allow_reviews_only_registered) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
      <?php echo _JSHOP_SHOP_BUTTON_BACK;?>
    </td>
    <td>
      <input type = "checkbox" name = "product_show_button_back" value = "1" <?php if ($jshopConfig->product_show_button_back) echo 'checked = "checked"';?> />
    </td>
</tr>
<?php if ($jshopConfig->admin_show_vendors){?>
<tr>
    <td class="key">
      <?php echo _JSHOP_SHOW_VENDOR;?>
    </td>
    <td>
      <input type = "checkbox" name = "product_show_vendor" value = "1" <?php if ($jshopConfig->product_show_vendor) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
      <?php echo _JSHOP_SHOW_VENDOR_DETAIL;?>
    </td>
    <td>
      <input type = "checkbox" name = "product_show_vendor_detail" value = "1" <?php if ($jshopConfig->product_show_vendor_detail) echo 'checked = "checked"';?> />
    </td>
</tr>
<?php }?>

<tr>
    <td class="key">
      <?php echo _JSHOP_SHOW_BUTTON_PRINT;?>
    </td>
    <td>
      <input type = "checkbox" name = "display_button_print" value = "1" <?php if ($jshopConfig->display_button_print) echo 'checked = "checked"';?> />
    </td>
</tr>
 
<tr>
    <td class="key">
      <?php echo _JSHOP_REVIEW_MAX_MARK;?>
    </td>
    <td>
      <input type = "text" name = "max_mark" id = "max_mark" value = "<?php echo $jshopConfig->max_mark?>" />
    </td>
</tr>
<tr>
   <td class="key">
     <?php echo _JSHOP_PRODUCTS_RELATED_IN_ROW?>
   </td>
   <td>
     <input type = "text" class = "inputbox" name="product_count_related_in_row" value = "<?php echo $jshopConfig->product_count_related_in_row?>" />
   </td>
</tr>

<?php if ($jshopConfig->admin_show_product_extra_field){?>
<tr>
    <td class="key">
        <?php echo _JSHOP_HIDE_EXTRA_FIELDS?>
    </td>
    <td>
        <?php print $this->lists['product_hide_extra_fields'];?>
    </td>
</tr>
<?php }?>


   
</table>
    
</fieldset>
</div>
<div class="clr"></div>

</form>