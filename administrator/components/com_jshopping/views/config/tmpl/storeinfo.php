<?php
$jshopConfig = &JSFactory::getConfig();
JFilterOutput::objectHTMLSafe( $jshopConfig, ENT_QUOTES);
$lists = $this->lists;
JHTML::_('behavior.tooltip');
include(dirname(__FILE__)."/submenu.php");
?>
<form action = "index.php?option=com_jshopping&controller=config" method = "post" name = "adminForm" enctype = "multipart/form-data">
<input type="hidden" name="task" value="">
<input type="hidden" name="tab" value="5">

<div class="col100">
<fieldset class="adminform">
    <legend><?php echo _JSHOP_STORE_INFO ?></legend>
    <table class="admintable" width = "100%" >
    <tr>
     <td class="key">
       <?php echo _JSHOP_STORE_NAME;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "store_name" id = "store_name"  value = "<?php echo $jshopConfig->store_name?>" />
     </td>
    </tr>
    <tr>
     <td  class="key">
       <?php echo _JSHOP_STORE_COMPANY;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "store_company_name" id = "store_company_name"  value = "<?php echo $jshopConfig->store_company_name?>" />
     </td>
    </tr>
    <tr>
     <td  class="key">
       <?php echo _JSHOP_STORE_URL;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "store_url" id = "store_url"  value = "<?php echo $jshopConfig->store_url?>" />
     </td>
    </tr>
    <tr>
     <td  class="key">
       <?php echo _JSHOP_LOGO;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "store_logo" value = "<?php echo $jshopConfig->store_logo?>" />
     </td>
    </tr>    
    <tr>
     <td  class="key">
       <?php echo _JSHOP_STORE_ADRESS;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "store_address" id = "store_address"  value = "<?php echo $jshopConfig->store_address?>" />
     </td>
    </tr>
    <tr>
     <td  class="key">
       <?php echo _JSHOP_STORE_CITY;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "store_city" id = "store_city"  value = "<?php echo $jshopConfig->store_city?>" />
     </td>
    </tr>
    <tr>
     <td  class="key">
       <?php echo _JSHOP_STORE_ZIP;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "store_zip" id = "store_zip"  value = "<?php echo $jshopConfig->store_zip?>" />
     </td>
    </tr>
    <tr>
     <td  class="key">
       <?php echo _JSHOP_STORE_STATE;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "store_state" id = "store_state"  value = "<?php echo $jshopConfig->store_state?>" />
     </td>
    </tr>
    <tr>
     <td  class="key">
       <?php echo _JSHOP_STORE_COUNTRY;?>
     </td>
     <td>
       <?php echo $lists['countries'];?>
     </td>
    </tr>
    <tr>
     <td  class="key">
       <?php echo _JSHOP_STORE_DATE_FORMAT;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "store_date_format" id = "store_date_format"  value = "<?php echo $jshopConfig->store_date_format?>" />
     </td>
    </tr>
    </table>
</fieldset>
</div>
<div class="clr"></div>

<div class="col100">
<fieldset class="adminform">
    <legend><?php echo _JSHOP_CONTACT_INFO ?></legend>
    <table class="admintable" width = "100%" >
    <tr>
     <td  class="key">
       <?php echo _JSHOP_CONTACT_FIRSTNAME;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "contact_firstname" id = "contact_firstname"  value = "<?php echo $jshopConfig->contact_firstname?>" />
     </td>
    </tr>
    <tr>
     <td  class="key">
       <?php echo _JSHOP_CONTACT_LASTNAME;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "contact_lastname" id = "contact_lastname"  value = "<?php echo $jshopConfig->contact_lastname?>" />
     </td>
    </tr>
    <tr>
     <td  class="key">
       <?php echo _JSHOP_CONTACT_MIDDLENAME;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "contact_middlename" id = "contact_middlename"  value = "<?php echo $jshopConfig->contact_middlename?>" />
     </td>
    </tr>
    <tr>
     <td  class="key">
       <?php echo _JSHOP_CONTACT_PHONE;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "contact_phone" id = "contact_phone"  value = "<?php echo $jshopConfig->contact_phone?>" />
     </td>
    </tr>
    <tr>
     <td  class="key">
       <?php echo _JSHOP_CONTACT_FAX;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "contact_fax" id = "contact_fsx"  value = "<?php echo $jshopConfig->contact_fax?>" />
     </td>
    <tr>
     <td  class="key">
       <?php echo _JSHOP_EMAIL;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "store_email" value = "<?php echo $jshopConfig->store_email?>" />
     </td>
    </tr>
    </table>
</fieldset>
</div>
<div class="clr"></div>

<div class="col100">
<fieldset class="adminform">
    <legend><?php echo _JSHOP_BANK ?></legend>
    <table class="admintable" width = "100%" >
    <tr>
     <td  class="key">
       <?php echo _JSHOP_BENEF_BANK_NAME;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "benef_bank_info" value = "<?php echo $jshopConfig->benef_bank_info?>" />
     </td>
    </tr>

    <tr>
     <td  class="key">
       <?php echo _JSHOP_BENEF_BIC;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "benef_bic" id = "benef_bic"  value = "<?php echo $jshopConfig->benef_bic?>" />
     </td>
    </tr>
    <tr>
     <td  class="key">
       <?php echo _JSHOP_BENEF_CONTO;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "benef_conto" id = "benef_conto"  value = "<?php echo $jshopConfig->benef_conto?>" />
     </td>
    </tr>
    <tr>
     <td  class="key">
       <?php echo _JSHOP_BENEF_PAYEE;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "benef_payee" value = "<?php echo $jshopConfig->benef_payee?>" />
     </td>
    </tr>
    <tr>
     <td  class="key">
       <?php echo _JSHOP_BENEF_IBAN;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "benef_iban" id = "benef_iban"  value = "<?php echo $jshopConfig->benef_iban?>" />
     </td>
    </tr>
    <tr>
     <td  class="key">
       <?php echo _JSHOP_BENEF_SWIFT;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "benef_swift" id = "benef_swift"  value = "<?php echo $jshopConfig->benef_swift?>" />
     </td>
    </tr>
    </table>
</fieldset>
</div>
<div class="clr"></div>

<div class="col100">
<fieldset class="adminform">
    <legend><?php echo _JSHOP_INTERM_BANK ?></legend>
    <table class="admintable" width = "100%" >
    <tr>
     <td  class="key">
       <?php echo _JSHOP_INTERM_NAME;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "interm_name" id = "interm_name"  value = "<?php echo $jshopConfig->interm_name?>" />
     </td>
    </tr>
    <tr>
     <td  class="key">
       <?php echo _JSHOP_INTERM_SWIFT;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "interm_swift" id = "interm_swift"  value = "<?php echo $jshopConfig->interm_swift?>" />
     </td>
    </tr>
    </table>
</fieldset>
</div>
<div class="clr"></div>

<div class="col100">
<fieldset class="adminform">
    <table class="admintable" width = "100%" >
    <tr>
     <td  class="key">
       <?php echo _JSHOP_IDENTIFICATION_NUMBER;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "identification_number" value = "<?php echo $jshopConfig->identification_number?>" />
     </td>
    </tr>
    <tr>
     <td  class="key">
       <?php echo _JSHOP_TAX_NUMBER;?>
     </td>
     <td>
       <input size="55" type = "text" class = "inputbox" name = "tax_number" value = "<?php echo $jshopConfig->tax_number?>" />
     </td>
    </tr>
    </table>
</fieldset>
</div>
<div class="clr"></div>

<div class="col100">
<fieldset class="adminform">
    <legend><?php echo _JSHOP_PDF_CONFIG ?></legend>
    <table class="admintable" width = "100%" >
    <tr>
    <td  class="key">
       <?php echo _JSHOP_PDF_HEADER?>
       <?php echo JHTML::tooltip(_JSHOP_PDF_ONLYJPG)?>
    </td>
    <td>
        <input size="55" type = "file" name = "header" value = "" />
    </td>
    </tr>

    <tr>
    <td  class="key">
       <?php echo _JSHOP_IMAGE_WIDTH?>
       <?php echo JHTML::tooltip(_JSHOP_PDF_INMM)?>
    </td>
    <td>
        <input size="55" type = "text" class = "inputbox" name = "pdf_parameters[pdf_header_width]" value = "<?php echo $jshopConfig->pdf_header_width?>" />
    </td>
    </tr>
    <tr>
    <td  class="key">
       <?php echo _JSHOP_IMAGE_HEIGHT?>
       <?php echo JHTML::tooltip(_JSHOP_PDF_INMM)?>
    </td>
    <td>
        <input size="55" type = "text" class = "inputbox" name = "pdf_parameters[pdf_header_height]" value = "<?php echo $jshopConfig->pdf_header_height?>" />
    </td>
    </tr>
    <tr>
    <td> </td>
    </tr>
    <tr>
    <td  class="key">
       <?php echo _JSHOP_PDF_FOOTER?>
       <?php echo JHTML::tooltip(_JSHOP_PDF_ONLYJPG)?>
    </td>
    <td>
        <input size="55" type = "file" name = "footer" value = "" />
    </td>
    </tr>
    <tr>
    <td  class="key">
       <?php echo _JSHOP_IMAGE_WIDTH?>
       <?php echo JHTML::tooltip(_JSHOP_PDF_INMM)?>
    </td>
    <td>
        <input size="55" type = "text" class = "inputbox" name = "pdf_parameters[pdf_footer_width]" value = "<?php echo $jshopConfig->pdf_footer_width?>" />
    </td>
    </tr>
    <tr>
    <td  class="key">
       <?php echo _JSHOP_IMAGE_HEIGHT?>
       <?php echo JHTML::tooltip(_JSHOP_PDF_INMM)?>
    </td>
    <td>
        <input size="55" type = "text" class = "inputbox" name = "pdf_parameters[pdf_footer_height]" value = "<?php echo $jshopConfig->pdf_footer_height?>" />
    </td>
    </tr>
    <tr>
    <td></td>
    <td >
        <?php print _JSHOP_PDF_PREVIEW_INFO1;?>
        <a target = "_blank" href = "index.php?option=com_jshopping&controller=config&task=preview_pdf"><?php echo _JSHOP_PDF_PREVIEW?></a>
    </td>
    </tr>
    </table>

</fieldset>
</div>
<div class="clr"></div>

</form>