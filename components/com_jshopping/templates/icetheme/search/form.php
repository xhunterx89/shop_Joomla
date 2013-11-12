<script type="text/javascript">var liveurl = '<?php print JURI::root()?>';</script>
<div class="jshop">
   
    
    <form action = "<?php print $this->action?>" name = "form_ad_search" method = "post" onsubmit = "return validateFormAdvancedSearch('form_ad_search')">    
    <input type="hidden" name="setsearchdata" value="1">
    <fieldset>
     <legend><?php print _JSHOP_SEARCH ?></legend>
    <table class = "jshop jshop_searchform" cellpadding = "6" cellspacing="0">
      <tr>
  	    <td class="name">
  		    <?php print _JSHOP_SEARCH_TEXT?>
	    </td>
        <td>
          <input type = "text" name = "search" class = "inputbox" style = "width:300px" />
        </td>
      </tr>
      <tr>
         <td class="name">
          <?php print _JSHOP_SEARCH_CATEGORIES ?>
        </td>
        <td> 
          <?php print $this->list_categories ?><br />
          <input type = "checkbox" name = "include_subcat" id = "include_subcat" value = "1" />
          <label for = "include_subcat"><?php print _JSHOP_SEARCH_INCLUDE_SUBCAT ?></label>
        </td>
      </tr>
      <tr>
        <td class="name">
          <?php print _JSHOP_SEARCH_MANUFACTURERS ?>    
        </td>
        <td>
          <?php print $this->list_manufacturers ?>
        </td>
      </tr>
      <tr>
        <td class="name">
          <?php print _JSHOP_SEARCH_PRICE_FROM ?>      
        </td>
        <td>
          <input type = "text" class = "inputbox" name = "price_from" id = "price_from" /> <?php print $this->config->currency_code?>
        </td>
      </tr>
      <tr>
        <td class="name">
          <?php print _JSHOP_SEARCH_PRICE_TO ?>      
        </td>
        <td>
          <input type = "text" class = "inputbox" name = "price_to" id = "price_to" /> <?php print $this->config->currency_code?>
        </td>
      </tr>
      <tr>
        <td class="name">
          <?php print _JSHOP_SEARCH_DATE_FROM ?>      
        </td>
        <td>
    	    <?php echo JHTML::_('calendar','', 'date_from', 'date_from', '%Y-%m-%d', array('class'=>'inputbox', 'size'=>'25', 'maxlength'=>'19')); ?>
        </td>
      </tr>
      <tr>
         <td class="name">
          <?php print _JSHOP_SEARCH_DATE_TO ?>      
        </td>
        <td>
    	    <?php echo JHTML::_('calendar','', 'date_to', 'date_to', '%Y-%m-%d', array('class'=>'inputbox', 'size'=>'25', 'maxlength'=>'19')); ?>
        </td>
      </tr>      
      <tr>
        <td colspan="2" id="list_characteristics"><?php print $this->characteristics?></td>
      </tr>
    </table>
     </fieldset>
     
    <div style="padding:2px;">
    <input type = "submit" class="button" value = "<?php print _JSHOP_SEARCH ?>" />  
    </div>
    </form>
    
   
</div>