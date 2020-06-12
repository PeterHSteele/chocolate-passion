<?php
/**
* Footer Widget Area
*
* @package chocolate-passion
*/
?>

<aside role="complementary" class="row widget-area" <?php chocolate_passion_footer_widgets_aria_label() ?>> 
	<?php dynamic_sidebar( 'footer-widgets' ) ?>	
</aside>