```
function update_focus_keywords() {
    $posts = get_posts( array(
        'posts_per_page' => -1,
        'post_type'      => 'post' //replace post with the name of your post type
    ) );
    foreach ( $posts as $p ) {
        $ckeyword = get_field('app_name', $p->ID); // Replace app_name with Custom fields id

        update_post_meta( $p->ID, 'rank_math_focus_keyword', $ckeyword );
    }
}
add_action( 'init', 'update_focus_keywords' );
```

This Code Automatically Add Focus Keywords in Rank Math Through Custom Field's Value
