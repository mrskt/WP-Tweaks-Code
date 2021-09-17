### Meta Title
```
add_filter( 'rank_math/frontend/title', function( $title ) {
		if (has_term( 'free-wordpress-plugins', 'category' ) ) {
			return do_shortcode('[mbv name="theme-plugin-title"]');
		}
	 return $title;
	});
```
### Meta Description
```
add_filter( 'rank_math/frontend/description', function( $description ) {
		if ( is_page_template( 'templates/mds_test.php' ) ) {
	   $description="custom description";
		return $description;
		}
		return $description;
```

By Using This Codes and your own desired conditional tags you can Customize Rank Math Meta Titles & Descriptions Very Easily.
