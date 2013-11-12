<form enctype="multipart/form-data" action="index.php?option=com_jshopping&controller=update&task=update" method="post" name="adminForm">
    <table class="adminform">
	    <tr>
	        <td width="120">
	            <label for="install_package"><?php echo _JSHOP_UPDATE_PACKAGE_FILE; ?>:</label>
	        </td>
	        <td>
	            <input class="input_box" id="install_package" name="install_package" type="file" size="57" />
	            <input class="button" type="submit" value="<?php echo _JSHOP_UPDATE_PACKAGE_UPLOAD; ?>" />
	        </td>
	    </tr>
    </table>
</form>    