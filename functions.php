<?php
/**
 * brosco functions and definitions
 *
 * @package brosco
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'brosco_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function brosco_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on brosco, use a find and replace
	 * to change 'brosco' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'brosco', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
    add_image_size( 'category-thumb', 500, 750, true ); // nemzetmuvesze thumbstyle

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'brosco' ),
	) );
    
    register_nav_menus( array(
		'forntpage' => __( 'Frontpage Menu', 'brosco' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
//	add_theme_support( 'post-formats', array(
//		'aside', 'image', 'video', 'quote', 'link'
//	) );


}
endif; // brosco_setup
add_action( 'after_setup_theme', 'brosco_setup' );

/**
*	List archives by Title on Archive page
*	if(is_archive())
*
**/

function nm_query_order( $query ) 
{
        $query->set( 'orderby', 'title' );
        $query->set( 'order', 'ASC' );
    }

add_action( 'pre_get_posts', 'nm_query_order' );



/**
 * Enqueue scripts and styles.
 */

/* masonry */


function nm_adding_masonry() {
wp_register_script('masonry', get_template_directory_uri() . '/js/isotope.min.js', array('jquery'),'1.1', true);
wp_enqueue_script('masonry');
}

add_action( 'wp_enqueue_scripts', 'nm_adding_masonry' );  


/*	end masonry */

function brosco_scripts() {
	wp_enqueue_style( 'brosco-style', get_stylesheet_uri() );


	if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}




	wp_enqueue_script( 'brosco-waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array(), '20120206', true );

    wp_enqueue_script( 'popup-scripts', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array(), '20120206', true );

	wp_enqueue_script( 'daily-scripts', get_template_directory_uri() . '/js/daily-scripts.js', array(), '20120206', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'brosco_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

function odd_even() {
	global $post_num;

	if ( ++$post_num % 2 )
		$class = 'even';
	else
		$class = 'odd';

	echo $class;
}



/**
 * Register `intro` post type
 */
function intro_post_type() {

   // Labels
	$labels = array(
		'name' => _x("Intro", "post type general name"),
		'singular_name' => _x("Intro", "post type singular name"),
		'menu_name' => 'Intro',
		'add_new' => _x("Add New", "Intro"),
		'add_new_item' => __("Add New Intro"),
		'edit_item' => __("Edit Intro"),
		'new_item' => __("New Intro"),
		'view_item' => __("View Intro"),
		'search_items' => __("Search Intro"),
		'not_found' =>  __("No Intro Found"),
		'not_found_in_trash' => __("No Intro Found in Trash"),
		'parent_item_colon' => ''
	);

	// Register post type
	register_post_type('intro' , array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => false,
	//	'menu_icon' => get_stylesheet_directory_uri() . '/lib/TeamProfiles/team-icon.png',
		'rewrite' => false,
		'supports' => array('title', 'editor')
	) );
}
add_action( 'init', 'intro_post_type', 0 );




function brosco_theme_customizer( $wp_customize ) {
    $wp_customize->add_section( 'brosco_logo_section' , array(
    'title'       => __( 'Logo', 'brosco' ),
    'priority'    => 30,
    'description' => 'Upload a logo to replace the default site name and description in the header',
    ) );

    $wp_customize->add_setting( 'brosco_logo' );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'brosco_logo', array(
    'label'    => __( 'Logo', 'brosco' ),
    'section'  => 'brosco_logo_section',
    'settings' => 'brosco_logo',
) ) );

}
add_action('customize_register', 'brosco_theme_customizer');


/**
 * Attach a class to linked images' parent anchors
 * e.g. a img => a.img img
 */
function give_linked_images_class($html, $id, $caption, $title, $align, $url, $size, $alt = '' ){
  $classes = 'img'; // separated by spaces, e.g. 'img image-link'

  // check if there are already classes assigned to the anchor
  if ( preg_match('/<a.*? class=".*?">/', $html) ) {
    $html = preg_replace('/(<a.*? class=".*?)(".*?>)/', '$1 ' . $classes . '$2', $html);
  } else {
    $html = preg_replace('/(<a.*?)>/', '$1 class="' . $classes . '" >', $html);
  }
  return $html;
}
add_filter('image_send_to_editor','give_linked_images_class',10,8);




//acf

define( 'ACF_LITE', true );
include_once('advanced-custom-fields/acf.php');

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_intro-fields',
		'title' => 'Intro fields',
		'fields' => array (
			array (
				'key' => 'field_5429d3b2a2818',
				'label' => 'Intro Text',
				'name' => 'intro-text',
				'type' => 'textarea',
				'instructions' => 'Please enter the intro text here.',
				'required' => 1,
				'default_value' => 'WELCOME TO DAILY. A SIMPLE, CLEAN WORDPRESS THEME PERFECT FOR PHOTOGRAPHERS AND BLOGGERS.',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 3,
				'formatting' => 'none',
			),
			array (
				'key' => 'field_544ab9d319da4',
				'label' => 'Intro Text Color',
				'name' => 'intro_text_color',
				'type' => 'select',
				'instructions' => 'Choose a light or dark text color. ',
				'choices' => array (
					'light-text' => 'Light',
					'dark-text' => 'Dark',
				),
				'default_value' => 'light-text : Light',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5429d45c2e852',
				'label' => 'Button Text',
				'name' => 'button-text',
				'type' => 'text',
				'instructions' => 'Please enter the text which will appear on the button',
				'required' => 1,
				'default_value' => 'Scroll Down',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_542bfacd2d59f',
				'label' => 'Button background color',
				'name' => 'button-background-color',
				'type' => 'color_picker',
				'default_value' => '#ffffff',
			),
			array (
				'key' => 'field_544ab621aefc3',
				'label' => 'Button Text Color',
				'name' => 'button_text_color',
				'type' => 'select',
				'instructions' => 'If you choose a dark background color for a button, you probably gonna need to change text	color to light one.',
				'choices' => array (
					'dark-text' => 'Dark',
					'light-text' => 'Light',
				),
				'default_value' => 'dark-text : Dark',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5429d49b2e853',
				'label' => 'Background Image',
				'name' => 'background-image',
				'type' => 'image',
				'instructions' => 'Upload image to be used as background. For best effect, use image with 1920 x 1200px resolution.',
				'save_format' => 'url',
				'preview_size' => 'full',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'intro',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'the_content',
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_show-post-category',
		'title' => 'Show post category',
		'fields' => array (
			array (
				'key' => 'field_544b9089008f6',
				'label' => 'Show post category',
				'name' => 'show_post_category',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}



