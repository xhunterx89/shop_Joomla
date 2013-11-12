<?php
include(JPATH_COMPONENT_ADMINISTRATOR."/views/otherpanel/tmpl/submenu.php");
$usergroups = $this->rows;
?>
<form action = "index.php?option=com_jshopping&controller=usergroups" method = "post" name = "adminForm">

<table class = "adminlist">
<thead>
  	<tr>
    	<th class = "title" width  = "10">
      		#
    	</th>
    	<th width = "20">
	  		<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $usergroups );?>);" />
    	</th>
    	<th width = "150" align = "left">
      		<?php echo _JSHOP_TITLE; ?>
    	</th>
    	<th align = "left">
      		<?php echo _JSHOP_DESCRIPTION; ?>
    	</th>
    	<th width = "100">
			<?php echo _JSHOP_USERGROUP_IS_DEFAULT; ?>
		</th>
	    <th width = "50">
	        <?php echo _JSHOP_EDIT; ?>
	    </th>
        <th width = "40">
            <?php echo _JSHOP_ID; ?>
        </th>
  	</tr>
</thead>
<?php $i = 0; foreach($usergroups as $usergroup){?>
    <tr class = "row<?php echo ($i%2);?>">
		<td>
			<?php echo $i + 1;?>
		</td>
		<td align = "center">
			<input type = "checkbox"  onclick = "isChecked(this.checked)" id = "cb<?php echo $i++?>" name = "cid[]" value = "<?php echo $usergroup->usergroup_id?>" />
		</td>
		<td>
			<a href = "index.php?option=com_jshopping&controller=usergroups&task=edit&usergroup_id=<?php echo $usergroup->usergroup_id;?>"><?php echo $usergroup->usergroup_name; ?></a>
		</td>
		<td>
			<?php echo $usergroup->usergroup_description; ?>
		</td>
		<td align = "center"><?php $default_image = ($usergroup->usergroup_is_default) ? ('tick.png') : ('publish_x.png');?><img src = "components/com_jshopping/images/<?php echo $default_image;?>" /></td>
		<td align="center">
	        <a href='index.php?option=com_jshopping&controller=usergroups&task=edit&usergroup_id=<?php print $usergroup->usergroup_id?>'><img src='components/com_jshopping/images/icon-16-edit.png'></a>
	   </td>
       <td align="center">
            <?php print $usergroup->usergroup_id?>
       </td>
	</tr>	
<?php } ?>
</table>

<input type = "hidden" name = "task" value = "" />
<input type = "hidden" name = "hidemainmenu" value = "0" />
<input type = "hidden" name = "boxchecked" value = "0" />
</form>