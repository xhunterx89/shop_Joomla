<?php
$row = $this->row;
?>
<form action = "index.php?option=com_jshopping&controller=licensekeyaddon" method = "post"name = "adminForm">

<div class="col100">
<fieldset class="adminform">
<table width = "100%" class="admintable">
   <tr>
     <td class="key" style="width:250px;">
       <?php echo _JSHOP_KEY; ?>
     </td>
     <td>
       <input type = "text" class = "inputbox" name = "key" value = "<?php echo $row->key;?>" size="100" />
     </td>   
 </table>
</fieldset>
</div>
<div class="clr"></div>

<input type = "hidden" name = "task" value = "" />
<input type = "hidden" name = "id" value = "<?php print $row->id?>" />
<input type = "hidden" name = "alias" value = "<?php print $row->alias?>" />
<input type = "hidden" name = "back" value = "<?php print $this->back?>" />
</form>