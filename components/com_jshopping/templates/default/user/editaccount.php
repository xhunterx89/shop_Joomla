<div class="jshop editaccount_block">
<?php 
$config_fields = $this->config_fields;
include(dirname(__FILE__)."/editaccount.js.php");
?>

    <h1><?php print _JSHOP_EDIT_DATA ?></h1>
    
    <form action = "<?php print $this->action ?>" method = "post" name = "loginForm" onsubmit = "return validateEditAccountForm('<?php print $this->live_path ?>', this.name)">
    <div class = "jshop_register">
    <table>
        <?php if ($config_fields['title']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_REG_TITLE ?> <?php if ($config_fields['title']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <?php print $this->select_titles ?>
          </td>
        </tr>        
        <?php } ?>
        <?php if ($config_fields['f_name']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_F_NAME ?> <?php if ($config_fields['f_name']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "f_name" id = "f_name" value = "<?php print $this->user->f_name ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['l_name']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_L_NAME ?> <?php if ($config_fields['l_name']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "l_name" id = "l_name" value = "<?php print $this->user->l_name ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['firma_name']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_FIRMA_NAME ?> <?php if ($config_fields['firma_name']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "firma_name" id = "firma_name" value = "<?php print $this->user->firma_name ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['client_type']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_CLIENT_TYPE ?> <?php if ($config_fields['client_type']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <?php print $this->select_client_types;?>
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['firma_code']['display']){?>
        <tr id='tr_field_firma_code' <?php if ($this->user->client_type!="2"){?>style="display:none;"<?php } ?>>
          <td class="name">
            <?php print _JSHOP_FIRMA_CODE ?> <?php if ($config_fields['firma_code']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "firma_code" id = "firma_code" value = "<?php print $this->user->firma_code ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['tax_number']['display']){?>
        <tr id='tr_field_tax_number' <?php if ($this->user->client_type!="2"){?>style="display:none;"<?php } ?>>
          <td class="name">
            <?php print _JSHOP_VAT_NUMBER ?> <?php if ($config_fields['tax_number']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "tax_number" id = "tax_number" value = "<?php print $this->user->tax_number ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['email']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_EMAIL ?> <?php if ($config_fields['email']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "email" id = "email" value = "<?php print $this->user->email ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['street']['display']){?>
        <tr>
          <td  class="name">
            <?php print _JSHOP_STREET_NR ?> <?php if ($config_fields['street']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "street" id = "street" value = "<?php print $this->user->street ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['zip']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_ZIP ?> <?php if ($config_fields['zip']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "zip" id = "zip" value = "<?php print $this->user->zip ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['city']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_CITY ?> <?php if ($config_fields['city']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "city" id = "city" value = "<?php print $this->user->city ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['state']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_STATE ?> <?php if ($config_fields['state']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "state" id = "state" value = "<?php print $this->user->state ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['country']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_COUNTRY ?> <?php if ($config_fields['country']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <?php print $this->select_countries ?>
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['phone']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_TELEFON ?> <?php if ($config_fields['phone']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "phone" id = "phone" value = "<?php print $this->user->phone ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['mobil_phone']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_MOBIL_PHONE ?> <?php if ($config_fields['mobil_phone']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "mobil_phone" id = "mobil_phone" value = "<?php print $this->user->mobil_phone ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['fax']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_FAX ?> <?php if ($config_fields['fax']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "fax" id = "fax" value = "<?php print $this->user->fax ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['ext_field_1']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_EXT_FIELD_1 ?> <?php if ($config_fields['ext_field_1']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "ext_field_1" id = "ext_field_1" value = "<?php print $this->user->ext_field_1 ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['ext_field_2']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_EXT_FIELD_2 ?> <?php if ($config_fields['ext_field_2']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "ext_field_2" id = "ext_field_2" value = "<?php print $this->user->ext_field_2 ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['ext_field_3']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_EXT_FIELD_3 ?> <?php if ($config_fields['ext_field_3']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "ext_field_3" id = "ext_field_3" value = "<?php print $this->user->ext_field_3 ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
    </table>                                
    </div>
    
    <?php if ($this->count_filed_delivery > 0){?>
    <div>
    <?php print _JSHOP_DELIVERY_ADRESS ?>
    <input type = "radio" name = "delivery_adress" id = "delivery_adress_1" value = "0" <?php if (!$this->delivery_adress) {?> checked = "checked" <?php } ?> onclick = "jQuery('#div_delivery').hide()" />
    <label for = "delivery_adress_1"><?php print _JSHOP_NO ?></label>
    <input type = "radio" name = "delivery_adress" id = "delivery_adress_2" value = "1" <?php if ($this->delivery_adress) {?> checked = "checked" <?php } ?> onclick = "jQuery('#div_delivery').show()" />
    <label for = "delivery_adress_2"><?php print _JSHOP_YES ?></label>
    </div>
    <?php }?>
    
    <div id = "div_delivery" class = "jshop_register" style = "padding-bottom:0px;<?php if (!$this->delivery_adress){ ?>display:none;<?php } ?>" >
    <table>
        <?php if ($config_fields['d_title']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_REG_TITLE ?> <?php if ($config_fields['d_title']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <?php print $this->select_d_titles ?>
          </td>
        </tr>        
        <?php } ?>
        <?php if ($config_fields['d_f_name']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_F_NAME ?> <?php if ($config_fields['d_f_name']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "d_f_name" id = "d_f_name" value = "<?php print $this->user->d_f_name ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_l_name']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_L_NAME ?> <?php if ($config_fields['d_l_name']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "d_l_name" id = "d_l_name" value = "<?php print $this->user->d_l_name ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_firma_name']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_FIRMA_NAME ?> <?php if ($config_fields['d_firma_name']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "d_firma_name" id = "d_firma_name" value = "<?php print $this->user->d_firma_name ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_email']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_EMAIL ?> <?php if ($config_fields['d_email']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "d_email" id = "d_email" value = "<?php print $this->user->d_email ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>        
        <?php if ($config_fields['d_street']['display']){?>
        <tr>
          <td  class="name">
            <?php print _JSHOP_STREET_NR ?> <?php if ($config_fields['d_street']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "d_street" id = "d_street" value = "<?php print $this->user->d_street ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_zip']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_ZIP ?> <?php if ($config_fields['d_zip']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "d_zip" id = "d_zip" value = "<?php print $this->user->d_zip ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_city']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_CITY ?> <?php if ($config_fields['d_city']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "d_city" id = "d_city" value = "<?php print $this->user->d_city ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_state']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_STATE ?> <?php if ($config_fields['d_state']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "d_state" id = "d_state" value = "<?php print $this->user->d_state ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_country']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_COUNTRY ?> <?php if ($config_fields['d_country']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <?php print $this->select_d_countries ?>
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_phone']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_TELEFON ?> <?php if ($config_fields['d_phone']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "d_phone" id = "d_phone" value = "<?php print $this->user->d_phone ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_mobil_phone']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_MOBIL_PHONE ?> <?php if ($config_fields['d_mobil_phone']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "d_mobil_phone" id = "d_mobil_phone" value = "<?php print $this->user->d_mobil_phone ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_fax']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_FAX ?> <?php if ($config_fields['d_fax']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "d_fax" id = "d_fax" value = "<?php print $this->user->d_fax ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_ext_field_1']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_EXT_FIELD_1 ?> <?php if ($config_fields['d_ext_field_1']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "d_ext_field_1" id = "d_ext_field_1" value = "<?php print $this->user->d_ext_field_1 ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_ext_field_2']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_EXT_FIELD_2 ?> <?php if ($config_fields['d_ext_field_2']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "d_ext_field_2" id = "d_ext_field_2" value = "<?php print $this->user->d_ext_field_2 ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
        <?php if ($config_fields['d_ext_field_3']['display']){?>
        <tr>
          <td class="name">
            <?php print _JSHOP_EXT_FIELD_3 ?> <?php if ($config_fields['d_ext_field_3']['require']){?><span>*</span><?php } ?>
          </td>
          <td>
            <input type = "text" name = "d_ext_field_3" id = "d_ext_field_3" value = "<?php print $this->user->d_ext_field_3 ?>" class = "inputbox" />
          </td>
        </tr>
        <?php } ?>
    </table>
    </div>
    
    <div style="padding-top:10px;">
        <div class="requiredtext">* <?php print _JSHOP_REQUIRED?></div>
        <input type = "submit" name = "next" value = "<?php print _JSHOP_SAVE ?>" class = "button" />
    </div>
    
    </form>
</div>    