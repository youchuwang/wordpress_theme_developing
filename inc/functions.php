<?php
add_image_size( 'home-blog-size', 270, 270, true );

/**
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_false' );
 
/**
 * Set theme mode true
 */
add_filter( 'ot_theme_mode', '__return_true' );

/** 
* Hide layout option from option tree
*/
add_filter( 'ot_show_new_layout', '__return_false' );

/**
 * Required: include OptionTree.
 */
include_once( 'option-tree/ot-loader.php' );
/**
 * Theme Options
*/
include_once( 'option-tree/assets/theme-mode/theme-options.php' );

/**
 * Meta Boxes
*/
// include_once( 'option-tree/assets/theme-mode/demo-meta-boxes.php' );

add_action('wp_enqueue_scripts','theme_main_css_js');

function theme_main_css_js(){
	wp_enqueue_style( 'lato', 'http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic' );
	wp_enqueue_style( 'libre-baskerville', 'http://fonts.googleapis.com/css?family=Libre+Baskerville:400,700,400italic' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/lib/bootstrap-3.3.1-dist/dist/css/bootstrap.min.css' );
	wp_enqueue_style( 'main', get_template_directory_uri() . '/css/main.css' );
	
	wp_enqueue_script('bootstrap', get_bloginfo('template_url') . '/lib/bootstrap-3.3.1-dist/dist/js/bootstrap.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('slick', get_bloginfo('template_url') . '/lib/slick/slick.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('main', get_bloginfo('template_url') . '/js/main.js', array('jquery'), '1.0.0', true );

	wp_localize_script('main', 'admin_ajax', array(
		'url' => admin_url('admin-ajax.php')
    ));
}

/*--------------------------------------*/
/*    Clean up Shortcodes
/*--------------------------------------*/
			
function wpex_clean_shortcodes($content){  
	$array = array (
		'<p>[' => '[', 
		']</p>' => ']', 
		']<br />' => ']'
	);
	$content = strtr($content, $array);
	return $content;
}
add_filter('the_content', 'wpex_clean_shortcodes');

add_shortcode('cake-kind-list', 'cake_kind_list_func');
function cake_kind_list_func( $attr, $content = null ){
	return '<div class="cake-kind-list"><div class="cake-kind-list-menu"><ul>' . do_shortcode( $content ) . '</ul></div><div class="cake-kind-list-content"></div></div>';
}

add_shortcode('cake-kind-item', 'cake_kind_item_func');
function cake_kind_item_func( $attr, $content = null ){
	$activeClass = "";
	if( isset( $attr['active'] ) && $attr['active'] == 'true' ){
		$activeClass = 'class="active"';
		$activeClass = 'class="active"';
	}

	return '<li ' . $activeClass . '><h3>' . $attr['title'] . '</h3><div class="cake-kind-info">' . do_shortcode( $content ) . '</div></li>';
}

add_shortcode('cake-special-list', 'cake_special_list_func');
function cake_special_list_func( $attr, $content = null ){
	return '<div class="cake-special-list">' . $content . '</div>';
}

add_shortcode('stroke-title', 'stroke_title_func');
function stroke_title_func( $attr, $content = null ){
	return '<div class="stroke-title"><div class="stroke-title-line-left white-bkg"></div><h2>' . $content . '<h2><div class="stroke-title-line-right white-bkg"></div></div>';
}

add_shortcode('bt-row', 'bt_row_func');
function bt_row_func( $attr, $content = null ){
	return '<div class="bt-row">' . do_shortcode( $content ) . '</div>';
}

add_shortcode('bt-span6', 'bt_span6_func');
function bt_span6_func( $attr, $content = null ){
		$activeClass = 'class="active"';
	return '<div class="bt-span6">' . do_shortcode( $content ) . '</div>';
}

add_shortcode('bt-span4', 'bt_span4_func');
function bt_span4_func( $attr, $content = null ){
	return '<div class="bt-span4">' . do_shortcode( $content ) . '</div>';
}

add_shortcode('bt-contact-form-row', 'bt_contact_form_row_func');
function bt_contact_form_row_func( $attr, $content = null ){
	return '<div class="bt-contact-form-row"><div class="bt-contact-form-inner">' . do_shortcode( $content ) . '</div><div class="bt-contact-form-img-wrapper"><div class="bt-contact-form-img" style="background-image:url(' . $attr['background_url'] . ')"></div></div></div>';
}

add_action( 'wp_ajax_read_more_post', 'read_more_post' );
add_action( 'wp_ajax_nopriv_read_more_post', 'read_more_post' );
function read_more_post() {
	$postid = $_POST['postid'];

	$content_post = get_post( $postid );
	$content = $content_post->post_content;

	header("Content-Type: application/json");
	echo json_encode( array(
		'data' => apply_filters( 'the_content', $content )
	) );
	exit;
}

add_action( 'wp_ajax_load_more_post', 'load_more_post' );
add_action( 'wp_ajax_nopriv_load_more_post', 'load_more_post' );
function load_more_post() {
	$offset = intVal( $_POST['offset'] );

	global $post;
	$args = array(  
		'post_type' => 'post',
		'posts_per_page' => 2,
		'offset' => $offset
	);

	$blogPosts = new WP_Query( $args );

	$htmlContent = '';

	if( $blogPosts->have_posts() ){
		while( $blogPosts->have_posts() ){
			$blogPosts->the_post();

			$offset++;

			$htmlContent .= '<div class="blog-item"><div class="blog-item-image">' .  get_the_post_thumbnail($post->ID, 'home-blog-size') . '</div><div class="blog-item-content"><div class="blog-item-content-inner"><h2>' . $post->post_title . '</h2><div class="post-date">' . get_the_date('', $post->ID) . '</div><div id="blog-content-close' . $post->ID . '" class="blog-item-content-excerpt">' . apply_filters( 'the_content', $post->post_excerpt ) . '</div><div id="blog-content-open' . $post->ID . '" class="blog-item-content-full hide"></div><div class="blog-item-read-more"><a href="#" id="blog-content-btn' . $post->ID . '" data-read="un-read" data-status="close" data-postid="' . $post->ID . '">Read More</a></div></div></div></div>';
		}
	}

	$count_posts = wp_count_posts();

	$visible = true;
	if( $count_posts->publish <= $offset ){
		$visible = false;
	}

	header("Content-Type: application/json");
	echo json_encode( array(
		'data' => $htmlContent,
		'offset' => $offset,
		'visible' => $visible
	) );
	exit;
}

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page('Gallery Slider Builder');
}

add_filter('acf/options_page/settings', 'my_options_page_settings');

function my_options_page_settings($options){
	$options['title'] = __('Gallery Slider Builder');
	$options['pages'] = array(
		__('Gallery Slider Builder')
	);

	return	$options;
}

//Review Post Type
add_action('init', 'register_review_posttype');
function register_review_posttype() {
	$labels = array(
		'name'               => _x( 'Reviews', 'post type general name' ),
		'singular_name'      => _x( 'Review', 'post type singular name' ),
		'add_new'            => __( 'Add New Review' ),
		'add_new_item'       => __( ' Add New Review' ),
		'edit_item'          => __( 'Edit Review' ),
		'new_item'           => __( ' New Review' ),
		'view_item'          => __( 'View Review' ),
		'search_items'       => __( 'Search Review' ),
		'not_found'          => __( 'Review Not Found' ),
		'not_found_in_trash' => __( 'Review' ),
		'parent_item_colon'  => __( 'Review' ),
		'menu_name'          => __( 'Reviews' )
	);

	$taxonomies = array();

	// $supports = array('title','editor','author','thumbnail','excerpt','custom-fields','comments','revisions');
	$supports = array('title', 'editor');

	$post_type_args = array(
		'labels'             => $labels,
		'singular_label'     => __('Review'),
		'public'             => true,
		'show_ui'            => true,
		'publicly_queryable' => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'rewrite'            => array('slug' => 'review', 'with_front' => false ),
		'supports'           => $supports,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-index-card',
		'taxonomies'         => $taxonomies
	 );
	 register_post_type('review', $post_type_args);
}

//Cake Gallery Post Type
add_action('init', 'register_cakegallery_posttype');
function register_cakegallery_posttype() {
	$labels = array(
		'name'               => _x( 'Cake Galleries', 'post type general name' ),
		'singular_name'      => _x( 'Cake Gallery', 'post type singular name' ),
		'add_new'            => __( 'Add New Cake Gallery' ),
		'add_new_item'       => __( ' Add New Cake Gallery' ),
		'edit_item'          => __( 'Edit Cake Gallery' ),
		'new_item'           => __( ' New Cake Gallery' ),
		'view_item'          => __( 'View Cake Gallery' ),
		'search_items'       => __( 'Search Cake Gallery' ),
		'not_found'          => __( 'Cake Gallery Not Found' ),
		'not_found_in_trash' => __( 'Cake Gallery' ),
		'parent_item_colon'  => __( 'Cake Gallery' ),
		'menu_name'          => __( 'Cake Galleries' )
	);

	$taxonomies = array();

	// $supports = array('title','editor','author','thumbnail','excerpt','custom-fields','comments','revisions');
	$supports = array('title', 'editor');

	$post_type_args = array(
		'labels'             => $labels,
		'singular_label'     => __('Cake Gallery'),
		'public'             => true,
		'show_ui'            => true,
		'publicly_queryable' => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'rewrite'            => array('slug' => 'cake-gallery', 'with_front' => false ),
		'supports'           => $supports,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-images-alt',
		'taxonomies'         => $taxonomies
	);

	register_post_type('cake-gallery', $post_type_args);
}