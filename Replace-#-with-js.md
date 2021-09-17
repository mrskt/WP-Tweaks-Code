```
// Replace # With Js
add_filter('walker_nav_menu_start_el', 'wpse_226884_replace_hash', 999);
function wpse_226884_replace_hash($menu_item) {
    if (strpos($menu_item, 'href="#"') !== false) {
        $menu_item = str_replace('href="#"', 'href="javascript:void(0);"', $menu_item);
    }
    return $menu_item;
}
```
You can not save menu item with javascript:void(0); because WordPress filter the URL using function esc_url() thus removing bad values. And it all happens in Nav Walker class. So you need to alter the URL when WordPress done with filtering and returning final safe HTML.

You can use filter walker_nav_menu_start_el if your theme does not have custom nav menu walker class OR does have this filter in walker class.
