<?php
foreach ($this->rows as $row){
    if (!$row->image) $row->image = "noimage.gif";
?>      
<div class="block_related" id="serched_product_<?php print $row->product_id;?>">
    <div class="block_related_inner">
        <div class="name"><?php echo $row->name;?> (ID:&nbsp;<?php print $row->product_id?>)</div>
        <div class="image"><a href="index.php?option=com_jshopping&controller=products&task=edit&product_id=<?php print $row->product_id?>"><img src="<?php print $this->config->image_product_live_path."/".$row->image?>" width="90" border="0" /></a></div>
        <div style="padding-top:5px;"><input type="button" value="<?php print _JSHOP_ADD;?>" onclick="add_to_list_relatad(<?php print $row->product_id;?>)"></div>
    </div>
</div>
<?php
}
?>
<div class="clr"></div>


<?php if ($this->pages>1){?>
<table align="center">
<tr>
    <td><?php print _JSHOP_PAGE?>: </td>
    <td>
    <div class="pagination">
        <div class="button2-left">
        <div class="page">
            <?php 
            for($i=1;$i<=$this->pages; $i++){
                if ($i<=20){
            ?>
            <a onclick="releted_product_search(<?php print ($i-1)*$this->limit;?>, <?php print $this->no_id?>);return false;" href="#"><?php print $i;?></a>
            <?php 
                }else{
            ?>
                    <a onclick="return false;" href="#" >...</a>
            <?php
                break;
                }
            }
            ?>            
        </div>
        </div>
    </div>
    </td>
</tr>    
</table>
<div class="clr"></div>
<?php }?>