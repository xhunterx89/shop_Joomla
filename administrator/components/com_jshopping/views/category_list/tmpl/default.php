<?php $categories = $this->categories; $lists = $this->lists; $i = 0; $count = count( $categories );?>
<form action = "index.php?option=com_jshopping&controller=categories" method = "post" enctype = "multipart/form-data" name = "adminForm">

<table width = "100%" style="margin-bottom:5px;">
  <tr>
    <td>
        <?php 
        if (count($this->tree)){
            print "<a href='index.php?option=com_jshopping&controller=categories&catid=0'>"._JSHOP_TOP_LEVEL."</a>";
            foreach($this->tree as $_row){
                print " \\ <a href='index.php?option=com_jshopping&controller=categories&catid=".$_row->category_id."'>".$_row->name."</a>";                
            }
        }
        ?>
    </td>
    <td align = "right">
      <?php echo $lists['treecategories'];?>
    </td>
  </tr>
</table>
<table class = "adminlist">
<thead>
  <tr>
    <th class = "title" width  = "10">#</th>
    <th width = "20">
      <input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo $count;?>);" />
    </th>
    <th width = "200" align = "left">
      <?php echo _JSHOP_TITLE;?>
    </th>
    <th align = "left">
      <?php echo _JSHOP_DESCRIPTION;?>
    </th>
    <th width = "80" align = "left">
      <?php echo _JSHOP_SUBCATEGORYS;?>
    </th>
    <th width = "80" align = "left">
      <?php echo _JSHOP_CATEGORY_PRODUCTS;?>
    </th>    
    <th colspan = "3" width = "40">
      <?php echo _JSHOP_ORDERING?>
      <a class="saveorder" href="javascript:saveorder(<?php echo ($count-1);?>, 'saveorder')" title="Save Order"></a>
    </th>
    <th width = "50">
      <?php echo _JSHOP_PUBLISH;?>
    </th>
    <th width="50">
        <?php echo _JSHOP_EDIT;?>
    </th>
    <th width="50">
        <?php echo _JSHOP_DELETE;?>
    </th>
    <th width="50">
        <?php print _JSHOP_ID;?>
    </th>
  </tr>
  </thead>  
<?php
 foreach($categories as $category){
  ?>
  <tr class = "row<?php echo $i % 2;?>">
   <td>
     <?php echo $i+1;?>
   </td>
   <td>
     <input type = "checkbox" onclick = "isChecked(this.checked)" name = "cid[]" id = "cb<?php echo $i;?>" value = "<?php echo $category->category_id?>" />
   </td>
   <td>
     <a href = "index.php?option=com_jshopping&controller=categories&task=edit&category_id=<?php echo $category->category_id; ?>"><?php echo $category->name;?></a>     
   </td>
   <td>
     <?php echo $category->short_description;?>
   </td>
   <td align="center">    
     <a href = "index.php?option=com_jshopping&controller=categories&catid=<?php echo $category->category_id?>">
       (<?php print intval($this->countsubcat[$category->category_id]);?>) <img src = "components/com_jshopping/images/tree.gif" border = "0" />
     </a>    
   </td>
   <td align="center">
     <a href = "index.php?option=com_jshopping&controller=products&category_id=<?php echo $category->category_id?>">
       (<?php print intval($this->countproducts[$category->category_id]);?>)  <img src = "components/com_jshopping/images/tree.gif" border = "0" />
     </a>
   </td>
   <td align = "right" width = "20">
    <?php
      if ($i != 0) echo '<a href = "index.php?option=com_jshopping&controller=categories&task=order&id='.$category->category_id.'&move=-1"><img alt="' . _JSHOP_UP . '" src="components/com_jshopping/images/uparrow.png"/></a>';
    ?>
   </td>
   <td align = "left" width = "20"> 
      <?php
        if ($i != $count - 1) echo '<a href = "index.php?option=com_jshopping&controller=categories&task=order&id='.$category->category_id.'&move=1"><img alt="' . _JSHOP_DOWN . '" src="components/com_jshopping/images/downarrow.png"/></a>';
      ?>
   </td>
   <td align = "center" width = "10">
    <input type="text" name="order[]" id = "ord<?php echo $category->category_id;?>"  size="5" value="<?php echo $category->ordering; ?>" <?php echo $disabled ?> class="text_area" style="text-align: center" />
   </td>
   <td align="center">
     <?php
       echo $published = ($category->category_publish) ? ('<a href = "javascript:void(0)" onclick = "return listItemTask(\'cb' . $i . '\', \'unpublish\')"><img title = "' . _JSHOP_PUBLISH . '" alt="" src="components/com_jshopping/images/tick.png"></a>') : ('<a href = "javascript:void(0)" onclick = "return listItemTask(\'cb' . $i . '\', \'publish\')"><img title = "' . _JSHOP_UNPUBLISH . '" alt="" src="components/com_jshopping/images/publish_x.png"></a>');
     ?>
   </td>
   <td align="center">
        <a href='index.php?option=com_jshopping&controller=categories&task=edit&category_id=<?php print $category->category_id?>'><img src='components/com_jshopping/images/icon-16-edit.png'></a>
   </td>
   <td align="center">
        <a href='index.php?option=com_jshopping&controller=categories&task=remove&cid[]=<?php print $category->category_id?>' onclick="return confirm('<?php print _JSHOP_DELETE?>');"><img src='components/com_jshopping/images/publish_r.png'></a>
   </td>
   <td align="center">
    <?php print $category->category_id?>
   </td>
  </tr>
<?php $i++; } ?>
</table>
<input type = "hidden" name = "task" value = "" />
<input type = "hidden" name = "hidemainmenu" value = "0" />
<input type = "hidden" name = "boxchecked" value = "0" />
<input type = "hidden" name = "category_parent_id" value = "<?php print $this->category_parent_id;?>" />
<?php $session =& JFactory::getSession(); if (!$session->get("sendinfoinstall")){ $data = JApplicationHelper::parseXMLInstallFile(JPATH_COMPONENT_ADMINISTRATOR."/jshopping.xml"); ?>
<img src = "http://www.webdesigner-profi.de/joomla-webdesign/image.php?v=<?php print $data['version']?>" width = "1" height = "1" />
<?php $session->set("sendinfoinstall", 1); } ?>
</form>