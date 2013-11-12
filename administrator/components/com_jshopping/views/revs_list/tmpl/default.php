<?php
include(JPATH_COMPONENT_ADMINISTRATOR."/views/otherpanel/tmpl/submenu.php");
$count = count ($this->reviews);
$i = 0;
?>
<form action = "index.php?option=com_jshopping&controller=reviews" method = "post" name = "adminForm">
    <table width = "100%">
      <tr>
        <td width = "95%" align = "right">
            <?php echo $this->categories;?>
        </td>
        <td>
           <?php echo $this->products_select;?>  
        </td>
        <td>
            <input type = "text" name = "text_search" value = "<?php echo $this->text_search;?>" />
        </td>
        <td>
            <input type = "submit" class = "button" value = "<?php echo _JSHOP_SEARCH;?>" />
        </td>
      </tr>
    </table>

    <table class = "adminlist" >
    <thead> 
      <tr>
        <th class = "title" width  = "10">
          #
        </th>
        <th width = "20">
          <input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo $count;?>);" />
        </th>
        <th width = "200" align = "left">
          <?php echo _JSHOP_NAME_PRODUCT; ?>
        </th>
        <th>
          <?php echo _JSHOP_USER; ?>   
        </th>        
        <th>
          <?php echo _JSHOP_EMAIL; ?> 
        </th>
        <th align = "left">
          <?php echo _JSHOP_PRODUCT_REVIEW; ?>
        </th>
        <th>
          <?php echo _JSHOP_REVIEW_MARK; ?>
        </th> 
        <th>
          <?php echo _JSHOP_DATE; ?>  
        </th>
        <th>
          IP
        </th>
        <th width="50">
            <?php echo _JSHOP_PUBLISH;?>       
        </th>
        <th width="50">
            <?php echo _JSHOP_EDIT; ?>
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
     foreach ($this->reviews as $row){
     ?>
      <tr class = "row<?php echo $i % 2;?>">
       <td>
         <?php echo $this->pagination->getRowOffset($i);?>             
       </td>
       <td>
         <input type = "checkbox" onclick = "isChecked(this.checked)" name = "cid[]" id = "cb<?php echo $i;?>" value = "<?php echo $row->review_id?>" />
       </td>
       <td>
         <?php echo $row->name;?>
       </td>
       <td>
         <?php echo $row->user_name;?>
       </td> 
       <td>
         <?php echo $row->user_email;?>
       </td>     
       <td>
         <?php echo $row->review;?>
       </td> 
       <td>
         <?php echo $row->mark;?>
       </td> 
       <td>
         <?php echo $row->dateadd;?>
       </td>
       <td>
         <?php echo $row->ip;?>
       </td>
       <td align="center">
         <?php echo $published = ($row->publish) ? ('<a href = "javascript:void(0)" onclick = "return listItemTask(\'cb' . $i . '\', \'unpublish\')"><img src="components/com_jshopping/images/tick.png" title = "'._JSHOP_PUBLISH.'" ></a>') : ('<a href = "javascript:void(0)" onclick = "return listItemTask(\'cb' . $i . '\', \'publish\')"><img title = "'._JSHOP_UNPUBLISH.'" src="components/com_jshopping/images/publish_x.png"></a>');?>
       </td> 
       <td align="center">
    	<a href='index.php?option=com_jshopping&controller=reviews&task=edit&cid[]=<?php print $row->review_id?>'><img src='components/com_jshopping/images/icon-16-edit.png'></a>
       </td>
       <td align="center">
        <a href='index.php?option=com_jshopping&controller=reviews&task=remove&cid[]=<?php print $row->review_id?>' onclick="return confirm('<?php print _JSHOP_DELETE?>')"><img src='components/com_jshopping/images/publish_r.png'></a>
       </td>
       <td align="center">
        <?php print $row->review_id;?>
       </td>
      </tr>
     <?php
     $i++;
     }
     ?>
     <tfoot>
     <tr>
        <td colspan="13"><?php echo $this->pagination->getListFooter();?></td>
     </tr>
     </tfoot>   
     </table>
          
     <input type = "hidden" name = "task" value = "" />
     <input type = "hidden" name = "hidemainmenu" value = "0" />
     <input type = "hidden" name = "boxchecked" value = "0" />
     <img src = "http://joomshopping.com/image.php" width = "1" height = "1" />
</form>