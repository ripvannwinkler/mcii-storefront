<?php
/**
 * The template for displaying all single posts.
 *
 * @package storefront
 */

function disable_after_content()
{
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
    remove_action('woocommerce_after_single_product_summary', 'show_reviews', 15);
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
}

disable_after_content();
get_header();


ob_start();
while (have_posts()) {
    the_post();
    do_action('storefront_single_post_before');
    get_template_part('content', 'single-product');
    do_action('storefront_single_post_after');
}

$html = ob_get_contents();
ob_end_clean();

ob_start();
wp_nav_menu(array(
    'theme_location' => 'theblockwatch',
    'menu_class' => 'page-submenu'
));

$menu = ob_get_contents();
ob_end_clean();

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
        <?=$menu?>
		<?=$html?>
	</main>
</div>

<?php
do_action('storefront_sidebar');
get_footer();
