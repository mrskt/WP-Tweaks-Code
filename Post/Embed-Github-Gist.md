```
function mrskt_add_gist_github_shortcode( $atts, $content = NULL ) {
   extract( shortcode_atts( array(
'id' => '',
'file' => '',
), $atts ) );
   if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
return sprintf('<amp-gist data-gistid="%s" %s layout="fixed-height" height="250"></amp-gist>',
$id ? $id : trim(esc_attr($content)),
$file ? 'data-file="' . esc_attr( $file ) . '"' : ''
);
} else {
   return sprintf('<script src="https://gist.github.com/%s.js%s"></script>',
   $id ? $id : trim(esc_attr($content)) ,
   $file ? '?file=' . esc_attr( $file ) : ''
   );
   }
}
add_shortcode('mgit', 'mrskt_add_gist_github_shortcode');
```

First:
```
[mgit]89ad3e32630de777dd0d283ae41e80z[/mgit]
```
Second:
```
[gist id="89ad3e32630de777dd0d2183ae41e80z" /]
```
