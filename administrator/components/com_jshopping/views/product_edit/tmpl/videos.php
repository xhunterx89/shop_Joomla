<?php
echo $pane->startPanel(_JSHOP_PRODUCT_VIDEOS, 'product_videos');
?>
   <table><tr>
    <?php foreach ($lists['videos'] as $video){ 
        if (!$video->video_preview) $video->video_preview = "video.gif";
    ?>
        <td style="padding-right:5px;">
        <div id="video_product_<?php print $video->video_id?>">
            <div style="padding-bottom:5px;">
                <a target="_blank" href="<?php echo $jshopConfig->video_product_live_path."/".$video->video_name;?>">
                    <img width="80" src = "<?php echo $jshopConfig->video_product_live_path."/".$video->video_preview ?>" border="0" />
                </a>
            </div>
            <div class="link_delete_foto"><a href="#" onclick="if (confirm('<?php print _JSHOP_DELETE_VIDEO;?>')) deleteVideoProduct('<?php echo $video->video_id?>');return false;"><img src="components/com_jshopping/images/publish_r.png"> <?php print _JSHOP_DELETE_VIDEO;?></a></div>
        </div>
        </td>
    <?php } ?>
    </tr></table>
    <div class="col100">
    <table class="admintable" >
        <?php for ($i = 0; $i < 3; $i++){?>
        <tr>
            <td class="key" style="width:250px;"><?php print _JSHOP_UPLOAD_VIDEO?></td>
            <td><input type = "file" name = "product_video_<?php print $i;?>" /></td>
        </tr>
        <tr>
            <td class="key"><?php print _JSHOP_UPLOAD_VIDEO_IMAGE?></td>
            <td><input type = "file" name = "product_video_preview_<?php print $i;?>" /></td>
        </tr>
        <tr>
            <td style="height:5px;font-size:1px;">&nbsp;</td>
        </tr>
        <?php }?>
    </table>
    </div>
    <div class="clr"></div>
    <br/>
    <div class="helpbox">
        <div class="head"><?php echo _JSHOP_ABOUT_UPLOAD_FILES;?></div>
        <div class="text">
            <?php print sprintf(_JSHOP_SIZE_FILES_INFO, ini_get("upload_max_filesize"), ini_get("post_max_size"));?>
        </div>
    </div>
<?php
  echo $pane->endPanel();
?>