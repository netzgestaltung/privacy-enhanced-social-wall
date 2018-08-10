<?php

function pesf_dir_url($file){
  $path = str_replace('\\', '/', $file);
  $path = str_replace($_SERVER['DOCUMENT_ROOT'], '', $path);
  $path = '//' . $_SERVER['HTTP_HOST'] . '/' . $path;
  
  return dirname($path);
}
define('PESF_DIR', __DIR__);
define('PESF_URL', pesf_dir_url(__FILE__));
define('PESF_INCLUDE_DIR', __DIR__ . 'includes/');
define('PESF_INCLUDE_URL', pesf_dir_url(__FILE__) . 'includes/'); 

// Options set
$pesf_options = array(
  'services' => array(
    'facebook' => false,
    'twitter' => true, // only one ready yet
    'instagram' => false,
    'pinterest' => false,
    'youtube' => false,
  ),
);

// Load necessary classes
require_once PESF_INCLUDE_DIR . 'class-social-post.php';
require_once PESF_INCLUDE_DIR . 'class-local-social-image.php';

// Filter content for Twitter usernames and hashtags
// @see: https://stackoverflow.com/a/37853639/1165121
// needs additions to work with facebook and instagram
function pesf_social_content($content){
  $content = apply_filters('the_content', $content);
  
  // Usernames searching for "@"
  $pattern_at = '/(?<!=|\b|&)@([a-z0-9_]+)/i';
  $replace_at = '<a href="http://www.twitter.com/$1" target="_blank" rel="nofollow">@$1</a>';
  $content = preg_replace($pattern_at, $replace_at, $content);
  
  // Hashtags searching for "#"
  $pattern_hash = '/(?<!=|\b|&)#([a-z0-9_]+)/i';
  $replace_hash = '<a href="http://twitter.com/hashtag/$1" target="_blank" rel="nofollow">#$1</a>';
  $content = preg_replace($pattern_hash, $replace_hash, $content);
  
  return $content;
}

function get_pesf_wall(){
  $wall = '';
  $services = array(
    'results' => array(),
    'facebook' => array(
      'shortname' => 'fb',
      'slug' => 'facebook',
      'label' => 'Facebook',
    ),
    'twitter' => array(
      'shortname' => 'tw',
      'slug' => 'twitter',
      'label' => 'Twitter',
    ),
    'instagram' => array(
      'shortname' => 'ins',
      'slug' => 'instagram',
      'label' => 'Instagram',
    ),
    'pinterest' => array(
      'shortname' => 'pi',
      'slug' => 'pinterest',
      'label' => 'Pinterest',
    ),
    'youtube' => array(
      'shortname' => 'yt',
      'slug' => 'youtube',
      'label' => 'Youtube',
    ),
  );  
  $eol = "\r\n";
  
  foreach ( $services as $service_name => $service_data ) {
    if ( $pesf_options['services'][$service_data['slug']] ) {
      include PESF_INCLUDE_DIR . '/services/' . $service_data['slug'] . '/' . $service_data['slug'] . '.php';

      foreach ( $service_raw as $service_post ) {
        $services['results'][] = new Social_Post($service_name, $service_post);
      }
    }
  }
  if ( !empty($services['results']) ) {
    $wall .= '<div class="social-wall">';
    foreach ( $services['results'] as $service_result ) {
      $wall .= '<div class="wall-item ' . $service_result->type . '">' . $eol;
      if ( isset($service_result->img) ) {
        $wall_image = new Local_Social_Image($service_result->img);
        if ( $wall_image->src ) {
          $wall .= '<a class="wall-image" href="' . $service_result->url . '" target="_blank"><img src="' . $wall_image->src . '" alt="" /></a>' . $eol;
        }
      }
      if ( isset($service_result->name) ) {
        $wall .= '<h3 class="wall-title">' . $service_result->name . '</h3>' . $eol;
      }
      if ( isset($service_result->text) ) {
        $wall .= '<div class="wall-content">' .  pesf_social_content($service_result->text) . '</div>' . $eol;
      }
      $wall .= '</div>' . $eol;
    }
    $wall .= '</div>' . $eol;
  }
  // return $wall;
  return $wall;
}
function pesf_wall(){
  echo get_pesf_wall();
}

?>
