### How this works
Let’s take a look at the plugin’s code, which is very simple.
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
What this code does is that it creates a function called easy_add_thumbnail, which checks if a featured image has been set for your post, and then if a featured image hasn’t been set, it will scan through the images in your post and assign one of them to be the featured image.

Next, this code hooks that easy_add_thumbnail function to the post editing events so that the function will be called every time the post is published or displayed (for old posts).

If you don’t want to install the plugin, you can just add this code snippet to your theme’s function.php file or create your own plugin, whichever you prefer.
