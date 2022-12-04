## Replace post title with shorcode's content

### Example 1
```
// Custom Fields to title
add_filter('the_title', function ($title) {
if( in_the_loop() && !has_tag( $tag = 'bundle-themes-and-plugins')){
return do_shortcode('[mbv name="theme-plugin-title"]');
}
return $title;
});
```
### Example 2
```
// Custom Fields to title
add_filter('the_title', function ($title) {
if( in_the_loop()){
return do_shortcode('[mbv name="theme-plugin-title"]');
}
return $title;
});
```
### Example 3 (Excluding Pages)

```
// Custom Fields to title
add_filter('the_title', function ($title) {
if( in_the_loop() && !is_singular( $post_types = 'page' )){
return do_shortcode('[mbv name="theme-plugin-title"]');
}
return $title;
});
```
