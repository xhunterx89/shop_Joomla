<?php
$jshopConfig = &JSFactory::getConfig();
include(dirname(__FILE__)."/submenu.php");
$rows = $this->rows;
$i = 0;
?>
<form action = "index.php?option=com_jshopping&controller=config" method = "post" name = "adminForm">
<table class = "adminlist">
<thead>
  <tr>
    <th class = "title" width  = "10">
      #
    </th>
    <th width = "20">
      <input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo $count = count( $rows );?>);" />
    </th>
    <th align = "left">
      <?php echo _JSHOP_PAGE; ?>
    </th>
    <th width = "50">
        <?php echo _JSHOP_EDIT;?>
    </th>
    <th width = "40">
        <?php echo _JSHOP_ID;?>
    </th>
  </tr>
</thead>  
<?php
foreach($rows as $row){
?>
  <tr class = "row<?php echo $i % 2;?>">
   <td>
     <?php echo $i+1;?>
   </td>
   <td>
     <input type = "checkbox" onclick = "isChecked(this.checked)" name = "cid[]" id = "cb<?php echo $i;?>" value = "<?php echo $row->id?>" />
   </td>
   <td>
    <a href='index.php?option=com_jshopping&controller=config&task=statictextedit&id=<?php print $row->id?>'>
    <?php if (defined("_JSHP_STPAGE_".$row->alias)) print constant("_JSHP_STPAGE_".$row->alias); else print $row->alias;?>
    </a>
   </td>   
   <td align="center">
        <a href='index.php?option=com_jshopping&controller=config&task=statictextedit&id=<?php print $row->id?>'><img src='components/com_jshopping/images/icon-16-edit.png'></a>
   </td>
   <td align="center">
    <?php print $row->id;?>
   </td>
   </tr>
<?php
    $i++;
}
?>
</table>

<input type = "hidden" name = "task" value = "" />
<input type = "hidden" name = "hidemainmenu" value = "0" />
<input type = "hidden" name = "boxchecked" value = "0" />
</form>