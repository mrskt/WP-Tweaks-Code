### Add this code in your first site from where you get data

This code is assuming you're getting data from tp_name custom field

```
add_action( 'rest_api_init', function() {
  register_rest_route( 'myplugin/v1', '/tp_name/(?P<id>\d+)', array(
    'methods' => 'GET',
    'callback' => 'get_tp_name',
  ) );
} );

function get_tp_name( $data ) {
  $post_id = $data['id'];
  $tp_name = get_post_meta( $post_id, 'tp_name', true ); // Replace tp_name with your custom field name
  return $tp_name;
}
```
### Add this code in your second site where you want to display data

```
function gplastra_tp_name_shortcode( $atts ) {
  $atts = shortcode_atts( array(
    'id' => get_the_ID(),
  ), $atts );
  $api_url = 'https://www.example.com/wp-json/myplugin/v1/tp_name/' . $atts['id']; // replace example with the first site domain
  $response = wp_remote_get( $api_url );
  if ( is_wp_error( $response ) ) {
    return ''; // insert value that will show if get error response
  }
  $tp_name = json_decode( wp_remote_retrieve_body( $response ) );
  if ( empty( $tp_name ) ) {
    return ''; insert value that will show if tp_name gives empty value
  }
  return $tp_name;
}
add_shortcode( 'gplastra_tp_name', 'gplastra_tp_name_shortcode' );
```

This modified shortcode will retrieve the "tp_name" custom field value for the post with the ID specified in the shortcode parameter (e.g. `[gplastra_tp_name id="451"]`). If no post ID is specified, it will retrieve the "tp_name" value for the current post being displayed on your mrskt.com site.

Note that both the API endpoint and the shortcode should handle errors and edge cases appropriately. For example, if the specified post ID does not exist on the gplastra.com site, the shortcode should display an error message or fallback value instead of an empty string. Similarly, if the API endpoint is not accessible or returns an error, the shortcode should handle it gracefully instead of crashing or displaying an error message to the user.
