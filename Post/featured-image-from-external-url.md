### Code 1
Modify `$src' value for image
```
add_filter('post_thumbnail_html', 'custom_thumbnail_tag_filter', 10, 3);
function custom_thumbnail_tag_filter($html, $postid, $thumbnailid) {
    if (!$thumbnailid) {
        $src = get_post_meta($postid, 'thumbnail_url', true);
        if ($src) {$html = "<img src='" . $src . "'>";}
    }
    return $html;
}
```
### Code 2
For References & Codes

Hook [`'acf/save_post'`](https://www.advancedcustomfields.com/resources/acfsave_post/) after ACF saves the `$_POST['acf']` data. Then check to see if the post [`has_post_thumbnail`](https://developer.wordpress.org/reference/functions/has_post_thumbnail/) and [`set_post_thumbnail`](https://codex.wordpress.org/Function_Reference/set_post_thumbnail) if it doesn't.

    function save_acf_image_to_post_thumbnail( $post_id ) {
    
        $image = get_field( 'fl_image' );
    
        if ( ! empty ( $image ) ) {
    
            if ( ! has_post_thumbnail( $post_id ) ) {
    
                $image_id = isset( $image[ 'id' ] ) ? $image[ 'id' ] : ( isset( $image[ 'ID' ] ) ? $image[ 'ID' ] : '' );
    
                if ( ! empty ( $image_id ) ) {
    
                    set_post_thumbnail( $post_id, $image_id );
                }
            }
        }
    }
    
    add_action( 'acf/save_post', 'save_acf_image_to_post_thumbnail', 20 );

This assumes the `Return Value` is an `Image Object`. 

[![](https://www.advancedcustomfields.com/wp-content/uploads/2013/02/acf-image-field-edit.jpg)](https://www.advancedcustomfields.com/resources/image/)

---

It's also possible to trick `has_post_thumbnail` and `post_thumbnail_html` to render your custom field `Image URL` when the metadata is missing.

Spoof `has_post_thumbnail`: 

    function filter_post_metadata( $value, $object_id, $meta_key, $single ) {
    
        if ( $meta_key === '_thumbnail_id' && ! $value ) {
    
            return empty ( get_field( 'fl_image' ) ) ? $value : - 1;
        }
    
        return $value;
    }
    
    add_filter( 'get_post_metadata', 'filter_post_metadata', 20, 4 );
    
Doctor `post_thumbnail_html`:

    function filter_post_thumbnail_html( $html, $post_ID, $post_thumbnail_id, $size, $attr ) {
    
    	$image = get_field( 'fl_image' );
    
    	if ( ! empty( $image ) && (empty( $post_thumbnail_id ) || $post_thumbnail_id === -1) ) :
    
    		$html = sprintf( '<img width="%s" height="auto" src="%s" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" >', "100%", esc_url( $image)  );
    
    	endif;
    
    	return $html;
    }
    
    add_filter( 'post_thumbnail_html', 'filter_post_thumbnail_html', 20, 5 );

