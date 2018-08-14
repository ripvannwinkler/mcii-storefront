<?php

function site_content_start()
{
    ?><div class="container site-content"><?php
}

function site_content_end()
{
    ?></div><?php
}

function storefront_page_header()
{
    if (is_page()) {
        return;
    } ?>

    <header class="entry-header"><?php
    storefront_post_thumbnail('full');
    the_title('<h1 class="entry-title">', '</h1>'); ?>
    </header>
    <?php
}

function storefront_post_header()
{
    if (is_page()) {
        return;
    } ?>

    <header class="entry-header">
    <?php
    if (is_single()) {
        storefront_posted_on();
        the_title('<h1 class="entry-title">', '</h1>');
    } else {
        if ('post' == get_post_type()) {
            storefront_posted_on();
        }

        the_title(sprintf('<h2 class="alpha entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
    } ?>
    </header>
    <?php
}
