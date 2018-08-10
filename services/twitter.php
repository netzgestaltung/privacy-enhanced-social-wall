<?php 

/*Here you will get all info from user timeline */
$valid_data = json_decode($response); 
$twit = "<ul class='tw-f'>";
foreach ($valid_data as $key=>$value) {
	$twit .= "<li>";
	$twit .=  "<div class='tw-desc'>".$value->text."<span class='tw-date'>".$value->created_at."</span></div>";
	$twit .=  "</li>";
}
$twit .=  "</ul>";
echo $twit;
?>
