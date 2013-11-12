<?php if ($this->params->get('show_page_title') && $this->params->get('page_title')) {?>    
<div class="componentheading<?php print $this->params->get('pageclass_sfx');?>"><?php print $this->params->get('page_title')?></div>
<?php }?>
<?php if (count($this->rows)){?>
<div class="jshop_list_manufacturer">
<table class = "jshop">
    <?php foreach($this->rows as $k=>$row){?>
        <?php if ($k%$this->count_to_row==0) print "<tr>";?>
        <td class = "jshop_categ" width = "<?php print (100/$this->count_to_row)?>%">
          <table class = "vendor">
             <tr>
               <td class="image">
                    <a class = "product_link" href = "<?php print $row->link?>">
                        <img class = "jshop_img" src = "<?php print $row->logo;?>" alt="<?php print htmlspecialchars($row->shop_name);?>" />
                    </a>                    
               </td>
               <td>
                   <a class = "product_link" href = "<?php print $row->link?>"><?php print $row->shop_name?></a><br />                   
               </td>
             </tr>
           </table>
        </td>    
        <?php if ($k%$this->count_to_row==$this->count_to_row-1) print "</tr>";?>
	 <?php } ?>
     <?php if ($k%$this->count_to_row!=$this->count_to_row-1) print "</tr>";?>
</table>
</div>
<table align="center" >
    <tr>
        <td style = "text-align:center">
            <div class="pagination"><?php print $this->navigation_products?></div>
        </td>
    </tr>
</table>
<?php } ?>