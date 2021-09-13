```
//Disable Automatic embeds in WordPress
function disable_embeds_init() {
	/* @var WP $wp */
	global $wp;

	// Remove the embed query var.
	$wp->public_query_vars = array_diff( $wp->public_query_vars, array(
		'embed',
	) );

	// Remove the oembed/1.0/embed REST route.
	add_filter( 'rest_endpoints', 'disable_embeds_remove_embed_endpoint' );

	// Disable handling of internal embeds in oembed/1.0/proxy REST route.
	add_filter( 'oembed_response_data', 'disable_embeds_filter_oembed_response_data' );

	// Turn off oEmbed auto discovery.
	add_filter( 'embed_oembed_discover', '__return_false' );

	// Don't filter oEmbed results.
	remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

	// Remove oEmbed discovery links.
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

	// Remove oEmbed-specific JavaScript from the front-end and back-end.
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );

	// Remove all embeds rewrite rules.
	add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );

	// Remove filter of the oEmbed result before any HTTP requests are made.
	remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result', 10 );

	// Load block editor JavaScript.
	add_action( 'enqueue_block_editor_assets', 'disable_embeds_enqueue_block_editor_assets' );

	// Remove wp-embed dependency of wp-edit-post script handle.
	add_action( 'wp_default_scripts', 'disable_embeds_remove_script_dependencies' );
}

add_action( 'init', 'disable_embeds_init', 9999 );
function disable_embeds_tiny_mce_plugin( $plugins ) {
	return array_diff( $plugins, array( 'wpembed' ) );
}
function disable_embeds_rewrites( $rules ) {
	foreach ( $rules as $rule => $rewrite ) {
		if ( false !== strpos( $rewrite, 'embed=true' ) ) {
			unset( $rules[ $rule ] );
		}
	}

	return $rules;
}
function disable_embeds_remove_embed_endpoint( $endpoints ) {
	unset( $endpoints['/oembed/1.0/embed'] );

	return $endpoints;
}
function disable_embeds_filter_oembed_response_data( $data ) {
	if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
		return false;
	}

	return $data;
}
function disable_embeds_enqueue_block_editor_assets() {
	$asset_file  = plugin_dir_path( __FILE__ ) . 'build/index.asset.php';
	$asset       = is_readable( $asset_file ) ? require $asset_file : [];

	$asset['dependencies'] = isset( $asset['dependencies'] ) ? $asset['dependencies'] : [];
	$asset['version'] = isset( $asset['version'] ) ? $asset['version'] : '';

	wp_enqueue_script(
		'disable-embeds',
		plugins_url( 'build/index.js', __FILE__ ),
		$asset['dependencies'],
		$asset['version'],
		true
	);
}
function disable_embeds_remove_script_dependencies( $scripts ) {
	if ( ! empty( $scripts->registered['wp-edit-post'] ) ) {
		$scripts->registered['wp-edit-post']->deps = array_diff(
			$scripts->registered['wp-edit-post']->deps,
			array( 'wp-embed' )
		);
	}
}
```
### What is Post oEmbed in WordPress and Why You Should Disable it
OEmbed provides an easy way to embed content from one site to another. Many popular websites like Flickr, YouTube, Twitter, and others use it.

Websites that allow other websites to embed their content using oEmbed protocol are called oEmbed providers.

WordPress supports many oEmbed providers by default that’s why you can easily embed videos, Tweets, Instagram photos, and much more by just pasting the URL and not the embed code.

Since WordPress 4.4, all WordPress sites using the latest version will become an oEmbed provider themselves. This means other bloggers can add your posts to their site by simply adding the post URL in their own posts.

There is no harm in leaving it enabled on your website. It only allows other websites to show a small summary of your content with post title and featured image.
