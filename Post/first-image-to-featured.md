You can add this code in your theme's functions.php file instead of a plugin:

```
function set_first_image_as_featured($post_id) {

    $post = get_post($post_id);



    // Check if a featured image is already set

    if (has_post_thumbnail($post_id)) {

        return;

    }



    // Get the first image from the post content

    $first_image = '';

    $matches = array();

    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $post->post_content, $matches);

    if (isset($matches['src'])) {

        $first_image = $matches['src'];

    }



    // If a first image is found, set it as the featured image

    if (!empty($first_image)) {

        $attachment_id = attachment_url_to_postid($first_image);

        if ($attachment_id) {

            set_post_thumbnail($post_id, $attachment_id);

        }

    }

}



add_action('save_post', 'set_first_image_as_featured');

```



And for existing posts, you can add this one time code and after that refresh your wp dashboard and then remove this code:


```
function set_featured_images_for_existing_posts() {

    $args = array(

        'post_type' => 'post',

        'posts_per_page' => -1, // set the number of posts per page to -1 to get all posts

    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {

        while ($query->have_posts()) {

            $query->the_post();

            set_first_image_as_featured(get_the_ID());

        }

        wp_reset_postdata();

    }

}

add_action('init', 'set_featured_images_for_existing_posts');
```
