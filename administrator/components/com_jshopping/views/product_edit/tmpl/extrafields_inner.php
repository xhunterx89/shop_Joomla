<table class="admintable" >
<?php
foreach($this->fields as $field){
?>
<tr>
   <td class="key">
     <?php echo $field->name;?>
   </td>
   <td>
     <?php echo $field->values;?>
   </td>
</tr>
<?php }?>
</table>