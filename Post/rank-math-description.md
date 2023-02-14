```
// Rank Math Meta Description Dynamically
add_filter( 'rank_math/frontend/description', function( $description ) {
	if( is_singular( $post_types = 'post' ) && $tpname = rwmb_get_value('tp_name', $post->ID ) ) {
	$tp_version = rwmb_get_value( 'tp_version', $post->ID );
    $tp_type = rwmb_get_value( 'tp_type', $post->ID );
    // Calculate the maximum length of $description
    $max_length = 160 - strlen($tpname . ' Nulled Download Free Latest v' . $tp_version . ' - ');
    // Check if the length of $description is greater than $max_length
    if (strlen($description) > $max_length) {
        // Limit the length of the $description value to $max_length
        $description = substr($description, 0, $max_length - 3) . '...';
    }
    // Return the string with the limited $description value
    return $tpname . ' Nulled Download Free Latest v' . $tp_version . ' - ' . $description;
		}
	$description = substr($description, 0, 160);
		return $description;
});  
```
