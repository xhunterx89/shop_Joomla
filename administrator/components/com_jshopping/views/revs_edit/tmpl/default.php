<form action = "index.php?option=com_jshopping&controller=reviews" method = "post" enctype = "multipart/form-data" name = "adminForm">
     <div class="col100">
     <table class="admintable" >
       <?php if ($this->review->review_id){ ?>
       <tr>
         <td class="key" style="width:180px;">
           <?php echo _JSHOP_NAME_PRODUCT; ?>
         </td>
         <td>
           <?php echo $this->review->name?>     
           <input type="hidden" name="product_id" value="<?php print $this->review->product_id;?>">
         </td>
       </tr>
       <?php }else { ?>
       <tr>
         <td class="key" style="width:180px;">
           <?php echo _JSHOP_PRODUCT_ID;?>
         </td>
         <td>
           <input type="text" name="product_id" value="">    
         </td>
       </tr>    
       <?php } ?>
       <tr>
         <td class="key" style="width:180px;">
           <?php echo _JSHOP_USER; ?>
         </td>
         <td>
           <input type = "text" class = "inputbox" size = "50" name = "user_name" value = "<?php echo $this->review->user_name?>" />
         </td>
       </tr>
       <tr>
         <td class="key" style="width:180px;">
           <?php echo _JSHOP_EMAIL; ?>
         </td>
         <td>
           <input type = "text" class = "inputbox" size = "50" name = "user_email" value = "<?php echo $this->review->user_email?>" />
         </td>
       </tr>       
              
       <tr>
         <td  class="key">
           <?php echo _JSHOP_PRODUCT_REVIEW; ?>
         </td>
         <td>
           <textarea name = "review" cols = "35"><?php echo $this->review->review ?></textarea>
         </td>
       </tr>
       <tr>
        <td class="key">
          <?php echo _JSHOP_REVIEW_MARK; ?> 
        </td>
        <td>
            <?php print $this->mark?>
        </td>
       </tr>
     </table>
     </div>
     <div class="clr"></div>
     <input type="hidden" name="review_id" value="<?php echo $this->review->review_id?>">
     <input type = "hidden" name = "task" value = "<?php echo JRequest::getVar('task', 0)?>" />          
</form>