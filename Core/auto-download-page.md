To create a dynamic download page for each post that has the tp_version and tp_dl1 custom fields, you can use WordPress's add_rewrite_rule function to create a custom rewrite rule that maps the /download/ endpoint to a custom template file that you will create in your theme.

Here are the steps to implement this:

Create a new template file in your theme called download.php. This file will be used to display the custom content for each post.

Add the following code to your theme's functions.php file to create the custom rewrite rule:

```
function custom_rewrite_rule() {
    add_rewrite_rule('^([^/]+)/download/?', 'index.php?name=$matches[1]&download=1', 'top');
}
add_action('init', 'custom_rewrite_rule', 10, 0);

```

This code creates a rewrite rule that captures any URL that ends with /download/ and sets the download query parameter to 1.

Add the following code to your download.php template file to display the custom content for each post:

```
<?php
/*
Template Name: Download
*/

// Get the post ID
$post_id = get_queried_object_id();

// Check if the post has the tp_version and tp_dl1 custom fields
if (get_post_meta($post_id, 'tp_version', true) && get_post_meta($post_id, 'tp_dl1', true)) {
    // Get the custom field values
    $tp_version = get_post_meta($post_id, 'tp_version', true);
    $tp_dl1 = get_post_meta($post_id, 'tp_dl1', true);
    
    // Display the custom content
    echo '<h2>' . get_the_title() . '</h2>';
    echo '<p>TP Version: ' . $tp_version . '</p>';
    echo '<p>TP DL1: ' . $tp_dl1 . '</p>';
    the_content();
} else {
    // If the post doesn't have the custom fields, redirect to the post URL
    wp_redirect(get_permalink($post_id));
    exit;
}
?>
```
This code checks if the current post has the tp_version and tp_dl1 custom fields. If it does, it displays the custom content along with the custom field values. If it doesn't, it redirects the user to the post URL.

Save your changes and flush the rewrite rules by going to Settings > Permalinks in your WordPress dashboard and clicking the "Save Changes" button.
After following these steps, each post that has the tp_version and tp_dl1 custom fields will have a dynamic download page accessible at the /download/ endpoint. 
