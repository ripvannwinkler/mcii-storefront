<?php

global $woocommerce;

include_once(dirname(__FILE__)."/inc/php/navigation.php");

$base_dir = get_stylesheet_directory_uri();
$stylesheet = "$base_dir/dist/main.css";

function render_menu($location)
{
    wp_nav_menu(array('theme_location' => $location));
}

?>

<!DOCTYPE html>
<html <?php language_attributes();?>>

<head>
	<meta charset="<?php bloginfo('charset');?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
	<link rel="pingback" href="<?php bloginfo('pingback_url');?>">
	<?php wp_head();?>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
	<link href="<?=$stylesheet?>" rel="stylesheet">
</head>

<body <?php body_class();?>>

<?php if (!is_front_page()) {
    ?>
	<!-- mobile version -->
	<div class="d-block d-lg-none">
			<div class="text-center">
				<?=render_menu("main-mobile")?>
			</div>
			<div class="text-center">
				<?=get_site_logo_html()?>
			</div>
	</div>
	<!-- desktop version -->
	<div class="container d-none d-lg-block">
		<div class="row blog-header">
			<div class="col-sm-auto text-left">
				<?=render_menu("main-left")?>
			</div>
			<div class="col text-center">
				<?=get_site_logo_html()?>
			</div>
			<div class="col-sm-auto  text-right">
				<?=render_menu("main-right")?>
				<?=storefront_cart_link()?>
			</div>
			
		</div>
	</div>
<?php

    site_content_start();
} ?>