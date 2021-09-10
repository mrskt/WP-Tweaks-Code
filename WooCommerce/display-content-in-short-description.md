```
// Replace Short Description with Shortcode Content
add_filter('woocommerce_short_description', function ($description) {
	if (! is_product()|| has_term( 'membership-plans', 'product_cat' ) ) { return $description; }
	return do_shortcode('[mbv name="product-desc"]');
});
```

This code can helps you to replace WooCommerce short Description with your own content with conditions to exclude specific category.
