```
// List Similar Post Shortcode
function saur8bh_similar_posts_shortcode($atts) {

  // Parse the shortcode attributes
  $atts = shortcode_atts(array(
    'tag' => '',
    'cat' => '',
    'tc' => '',
    'max' => '5'
  ), $atts);

  // Build the query arguments
  $args = array(
    'post_type' => 'any',
    'post_status' => 'publish',
    'orderby' => 'modified',
    'order' => 'DESC',
    'posts_per_page' => $atts['max']
  );

  // Add the taxonomy query, if specified
  if (!empty($atts['tag'])) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'post_tag',
        'field' => 'slug',
        'terms' => $atts['tag']
      )
    );
  }
  else if (!empty($atts['cat'])) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'category',
        'field' => 'slug',
        'terms' => $atts['cat']
      )
    );
  }

  // Add the title contains search, if specified
  if (!empty($atts['tc'])) {
    $args['s'] = $atts['tc'];
  }

  // Execute the query
  $query = new WP_Query($args);

  // Build the output HTML
  $output = '<div class="saur8bh-sp">';
  $output .= '<p><strong>Similar Posts:</strong></p>';
  $output .= '<ul>';
  while ($query->have_posts()) {
    $query->the_post();
    $output .= '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
  }
  $output .= '</ul>';
  $output .= '</div>';

  // Restore the original query
  wp_reset_postdata();

  // Return the output
  return $output;

}

// Register the shortcode
add_shortcode('saur8bh-sp', 'saur8bh_similar_posts_shortcode');
```
You can then use the shortcode in your posts or pages like this:

To show posts by tag name: `[saur8bh-sp tag="example-tag-name"]`
To show posts by category name: `[saur8bh-sp cat="example-category-name"]`
To show posts which title contains specific words: `[saur8bh-sp tc="example word"]`
You can also change the max attribute to show more or fewer posts (default is 5).
