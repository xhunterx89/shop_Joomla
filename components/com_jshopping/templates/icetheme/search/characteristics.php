<?php
$characteristic_displayfields = $this->characteristic_displayfields;
$characteristic_fields = $this->characteristic_fields;
$characteristic_fieldvalues = $this->characteristic_fieldvalues;

?>
<?php if (is_array($characteristic_displayfields) && count($characteristic_displayfields)){?>
    <div class="filter_characteristic">
    <?php foreach($characteristic_displayfields as $ch_id){?>   
        <div class="characteristic_name"><?php print $characteristic_fields[$ch_id]->name;?></div>
        <input type="hidden" name="extra_fields[<?php print $ch_id?>][]" value="0" />
        <?php if (is_array($characteristic_fieldvalues[$ch_id])){?>
            <?php foreach($characteristic_fieldvalues[$ch_id] as $val_id=>$val_name){?>
                <input type="checkbox" name="extra_fields[<?php print $ch_id?>][]" value="<?php print $val_id;?>" <?php if (is_array($extra_fields_active[$ch_id]) && in_array($val_id, $extra_fields_active[$ch_id])) print "checked";?> /> <?php print $val_name;?><br/>
            <?php }?>
        <?php }?>
        <br/>
    <?php }?>
    </div>
<?php } ?>