<?php 
 
$pin = " "; 
for($x=0;$x<count($feed4);$x++) {  //Displays first three pins (can be changed)
    $title = str_replace(' & ', ' &amp; ', $feed4[$x]['title']);
    $link = $feed4[$x]['link'];
    $start = strpos($feed4[$x]['description'],"<img src") + 10;  //Find position of source image url from description
    $length = strpos($feed4[$x]['description'],"></a>") - 1 - $start;  //Find length of source image url from description
    $image = substr($feed4[$x]['description'],$start,$length);  //Extract source image url from description
    $date = date('l F d, Y', strtotime($feed4[$x]['date']));  //Date format can be changed
    
	$pin .= "<a href='".$link."'><img src='".$image."' border=0 alt='".$title."'></a>";

}

echo $pin;
?>