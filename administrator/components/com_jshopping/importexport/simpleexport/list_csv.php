<form action = "index.php?option=com_jshopping&controller=importexport" method = "post" name = "adminForm">
<input type = "hidden" name = "task" value = "" />
<input type = "hidden" name = "hidemainmenu" value = "0" />
<input type = "hidden" name = "boxchecked" value = "0" />
<input type = "hidden" name = "ie_id" value = "<?php print $ie_id;?>" />

<?php print _JSHOP_FILE_NAME?>: <input type="text" name="params[filename]" value="<?php print $ie_params['filename']?>" size="45"><br/>
<br/>
<table class = "adminlist">
<thead>
  <tr>
    <th class = "title" width  = "10">
      #
    </th>    
    <th align = "left">
      <?php echo _JSHOP_NAME;?>
    </th>
    <th width="150">
        <?php echo _JSHOP_DATE;?>
    </th>    
    <th width="50">
        <?php echo _JSHOP_DELETE;?>
    </th>
  </tr>
</thead>
<?php
$i = 0;
foreach($files as $row){
?>
<tr class = "row<?php echo $i % 2;?>">
    <td>
        <?php echo $i+1;?>
    </td>    
    <td>
        <a target="_blank" href = "<?php print $jshopConfig->importexport_live_path.$_importexport->get('alias')."/".$row; ?>"><?php echo $row;?></a>
    </td>
    <td>
        <?php print date("d.m.Y H:i:s", filemtime($jshopConfig->importexport_path.$_importexport->get('alias')."/".$row)); ?>
    </td>    
    <td align="center">
        <a href='index.php?option=com_jshopping&controller=importexport&task=filedelete&ie_id=<?php print $ie_id;?>&file=<?php print $row?>' onclick="return confirm('<?php print _JSHOP_DELETE?>');"><img src='components/com_jshopping/images/publish_r.png'></a>
    </td>
</tr>
<?php
$i++;  
}
?>
</table>


</form>