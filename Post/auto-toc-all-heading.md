```

function saur8bh_add_table_of_contents( $content ) {
    if ( is_singular( array( 'post', 'page' ) ) ) {
        $table_of_contents = '<div id="table-of-contents"><p><strong>Table of Contents</strong></p><ul>';
        $count = 0;

        // Add ID's to the headings
        $content = preg_replace_callback( '/<h([2-6]).*>(.*)<\/h[2-6]>/i', function( $matches ) use ( &$count ) {
            $count++;
            return '<h' . $matches[1] . ' id="heading-' . $count . '">' . $matches[2] . '</h' . $matches[1] . '>';
        }, $content );

        // Generate table of contents
        $dom = new DOMDocument();
        libxml_use_internal_errors( true );
        $dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
        $xpath = new DOMXPath( $dom );

        $headings = $xpath->query( '//h2|//h3|//h4|//h5|//h6' );

        $current_level = 2;
        $previous_level = 2;
        $toc_counter = 0;
        $stack = array();

        foreach ( $headings as $heading ) {
            $toc_counter++;

            // Determine heading level
            $current_level = (int) $heading->tagName[1];

            // Generate anchor
            $anchor = '<a href="#' . $heading->getAttribute( 'id' ) . '">' . $heading->nodeValue . '</a>';

            // Add to table of contents
            if ( $current_level > $previous_level ) {
                $table_of_contents .= '<ul>';
                array_push( $stack, '</ul>' );
            } elseif ( $current_level < $previous_level ) {
                $table_of_contents .= str_repeat( array_pop( $stack ), $previous_level - $current_level ) . '</li>';
            } else {
                $table_of_contents .= '</li>';
            }

            $table_of_contents .= '<li>' . $anchor;

            $previous_level = $current_level;
        }

        $table_of_contents .= str_repeat( array_pop( $stack ), $previous_level - 2 ) . '</li></ul></div>';

        // Add table of contents to content
        $content = $table_of_contents . $content;
    }

    return $content;
}

add_filter( 'the_content', 'saur8bh_add_table_of_contents' );
```
