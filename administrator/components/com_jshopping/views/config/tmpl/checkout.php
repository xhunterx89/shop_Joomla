<?php
$jshopConfig = &JSFactory::getConfig();
JHTML::_('behavior.tooltip');
$lists = $this->lists;
include(dirname(__FILE__)."/submenu.php");
?>
<form action = "index.php?option=com_jshopping&controller=config" method = "post" name = "adminForm" enctype = "multipart/form-data">
<input type="hidden" name="task" value="">
<input type="hidden" name="tab" value="7">

<div class="col100">
<fieldset class="adminform">
    <legend><?php echo _JSHOP_CHECKOUT ?></legend>
<table class="admintable">

<tr>
    <td class="key" style="width:220px;">
        <?php echo _JSHOP_DEFAULT_ORDER_STATUS;?>
    </td>
    <td>
        <?php echo $lists['status']; ?>
    </td>
</tr>
<tr>
    <td class="key">
      <?php echo _JSHOP_NEXT_ORDER_NUMBER;?>
    </td>
    <td>
      <input type = "text" name = "next_order_number" value = "<?php echo $jshopConfig->next_order_number;?>" />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_HIDE_SHIPPING_STEP?>
    </td>
    <td>
        <input type = "checkbox" name = "hide_shipping_step" value = "1" <?php if ($jshopConfig->hide_shipping_step) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_HIDE_PAYMENT_STEP?>
    </td>
    <td>
        <input type = "checkbox" name = "hide_payment_step" value = "1" <?php if ($jshopConfig->hide_payment_step) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
      <?php echo _JSHOP_NULL_SIHPPING;?>
    </td>
    <td>
      <input type = "text" name = "summ_null_shipping" value = "<?php echo $jshopConfig->summ_null_shipping;?>" /> <?php print $this->currency_code;?>
      <?php echo JHTML::tooltip(_JSHOP_NULL_SIHPPING_INFO);?>
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_ORDER_SEND_PDF_CLIENT?>
    </td>
    <td>
        <input type = "checkbox" name = "order_send_pdf_client" value = "1" <?php if ($jshopConfig->order_send_pdf_client) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_ORDER_SEND_PDF_ADMIN?>
    </td>
    <td>
        <input type = "checkbox" name = "order_send_pdf_admin" value = "1" <?php if ($jshopConfig->order_send_pdf_admin) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_HIDE_TAX?>
    </td>
    <td>
        <input type = "checkbox" name = "hide_tax" value = "1" <?php if ($jshopConfig->hide_tax) echo 'checked = "checked"';?> />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_DISPLAY_REGISTRATION_FORM_ON_LOGIN_PAGE?>
    </td>
    <td>
        <input type = "checkbox" name = "show_registerform_in_logintemplate" value = "1" <?php if ($jshopConfig->show_registerform_in_logintemplate) echo 'checked = "checked"';?> />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_SORTING_COUNTRY_IN_ALPHABET?>
    </td>
    <td>
        <input type = "checkbox" name = "sorting_country_in_alphabet" value = "1" <?php if ($jshopConfig->sorting_country_in_alphabet) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_DEFAULT_COUNTRY;?>
    </td>
    <td>
        <?php echo $lists['default_country']; ?>
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_SHOW_WEIGHT_PRODUCT?>
    </td>
    <td>
        <input type = "checkbox" name = "show_weight_order" value = "1" <?php if ($jshopConfig->show_weight_order) echo 'checked = "checked"';?> />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_DISCOUNT_USE_FULL_SUM?>
    </td>
    <td>
        <input type = "checkbox" name = "discount_use_full_sum" value = "1" <?php if ($jshopConfig->discount_use_full_sum) echo 'checked = "checked"';?> />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_CALCULE_TAX_AFTER_DISCOUNT?>
    </td>
    <td>
        <input type = "checkbox" name = "calcule_tax_after_discount" value = "1" <?php if ($jshopConfig->calcule_tax_after_discount) echo 'checked = "checked"';?> />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_SHOW_CART_ALL_STEP_CHECKOUT?>
    </td>
    <td>
        <input type = "checkbox" name = "show_cart_all_step_checkout" value = "1" <?php if ($jshopConfig->show_cart_all_step_checkout) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_NOT_REDIRECT_IN_CART_AFTER_BUY?>
    </td>
    <td>
        <input type = "checkbox" name = "not_redirect_in_cart_after_buy" value = "1" <?php if ($jshopConfig->not_redirect_in_cart_after_buy) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_SHOW_EAN_PRODUCT?>
    </td>
    <td>
        <input type = "checkbox" name = "show_product_code_in_cart" value = "1" <?php if ($jshopConfig->show_product_code_in_cart) echo 'checked = "checked"';?> />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_SHOW_RETURN_POLICY_IN_EMAIL_ORDER?>
    </td>
    <td>
        <input type = "checkbox" name = "show_return_policy_in_email_order" value = "1" <?php if ($jshopConfig->show_return_policy_in_email_order) echo 'checked = "checked"';?> />
    </td>
</tr>

<tr>
    <td class="key">
        <?php echo _JSHOP_CLIENT_ALLOW_CANCEL_ORDER?>
    </td>
    <td>
        <input type = "checkbox" name = "client_allow_cancel_order" value = "1" <?php if ($jshopConfig->client_allow_cancel_order) echo 'checked = "checked"';?> />
    </td>
</tr>

<?php if ($jshopConfig->admin_show_vendors){?>
<tr>
    <td class="key">
        <?php echo _JSHOP_MESSAGE_OF_ORDER_VENDOR?>
    </td>
    <td>        
        <?php echo $lists['vendor_order_message_type']; ?>
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_ADMIN_NOT_SEND_EMAIL_ORDER_IF_SEND_VENDOR?>
    </td>
    <td>
        <input type = "checkbox" name = "admin_not_send_email_order_vendor_order" value = "1" <?php if ($jshopConfig->admin_not_send_email_order_vendor_order) echo 'checked = "checked"';?> />
    </td>
</tr>
<?php }?>

<tr>
    <td class="key">
      <?php echo _JSHOP_ERROR_MAX_COUNT_ORDER_ONE_PRODUCT;?>
    </td>
    <td>
      <input type = "text" name = "max_count_order_one_product" value = "<?php echo $jshopConfig->max_count_order_one_product;?>" />
    </td>
</tr>

<tr>
    <td class="key">
      <?php echo _JSHOP_ERROR_MIN_COUNT_ORDER_ONE_PRODUCT;?>
    </td>
    <td>
      <input type = "text" name = "min_count_order_one_product" value = "<?php echo $jshopConfig->min_count_order_one_product;?>" />
    </td>
</tr>

<tr>
    <td class="key">
      <?php echo _JSHOP_ERROR_MAX_SUM_ORDER;?>
    </td>
    <td>
      <input type = "text" name = "max_price_order" value = "<?php echo $jshopConfig->max_price_order;?>" />
    </td>
</tr>

<tr>
    <td class="key">
      <?php echo _JSHOP_ERROR_MIN_SUM_ORDER;?>
    </td>
    <td>
      <input type = "text" name = "min_price_order" value = "<?php echo $jshopConfig->min_price_order;?>" />
    </td>
</tr>

	
</table>
</fieldset>
</div>
<div class="clr"></div>
</form>