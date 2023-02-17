```
// Block Sitemap Access
function restrict_sitemap_access() {
  if(preg_match('/sitemap.*\.xml$/i', $_SERVER['REQUEST_URI']) && !preg_match('/googlebot|bingbot|yahoo|ahrefs|semrush/i', $_SERVER['HTTP_USER_AGENT'])) {
    header('HTTP/1.1 403 Forbidden');
    exit;
  }
}
add_action('init', 'restrict_sitemap_access');
```
This code defines a function called restrict_sitemap_access, which contains the same logic as the previous code. It then adds this function as an action to the WordPress init hook, which runs on every page load.

By adding this code to your theme's functions.php file, you will prevent non-search engine users from accessing any URLs that contain "sitemap" and end in ".xml".
