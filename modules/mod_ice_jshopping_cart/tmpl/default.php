<?php

// No direct access
defined('_JEXEC') or die;

 //echo "<pre>".print_r($cart,1);die;
 
 ?>
 
 
<?php $dropdown = $params->get('dropdown',1); ?>
<div id="jshop_module_cart">
	<div class="lof_jshop_top">
		
        <div class="lof_top_1">
			<span class="jshop_products"><?php print $cart->count_product?>&nbsp;<?php print JText::_('Sản phẩm')?></span>
            <span class="jshop_sum"><?php print formatprice($cart->getSum(0,1))?></span>
		</div>
        
		<div class="lof_top_2">
			<a class="jshop_viewcart" href="<?php print SEFLink('index.php?option=com_jshopping&controller=cart&task=view', 1)?>"><?php print JText::_('Xem giỏ hàng')?></a>
			<?php if($dropdown){ ?>
				<?php if( count( $cart->products) == 0): ?>
					<span class="jshop_readmore"><?php print JText::_('SHOW_MORE')?></span>
				<?php else:?>
					<a class="jshop_readmore showmore" href = "javascript:void(0)"><?php print JText::_('SHOW_MORE')?></a>
				<?php endif; ?>
			<?php } ?>
			
		</div>
	</div>
	<?php 
		//echo $dropdown; die;
		if($dropdown){
	?>
	<div class="lof_jshop_bottom" style="display:none;">
		<?php 
		foreach($cart->products as $product){
		?><div style="clear:both;"></div> 
		<div class="lof_item">
			<a href = "<?php print SEFLink('index.php?option=com_jshopping&controller=product&task=view&category_id='.$product['category_id'].'&product_id='.$product['product_id'], 1)?>" title = "<?php print htmlspecialchars($product['product_name']);?>">
				<img src = "<?php print $jshopConfig->image_product_live_path ?>/<?php if ($product['thumb_image']) print $product['thumb_image']; else 'noimage.gif'; ?>" alt = "<?php print htmlspecialchars($product['product_name']);?>" class = "jshop_img" />
			</a>
			<div class="lof_info">
				<a href = "<?php print SEFLink('index.php?option=com_jshopping&controller=product&task=view&category_id='.$product['category_id'].'&product_id='.$product['product_id'], 1)?>" title = "<?php print htmlspecialchars($product['product_name']);?>">
					<?php print htmlspecialchars($product['product_name']);?>
				</a>
				<span class="lof_quantity"><?php print JText::_('QUANTITY')?> : <?php print $product['quantity']; ?></span>
				<span class="lof_price"><?php print JText::_('PRICE')?> : <?php print formatprice($product['price'])?></span>
			</div>
		</div>
		<?php }?>
		<div class="lof_jshop_bottom_btn">
			<a class="lof_left" href = "<?php print SEFLink('index.php?option=com_jshopping&controller=cart&task=view', 1)?>"><?php print JText::_('VIEW_CART')?></a>
			<a class="lofclose" href = "javascript:void(0)"><?php print JText::_('CLOSE')?></a>
		</div>
	</div>
	<?php } ?>
	<script language="javascript">
		jQuery(document).ready(function(){
			<?php if($dropdown){ ?>
			jQuery('.lof_jshop_top .showmore').click(function(){
				if(jQuery(this).hasClass('showmore')){
					jQuery('.lof_jshop_bottom').slideDown("slow");
					jQuery(this).text('<?php print JText::_('SHOW_LESS')?>');
					$(this).removeClass('showmore').addClass('showless');
				}else{
					jQuery('.lof_jshop_bottom').slideUp();
					jQuery(this).text('<?php print JText::_('SHOW_MORE')?>');
					$(this).removeClass('showless').addClass('showmore');
				}
			});
			jQuery('.lof_jshop_bottom_btn .lofclose').click(function(){
				jQuery('.lof_jshop_bottom').slideUp();
				jQuery('.lof_jshop_top .lof_top_2 .showless').text('<?php print JText::_('SHOW_MORE')?>');
				jQuery('.lof_jshop_top .lof_top_2 .showless').removeClass('showless').addClass('showmore');
			});
			<?php } ?>
			jQuery('#main').find('.jshop table.cart').addClass("cart-full");
			
		});	
	</script>
</div>
