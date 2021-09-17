```
// Custom Fields to title
add_filter('the_title', function ($title) {
if( $tpname = get_field('tpname') ) {
return do_shortcode('[mbv name="theme-plugin-title"]');
}
return $title;
});
```
