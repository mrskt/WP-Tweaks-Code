If you want display an image that is inserted into your content (a hotlinked image, for example), you must use a function like this (source):

add in functions.php:
```
function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];

  if(empty($first_img)){ //Defines a default image
    $first_img = "/images/default.jpg";
  }
  return $first_img;
}
```
Then place ```<?php echo catch_that_image() ?>``` where you want display the image.

Note: a hotlinked image just placed in your content can't be set as Featured Image, a bultin WordPress'feature.
