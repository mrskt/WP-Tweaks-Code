### PHP function to add redirect page link to specific domains

```
// Redirect Links
function add_redirect_links($content) {
    $redirect_domains = array("mediafire.com", "mega.nz", "pling.com", "github.com", "drive.google.com");
    $redirect_base_url = "https://www.mrskt.com/redirect-link?goto=";
    $domains_pattern = implode("|", $redirect_domains);
    $pattern = '/href=[\'"]?(https?:\/\/(www\.)?('.$domains_pattern.')[^\'" >]+)[\'"]?/';
    $replace = 'href="'.$redirect_base_url.'$1"';
    $content = preg_replace($pattern, $replace, $content);
    return $content;
}
add_filter('the_content', 'add_redirect_links');
```
