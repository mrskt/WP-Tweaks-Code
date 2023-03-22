### Get External Image URL from First Image in Post
This code uses a regular expression to find all img tags in the post content and extract their src attributes. It then gets the src attribute of the first image and uses it in the img tag.
```
function display_blogger_template_thumbnail( $html, $post_id ) {
        if ( has_post_thumbnail( $post_id ) ) {
            return $html;
        } else {
            // Get post content
            $post_content = get_post_field( 'post_content', $post_id );
            // Use regex to find first image src in post content
            preg_match_all( '/<img[^>]+src="([^">]+)"/', $post_content, $matches );
            // Check if any images were found
            if ( ! empty( $matches[1] ) ) {
                // Get first image src
                $image_src = $matches[1][0];
                // Set alt text to post title
                $alt_text = get_the_title( $post_id );
                return '<img src="' . esc_url( $image_src ) . '" alt="' . esc_attr( $alt_text ) . '">';
            }
        }
    return $html;
}
add_filter( 'post_thumbnail_html', 'display_blogger_template_thumbnail', 10, 2 );
```

