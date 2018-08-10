<?php 

class Social_Post{
  
  /**
   * construct Social_Post object
   */
  function __construct($type = '', $data = array()){
    if ( $type === 'twitter' || $type === 'facebook'  || $type === 'instagram' ) {
      $this->type = $type;
      call_user_func(array($this, $type . '_post'), $data); 
    } else {
      $this->error('Required parameter $type on line '.__LINE__." in file ".__FILE__."must be either 'twitter', 'facebook' or 'instagram'");
    }
  }
  
  function twitter_post($tweet){
    $this->created_at = strtotime($tweet->created_at);
    $this->name = $tweet->user->screen_name;
    $this->url = 'https://twitter.com/' . $this->name . '/status/' . $tweet->id_str;
    $this->text = $tweet->full_text;
    $this->img = $tweet->entities->media[0]->media_url;
  }
  
  function facebook_post($facebook){
    $this->created_at = strtotime($facebook->created_time);
    $this->name = $facebook->user->screen_name;
    $this->url = $facebook->link;
    $this->text = $facebook->message;
  }
  
  function instagram_post($instagram){
    $this->created_at = $instagram->created_time;
    $this->name = $instagram->user->screen_name;
    $this->url = $instagram->link;
    $this->text = isset($instagram->caption->text) ? $instagram->caption->text : '';
    $this->img = $instagram->images->standard_resolution->url;
    $this->likes = isset($instagram->likes->count) && $instagram->likes->count > 0 ?  $instagram->likes->count : false;
  }
}

?>
