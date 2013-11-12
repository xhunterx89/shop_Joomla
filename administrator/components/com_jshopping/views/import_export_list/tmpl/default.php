<?php
include(JPATH_COMPONENT_ADMINISTRATOR."/views/otherpanel/tmpl/submenu.php");
$rows = $this->rows;
$i = 0;
?>
<form action = "index.php?option=com_jshopping&controller=importexport" method = "post" name = "adminForm">

<table class = "adminlist">
<thead>
  <tr>
    <th class = "title" width  = "10">
      #
    </th>
    <th width = "20">
	  <input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $rows );?>);" />
    </th>
    <th align = "left" width="25%">
      <?php echo _JSHOP_TITLE; ?>
    </th>    
    <th align = "left">
      <?php echo _JSHOP_DESCRIPTION; ?>
    </th>
    <th width="150">
        <?php echo _JSHOP_AUTOMATIC_EXECUTION; ?>
    </th>
    <th width="50">
        <?php echo _JSHOP_DELETE; ?>
    </th>
    <th width = "40">
        <?php echo _JSHOP_ID; ?>
    </th>
  </tr>
</thead>
<?php
$count = count($rows);
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
        <a href = "index.php?option=com_jshopping&controller=importexport&task=view&ie_id=<?php echo $row->id; ?>"><?php echo $row->name;?></a>
    </td>
    <td>
        <?php echo $row->description;?>
    </td>
    <td align="center">
        <a href='index.php?option=com_jshopping&controller=importexport&task=setautomaticexecution&cid=<?php print $row->id?>'>
            <?php if ($row->steptime>0){?>
                <img src='components/com_jshopping/images/tick.png'>
            <?php }else{ ?>
                <img src='components/com_jshopping/images/publish_x.png'>
            <?php }?>
        </a>
    </td>
    <td align="center">
        <a href='index.php?option=com_jshopping&controller=importexport&task=remove&cid=<?php print $row->id?>' onclick="return confirm('<?php print _JSHOP_DELETE?>');"><img src='components/com_jshopping/images/publish_r.png'></a>
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