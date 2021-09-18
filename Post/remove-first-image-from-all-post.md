```
function remove_first_image ($content) {
if (!is_page() && !is_feed() && !is_home()) {
$content = preg_replace("/<img[^>]+\>/i", "", $content, 1);
} return $content;
}
add_filter('the_content', 'remove_first_image');
```
With the introduction of Featured image in wordpress, attaching images to your post is not necessary. Most of the templates and plugins now work with Featured Images. So if you have upgraded your wordpress to newer version and want to use featured image, it will be a daunting task to set featured image for every post that were written before the upgrade.

But for that you have a plugin called Media Tools that will set featured image for every post from the first image attached to the post. Even if the first image is from external source like Flickr or Photobucket, then it will download and add them to your media gallery and set them as featured image.


But after setting featured image for every post, your attached images inside the post will remain, and with certain templates you will have same images displayed twice – once for the feature image and once for the attached image. So in that case you may want to remove the first attached image from the post. You can do it by adding these lines to your functions.php which is located in your theme folder.

Usually it is located in http://yourdomain/wp-content/themes/yourtheme/functions.php

This code will search the content and remove the first image from your posts. Here preg_replace() searches for the image tag and removes the first occurrence from the content.
