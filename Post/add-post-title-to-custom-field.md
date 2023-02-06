Q: how to automatically add post title in custom field "tp_type" if its empty, after saving post in wordpress

You can use the `save_post` action hook to automatically fill the custom field "tp_type" with the post title if it's empty. Here's a code snippet that you can add to your theme's functions.php file to accomplish this:
```
function tp_fill_custom_field_with_post_title( $post_id ) {
    // Check if the custom field is empty
    $tp_type = get_post_meta( $post_id, 'tp_type', true );
    if ( empty( $tp_type ) ) {
        // Get the post title
        $post_title = get_the_title( $post_id );
        // Update the custom field with the post title
        update_post_meta( $post_id, 'tp_type', $post_title );
    }
}
add_action( 'save_post', 'tp_fill_custom_field_with_post_title' );
```
This code will run every time a post is saved, and will fill the custom field "tp_type" with the post title if it's empty.
