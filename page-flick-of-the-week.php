<?php
/**
 * The template for displaying all single posts.
 *
 * @package storefront
 */

function modify_wc_actions()
{
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
    remove_action('woocommerce_after_single_product_summary', 'show_reviews', 15);
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
}

function get_content()
{
    ob_start();
    while (have_posts()) {
        the_post();
        do_action('storefront_single_post_before');
        get_template_part('content', 'single-product');
        do_action('storefront_single_post_after');
    }

    $html = ob_get_contents();
    ob_end_clean();
    return $html;
}

function get_menu()
{
    ob_start();
    wp_nav_menu(array(
        'theme_location' => 'theblockwatch',
        'menu_class' => 'page-submenu'
    ));
    
    $menu = ob_get_contents();
    ob_end_clean();
    return $menu;
}

modify_wc_actions();
get_header();

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
        <?=get_menu()?>
		<?=get_content()?>
	</main>
</div>

<?php
do_action('storefront_sidebar');
get_footer();
