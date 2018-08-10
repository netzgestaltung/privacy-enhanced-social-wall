<?php

function fetch_youtube($config){
  preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $config['url'], $matches);
  return $matches[1];
}

/**
 * Set the user credentials 
 */ 
$service['config'] = array(
  'url' => trim(get_option('netgo_youtube_video_url')),
);

/**
 * Create service instance
 */
$service['service'] = fetch_youtube($service['config']);

/**
 * Store result
 */
$service['result'] = '<iframe id="ytplayer" type="text/html" src="https://www.youtube.com/embed/' . $service['service'] . '?rel=0&showinfo=0&color=white&iv_load_policy=3" frameborder="0" allowfullscreen></iframe>'

