### Automatically Add Terms from other Taxonomy
Here is the example of Genre to Tag
```
add_action('save_post','getags');
function getags($post_id) { 
  $genres = get_the_terms( $post_id, 'genre');
  $taxonomy = 'post_tag'; 
  foreach($genres as $genre) {
    $terms = 'Android '.$genre->name.' Download'; 
    wp_set_object_terms( $post_id, $terms, $taxonomy, true );
  } 
}
```
### Automatically Add Terms from Custom Fields

Here is the example of `app_name` Custom field's id's value to Tags
```
add_action('save_post','cftags');
function cftags($post_id) { 
  $tvalue = get_field( "app_name" );
  $taxonomy = 'post_tag'; 
    $terms = $tvalue; 
    wp_set_object_terms( $post_id, $terms, $taxonomy, true );
 
}
```
