<?php  
	$result = json_decode($result);
	foreach ($result->data as $post) { ?>
		<img src="<?php echo $post->images->thumbnail->url; ?>" alt="" name="<?php echo $post->images->standard_resolution->url; ?>" class="popup" title="Instagram">
<?php 	} ?>