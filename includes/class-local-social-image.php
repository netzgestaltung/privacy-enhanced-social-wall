<?php

class Local_Social_Image{
  public $local_dir = PESF_DIR . 'images/cache/';
  public $cache_url = PESF_URL . 'images/cache/';
  
  function __construct($src){
    $this->remote_src = $src;
    $this->set_file_details();
    if ( !isset($this->error) ) {
      $this->download_image();
    }
  }
  // Checks if file has allready been downloaded
  private function local_file_exists() {
    return file_exists($this->path);
  }
  // Sets name, mime_type and other details
  private function set_file_details() {
    $pathinfo = pathinfo($this->remote_src);
    $this->remote_dirname = $pathinfo['dirname'];
    $this->basename = $pathinfo['basename'];
    $this->extension = $pathinfo['extension'];
    $this->filename = $pathinfo['filename'];
    $this->path = $this->local_dir . $this->basename;
    $this->src = $this->cache_url . $this->basename;
    $this->set_file_mime_type();
  }
  // Stores the file's mime type and validates that the file is indeed an image.
  private function set_file_mime_type() {
    $image_type = exif_imagetype($this->remote_src);
    if ( !$image_type ) {
      $this->error('The file you supplied isn\'t a valid image.');
    }
    $this->file_mime_type = image_type_to_mime_type($image_type);
    $this->file_extension = image_type_to_extension($image_type, false);
  }
  
  function download_image(){
    $remote_image = file_get_contents($this->remote_src);
    if ( !$this->local_file_exists() ) {
      if ( !file_put_contents($this->path, $remote_image) ) {
        $this->error('Could not download the remote image');
        $this->src = false;
      }
    }
  }
}

?>
