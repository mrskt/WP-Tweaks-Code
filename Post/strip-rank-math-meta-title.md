```
add_filter( 'rank_math/frontend/title', function( $title ) {
	$title = substr($title, 0, 60);
	return $title;
});
```
