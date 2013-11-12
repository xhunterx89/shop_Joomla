<?php
$jshopConfig = &JSFactory::getConfig();
JHTML::_('behavior.tooltip');
$lists = $this->lists;
include(dirname(__FILE__)."/submenu.php");
?>
<form action = "index.php?option=com_jshopping&controller=config" method = "post" name = "adminForm" enctype = "multipart/form-data">
<input type="hidden" name="task" value="">
<input type="hidden" name="tab" value="8">

<div class="col100">
<fieldset class="adminform">
    <legend><?php echo _JSHOP_GENERAL;?></legend>
<table class="admintable">

<tr>
    <td class="key">
      <?php echo _JSHOP_ENABLE_WISHLIST;?>
    </td>
    <td>
      <input type = "checkbox" name = "enable_wishlist" class = "inputbox" id = "enable_f_wishlist" value = "1" <?php if ($jshopConfig->enable_wishlist) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
      <?php echo _JSHOP_USE_RABATT_CODE;?>
    </td>
    <td>
      <input type = "checkbox" name = "use_rabatt_code" id = "use_rabatt_code" value = "1" <?php if ($jshopConfig->use_rabatt_code) echo 'checked = "checked"';?> />
    </td>
</tr> 
<tr>
    <td class="key">
        <?php echo _JSHOP_PURCHASE_WITHOUT_REGISTERING?>
    </td>
    <td>
        <?php print $this->lists['shop_register_type'];?>
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_USER_AS_CATALOG?>
    </td>
    <td>
        <input type = "checkbox" name = "user_as_catalog" value = "1" <?php if ($jshopConfig->user_as_catalog) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_PANEL_LANGUAGES?>
    </td>
    <td>
        <input type = "checkbox" name = "admin_show_languages" value = "1" <?php if ($jshopConfig->admin_show_languages) echo 'checked = "checked"';?> />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_SHIPPINGS?>
    </td>
    <td>
        <input type = "checkbox" name = "without_shipping" value = "1" <?php if (!$jshopConfig->without_shipping) echo 'checked = "checked"';?> />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_PAYMENTS?>
    </td>
    <td>
        <input type = "checkbox" name = "without_payment" value = "1" <?php if (!$jshopConfig->without_payment) echo 'checked = "checked"';?> />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_USE_DIFFERENT_TEMPLATES_CATEGORIES_PRODUCTS?>
    </td>
    <td>
        <input type = "checkbox" name = "use_different_templates_cat_prod" value = "1" <?php if ($jshopConfig->use_different_templates_cat_prod) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_USE_VENDORS?>
    </td>
    <td>
        <input type = "checkbox" name = "admin_show_vendors" value = "1" <?php if ($jshopConfig->admin_show_vendors) echo 'checked = "checked"';?> />
    </td>
</tr>

</table>
</fieldset>
</div>
<div class="clr"></div>

<div class="col100">
<fieldset class="adminform">
    <legend><?php echo _JSHOP_PRODUCTS ?></legend>
<table class="admintable" width = "100%" >
<tr>
    <td class="key">
        <?php echo _JSHOP_ATTRIBUTES?>
    </td>
    <td>
        <input type = "checkbox" name = "admin_show_attributes" value = "1" <?php if ($jshopConfig->admin_show_attributes) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_FREE_ATTRIBUTES?>
    </td>
    <td>
        <input type = "checkbox" name = "admin_show_freeattributes" value = "1" <?php if ($jshopConfig->admin_show_freeattributes) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_DELIVERY_TIME?>
    </td>
    <td>
        <input type = "checkbox" name = "admin_show_delivery_time" value = "1" <?php if ($jshopConfig->admin_show_delivery_time) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_PRODUCT_VIDEOS?>
    </td>
    <td>
        <input type = "checkbox" name = "admin_show_product_video" value = "1" <?php if ($jshopConfig->admin_show_product_video) echo 'checked = "checked"';?> />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_PRODUCT_RELATED?>
    </td>
    <td>
        <input type = "checkbox" name = "admin_show_product_related" value = "1" <?php if ($jshopConfig->admin_show_product_related) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_FILES?>
    </td>
    <td>
        <input type = "checkbox" name = "admin_show_product_files" value = "1" <?php if ($jshopConfig->admin_show_product_files) echo 'checked = "checked"';?> />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_LABEL;?>
    </td>
    <td>
        <input type = "checkbox" name = "admin_show_product_labels" value = "1" <?php if ($jshopConfig->admin_show_product_labels) echo 'checked = "checked"';?> />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_PRODUCT_BUY_PRICE?>
    </td>
    <td>
        <input type = "checkbox" name = "admin_show_product_bay_price" value = "1" <?php if ($jshopConfig->admin_show_product_bay_price) echo 'checked = "checked"';?> />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_BASIC_PRICE?>
    </td>
    <td>
        <input type = "checkbox" name = "admin_show_product_basic_price" value = "1" <?php if ($jshopConfig->admin_show_product_basic_price) echo 'checked = "checked"';?> />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_EXTRA_FIELDS?>
    </td>
    <td>
        <input type = "checkbox" name = "admin_show_product_extra_field" value = "1" <?php if ($jshopConfig->admin_show_product_extra_field) echo 'checked = "checked"';?> />
    </td>
</tr>

</table>
</fieldset>
</div>
<div class="clr"></div>
</form>