<?php



//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'parallax', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'parallax' ) );

//* Add Image upload to WordPress Theme Customizer
add_action( 'customize_register', 'parallax_customizer' );
function parallax_customizer(){

	require_once( get_stylesheet_directory() . '/lib/customize.php' );

}

//* Include Section Image CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Parallax Pro Theme' );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/parallax/' );
define( 'CHILD_THEME_VERSION', '1.2' );


	//wp_deregister_script('jquery');( 'jquery-ui-core' );
    //wp_deregister_script('jquery');( 'jquery-ui-datepicker' );
	//wp_deregister_script('jquery');( 'jquery-ui-datepicker-local' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'parallax_enqueue_scripts_styles' );
function parallax_enqueue_scripts_styles() {


	wp_enqueue_script( 'parallax-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );
	//wp_enqueue_script( 'thrive-jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js', array( 'jquery' ), '2.2.0' );
	wp_enqueue_script( 'thrive-custom-jquery', get_bloginfo( 'stylesheet_directory' ) . '/js/custom.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'datatables', 'https://cdn.datatables.net/v/zf/dt-1.10.12/datatables.min.js', array( 'jquery' ), '1.10.12' );
	wp_enqueue_script( 'ocf-product-list', get_bloginfo( 'stylesheet_directory' ) . '/js/ocf_product_list.js', array( 'jquery', 'datatables' ), '1.0.0' );

	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'customcss', get_bloginfo( 'stylesheet_directory' ) . '/custom.css', array() );
	wp_enqueue_style( 'product_library', get_bloginfo( 'stylesheet_directory' ) . '/stylesheets/product_library.css', array() );
	wp_enqueue_style( 'fontawesome', get_bloginfo( 'stylesheet_directory' ) . '/font-awesome/css/font-awesome.css', array() );
	wp_enqueue_style( 'Roboto-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic', array(), CHILD_THEME_VERSION );

}


//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_nav' );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 7 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'parallax_secondary_menu_args' );
function parallax_secondary_menu_args( $args ){

	if( 'secondary' != $args['theme_location'] )
	return $args;

	$args['depth'] = 1;
	return $args;

}

//* Use h1 for site title
function ea_h1_for_site_title( $wrap ) {
if (is_front_page()) {
    return 'h1';
} else {
    return 'p';
  }
}
add_filter( 'genesis_site_title_wrap', 'ea_h1_for_site_title' );

// Genesis Post Widget
add_image_size( 'Genesis-post-thumbnail', 350, 180, true );

//* Unregister layout settings
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

//* Add support for additional color styles
add_theme_support( 'genesis-style-selector', array(
	'parallax-pro-blue'   => __( 'Parallax Pro Blue', 'parallax' ),
	'parallax-pro-green'  => __( 'Parallax Pro Green', 'parallax' ),
	'parallax-pro-orange' => __( 'Parallax Pro Orange', 'parallax' ),
	'parallax-pro-pink'   => __( 'Parallax Pro Pink', 'parallax' ),
) );

//* Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 360,
	'height'          => 70,
	'header-selector' => '.site-title a',
	'header-text'     => false,
) );

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'subnav',
	'footer-widgets',
	'footer',
) );

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'parallax_author_box_gravatar' );
function parallax_author_box_gravatar( $size ) {

	return 176;

}

//* Modify the size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'parallax_comments_gravatar' );
function parallax_comments_gravatar( $args ) {

	$args['avatar_size'] = 120;

	return $args;

}

//* Include Custom banner for home and subpages
add_action( 'genesis_after_header', 'banner' );

function banner() {

 if (is_front_page()) {
		require(CHILD_DIR.'/home-banner.php');
	 }
  // If it's the About page, display subpage banner
	elseif ( is_page()) {
		require(CHILD_DIR.'/subpage-banner.php');
	}
	elseif ( is_single()) {
		require(CHILD_DIR.'/subpage-banner.php');
	}
	elseif ( is_archive()) {
		require(CHILD_DIR.'/subpage-banner.php');
	}
	elseif(is_home()) {
		require(CHILD_DIR.'/subpage-banner.php');
	}
	elseif(is_404()) {
		require(CHILD_DIR.'/subpage-banner.php');
	}
	elseif(is_search()) {
		require(CHILD_DIR.'/subpage-banner.php');
	}else{
		require(CHILD_DIR.'/subpage-banner.php');
	}


}

// Add Read More Link to Excerpts

add_filter('excerpt_more', 'get_read_more_link');
add_filter( 'the_content_more_link', 'get_read_more_link' );

function get_read_more_link() {

   return '...&nbsp;<a class="readmore" href="' . get_permalink() . '">[Read&nbsp;More]</a>';

}

// Customize the post info function
add_filter( 'genesis_post_info', 'post_info_filter' );
function post_info_filter($post_info) {
	$post_info = 'Posted on: [post_date]';
	return $post_info;
}

// Button Shortcode
function download_button($atts, $content = null) {
 extract( shortcode_atts( array(
          'url' => '#'
), $atts ) );
return '<a href="'.$url.'" class="wpbutton"><span>' . do_shortcode($content) . '</span></a>';
}
add_shortcode('download', 'download_button');


//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 2 );

// Genesisi Custom image size
add_image_size( 'genesis-image-size', 232, 124, true );

remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
add_action( 'genesis_footer', 'genesis_footer_widget_areas', 5 );

/* Genesis - Remove breadcrumbs */
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

/** Remove page/post/attachment titles */
add_action( 'get_header', 'remove_titles_all_single_pages' );
function remove_titles_all_single_pages() {
    if ( is_singular('page') ) {
        remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
    }
}
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

//Changing the Copyright text
function genesischild_footer_creds_text () {
 $copyrightyear = date("Y");
 $thrivelogo = get_stylesheet_directory_uri();
 echo '<div class="footer-credits">
  <p class="copyright">Copyright © '. $copyrightyear . ' - All rights reserved  &nbsp;|&nbsp; <a href="/site-map/">Sitemap</a> &nbsp;|&nbsp; <a href="/privacy-policy/">Privacy Policy</a> &nbsp;|&nbsp; <a href="/terms-of-use/">Terms of Use</a> &nbsp;|&nbsp; Site by <a target="_blank" href="http://thrivenetmarketing.com/"><img class="svg" src="'. $thrivelogo .'/images/thrive-logo.png"></a></p>
  <p class="credits">The Open Connectivity Foundation Certification Mark and Word Mark and the Open Connectivity Foundation&trade; Logo and Word Mark are trademarks or registered trademarks of Open Connectivity Foundation, Inc.</p>
  <p class="credits">All rights reserved. Unauthorized use is strictly prohibited.</p>
</div>';
}
add_filter( 'genesis_footer_creds_text', 'genesischild_footer_creds_text' );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Relocate after entry widget
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );


// Widget - Latest News on home page
genesis_register_sidebar( array(
	'id'			=> 'genesis-featured-posts',
	'name'			=> __( 'Latest News on Home Page', 'timothy' ),
	'description'	=> __( 'This is home page widget', 'timothy' ),
));

// Widget - Latest Events on home page
genesis_register_sidebar( array(
	'id'			=> 'genesis-featured-events',
	'name'			=> __( 'Upcoming Events on Home Page', 'timothy' ),
	'description'	=> __( 'This is home page widget', 'timothy' ),
));

// Widget - Testimonials on home page
genesis_register_sidebar( array(
	'id'			=> 'testimonials-home',
	'name'			=> __( 'Testimonials', 'timothy' ),
	'description'	=> __( 'This is home page widget', 'timothy' ),
));

// Widget - Utility Bar above header
genesis_register_sidebar( array(
	'id'			=> 'social-home',
	'name'			=> __( 'Social Bar Above Header', 'timothy' ),
	'description'	=> __( 'This is home page widget', 'timothy' ),
));

//* Rotate image using Sub Tag
function random_hero_img($tag) {

	$args = array( 'post_type' => 'attachment',
				// 'post_status' => 'publish',
				'orderby' => 'rand',
				'post_mime_type' => 'image',
				'post_status' => 'inherit',
				'tax_query' => array(
					array(
						'taxonomy' => 'media_tag',
						'field' => 'slug',
						'terms' => $tag
					)

						));
    $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post();
		  $image = wp_get_attachment_image_src('', $size, false);

		endwhile;
		wp_reset_query();
		$header_url = $image[0];
  return $header_url;

}


// Previous / Next Post Navigation Filter
add_filter( 'genesis_prev_link_text', 'gt_review_prev_link_text' );
function gt_review_prev_link_text() {
        $prevlink = '&laquo;';
        return $prevlink;
}
add_filter( 'genesis_next_link_text', 'gt_review_next_link_text' );
function gt_review_next_link_text() {
        $nextlink = '&raquo;';
        return $nextlink;
}

// custom excerpt length
function themify_custom_excerpt_length( $length ) {
   return 17;
}
add_filter( 'excerpt_length', 'themify_custom_excerpt_length', 999 );

// add more link to excerpt
function themify_custom_excerpt_more($more) {
   global $post;
   return ' ... <a class="more-link" href="'. get_permalink($post->ID) . '">'. __('[Read More...]', 'themify') .'</a>';
}
add_filter('excerpt_more', 'themify_custom_excerpt_more');

// Changes the escerpt length for main events description to 100 words
function custom_excerpt_length( $length ) {
  if( tribe_is_event() && is_archive() ) {
    return 60;
  } else {
	return 17;
  }
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

add_filter('tribe_get_events_title', 'my_get_events_title');
function my_get_events_title($title) {
if( tribe_is_month() && !is_tax() ) { // The Main Calendar Page
    return 'Events Calendar';
} elseif( tribe_is_month() && is_tax() ) { // Calendar Category Pages
    return 'Events Calendar' . ' &raquo; ' . single_term_title('', false);
} elseif( tribe_is_event() && !tribe_is_day() && !is_single() ) { // The Main Events List
    return 'Events List';
} elseif( tribe_is_event() && is_single() ) { // Single Events
    return get_the_title();
} elseif( tribe_is_day() ) { // Single Event Days
    return 'Events on: ' . date('F j, Y', strtotime($wp_query->query_vars['eventDate']));
} elseif( tribe_is_venue() ) { // Single Venues
    return $title;
} else {
    return $title;
}
}


add_action('admin_menu', 'ocf_add_product_archive_settings_page');

function ocf_add_product_archive_settings_page() {
	add_submenu_page('edit.php?post_type=upnp_product', 'Certified Products Archive Page', 'Archive Settings Test', 'manage_options', 'certified-product-archive-settings');
}

// Gravity Forms confirmation anchor on all forms
add_filter( 'gform_confirmation_anchor', '__return_true' );
