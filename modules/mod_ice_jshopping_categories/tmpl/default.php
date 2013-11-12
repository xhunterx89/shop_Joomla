<div class="lofmenu_jshopping">
	<?php echo $categories; ?>
</div>
<script language="javascript">
	jQuery(document).ready(function(){
		jQuery('.lofmenu_jshopping .lofmenu .lofitem1').find('ul').css({'visibility':'hidden'});
		jQuery('.lofmenu_jshopping .lofmenu .lofitem1 ul').each(function(){
			jQuery(this).find('li:first').addClass('loffirst');
		})
		jQuery('.lofmenu_jshopping .lofmenu li').each(function(){
			jQuery(this).mouseenter(function(){
				jQuery(this).addClass('lofactive');
				jQuery(this).find('ul').css({'visibility':'visible'});
				jQuery(this).find('ul li ul').css({'visibility':'hidden'});
			});
			jQuery(this).mouseleave(function(){
				jQuery(this).removeClass('lofactive');
				jQuery(this).find('ul').css({'visibility':'hidden'});
			});
		});
	});
</script>