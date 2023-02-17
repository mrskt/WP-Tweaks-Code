```
// Disable Image Sizes
function disable_image_sizes() {
    $sizes = get_intermediate_image_sizes();
    // Remove all image sizes except the original "full" size
    foreach ($sizes as $size) {
        if ($size !== 'full') {
            remove_image_size($size);
        }
    }
    // Override the default image sizes
    update_option('thumbnail_size_w', 0);
    update_option('thumbnail_size_h', 0);
    update_option('thumbnail_crop', 0);

    update_option('medium_size_w', 0);
    update_option('medium_size_h', 0);
    update_option('medium_crop', 0);

    update_option('large_size_w', 0);
    update_option('large_size_h', 0);
    update_option('large_crop', 0);
}
add_action('init', 'disable_image_sizes');
```
This code works by first removing all image sizes except for the original full size using a foreach loop. Then, it overrides the default thumbnail, medium, and large image sizes by setting their width and height to 0 and disabling cropping.
