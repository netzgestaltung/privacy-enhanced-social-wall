<?php 

function fetch_pinterest($config){
  try {
    $rss4 = new DOMDocument();
    $rss4->load('http://pinterest.com/' . $config['user_name'] .'/feed.rss');  //Enter your pinterest username
    return $rss4;
  } catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
  }
}

function get_pins($rss4) {
  $pins = $rss4->getElementsByTagName('item');
  $feed4 = array():
  if ( count($pins) > 0 ) {
	  foreach ( $pins as $pin ) {
		  $item = array ( 
			  'title' => $pin->getElementsByTagName('title')->item(0)->nodeValue,
			  'image' => $pin->getElementsByTagName('image')->item(0)->nodeValue,
			  'link' => $pin->getElementsByTagName('link')->item(0)->nodeValue,
			  'date' => $pin->getElementsByTagName('pubDate')->item(0)->nodeValue,
			  'description' => $pin->getElementsByTagName('description')->item(0)->nodeValue,
		  );
		  array_push($feed4, $item);
	  }
  }
  return $feed4;
}

/**
 * Set the user credentials 
 */
$service['config'] = array(
  'user_name' => trim(get_option('netgo_pi_user_name'));
);

/**
 * Create service instance
 */
$service['service'] = fetch_pinterest($service['config']);

/**
 * Store result
 */
$service['result'] = get_pins($service['service']);

?>
