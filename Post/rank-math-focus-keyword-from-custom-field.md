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

```
// Rank Math Focus KeyWord Automatic
function update_focus_keywords() {
    $posts = get_posts( array(
        'posts_per_page' => -1,
        'post_type'      => 'product'
    ) );
    foreach ( $posts as $p ) {
        $ckeyword = get_field('product_name', $p->ID);
 // Checks if Rank Math keyword already exists and only updates if it doesn't have it
        $rank_math_keyword = get_post_meta( $p->ID, 'rank_math_focus_keyword', true );
	if ( ! $rank_math_keyword && $tpname = get_field('product_name') ){ 
        update_post_meta( $p->ID, 'rank_math_focus_keyword', $ckeyword );}
    }	
}
add_action( 'save_post', 'update_focus_keywords' );
```
```
// Rank Math Focus KeyWord Automatic
function update_focus_keywords() {
    $posts = get_posts( array(
        'posts_per_page' => -1,
        'post_type'      => 'post'
    ) );
    foreach ( $posts as $p ) {
        $ckeyword = get_field('tpname', $p->ID);
 // Checks if Rank Math keyword already exists and only updates if it doesn't have it
        $rank_math_keyword = get_post_meta( $p->ID, 'rank_math_focus_keyword', true );
	if ( ! $rank_math_keyword && $tpname = get_field('tpname') ){ 
        update_post_meta( $p->ID, 'rank_math_focus_keyword', $ckeyword );}
    }	
}
add_action( 'save_post', 'update_focus_keywords' );
```
