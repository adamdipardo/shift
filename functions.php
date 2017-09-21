<?php

// load config vars
require( __dir__ . '/theme-config.php' );

add_action( 'after_setup_theme', 'setup_shift' );
add_action('wp_enqueue_scripts', 'shift_styles' );
add_action('wp_enqueue_scripts', 'shift_scripts' );
add_action( 'init', 'shift_menus' );
add_action( 'init', 'shift_team_post_type' );
add_action( 'init', 'shift_support' );
add_action( 'admin_menu', 'shift_admin_menu_cleanup' );
add_action( 'wp_ajax_process_donate', 'shift_handle_donate' );
add_action( 'wp_ajax_nopriv_process_donate', 'shift_handle_donate' );
add_action( 'customize_register', 'shift_customizer' );
add_action( 'after_setup_theme', 'shift_image_sizes' );

add_filter( 'body_class', 'shift_add_slug_body_class' );

// handle theme setup
function setup_shift() {

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

}

// enqueueing styles
function shift_styles() {

	// bootstrap styles
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '3.3.7', 'all' );
	wp_register_style( 'shift_style', get_template_directory_uri() . '/style.css', array(), '0.0.19', 'all' );
	wp_enqueue_style( 'bootstrap' );
	wp_enqueue_style( 'shift_style' );

	// Didact Gothic font
	wp_register_style( 'didact_gothic', 'https://fonts.googleapis.com/css?family=Didact+Gothic', array(), '1.0', 'all' );
	wp_enqueue_style( 'didact_gothic' );

	// slick
	wp_register_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'slick' );

	wp_register_style( 'slick_theme', get_template_directory_uri() . '/assets/css/slick-theme.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'slick_theme' );

}

// enqueue scripts
function shift_scripts() {

	// bootstrap JS
	wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '3.3.7' );
	wp_enqueue_script( 'bootstrap' );

	// stripe
	wp_register_script( 'stripe', 'https://checkout.stripe.com/checkout.js', array() );
	wp_enqueue_script( 'stripe' );

	// slick
	wp_register_script( 'slick', get_template_directory_uri() . '/assets/js/slick.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'slick' );

	// slick-shift
	wp_register_script( 'shift_slick', get_template_directory_uri() . '/assets/js/shift-slick.js', array( 'slick' ) );
	wp_enqueue_script( 'shift_slick' );

}

// register menus
function shift_menus() {

	register_nav_menu( 'shift_header_menu', 'Primary header menu' );

}

// register Team post type
function shift_team_post_type() {

	register_post_type( 'shift_team',
		array(
			'labels' => array(
				'name' => 'Team',
				'singular_name' => 'Team Member'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array(
				'slug' => 'team',
				'with_front' => false
			),
			'supports' => array(
				'title',
				'editor',
				'thumbnail'
			),
			'menu_icon' => 'dashicons-groups'
		)
	);

	register_post_type( 'shift_progress',
		array(
			'labels' => array(
				'name' => 'Progress Slides',
				'singular_name' => 'Slide'
			),
			'public' => true,
			'has_archive' => false,
			'supports' => array(
				'title',
				'editor',
				'thumbnail'
			),
			'menu_icon' => 'dashicons-format-gallery'
		)
	);

}

// hide admin menu items that aren't needed
function shift_admin_menu_cleanup() {
    remove_menu_page( 'edit.php' );
    remove_menu_page( 'edit-comments.php' );
}

// AJAX handler for Stripe donation
function shift_handle_donate() {

	// include Stripe
	require_once( __dir__ . '/stripe-php/init.php' );

	\Stripe\Stripe::setApiKey($stripeKey);

	$token = $_POST['token'];

	try {
		$charge = \Stripe\Charge::create(array(
			"amount" => $_POST['amount'] * 100,
			"currency" => "cad",
			"description" => "Donation to Shift",
			"source" => $token
		));

		die(json_encode(array('message' => 'Thank you! Your donation of $' . $_POST["amount"] . ' has been sent.')));
	} catch (Exception $e) {
		die(json_encode(array('error' => $e->getMessage())));
	}

}

// add logo to customizer
function shift_customizer( $wp_customize ) {

	$wp_customize->add_section( 'shift_logo_section' , array(
	    'title' => 'Logo',
	    'priority' => 30,
	    'description' => 'Upload a logo to use in the top left corner of the theme',
	) );

	$wp_customize->add_setting( 'shift_logo' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'shift_logo', array(
	    'label'    => 'Logo',
	    'section'  => 'shift_logo_section',
	    'settings' => 'shift_logo',
	) ) );

}

// add special thumbnail sizes
function shift_image_sizes() {

	// image size for members archive
	add_image_size( 'shift_team_thumb', 600, 600, true );

}

// register support for stuff
function shift_support() {

	add_theme_support( 'post-thumbnails', array( 'post', 'page', 'shift_team', 'shift_progress' ) );

}

//Page Slug Body Class
function shift_add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}