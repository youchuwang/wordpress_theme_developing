	</div>
</div>
<?php
	if( isMobile() ){
?>
<div class="mobile-menu-sidebar-section hide" style="background-image:url(<?php echo ot_get_option( 'menu_section_bkg' ); ?>);">
	<div class="mobile-menu-wrapper">
		<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
	</div>
	<div class="social-section">
		<a class="icon" href="<?php echo ot_get_option('facebook_url'); ?>">b</a>
		<a class="icon" href="<?php echo ot_get_option('pinterest_url'); ?>">d</a>
		<a class="icon" href="<?php echo ot_get_option('twitter_url'); ?>">a</a>
		<a class="icon" href="<?php echo ot_get_option('instagram_url'); ?>">x</a>
	</div>
	<div class="menu-content-wrapper">
		<?php echo do_shortcode(ot_get_option( 'menu_section_content' )); ?>
	</div>
</div>
<div class="mobile-scroll-top-btn hide">
	<span></span>
	<span></span>
	<span></span>
</div>
<?php
	}
?>
<?php
	wp_footer();
?>
</body>
</html>
