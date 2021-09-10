```
if ( function_exists( 'add_theme_support' ) ) {

    add_theme_support( 'post-thumbnails' ); // This should be in your theme. But we add this here because this way we can have featured images before swicth to a theme that supports them.

    function easy_add_thumbnail($post) {

        $already_has_thumb = has_post_thumbnail();
        $post_type = get_post_type( $post->ID );
        $exclude_types = array('');
        $exclude_types = apply_filters( 'eat_exclude_types', $exclude_types );

        // do nothing if the post has already a featured image set
        if ( $already_has_thumb ) {
            return;
        }

        // do the job if the post is not from an excluded type
        if ( ! in_array( $post_type, $exclude_types ) ) {
            // get first attached image
            $attached_image = get_children( "order=ASC&post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );

            if ( $attached_image ) {
                $attachment_values = array_values( $attached_image );
                // add attachment ID
                add_post_meta( $post->ID, '_thumbnail_id', $attachment_values[0]->ID, true );
            }
        }
    }

    // set featured image before post is displayed (for old posts)
    add_action('the_post', 'easy_add_thumbnail');

    // hooks added to set the thumbnail when publishing too
    add_action('new_to_publish', 'easy_add_thumbnail');
    add_action('draft_to_publish', 'easy_add_thumbnail');
    add_action('pending_to_publish', 'easy_add_thumbnail');
    add_action('future_to_publish', 'easy_add_thumbnail');
}
```
