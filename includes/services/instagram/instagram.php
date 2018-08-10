<?php
function fetch_instagram($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 20);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
} 
/**
 * Set the user credentials 
 */
$service['config'] = array(
  'user_id' => trim(get_option('netgo_ins_user_id')),
  'access_token' => trim(get_option('netgo_facebook_secret_key')),
);

/**
 * Create service instance
 * Attention, no service instance for instagram
 */
$service['service'] = null:

/**
 * Store result
 */
$service['result'] = fetch_instagram('https://api.instagram.com/v1/users/' . $service['config']['user_id'] . '/media/recent/?access_token=' . $service['config']['access_token']);
