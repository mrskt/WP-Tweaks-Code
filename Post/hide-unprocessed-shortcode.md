```
add_filter('the_content', 'hide_unprocessed_shortcode');
function hide_unprocessed_shortcode($content) {
    $pattern = get_shortcode_regex(['mrskt-ad']);
    return preg_replace_callback("/$pattern/s", function ($matches) {
        if ($matches[2] == 'mrskt-ad') {
            $shortcode_output = do_shortcode($matches[0]);
            if ($shortcode_output == $matches[0]) {
                return '';
            }
        }
        return $matches[0];
    }, $content);
}
```
