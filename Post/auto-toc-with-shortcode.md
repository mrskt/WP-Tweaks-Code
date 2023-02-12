```
add_filter( 'the_content', 'insert_toc_before_first_h2' );
add_shortcode( 'table_of_contents', 'generate_toc' );

function insert_toc_before_first_h2( $content ) {
  // Check if the post has at least two H2 headings
  if ( preg_match_all( '/<h2/', $content, $matches ) >= 2 ) {
    $content = preg_replace( '/<h2/', '[table_of_contents]<h2', $content, 1 );
  }

  return $content;
}

function generate_toc() {
  // Initialize the table of contents
  $toc = '<div id="table-of-contents">';
  $toc .= '<p><strong>Table of Contents</strong></p>';
  $toc .= '<ul>';

  // Get the headings in the post
  global $post;
  preg_match_all( '/<h2.*>(.*)<\/h2>/', $post->post_content, $headings );

  // Loop through the headings and add them to the table of contents
  foreach ( $headings[0] as $heading ) {
    $slug = sanitize_title( $heading );
    $heading = preg_replace( '/<h2.*>(.*)<\/h2>/', '$1', $heading );
    $toc .= sprintf( '<li><a href="#%s">%s</a></li>', $slug, $heading );
    $post->post_content = preg_replace( '/<h2(.*)>(.*)<\/h2>/', '<h2$1 id="' . $slug . '">$2</h2>', $post->post_content );
  }

  // Close the table of contents
  $toc .= '</ul>';
  $toc .= '</div>';

  return $toc;
}
```

In this code, the `insert_toc_before_first_h2()` function first checks if the post has at least two `<h2>` headings. If it does, it replaces the first `<h2>` heading with a call to the `[table_of_contents]` shortcode. The `generate_toc()` function is called by the shortcode and generates the table of contents by looping through all of the `<h2>` headings in the post and adding them to the table. The headings are also given unique IDs based on their text, which are used as the anchors for the table of contents links.
