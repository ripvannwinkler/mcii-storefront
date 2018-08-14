<?php
/**
 * Template Name: The Story
 */


function get_content()
{
    ob_start();
    while (have_posts()) {
        the_post();
        do_action('storefront_single_post_before');
        get_template_part('content', 'single');
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
            'theme_location' => 'thestory',
            'menu_class' => 'page-submenu'
    ));
    
    $menu = ob_get_contents();
    ob_end_clean();
    return $menu;
}

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?=get_menu()?>
			<?=get_content()?>
		</main>
	</div>

<?php
do_action('storefront_sidebar');
get_footer();
