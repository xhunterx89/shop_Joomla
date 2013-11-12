<?php
include(JPATH_COMPONENT_ADMINISTRATOR."/views/otherpanel/tmpl/submenu.php");
?>
<?php
$vendor = $this->vendor;
$lists = $this->lists;
$config_fields = $this->config_fields;
?>
<form action = "index.php?option=com_jshopping&controller=vendors" method = "post" name = "adminForm" >
<div class="col100">
<fieldset class="adminform">
<table class="admintable">
	<tr>
     <td class="key" style="width:200px;">
       <?php echo _JSHOP_PUBLISH;?>
     </td>
     <td>
       <input type = "checkbox" name = "publish" value = "1" <?php if ($vendor->publish) echo 'checked = "checked"'?> />
     </td>
   </tr>
	<tr>
	  <td class="key">
	    <?php echo _JSHOP_USER_FIRSTNAME;?>
	  </td>
	  <td>
	    <input type = "text" class = "inputbox" size="40" name = "f_name" value = "<?php echo $vendor->f_name ?>" />
	  </td>
	</tr>

	<tr>
	  <td class="key">
	    <?php echo _JSHOP_USER_LASTNAME;?>
	  </td>
	  <td>
	    <input type = "text" class = "inputbox" size="40" name = "l_name" value = "<?php echo $vendor->l_name ?>" />
	  </td>
	</tr>
		
	<tr>
	  <td class="key">
	    <?php echo _JSHOP_STORE_NAME;?>
	  </td>
	  <td>
	    <input type = "text" class = "inputbox" size="40" name = "shop_name" value = "<?php echo $vendor->shop_name ?>" />
	  </td>
	</tr>

	<tr>
	  <td class="key">
	    <?php echo _JSHOP_STORE_COMPANY;?>
	  </td>
	  <td>
	    <input type = "text" class = "inputbox" size="40" name = "company_name" value = "<?php echo $vendor->company_name ?>" />
	  </td>
	</tr>
    
    <tr>
      <td class="key">
        <?php echo _JSHOP_LOGO." ("._JSHOP_URL.")";?>
      </td>
      <td>
        <input type = "text" class = "inputbox" size="80" name = "logo" value = "<?php echo $vendor->logo ?>" />
      </td>
    </tr>    

	<tr>
	  <td class="key">
	    <?php echo _JSHOP_URL;?>
	  </td>
	  <td>
	    <input type = "text" class = "inputbox" size="80" name = "url" value = "<?php echo $vendor->url ?>" />
	  </td>
	</tr>

	<tr>
	  <td class="key">
	    <?php echo _JSHOP_ADRESS?>
	  </td>
	  <td>
	    <input type = "text" class = "inputbox" size="40" name = "adress" value = "<?php echo $vendor->adress ?>" />
	  </td>
	</tr>

	<tr>
	  <td class="key">
	    <?php echo _JSHOP_CITY?>
	  </td>
	  <td>
	    <input type = "text" class = "inputbox" size="40" name = "city" value = "<?php echo $vendor->city ?>" />
	  </td>
	</tr>

	<tr>
	  <td class="key">
	    <?php echo _JSHOP_ZIP?>
	  </td>
	  <td>
	    <input type = "text" class = "inputbox" size="40" name = "zip" value = "<?php echo $vendor->zip ?>" />
	  </td>
	</tr>

	<tr>
	  <td class="key">
	    <?php echo _JSHOP_STATE?>
	  </td>
	  <td>
	    <input type = "text" class = "inputbox" size="40" name = "state" value = "<?php echo $vendor->state ?>" />
	  </td>
	</tr>

	<tr>
	  <td class="key">
	    <?php echo _JSHOP_COUNTRY?>
	  </td>
	  <td>
	    <?php echo $lists['country'];?>
	  </td>
	</tr>

	<tr>
	  <td class="key">
	    <?php echo _JSHOP_TELEFON?>
	  </td>
	  <td>
	    <input type = "text" class = "inputbox" size="40" name = "phone" value = "<?php echo $vendor->phone ?>" />
	  </td>
	</tr>

	<tr>
	  <td class="key">
	    <?php echo _JSHOP_FAX?>
	  </td>
	  <td>
	    <input type = "text" class = "inputbox" size="40" name = "fax" value = "<?php echo $vendor->fax ?>" />
	  </td>
	</tr>

    <tr>
      <td class="key">
        <?php echo _JSHOP_EMAIL?>
      </td>
      <td>
        <input type = "text" class = "inputbox" size="40" name = "email" value = "<?php echo $vendor->email ?>" />
      </td>
    </tr>  
			    
    <tr>
      <td class="key">
        <?php echo _JSHOP_USER_ID." ("._JSHOP_MANAGER.")"?>
      </td>
      <td>
        <input type = "text" class = "inputbox" name = "user_id" value = "<?php echo $vendor->user_id ?>" />
      </td>
    </tr>   

</table>
</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="task" value=""/>
<input type="hidden" name="id" value="<?php print $vendor->id?>"/>
</form>