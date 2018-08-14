<?php

/**
 * Register theme styles
 */
function enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/dist/main.css');
}

add_action('wp_enqueue_scripts', 'enqueue_styles');
