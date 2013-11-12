<?php
include(JPATH_COMPONENT_ADMINISTRATOR."/views/otherpanel/tmpl/submenu.php");
$i = 0;
$rows = $this->rows;
$pageNav = $this->pageNav;
?>
<form name = "adminForm" method = "post" action = "index.php?option=com_jshopping&controller=vendors">
<table width="100%" style="padding-bottom:5px;">
   <tr>
      <td align="right">
        <input type = "text" name = "text_search" value = "<?php echo htmlspecialchars($this->text_search);?>" />&nbsp;&nbsp;&nbsp;
        <input type = "submit" class = "button" value = "<?php echo _JSHOP_SEARCH;?>" />
      </td>
   </tr>
 </table>
 
 <table class = "adminlist" width = "100%">
 <thead>
   <tr>
     <th width = "20">
       #
     </th>
     <th width = "20">
       <input type="checkbox" onclick="checkAll(<?php echo count($rows)?>)" value="" name="toggle" />
     </th>
     <th width = "150" align = "left">
       <?php echo _JSHOP_USER_FIRSTNAME?>
     </th>
     <th width = "150" align = "left">
       <?php echo _JSHOP_USER_LASTNAME?>
     </th>
     <th width = "150" align = "left" style = "padding-left:20px">
       <?php echo _JSHOP_STORE_NAME?>
     </th>	 	      
     <th width = "50">
        <?php echo _JSHOP_EDIT;?>
    </th>
     <th width = "40">
        <?php echo _JSHOP_ID;?>
    </th>
   </tr>
  </thead> 
   <?php $i = 0; foreach($rows as $row){?>
   <tr class = "row<?php echo ($i  %2);?>">
     <td align="center">
       <?php echo $pageNav->getRowOffset($i);?>
     </td>
     <td align="center">
       <input type = "checkbox" id = "cb<?php echo $i++?>" name = "cid[]" value = "<?php echo $row->id?>" />
     </td>
     <td>
         <?php echo $row->f_name?>
     </td>
     <td>
       <?php echo $row->l_name;?>
     </td>
     <td>
       <?php echo $row->shop_name;?>
     </td>
     <td align="center">
        <?php print "<a href='index.php?option=com_jshopping&controller=vendors&task=edit&id=".$row->id."'><img src='components/com_jshopping/images/icon-16-edit.png'></a>"?>
     </td>
     <td align="center">
        <?php print $row->id?>
     </td>
   </tr>
   <?php }?>
 <tfoot>
 <tr>   
    <td colspan="11"><?php echo $pageNav->getListFooter();?></td>
 </tr>
 </tfoot>
</table>
<input type = "hidden" name = "task" value = "" />
<input type = "hidden" name = "boxchecked" value = "1" />
</form>