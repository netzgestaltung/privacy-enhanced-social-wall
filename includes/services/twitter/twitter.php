<?php
/**
 * Taken from: oAuth Twitter Feed for Developers
 * License: MIT
 * License URI: http://opensource.org/licenses/MIT
 * Author: Liam Gladdy (Storm Consultancy)
 * Author URI: https://stormconsultancy.co.uk
 */

require('StormTwitter.class.php');


/* implement getTweets */
function getTweets($count = 20, $options = false) {

  $config['key'] = trim(get_option('pesf_consumer_key'));
  $config['secret'] = trim(get_option('pesf_consumer_secret'));
  $config['token'] = trim(get_option('pesf_access_token'));
  $config['token_secret'] = trim(get_option('pesf_access_token_secret'));
  $config['screenname'] = trim(get_option('pesf_screen_name'));
  $config['cache_expire'] = intval(get_option('pesf_cache_expire'));
  if ( $config['cache_expire'] < 1 ) {
    $config['cache_expire'] = 1;
  }  
  $config['directory'] = dirname(__FILE__);
  
  $obj = new StormTwitter($config);
  $res = $obj->getTweets($count, $options);
  return $res;
}

/**
 * Store result
 */
$service_raw = getTweets(20, array('include_rts' => true, 'exclude_replies' => true));

?>
