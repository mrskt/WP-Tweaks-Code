```
function disable_rss_feed() {
    wp_die( __( 'No feed available. Please visit our <a href="'. esc_url( home_url( '/' ) ) .'">Homepage</a>.' ) );
}
add_action('do_feed', 'disable_rss_feed', 1);
add_action('do_feed_rdf', 'disable_rss_feed', 1);
add_action('do_feed_rss', 'disable_rss_feed', 1);
add_action('do_feed_rss2', 'disable_rss_feed', 1);
add_action('do_feed_atom', 'disable_rss_feed', 1);
add_action('do_feed_rss2_comments', 'disable_rss_feed', 1);
add_action('do_feed_atom_comments', 'disable_rss_feed', 1);
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
```
