<?php
include(JPATH_COMPONENT_ADMINISTRATOR."/views/otherpanel/tmpl/submenu.php");

$currencies = $this->rows;
$i = 0;
?>
<form action = "index.php?option=com_jshopping&controller=currencies" method = "post" name = "adminForm">
<table class = "adminlist">
<thead>
  <tr>
    <th class = "title" width  = "10">
      #
    </th>
    <th width = "20">
      <input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $currencies );?>);" />
    </th>
    <th align = "left">
      <?php echo _JSHOP_TITLE; ?>
    </th>
    <th width = "60">
        <?php echo _JSHOP_DEFAULT;?>    
    </th>
    <th width = "60">
        <?php echo _JSHOP_VALUE_CURRENCY;?>    
    </th>    
    <th colspan = "2" width = "40">
      <?php echo _JSHOP_ORDERING; ?>
    </th>    
    <th width = "30">
      <?php echo _JSHOP_PUBLISH; ?>
    </th>
    <th width = "50">
        <?php print _JSHOP_EDIT; ?>
    </th>
    <th width = "40">
        <?php echo _JSHOP_ID; ?>
    </th>
  </tr>
</thead>  
<?php
 $count = count($currencies);
 foreach($currencies as $currency){
  ?>
  <tr class = "row<?php echo $i % 2;?>">
   <td>
     <?php echo $i+1;?>
   </td>
   <td>
     <input type = "checkbox" onclick = "isChecked(this.checked)" name = "cid[]" id = "cb<?php echo $i;?>" value = "<?php echo $currency->currency_id?>" />
   </td>
   <td>
     <a title = "<?php echo _JSHOP_EDIT_CURRENCY;?>" href = "index.php?option=com_jshopping&controller=currencies&task=edit&currency_id=<?php echo $currency->currency_id; ?>"><?php echo $currency->currency_name;?></a>
   </td>
   <td align="center">
     <?php if ($this->config->mainCurrency==$currency->currency_id) {?>
        <img src="components/com_jshopping/images/icon-16-default.png" />
     <?php }?>
   </td>
   <td align = "center">
       <?php echo $currency->currency_value;?>
   </td>
   <td align = "right" width = "20">
    <?php
      if ($i != 0) echo '<a href = "index.php?option=com_jshopping&controller=currencies&task=order&id=' . $currency->currency_id . '&order=up&number=' . $currency->currency_ordering . '"><img alt="' . _JSHOP_UP . '" src="components/com_jshopping/images/uparrow.png"/></a>';
    ?>
   </td>
   <td align = "left" width = "20">
      <?php
        if ($i != $count - 1) echo '<a href = "index.php?option=com_jshopping&controller=currencies&task=order&id=' . $currency->currency_id . '&order=down&number=' . $currency->currency_ordering . '"><img alt="' . _JSHOP_DOWN . '" src="components/com_jshopping/images/downarrow.png"/></a>';
      ?>
   </td>
   
   <td align="center">
     <?php
       echo $published = ($currency->currency_publish) ? ('<a href = "javascript:void(0)" onclick = "return listItemTask(\'cb' . $i . '\', \'unpublish\')"><img src="components/com_jshopping/images/tick.png" title = "'._JSHOP_PUBLISH.'" ></a>') : ('<a href = "javascript:void(0)" onclick = "return listItemTask(\'cb' . $i . '\', \'publish\')"><img title = "'._JSHOP_UNPUBLISH.'" src="components/com_jshopping/images/publish_x.png"></a>');
     ?>
   </td>
   <td align="center">
        <a href='index.php?option=com_jshopping&controller=currencies&task=edit&currency_id=<?php print $currency->currency_id?>'><img src='components/com_jshopping/images/icon-16-edit.png'></a>
   </td>
   <td align="center">
        <?php print $currency->currency_id;?>
   </td>
  </tr>
<?php
$i++; 
}
?>
</table>

<input type = "hidden" name = "task" value = "<?php echo JRequest::getVar('task')?>" />
<input type = "hidden" name = "hidemainmenu" value = "0" />
<input type = "hidden" name = "boxchecked" value = "0" />
</form>