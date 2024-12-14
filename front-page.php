<?php
/**
 * This file adds the Home Page to the Parallax Pro Theme.
 *
 * @author StudioPress
 * @package Parallax
 * @subpackage Customizations
 */

//* Force full width content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Add parallax-home body class
add_filter( 'body_class', 'parallax_body_class' );
function parallax_body_class( $classes ) {

	$classes[] = 'home';
	return $classes;
	
}
 
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'custom_homepage' );
 
function custom_homepage() { 
global $blogurl;
?>
<style>
.home .site-inner {
	padding: 0px 0px 0px 0px;
	max-width: 100%;
	margin-top: -15px;
}
.home .content {
	padding: 0px !important; /*margin-top: -199px;*/
	width: 100% !important;
}
</style>

<!--Home-Top  ENDS HERE-->


<section class="upnp-services">
    	<div class="boxie box-1">
            <h3><?php the_field("get_title2"); ?></h3>
            <a href="<?php the_field("get_button_link2"); ?>">IoTivity</a>
            <a href="<?php the_field("get_started_button-2"); ?>">Data Models</a>
            <a href="<?php the_field("get_started_button-3"); ?>">OIC Specs</a>
            <a href="<?php the_field("get_started_button-4"); ?>" style="text-transform:none !important;border-right:none;">UPnP Specs</a><br>
            <a href="/resources/" class="button">View More</a>
        </div>
    	<div class="boxie box-2">
        	<h3 style="margin-bottom: 10px;"><?php the_field("get_title1"); ?></h3>
            <p><?php the_field("get_description1"); ?></p>
            <a href="<?php the_field("get_button_link1"); ?>" class="button">News & Events</a>
        </div>
        <div class="boxie box-3">
            <h3><?php the_field("get_title3"); ?></h3>
            <p><?php the_field("get_description3"); ?></p>
            <a href="<?php the_field("get_button_link3"); ?>" class="button">Become a Member</a>
        </div>
</section>

<section class="what-upnp">
	<h2><?php the_field("what_upnp_main_title"); ?></h2>
	<div class="wrap">
    	<?php the_field("what_upnp_descriptions"); ?><a href="<?php the_field("what_upnp_learnmore_link"); ?>" class="button">Learn More</a>
    </div>
</section>


<section class="upnp-model">
	<h2><?php the_field("section_heading_latestmodels"); ?></h2>
	<div class="wrap">
    	<p style="font-size:16px; margin-bottom:20px;"><?php the_field("models_main_descriptions"); ?>  <a href="http://oneiota.org/" target="_blank" class="greenlink" style="white-space: nowrap;">View All Models &raquo;</a></p>
    	<?php dynamic_sidebar( 'testimonials-home' ); ?>
    </div>
    
    <script>
		jQuery('.srr-wrap .srr-item:first-child').prepend('<div class="hardware-icon"></div>');
		jQuery('.srr-wrap .srr-item:nth-child(2)').prepend('<div class="hardware-icon2"></div>');
		jQuery('.srr-wrap .srr-item:nth-child(3)').prepend('<div class="hardware-icon"></div>');
	</script>  

</section>

<section class="example-upnp">
	<h2><?php the_field("section_heading_oic_inaction"); ?></h2>
	<div class="wrap">
    	<div class="one-third first exboxie">
        	<img src="<?php the_field("example_upload_image1"); ?>"/>
            <h4><?php the_field("example_main_title1"); ?></h4>
            <p><?php the_field("example_descriptions1"); ?></p>
        </div>
        <div class="one-third exboxie">
        	<img src="<?php the_field("example_upload_image2"); ?>"/>
            <h4><?php the_field("example_main_title2"); ?></h4>
            <p><?php the_field("example_descriptions2"); ?></p>
        </div>
        <div class="one-third exboxie">
        	<img src="<?php the_field("example_upload_image3"); ?>"/>
            <h4><?php the_field("example_main_title3"); ?></h4>
            <p><?php the_field("example_descriptions3"); ?></p>
        </div>
    </div>
</section>


<section class="featured-blog">
	
    <div class="one-half first">
    <div class="wrap">
    	<h3><?php the_field("section_heading_latestnews"); ?></h3>
    	<p>Read the latest press releases, newsletters and articles. <a href="/news-events/" class="bluelink">View All News &raquo;</a></p>
    	<?php dynamic_sidebar( 'genesis-featured-posts' ); ?>
   </div>
    </div>
    
    <div class="one-half upcoming-events">
    <div class="wrap">
    	<h3><?php the_field("section_heading_upc_events"); ?></h3>
        <p><?php the_field("section_description_upc_events"); ?> <a href="<?php the_field("home_view_event_link"); ?>" class="bluelink">View All Events &raquo;</a></p>
    	<?php dynamic_sidebar( 'genesis-featured-events' ); ?>
    </div>
    </div>

</section>


<section class="member-upnp">
	<h2><?php the_field("section_heading_becomemember"); ?></h2>
	<div class="wrap">
    	<p><?php the_field("member_descriptions"); ?></p>
        <a href="<?php the_field("become_a_member_link"); ?>" class="button">Become a Member</a>
    </div>
</section>



<?php /*?>
<?php dynamic_sidebar( 'testimonials-home' ); ?>
<?php echo get_stylesheet_directory_uri() ?>/
<?php */?>

<?php }
 
//* Run the Genesis loop
genesis();