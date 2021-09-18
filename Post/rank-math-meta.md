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

### Full Customized Meta Title
```
// Rank Math Title Dynamically
add_filter( 'rank_math/frontend/title', function( $title ) {
		if( is_singular( $post_types = 'post' ) && $tpname = get_field('tpname') && has_term( 'free-wp', 'category' ) && !has_tag( $tag = 'bundle-themes-and-plugins') ) {
			return do_shortcode('[mbv name="theme-plugin-title"]');
		}
			if( is_singular( $post_types = 'post' ) && !$tpname = get_field('tpname') && has_term( 'free-wp', 'category' ) && !has_tag( $tag = 'bundle-themes-and-plugins') ) {
			return do_shortcode('[mbv name="noacf-pm-title"]');
		}
			if( is_singular( $post_types = 'post' ) &&  has_term( 'free-blogger-templates', 'category' ) && !has_tag( $tag = 'bundle-blogger-templates') ) {
			return do_shortcode('[mbv name="bt-meta-title"]');
		}
	 return $title;
	});
```

By Using This Codes and your own desired conditional tags you can Customize Rank Math Meta Titles & Descriptions Very Easily.
