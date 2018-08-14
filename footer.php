<?php

require_once 'mobile_detect.php';
$mobile_detector = new Mobile_Detect;
$is_mobile = $mobile_detector->isMobile();
$contact_phone = $is_mobile ? "tel:2484700086" : "/contact-us";

$template_dir = get_stylesheet_directory_uri();
$main_script = "$template_dir/dist/main.js";

function icon_url($dir, $name)
{
    return "$dir/assets/images/$name";
}
?>

<?php 
if (!is_front_page()) {
    site_content_end(); ?>
		<footer class="site-footer">
			<div class="site-footer-links">

				<a target="_blank" href="https://www.youtube.com/channel/UCP4ckjPTHF-QIgDpfBneV0A">
					<img src="<?=icon_url($template_dir, 'footer-youtube.png')?>" alt="YouTube"/></a>
				<a target="_blank" href="https://www.instagram.com/mciiclothing/">
					<img src="<?=icon_url($template_dir, 'footer-instagram.png')?>" alt="Instagram"/></a>

				<span class="site-copyright">&copy; MCII 2018</span>

				<a target="_blank" href="/contact-us">
					<img src="<?=icon_url($template_dir, 'footer-email.png')?>" alt="Email"/></a>
				<a target="_blank" href="<?= $contact_phone ?>">
					<img src="<?=icon_url($template_dir, 'footer-phone.png')?>" alt="Phone"/></a>
			</div>
		</footer>
<?php
} ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/turn.js/3/turn.min.js"></script>
<script src="<?=$main_script?>"></script>
<?php wp_footer();?>

</body>
</html>