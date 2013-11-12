<?php
$row = $this->manufacturer;
$edit = $this->edit;
$jshopConfig = &JSFactory::getConfig();
jimport('joomla.html.pane');
?>
<div class="jshop_edit">
<form action = "index.php?option=com_jshopping&controller=manufacturers" method = "post" name = "adminForm" enctype = "multipart/form-data" id="item-form">
   <?php
   $pane =& JPane::getInstance('Tabs');
   echo $pane->startPane('catPane');
   
   foreach($this->languages as $lang){
       $name = "name_".$lang->language;
       $alias = "alias_".$lang->language;
       $description = "description_".$lang->language;
       $short_description = "short_description_".$lang->language;
       $meta_title = "meta_title_".$lang->language;
       $meta_keyword = "meta_keyword_".$lang->language;
       $meta_description = "meta_description_".$lang->language;
       
       $name_pane = _JSHOP_DESCRIPTION; if ($this->multilang) $name_pane.=" (".$lang->lang.")".'<img class = "tab_image" border = "0" src = "' . JURI::root() . '/administrator/components/com_jshopping/images/flags/' . $lang->lang . '.gif" />';
   
     echo $pane->startPanel($name_pane, $lang->lang.'-page');
     ?>
     <div class="col100">
     <table class="admintable">
       <tr>
         <td class="key" style="width:180px;">
           <?php echo _JSHOP_TITLE; ?>
         </td>
         <td>
           <input type = "text" class = "inputbox" size = "50" name = "<?php print $name?>" value = "<?php print $row->$name?>" />
         </td>
       </tr>
       <tr>
         <td class="key">
           <?php echo _JSHOP_ALIAS;?>
         </td>
         <td>
           <input type = "text" class = "inputbox" size = "50" name = "<?php print $alias?>" value = "<?php print $row->$alias?>" />
         </td>
       </tr>
       <tr>
         <td  class="key">
           <?php echo _JSHOP_SHORT_DESCRIPTION;?>
         </td>
         <td>
           <textarea name = "<?php print $short_description;?>" cols = "55" rows="5"><?php echo $row->$short_description ?></textarea>
         </td>
       </tr>
       <tr>
         <td  class="key">
           <?php echo _JSHOP_DESCRIPTION; ?>
         </td>
         <td>
           <?php
              $editor = &JFactory::getEditor();
              print $editor->display('description'.$lang->id, $row->$description , '100%', '350', '75', '20' ) ;              
           ?>
         </td>
       </tr>
       <tr>
         <td  class="key">
           <?php echo _JSHOP_META_TITLE; ?>
         </td>
         <td>
           <input type = "text" class = "inputbox" size = "160" name = "<?php print $meta_title?>" value = "<?php print $row->$meta_title?>" />
         </td>
       </tr>
       <tr>
         <td  class="key">
           <?php echo _JSHOP_META_DESCRIPTION; ?>
         </td>
         <td>
           <input type = "text" class = "inputbox" size = "160" name = "<?php print $meta_description;?>" value = "<?php print $row->$meta_description;?>" />
         </td>
       </tr>
       <tr>
         <td  class="key">
           <?php echo _JSHOP_META_KEYWORDS; ?>
         </td>
         <td>
           <input type = "text" class = "inputbox" size = "160" name = "<?php print $meta_keyword?>" value = "<?php print $row->$meta_keyword;?>" />
         </td>
       </tr>
     </table>
     </div>
     <div class="clr"></div>
     <?php
     echo $pane->endPanel(); 
   }       
   echo $pane->startPanel(_JSHOP_MAIN_PARAMETERS, 'main-page');
   ?>
     <div class="col100">
     <table class="admintable" >
       <tr>
         <td class="key" style="width:200px;">
           <?php echo _JSHOP_PUBLISH;?>
         </td>
         <td>
           <input type = "checkbox" class = "inputbox" id = "manufacturer_publish" name = "manufacturer_publish" value = "1" value = "1" <?php if ($row->manufacturer_publish) echo 'checked = "checked"'?>  />
         </td>
       </tr>
       <tr>
     <td class="key">
           <?php echo _JSHOP_URL; ?>
         </td>
         <td>
           <input type = "text" class = "inputbox" id = "manufacturer_url" size="40" name = "manufacturer_url" value = "<?php echo $row->manufacturer_url;?>" />
         </td>
       </tr>
       <tr>
         <td  class="key">
           <?php echo _JSHOP_COUNT_PRODUCTS_PAGE;?>
         </td>
         <td>
           <input type = "text" class = "inputbox" id = "products_page" name = "products_page" value = "<?php echo $count_product_page = ($row->manufacturer_id) ? ($row->products_page) : ($jshopConfig->count_products_to_page);?>" />
         </td>
       </tr>
       <tr>
         <td  class="key">
           <?php echo _JSHOP_COUNT_PRODUCTS_ROW;?>
         </td>
         <td>
           <input type = "text" class = "inputbox" id = "products_row" name = "products_row" value = "<?php echo $count_product_row = ($row->manufacturer_id) ? ($row->products_row) : ($jshopConfig->count_products_to_row);?>" />
         </td>
       </tr>
       </tr>
     </table>
     </div>
     <div class="clr"></div>
   <?php
   echo $pane->endPanel();
   echo $pane->startPanel(_JSHOP_IMAGE, 'image'); 
   ?>
     
     <?php if ($row->manufacturer_logo){ ?>
     <div class = "jshop_quote" id="image_manufacturer">
        <div>
            <div><img src = "<?php print $jshopConfig->image_manufs_live_path . '/' . $row->manufacturer_logo?>" /></div>
            <div class="link_delete_foto"><a href="#" onclick="if (confirm('<?php print _JSHOP_DELETE_IMAGE;?>')) deleteFotoManufacturer('<?php echo $row->manufacturer_id?>');return false;"><img src="components/com_jshopping/images/publish_r.png"> <?php print _JSHOP_DELETE_IMAGE;?></a></div>
        </div>
     </div>
     <?php } ?>
     
     <div class="col100">

     <table class="admintable" >
       <tr>
         <td class="key">
           <?php echo _JSHOP_IMAGE_SELECT;?>
         </td>
         <td>
           <input type = "file" name = "manufacturer_logo" />
         </td>
       </tr>
       <tr>
         <td class="key">
           <?php echo _JSHOP_IMAGE_THUMB_SIZE;?>
         </td>
         <td>
            <div>
           <input type = "radio" name = "size_im_category" id = "size_1" checked = "checked" onclick = "setDefaultSize(<?php echo $jshopConfig->image_category_width; ?>,<?php echo $jshopConfig->image_category_height; ?>, 'category')" value = "1" />
           <label for = "size_1"><?php echo _JSHOP_IMAGE_SIZE_1;?></label>
           <div class="clear"></div>
           </div>
           <div>
           <input type = "radio" name = "size_im_category" value = "3" id = "size_3" onclick = "setOriginalSize('category')" value = "3"/>
           <label for = "size_3"><?php echo _JSHOP_IMAGE_SIZE_3;?></label>
           <div class="clear"></div>
           </div>
           <div>
           <input type = "radio" name = "size_im_category" id = "size_2" onclick = "setManualSize('category')" value = "2" />
           <label for = "size_2"><?php echo _JSHOP_IMAGE_SIZE_2;?></label> <?php echo JHTML::_('tooltip', _JSHOP_IMAGE_SIZE_INFO );?>
           <div class="clear"></div>
           </div>
         </td>
       </tr>
       <tr>
         <td class="key">
           <?php echo _JSHOP_IMAGE_WIDTH;?>
         </td>
         <td>
           <input type = "text" id = "category_width_image" name = "category_width_image" value = "<?php echo $jshopConfig->image_category_width?>" disabled = "disabled" />
         </td>
       </tr>
       <tr>
         <td class="key">
           <?php echo _JSHOP_IMAGE_HEIGHT;?>
         </td>
         <td>
           <input type = "text" id = "category_height_image" name = "category_height_image" value = "<?php echo $jshopConfig->image_category_height?>" disabled = "disabled" />           
         </td>
       </tr>
     </table>

     </div>
     <div class="clr"></div>
     <br/><br/>
     <div class="helpbox">
        <div class="head"><?php echo _JSHOP_ABOUT_UPLOAD_FILES;?></div>
        <div class="text">
        	<?php print _JSHOP_IMAGE_UPLOAD_EXT_INFO?><br/>
            <?php print sprintf(_JSHOP_SIZE_FILES_INFO, ini_get("upload_max_filesize"), ini_get("post_max_size"));?>
        </div>
    </div>
   <?php
   echo $pane->endPanel();
   
   echo $pane->endPane(); 
   ?>
   
   <script type = "text/javascript">   
     Joomla.submitbutton = function(task){
        if (task == 'save' || task == 'apply'){
            if (!parseInt($F_('products_page'))){
               alert ('<?php echo _JSHOP_WRITE_PRODUCTS_PAGE?>');
               return 0;
             } else if (!parseInt($F_('products_row'))){
               alert ('<?php echo _JSHOP_WRITE_PRODUCTS_ROW?>');
               return 0;
            } else if (isEmpty($F_('category_width_image')) && isEmpty($F_('category_height_image'))){
               alert ('<?php echo _JSHOP_WRITE_SIZE_BAD?>');
               return 0;
            }
         }
         Joomla.submitform(task, document.getElementById('item-form'));
     }
   </script>

<input type = "hidden" name = "old_image" value = "<?php echo $row->manufacturer_logo?>" />
<input type = "hidden" name = "task" value = "" />
<input type = "hidden" name = "edit" value = "<?php echo $edit;?>" />
<input type = "hidden" name = "manufacturer_id" value = "<?php echo $row->manufacturer_id?>" />

</form>
</div>