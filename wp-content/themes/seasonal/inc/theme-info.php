<?php
/**
 * Theme information page for the admin
 * attached to the Appearance Menu group.
 *
 * @package Seasonal
 */

//Add the theme page
add_action('admin_menu', 'seasonal_add_theme_info');
function seasonal_add_theme_info(){
	$theme_info = add_theme_page( esc_html__('Seasonal Info','seasonal'), esc_html__('Seasonal Info','seasonal'), 'manage_options', 'seasonal-info.php', 'seasonal_info_page' );
    add_action( 'load-' . $theme_info, 'seasonal_info_hook_styles' );
}

//Callback
function seasonal_info_page() {
?>
	<div class="info-container">
		<h2 class="info-title"><?php esc_html_e('Seasonal Info','seasonal'); ?></h2>
		<div class="info-block"><div class="dashicons dashicons-book-alt info-icon"></div>
        	<p class="info-text"><a href="http://www.shapedpixels.com/setup-seasonal/" target="_blank"><?php esc_html_e('Setup Tutorials','seasonal'); ?></a></p></div>
		<div class="info-block"><div class="dashicons dashicons-sos info-icon"></div>
        	<p class="info-text"><a href="https://wordpress.org/support/theme/seasonal" target="_blank"><?php esc_html_e('Support','seasonal'); ?></a></p></div>
 		<div class="info-block"><div class="dashicons dashicons-testimonial info-icon"></div>
 			<p class="info-text"><a href="https://wordpress.org/support/view/theme-reviews/seasonal" target="_blank"><?php esc_html_e('Submit a Testimonial','seasonal'); ?></a></p></div>	       
		<div class="info-block"><div class="dashicons dashicons-desktop info-icon"></div>
        	<p class="info-text"><a href="http://demo.shapedpixels.com/seasonal" target="_blank"><?php esc_html_e('Theme demo','seasonal'); ?></a></p></div>
         <div class="info-block"><div class="dashicons dashicons-smiley info-icon"></div>
        	<p class="info-text"><a href="http://www.shapedpixels.com/seasonal-pro" target="_blank"><?php esc_html_e('Seasonal Pro Version','seasonal'); ?></a></p></div>           
	</div>
<?php
}

//Styles
function seasonal_info_hook_styles(){
   	add_action( 'admin_enqueue_scripts', 'seasonal_info_page_styles' );
}
function seasonal_info_page_styles() {
	wp_enqueue_style( 'seasonal-info-style', get_template_directory_uri() . '/css/info-page.css', array(), true );
}