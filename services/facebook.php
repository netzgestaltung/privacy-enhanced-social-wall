<?php 
try {
	$pagefeed = $facebook->api("/" . $pageid . "/posts?fields=attachments,id,object_id,message,description,full_picture,source,created_time");?> 
	<?php
	if(!empty($pagefeed)){ $flag=1; ?>
	<ul id="fbfeed" class="fb-feed-grid-view">
		<?php foreach($pagefeed['data'] as $post):	?>
		<li  id="<?php echo $flag; ?><?php echo ($flag%4); ?>">
			<div class="product_box">
				<div class="img_box">
					<?php if($post['full_picture'] != '') { ?>
					<a target="_blank" href="<?php echo $post['attachments']['data'][0]['url']; ?>"></a>
					<?php } ?>
				</div>
				<div class="content"> 
					<div class="contant_box1"> 
						<?php echo  substr($post['message'], 0, 100); ?>
					</div>
					<div class="date_box"><?php echo date("d/M/Y H:i", (strtotime($post['created_time']))) ?>  </div>
				</div>
			</div>
		</li>
		<?php $flag++; endforeach;  ?>
	</ul> 
	<div style="clear:both;"></div><?php  
	}else{
		echo '<div class="nopost"><h3>No Post Found!</h3></div>';
	}   
}catch(Exception $e) {
	echo '<b>Message: </b> Invalid "Facebook App Id" ,"Facebook Secret Key" or "Facebook Page Id"';
} 
?>
