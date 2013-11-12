<?php
  echo $pane->startPanel(_JSHOP_EXTRA_FIELDS, 'product_extra_fields');
?>
   
   <div class="col100" id="extra_fields_space">
    <?php print $this->tmpl_extra_fields;?>
    </div>
    <div class="clr"></div>
<?php
   echo $pane->endPanel();
?>