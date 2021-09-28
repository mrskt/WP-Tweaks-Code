### Time Ago Function
```
function my_post_time_ago_function() {
return sprintf( esc_html__( '%s ago', 'textdomain' ), human_time_diff(get_the_modified_time ( 'U' ), current_time( 'timestamp' ) ) );
}
```

To Show in Meta Box Views
```
{{ mb.my_post_time_ago_function() }}
```
