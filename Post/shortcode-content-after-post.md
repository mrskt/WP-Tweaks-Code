```
// Content After Post Content
function my_shortcode_after_post_content($content) {
    if (is_singular('post')) {
    $my_shortcode = do_shortcode('[mbv name="after-post"]');
    // Append the shortcode output to the post content
    $content .= $my_shortcode;
	}
	return $content;
}
add_filter('the_content', 'my_shortcode_after_post_content');

```
