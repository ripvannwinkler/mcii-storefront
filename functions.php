<?php

update_option('siteurl','https://www.mcii.co');
update_option('home','https://www.mcii.co');

if (!isset($content_width)) {
    $content_width = 1280;
}

include_once(dirname(__FILE__)."/inc/php/styles.php");
include_once(dirname(__FILE__)."/inc/php/templates.php");
include_once(dirname(__FILE__)."/inc/php/products.php");
include_once(dirname(__FILE__)."/inc/php/navigation.php");
include_once(dirname(__FILE__)."/inc/php/gallery.php");
