<?php
/**
* @package Joomla
* @author Dmitry Stashenko
* @website http://nevigen.eu/
* @email support@nevigen.eu
* @copyright Copyright by Nevigen Ltd. All rights reserved.
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
**/

defined( '_JEXEC' ) or die;
?>

<div class="jshop random_products">
<?php foreach($rand_prod as $curr){ ?>
   <div class="block_item">
       <?php if ($show_image) { ?>
       <div class="item_image">
			<?php if ($curr->_label_image) { ?>
			<div class="product_label">
					<img src="<?php print $curr->_label_image?>" alt="<?php print htmlspecialchars($curr->_label_name)?>" />
			</div>
		   <?php } ?>
           <a href="<?php print $curr->product_link?>"><img src = "<?php print $jshopConfig->image_product_live_path?>/<?php if ($curr->product_thumb_image) print $curr->product_thumb_image; else print $noimage?>" alt="" /></a>
       </div>
       <?php } ?>
       <div class="item_name">
           <a href="<?php print $curr->product_link?>"><?php print $curr->name?></a>
       </div>
       <?php if ($curr->_display_price){?>
       <div class="item_price">
           <?php print formatprice($curr->product_price);?>
       </div>
       <?php }?>
   </div>       
<?php } ?>
</div>