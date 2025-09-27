<?php
	foreach ($_SESSION['storyimagesOthers'] as $key => $value) {
?>
<div class="image_uploaded"  id="remove_gallery_<?php echo $key;?>">
	<div class="crossbutton" onclick="remove_file_uploaded_other('<?php echo $key;?>')">
		<i class="fa fa-trash" title="Remove Image"></i>
	</div>
	<img src="<?php echo $value;?>">
	<div class="upload_image_name" title="<?php echo $value;?>">
		<?php echo $value;?>
	</div>		
</div>
<?php
	}
?>