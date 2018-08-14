<?php

function wc_hide_in_stock_message( $html, $product ) {
    
		return ''; // hide stock availability message per Michael
		
		$availability = $product->get_availability();
		if ( isset( $availability['class'] ) && 'in-stock' === $availability['class'] ) {
        return '';
    }
    
		return $html;
}

function remove_image_zoom_support()
{
    remove_theme_support('wc-product-gallery-zoom');
}

 
function adjust_catalog_sorting()
{
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    remove_action('woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10);
    remove_action('woocommerce_after_shop_loop', 'woocommerce_result_count', 20);
        
    add_action('woocommerce_after_shop_loop', 'woocommerce_result_count', 10);
    add_action('woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 20);
}

function filter_shop_page_categories($q)
{
    // hide these categories from the shop page
    $hide_categories = array( 'flick-of-the-week' );

    if (is_shop()) {
        $tax_query = (array) $q->get('tax_query');
        $tax_query[] = array(
            'field'    => 'slug',
            'operator' => 'NOT IN',
            'taxonomy' => 'product_cat',
            'terms'    => $hide_categories,
        );
    
        $q->set('tax_query', $tax_query);
    }
}

function filter_post_classes($classes)
{
    if ('product' == get_post_type()) {
        $classes = array_diff($classes, array( 'first', 'last' ));
    }

    return $classes;
}

function show_reviews()
{
    comments_template();
}

function remove_product_tabs($tabs)
{
    unset($tabs['reviews']);                  // Remove the reviews tab
    unset($tabs['description']);              // Remove the description tab
    unset($tabs['additional_information']);   // Remove the additional information tab
    return $tabs;
}

function get_category_names($category) {
	return $category->name;
}

function before_single_product() {
	
	global $post;
	$terms = get_the_terms( $post->id, 'product_cat' );
	if (empty($terms)) die('no product'); 
	
	$names = array_map(function($t) { return strtolower($t->name); }, $terms);
	$is_flickoftheweek = array_search('flick of the week', $names) !== false;
	
	if (!$is_flickoftheweek) {
		echo '<div class="woocommerce-before-single-product">';
		echo '  <a href="/shop">&#x2039;&#x2039;&#x2039; Back to Shop</a>';
		echo '</div>';
	}
}

function shipping_disclaimer() {
	echo do_shortcode('[insert page="1281" display="content"]');
}


add_action('init', 'adjust_catalog_sorting', 10);
add_action('wp', 'remove_image_zoom_support', 100);
add_action('woocommerce_before_single_product', 'before_single_product', 15 );
add_filter('post_class', 'filter_post_classes', 21);
add_filter('woocommerce_show_page_title', '__return_false');
add_filter('woocommerce_product_tabs', 'remove_product_tabs', 98);
add_action('woocommerce_product_query', 'filter_shop_page_categories');
add_filter('woocommerce_get_stock_html', 'wc_hide_in_stock_message', 50, 2 );
add_action('woocommerce_proceed_to_checkout', 'shipping_disclaimer', 10 );
add_filter( 'wc_product_sku_enabled', '__return_false' );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

 
