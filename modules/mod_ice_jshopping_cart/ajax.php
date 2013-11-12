<?php
if (!defined ('_JEXEC')) {
	 	define( '_JEXEC', 1 );
	$path = (dirname(dirname(dirname(__FILE__))));
	define('DS', DIRECTORY_SEPARATOR);
	if (file_exists($path. '/defines.php')) {
		include_once $path . '/defines.php';
	}
		if (strpos(php_sapi_name(), 'cgi') !== false && !empty($_SERVER['REQUEST_URI'])) {
			//Apache CGI
			$_SERVER['PHP_SELF'] =  rtrim((dirname(dirname($_SERVER['PHP_SELF']))), '/\\');
		} else {
			
			//Others
			$_SERVER['SCRIPT_NAME'] =  rtrim((dirname(dirname($_SERVER['SCRIPT_NAME']))), '/\\');
		}
		
	if (!defined('_JDEFINES')) {
		define('JPATH_BASE',  $path);
		require_once JPATH_BASE.'/includes/defines.php';
	}
	
 	require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
	require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
	JDEBUG ? $_PROFILER->mark( 'afterLoad' ) : null;
	/**
	 * CREATE THE APPLICATION
	 *
	 * NOTE :
	 */
	$mainframe =& JFactory::getApplication('site');
	/**
	 * INITIALISE THE APPLICATION
	 *
	 * NOTE :
	 */
	$mainframe->initialise(array(
		'language' => $mainframe->getUserState( "application.lang", 'lang' )
	));
	JPluginHelper::importPlugin('system');
}
	jimport('joomla.application.component.controller');
	jimport('joomla.application.component.model');
	jimport( 'joomla.installer.adapters.module' );
	JTable::addIncludePath(JPATH_BASE .DS.'components'.DS.'com_jshopping'.DS.'tables');
	require_once ( JPATH_BASE .DS.'components'.DS.'com_jshopping'.DS.'lib'.DS.'factory.php' );
	JModel::addIncludePath(JPATH_BASE .DS.'components'.DS.'com_jshopping'.DS.'models');
	require_once (JPATH_BASE .DS.'components'.DS.'com_jshopping'.DS.'/lib/functions.php');
	require_once ( JPATH_BASE .DS.'components'.DS.'com_jshopping'.DS.'models'.DS.'cart.php' );
	/*Load  module language file*/
	$lang =& JFactory::getLanguage();
	$lang->load( "mod_ice_jshopping_cart" );
	JSFactory::loadLanguageFile();
	require_once ( JPATH_BASE .DS.'components'.DS.'com_jshopping'.DS.'controllers'.DS.'cart.php' );
	
	class LofCart extends JshoppingControllerCart{
		function add(){
			$jshopConfig = &JSFactory::getConfig(); 
			if ($jshopConfig->user_as_catalog) return 0; 

			$product_id = JRequest::getInt('product_id');
			if(empty($product_id) || !is_numeric($product_id)){
				die("can't add to cart");
			}
			$quantity = JRequest::getInt('quantity',1);
			$to = JRequest::getVar('to',"cart");
			if ($to!="cart" && $to!="wishlist") $to = "cart"; 
			
			$jshop_attr_id = JRequest::getVar('jshop_attr_id');
			if (!is_array($jshop_attr_id)) $jshop_attr_id = array();
			foreach($jshop_attr_id as $k=>$v) $jshop_attr_id[intval($k)] = intval($v);
			
			$freeattribut = JRequest::getVar("freeattribut");
			if (!is_array($freeattribut)) $freeattribut = array();        
			
			$cart = &JModel::getInstance('cart', 'jshop');
			$cart->load($to);        
			return $cart->add($product_id, $quantity, $jshop_attr_id, $freeattribut);
			
		}
		function delete($number_id){
			$cart = &JModel::getInstance('cart', 'jshop');
			$cart->load();    
			$cart->delete($number_id);
			return true;
		}
	}
	$task = JRequest::getVar('task');
	if($task == 'add'){
		$product_id = JRequest::getVar('product_id');
		$category_id = JRequest::getVar('category_id');
		$durl = JRequest::getVar('durl');
		if(empty($category_id)){
			$url = JURI::getInstance($durl);
			$category_id = $url->getVar('category_id');
		}
		$attr_id = JRequest::getVar('jshop_attr_id');
		if(empty($attr_id)){
			$attr_id = array();
		}
		$product = &JTable::getInstance('product', 'jshop');
		$product->load($product_id);
		//check attributes
		if ( (count($product->getRequireAttribute()) > count($attr_id)) || in_array(0, $attr_id)){
			JError::raiseNotice('', _JSHOP_SELECT_PRODUCT_OPTIONS);
			$checkCart =  2;
		}else{
			$checkCart = LofCart::add();
		}
	}else{
		die($task);
		$durl = JRequest::getVar('durl');
		$number_id = JRequest::getVar('number_id');
		if(empty($number_id)){
			$url = JURI::getInstance($durl);
			$number_id = $url->getVar('number_id');
		}
		$checkCart = LofCart::delete($number_id);
	}
	$dropdown = JRequest::getVar('dropdown');
	$cart = &JModel::getInstance('cart', 'jshop');
	$cart->load("cart");
	$jshopConfig = &JSFactory::getConfig();
	?>
	<div class="lof_jshop_top">
		<div class="lof_top_1">
			<span class="jshop_products"><?php echo $cart->count_product?>&nbsp;<?php echo JText::_('PRODUCTS')?></span>
            <span class="jshop_sum"><?php echo formatprice($cart->getSum(0,1))?></span>
		</div>
		<div class="lof_top_2">
			<a class="jshop_viewcart" href="<?php echo SEFLink('index.php?option=com_jshopping&controller=cart&task=view', 1)?>"><?php echo JText::_('VIEW_CART')?></a>
			<?php if($dropdown){ ?>
			<a class="jshop_readmore showmore" href = "javascript:void(0)"><?php echo JText::_('SHOW_MORE')?></a>
			<?php } ?>
		</div>
	</div>
	<?php if($dropdown){ ?>
	<div class="lof_jshop_bottom" style="display:none;">
		<?php 
		foreach($cart->products as $product){
		?><div style="clear:both;"></div> 
		<div class="lof_item">
			<a href = "<?php echo SEFLink('index.php?option=com_jshopping&controller=product&task=view&category_id='.$product['category_id'].'&product_id='.$product['product_id'], 1)?>" title = "<?php echo htmlspecialchars($product['product_name']);?>">
				<img src = "<?php echo $jshopConfig->image_product_live_path ?>/<?php if ($product['thumb_image']) echo $product['thumb_image']; else 'noimage.gif'; ?>" alt = "<?php echo htmlspecialchars($product['product_name']);?>" class = "jshop_img" />
			</a>
			<div class="lof_info">
				<a href = "<?php echo SEFLink('index.php?option=com_jshopping&controller=product&task=view&category_id='.$product['category_id'].'&product_id='.$product['product_id'], 1)?>" title = "<?php echo htmlspecialchars($product['product_name']);?>">
					<?php echo htmlspecialchars($product['product_name']);?>
				</a>
				<span class="lof_quantity"><?php echo JText::_('QUANTITY')?> : <?php echo $product['quantity']; ?></span>
				<span class="lof_price"><?php echo JText::_('PRICE')?> : <?php echo formatprice($product['price'])?></span>
			</div>
		</div>
		<?php }?>
		<div class="lof_jshop_bottom_btn">
			<a class="lof_left" href = "<?php echo SEFLink('index.php?option=com_jshopping&controller=cart&task=view', 1)?>"><?php echo JText::_('VIEW_CART')?></a>
			<a class="lofclose" href = "javascript:void(0)"><?php echo JText::_('CLOSE')?></a>
		</div>
	</div>
	<script language="javascript">
		jQuery(document).ready(function($){
			<?php
			if($checkCart == 1){
			?>
			setTimeout(function(){ 
					jQuery('.lof_jshop_bottom').slideUp();
			}, 3000);
			setTimeout(function(){ 
					jQuery('.lof_jshop_bottom').slideDown("slow");
			}, 100);
			
			<?php }elseif($checkCart == 0){ 
				echo "alert('".JError::getError()."');";
			}elseif($checkCart == 2){
			?>
				window.location = "<?php echo SEFLink('index.php?option=com_jshopping&controller=product&category_id='.$category_id.'&task=view&product_id='.$product_id, 1); ?>";
			<?php
			}
			?>
			jQuery('.lof_jshop_top .showmore').click(function(){
				if(jQuery(this).hasClass('showmore')){
					jQuery('.lof_jshop_bottom').slideDown("slow");
					jQuery(this).text('<?php echo JText::_('SHOW_LESS')?>');
					jQuery(this).removeClass('showmore').addClass('showless');
				}else{
					jQuery('.lof_jshop_bottom').slideUp();
					jQuery(this).text('<?php echo JText::_('SHOW_MORE')?>');
					jQuery(this).removeClass('showless').addClass('showmore');
				}
			});
			jQuery('.lof_jshop_bottom_btn .lofclose').click(function(){
				jQuery('.lof_jshop_bottom').slideUp();
				jQuery('.lof_jshop_top .lof_top_2 .showless').text('<?php echo JText::_('SHOW_MORE')?>');
				jQuery('.lof_jshop_top .lof_top_2 .showless').removeClass('showless').addClass('showmore');
			});
		});	
	</script>
	<?php } ?>