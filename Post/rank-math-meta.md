### Rank Math Title Dynamically From Shortcode
```
// Rank Math Title Dynamically From Shortcode
add_filter( 'rank_math/frontend/title', function( $title ) {
		if( is_singular( $post_types = 'post' ) ) {
			return do_shortcode('[mbv name="theme-plugin-meta-title"]');
		}

	 return $title;
	});
```


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
// Rank Math Title Dynamically From Shortcode
add_filter( 'rank_math/frontend/title', function( $title ) {
	$tp_version = rwmb_get_value( 'tp_version', $post->ID );
    $tp_type = rwmb_get_value( 'tp_type', $post->ID );
if( is_singular( $post_types = 'post' ) && ! has_tag( 'themes-and-plugins-bundle' ) && $tpname = rwmb_get_value('tp_name', $post->ID ) ) {
    $string = 'Free Download '.$tpname . ' v' . $tp_version . ' ' . $tp_type;
    if (strlen($string) > 60) {
        return $tpname . ' v' . $tp_version . ' ' . 'Free Download';
    } else {
        return $string;
    }
}
if( is_singular( $post_types = 'post' ) && has_tag( 'themes-and-plugins-bundle' ) && $tpname = rwmb_get_value('tp_name', $post->ID ) ) {
    return $tpname . ' ' . $tp_version . ' Free Download';
    }
    return $title;
});
```

By Using This Codes and your own desired conditional tags you can Customize Rank Math Meta Titles & Descriptions Very Easily.
