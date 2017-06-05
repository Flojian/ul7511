<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package sparkling
 */
?>
</div>
	<div id="secondary" class="widget-area col-xs-12 col-sm-12 col-md-4 col-lg-3" role="complementary">
		<?php if( of_get_option('footer_social') ) sparkling_social_icons(); ?>
		<?php get_custom_home_side_widgets() ?>
	</div><!-- #secondary -->
