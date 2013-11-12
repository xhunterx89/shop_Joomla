<?php
	$show_categories_dropdown = $params->get("enable_categories",  0);
	$categories = buildTreeCategory(1);		
	$first = JHTML::_('select.option', 0, _JSHOP_SEARCH_ALL_CATEGORIES, 'category_id', 'name' );
	array_unshift($categories, $first);
	$search_cate = isset($_REQUEST["category_id"])?$_REQUEST["category_id"]: 0;
	$include_subcat = isset($_REQUEST["include_subcat"])?$_REQUEST["include_subcat"]: 0;
	$checked = !empty($include_subcat)?' checked="checked"':"";
	$list_categories = JHTML::_('select.genericlist', $categories, 'category_id', 'class = "inputbox" size = "1" ', 'category_id', 'name',$search_cate );
?>
<script type = "text/javascript">
function isEmptyValue(value){
    var pattern = /\S/;
    return ret = (pattern.test(value)) ? (true) : (false);
}
</script>
<form name = "searchForm" method = "post" action="<?php print SEFLink("index.php?option=com_jshopping&controller=search&task=result", 1);?>" onsubmit = "return isEmptyValue(jQuery('#jshop_search').val())">
<input type="hidden" name="setsearchdata" value="1">
<?php if(!$show_categories_dropdown): ?>
	<input type = "hidden" name="category_id" value = "<?php print $category_id?>" />
<?php endif; ?>
<input type = "text" class = "inputbox" name = "search" id = "jshop_search" size="30" onfocus="if (this.value=='<?php echo JText::_("SEARCH_TERM");?>') this.value='';" onblur="if (this.value=='') this.value='<?php echo JText::_("SEARCH_TERM");?>';" value="<?php echo JText::_("SEARCH_TERM");?>"  />



<?php if($show_categories_dropdown): ?>

	<span><?php echo JText::_("Categories"); ?></span>
	<?php echo $list_categories; ?>
	<input type="checkbox" value="1" id="include_subcat" name="include_subcat"<?php echo $checked; ?> checked="checked" disabled="disabled" >
	<label for="include_subcat"><?php echo JText::_("Include_subcategories"); ?></label>
<?php endif; ?>
<input class = "button" type = "submit" value = "<?php print _JSHOP_GO?>" />

<?php if ($adv_search) {?>
<a href="<?php print $adv_search_link?>" id="jshopping_adv_search"><?php print _JSHOP_ADVANCED_SEARCH?></a>
<?php } ?>
</form>