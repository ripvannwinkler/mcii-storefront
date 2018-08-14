<?php

/**
 * Our front page is a static HTML page with the hand tree graphic so we use a
 * dedicated template for that. No need to include all the wordpress bits we
 * won't be using.
 */

$template_dir = get_stylesheet_directory_uri();
$tree_image = "$template_dir/assets/images/hand_tree.png";

require_once 'mobile_detect.php';
$mobile_detector = new Mobile_Detect;
$is_mobile = $mobile_detector->isMobile();
$contact_phone = $is_mobile ? "tel:2484700086" : "/contact-us";

get_header();

?>

<div class="fp-wrapper">
	<div class="fp-content">
		<img 
			width="1459"
			height="1920"
			usemap="#map1" 
			src="<?=$tree_image?>"/>
	</div>
</div>

<map name="map1">
	<area title="Email" alt="Email" coords="195, 1607, 361, 1673, 311, 1775, 151, 1703" shape="poly" href="/contact-us"/>
	<area title="Phone" alt="Phone" coords="513, 1683, 618, 1734, 536, 1894, 447, 1830" shape="poly" href="<?= $contact_phone ?>"/>
	<area title="Instagram" alt="Instagram" coords="568, 1536, 510, 1668, 637, 1720, 683, 1580" shape="poly" href="https://instagram.com/mciiclothing" target="_blank"/>
	<area title="YouTube" alt="YouTube" coords="250, 1431, 209, 1551, 421, 1611, 446, 1479, 250, 1426" shape="poly" href="https://www.youtube.com/channel/UCP4ckjPTHF-QIgDpfBneV0A" target="_blank"/>
	<area title="The Media" alt="The Media" coords="554, 1042, 568, 1088, 785, 1030, 776, 988" shape="poly" href="/the-media"/>
	<area title="The Story" alt="The Story" coords="823, 1014, 821, 1070, 1041, 1068, 1036, 1024" shape="poly" href="/the-story"/>
	<area title="The Blockwatch" alt="The Blockwatch" coords="1052, 972, 1316, 760, 1353, 807, 1093, 1015" shape="poly" href="/the-blockwatch"/>
	<area title="The Shop" alt="The Shop" coords="703, 827, 911, 828, 897, 890, 704, 883" shape="poly" href="/shop" /> 
</map>

<?php 

get_footer();
