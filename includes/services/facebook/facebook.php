<?php
function fetch_facebook($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 20);
	$result = curl_exec($ch);
	curl_close($ch);
	return json_decode($result, true);
}


/**
 * Set the user credentials 
 */ 
$service_data['config'] = array(
  'access_token' => trim(get_option('pesf_facebook_app_id')) . '|' . trim(get_option('pesf_facebook_secret_key')),
  'appId' => trim(get_option('pesf_facebook_app_id')),
  'secret' => trim(get_option('pesf_facebook_secret_key')),
  'fileUpload' => true,
);

/**
 * Additional Data
 */ 
$service_data['pageid'] = trim(get_option('pesf_facebook_page_id'));
$service_data['url'] = 'https://graph.facebook.com/' . $service_data['pageid'] . '/posts?access_token=' . $service_data['config']['access_token'];

/**
 * Create service instance
 */
// $service_data['service'] = new Facebook($service_data['config']);

$service_data['service'] = null;

/**
 * Store result
 * Facebook only allows posts from one page or user
 * @see https://stackoverflow.com/questions/36736457/facebook-api-to-search-public-posts-containing-a-particular-hashtag
 */
$service_data['result'] = fetch_facebook($service_data['url']);
// $service_data['result'] = $service_data['service']->api('/' . $service_data['pageid'] . '/posts?fields=attachments,id,object_id,message,description,full_picture,source,created_time');

