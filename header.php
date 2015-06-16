<?php
/**
 * Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/*
	 * We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/*
	 * Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<div class="content-wrapper" style="background-image:url(<?php echo ot_get_option( 'menu_section_bkg' ); ?>);">
	<div class="menu-section">
		<div class="menu-logo-wrapper">
			<div>
				<a href="<?php echo site_url(); ?>"><img src="<?php echo ot_get_option( 'menu_section_logo' ); ?>" /></a>
			</div>
		</div>
		<div class="main-menu-wrapper">
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
	<div class="mobile-menu-section">
		<div class="mobile-logo-section">
			<a href="<?php echo site_url(); ?>"><img src="<?php echo ot_get_option( 'menu_section_mobile_logo' ); ?>" /></a>
		</div>
		<div class="mobile-toggle-nav">
			<button class="mobile-toggle-btn" data-status="close">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
	</div>
	<div class="content-inner-section">