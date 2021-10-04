```
function change_image_url( $image, $attachment_id, $size, $icon ){
    $otherthumb = str_replace("https://", "https://cdn.statically.io/img/", $image[0]);
    return $otherthumb;
}
add_filter( 'wp_get_attachment_image_src', 'change_image_url', 10, 4 );
```
