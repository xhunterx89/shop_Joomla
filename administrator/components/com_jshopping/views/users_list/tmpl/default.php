<?php
$rows = $this->rows;
$pageNav = $this->pageNav;
$limitstart = JRequest::getVar( 'limitstart' ,'');
$limit = JRequest::getVar( 'limit', 10);
$adv_string = '&limitstart=' . $limitstart . '&limit=' . $limit;
?>
<form name = "adminForm" method = "post" action = "index.php?option=com_jshopping&controller=users">
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
     <th align = "left">
       <?php echo _JSHOP_USERNAME?>
     </th>
     <th width = "150" align = "left" style = "padding-left:20px">
       <?php echo _JSHOP_USER_FIRSTNAME?>
     </th>
     <th width = "150" align = "left">
       <?php echo _JSHOP_USER_LASTNAME?>
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
     <td>
       <?php echo $pageNav->getRowOffset($i);?>
     </td>
     <td>
       <input type = "checkbox" id = "cb<?php echo $i++?>" name = "cid[]" value = "<?php echo $row->user_id?>" />
     </td>
     <td>
       <a href = "index.php?option=com_jshopping&controller=users&task=edit&user_id=<?php echo $row->user_id?>">
         <?php echo $row->username?>
       </a>
     </td>
     <td>
       <?php echo $row->f_name;?>
     </td>
     <td>
       <?php echo $row->l_name;?>
     </td>
     <td align="center">
        <?php print "<a href='index.php?option=com_jshopping&controller=users&task=edit&user_id=".$row->user_id."'><img src='components/com_jshopping/images/icon-16-edit.png'></a>"?>
     </td>
     <td align="center">
        <?php print $row->user_id?>
     </td>
   </tr>
   <?php }?>
 <tfoot>
 <tr>   
    <td colspan="8"><?php echo $pageNav->getListFooter();?></td>
 </tr>
 </tfoot>  
 </table>
<input type = "hidden" name = "task" value = "" />
 <input type = "hidden" name = "boxchecked" value = "1" />
</form>