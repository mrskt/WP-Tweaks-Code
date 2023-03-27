### To replace Blogger Post URLS to WordPress

```
function update_post_content_urls() {
    global $wpdb;
    $query = "SELECT ID, post_content FROM {$wpdb->posts} WHERE post_content LIKE '%.html%'";
    $results = $wpdb->get_results($query);
    foreach ($results as $result) {
        $new_content = preg_replace('/\\/\\d{4}\\/\\d{2}\\//', '/', $result->post_content);
        $new_content = str_replace('.html', '/', $new_content);
        $wpdb->update($wpdb->posts, array('post_content' => $new_content), array('ID' => $result->ID));
    }
}

add_action('wp_loaded', 'update_post_content_urls');
```
### To redirect Blogger Post URLS to WordPress

```
function redirect_old_urls() {
    if (is_404()) {
        $url = $_SERVER['REQUEST_URI'];
        $pattern = '/\\/\\d{4}\\/\\d{2}\\//';
        $replacement = '/';
        $new_url = preg_replace($pattern, $replacement, $url);
        $new_url = str_replace('.html', '', $new_url);
        if ($new_url !== $url) {
            wp_redirect($new_url, 301);
            exit;
        }
    }
}
add_action('template_redirect', 'redirect_old_urls');
```

for example, `/2023/01/domain-kaise-kharide.html` with this `/domain-kaise-kharide/`
