```
//featured image with custom field image for blogger-template post type
function display_blogger_template_thumbnail( $html, $post_id ) {
    if ( get_post_type( $post_id ) == 'blogger-template' ) {
        if ( has_post_thumbnail( $post_id ) ) {
            return $html;
        } else {
            $bt_image_url = rwmb_get_value( 'bt_image_url', $post_id );
			$alt_text = 'Download ' . rwmb_get_value( 'bt_name', $post->ID ) . ' Premium Blogger Template';
            if ( ! empty( $bt_image_url ) ) {
                return '<img src="' . esc_url( $bt_image_url ) . '" alt="' . esc_attr( $alt_text ) . '">';
            }
        }
    }
    return $html;
}
add_filter( 'post_thumbnail_html', 'display_blogger_template_thumbnail', 10, 2 );
```
