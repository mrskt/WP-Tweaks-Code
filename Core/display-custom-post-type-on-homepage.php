add_action('pre_get_posts', 'add_my_custom_post_type');

/**
 * @param WP_Query $query
 * @return WP_Query
 */
function add_my_custom_post_type($query) {
    if( ! is_page()
       and
        empty($query->query['post_type'])
        or $query->query['post_type'] === 'post'
        and !is_admin()
    ){
       $query->set('post_type', array('post', 'tutorial', 'review', 'collection'));
    }
}
