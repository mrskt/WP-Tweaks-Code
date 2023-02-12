```
add_filter( 'the_content', 'insert_toc_before_first_h2' );
function insert_toc_before_first_h2( $content ) {
  // Check if the post has at least two H2 headings
  if ( preg_match_all( '/<h2/', $content, $matches ) >= 2 ) {
    $content = add_id_to_headings( $content );
    $toc = generate_toc();
    $content = preg_replace( '/<h2/', $toc . '<h2', $content, 1 );
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

  // Counter for the number of headings
  $count = 0;

  // Loop through the headings and add them to the table of contents
  foreach ( $headings[0] as $heading ) {
    $count++;
    $slug = '#heading-' . $count;
    $heading = preg_replace( '/<h2.*>(.*)<\/h2>/', '$1', $heading );
    $toc .= sprintf( '<li><a href="%s">%s</a></li>', $slug, $heading );
  }

  // Close the table of contents
  $toc .= '</ul>';
  $toc .= '</div>';

  return $toc;
}

function add_id_to_headings( $content ) {
  // Counter for the number of headings
  $count = 0;

  // Add ID's to the headings
  $content = preg_replace_callback( '/<h2.*>(.*)<\/h2>/', function( $matches ) use ( &$count ) {
    $count++;
    return '<h2 id="heading-' . $count . '">' . $matches[1] . '</h2>';
  }, $content );

  return $content;
}
```
