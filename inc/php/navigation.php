<?php

/**
 * Unregister existing nav menus from the site
 */
function remove_default_menus()
{
    $existing = get_registered_nav_menus();
    foreach ($existing as $key => $value) {
        unregister_nav_menu($key);
    }
}

/**
 * Register nav menus for this theme
 */
function register_theme_menus()
{
    $menus = array(
        'main-left' => __('Main Menu Left'),
        'main-right' => __('Main Menu Right'),
        'main-mobile' => __('Main Menu Mobile'),
        'theblockwatch' => __('The Blockwatch Menu'),
        'thestory' => __('The Story Menu'),
        );

    register_nav_menus($menus);
}

/**
 * Gets the configured site logo html
 */
function get_site_logo_html()
{
    $home = get_home_url();
    $base_dir = get_stylesheet_directory_uri();
    $image_url = "$base_dir/assets/images/mcii_header.png";
    $html = "<h1 class='site-logo'><img src='{$image_url}'/></h1>";
    $html = "<a href='$home'>$html</a>";
    return $html;
}

/**
 * Removes the sidebar provided by parent theme
 * https://nicola.blog/2016/07/22/remove-sidebar-woocommerce-pages-storefront/
 */
function remove_storefront_sidebar()
{
    if (true || is_woocommerce()) {
        remove_action('storefront_sidebar', 'storefront_get_sidebar', 10);
    }
}

/**
 * Displays a link to the cart including the number of items present and the cart total
 */
function storefront_cart_link()
{
    ?>
    <a class="cart-contents" href="<?=esc_url(wc_get_cart_url()); ?>" 
       title="<?php esc_attr_e('View your shopping cart', 'storefront'); ?>">
    <span class="icon"><i class="fa fa-shopping-cart fa-2x"></i></span>
    <span class="count"><?=WC()->cart->get_cart_contents_count()?></span>
    </a><?php
}


add_action('init', 'remove_default_menus');
add_action('init', 'register_theme_menus');
add_action('init', 'remove_storefront_sidebar');
