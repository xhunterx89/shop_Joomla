<script type="text/javascript">
function modFilterclearPriceFilter(){
    jQuery("#price_from").val("");
    jQuery("#price_to").val("");
    document.jshop_filters.submit();
}
</script>
<div class="jshop_filters">
<form action="<?php print $_SERVER['REQUEST_URI'];?>" method="post" name="jshop_filters">

    <?php if (is_array($filter_manufactures) && count($filter_manufactures)) {?>
    <input type="hidden" name="manufacturers[]" value="0" />
    <span class="box_manufacrurer">
        <?php print JText::_('MANUFACTURER').":"?><br/>
        <?php foreach($filter_manufactures as $v){ ?>
        <input type="checkbox" name="manufacturers[]" value="<?php print $v->id;?>" <?php if (in_array($v->id, $manufacturers)) print "checked";?> onclick="document.jshop_filters.submit();"> <?php print $v->name;?><br/>
        <?php }?>
    </span>
    <br/>
    <?php }?>
    
    <?php if (is_array($filter_categorys) && count($filter_categorys)) {?>
    <input type="hidden" name="categorys[]" value="0" />
    <span class="box_manufacrurer">
        <?php print JText::_('CATEGORY').":"?><br/>
        <?php foreach($filter_categorys as $v){ ?>
        <input type="checkbox" name="categorys[]" value="<?php print $v->id;?>" <?php if (in_array($v->id, $categorys)) print "checked";?> onclick="document.jshop_filters.submit();"> <?php print $v->name;?><br/>
        <?php }?>
    </span>
    <br/>
    <?php }?>
    
    <?php if ($show_prices){?>
    <span class="filter_price"><?php print JText::_('PRICE')?>:<br/>
        <span class="box_price_from"><?php print JText::_('FROM')?> <input type = "text" class = "inputbox" name = "price_from" id="price_from" size="7" value="<?php if ($price_from>0) print $price_from?>" /></span>
        <span class="box_price_to"><?php print JText::_('TO')?> <input type = "text" class = "inputbox" name = "price_to"  id="price_to" size="7" value="<?php if ($price_to>0) print $price_to?>" /></span>
        <?php print $jshopConfig->currency_code?>
    </span>    
    <input type="submit" class="button" value="<?php print JText::_('GO')?>">    
    <span class="clear_filter"><a href="#" onclick="modFilterclearPriceFilter();return false;"><?php print JText::_('RESET FILTER')?></a></span>
    <?php }?>
    
    <?php if (is_array($characteristic_displayfields) && count($characteristic_displayfields)){?>
    <br/>
        <div class="filter_characteristic">
        <?php foreach($characteristic_displayfields as $ch_id){?>   
            <div class="characteristic_name"><?php print $characteristic_fields[$ch_id]->name;?></div>
            <input type="hidden" name="extra_fields[<?php print $ch_id?>][]" value="0" />
            <?php if (is_array($characteristic_fieldvalues[$ch_id])){?>
                <?php foreach($characteristic_fieldvalues[$ch_id] as $val_id=>$val_name){?>
                    <input type="checkbox" name="extra_fields[<?php print $ch_id?>][]" value="<?php print $val_id;?>" <?php if (is_array($extra_fields_active[$ch_id]) && in_array($val_id, $extra_fields_active[$ch_id])) print "checked";?> onclick="document.jshop_filters.submit();" /> <?php print $val_name;?><br/>
                <?php }?>
            <?php }?>
            <br/>
        <?php }?>
        </div>
    <?php } ?>
</form>
</div>