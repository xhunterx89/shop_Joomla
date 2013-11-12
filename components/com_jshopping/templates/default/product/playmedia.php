<html>
	<head>
		<title><?php print $this->description; ?></title>
		<script type = "text/javascript" src = "<?php print JURI::root(); ?>components/com_jshopping/js/jquery/jquery-1.3.2.min.js"></script>
		<script type = "text/javascript">jQuery.noConflict();</script>
		<script type = "text/javascript" src = "<?php print JURI::root(); ?>components/com_jshopping/js/jquery/jquery.media.js"></script>
	</head>
	
	<body style = "padding: 0px; margin: 0px;">
		<a class = "video_full" id = "video" href = "<?php print $this->config->demo_product_live_path.'/'.$this->filename; ?>"></a>
		<script type="text/javascript">
            var liveurl = '<?php print JURI::root()?>';
			jQuery('#video').media( { width: <?php print $this->config->video_product_width; ?>, height: <?php print $this->config->video_product_height; ?>, autoplay: 1} );
		</script>
	</body>
</html>