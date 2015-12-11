<?php
/**
 * Add inline styles to the head area
 * These styles represents options from the customizer
 * @package Seasonal
 */
 
 // Dynamic styles
function seasonal_inline_styles($custom) {

// base font size
	$base_font_size = get_theme_mod( 'base_font_size', '100' );
	$custom .= "html { font-size: " . esc_attr($base_font_size) . "%;}"."\n";
	
// link colour
	$link_colour = get_theme_mod( 'link_colour', '#7599c5' );
	$custom .= "a, a:visited {color:" . esc_attr($link_colour) . "}"."\n";
	
// link colour hover
	$link_colour_hover = get_theme_mod( 'link_colour_hover', '#424242' );
	$custom .= "a:hover,a:focus,a:active {color:" . esc_attr($link_colour_hover) . "}"."\n"; 

// site title
	$site_title = get_theme_mod( 'site_title', '#ffffff' );
	$site_title_size = get_theme_mod( 'site_title_size', '3rem' );
	$custom .= ".site-title a {font-size:" . esc_attr($site_title_size) . " ; color:" . esc_attr($site_title) . "}"."\n"; 	

// site description
	$site_tagline = get_theme_mod( 'site_tagline', '#ffffff' );
	$site_description_size = get_theme_mod( 'site_description_size', '1rem' );
	$custom .= ".site-description {font-size:" . esc_attr($site_description_size) . "; color:" . esc_attr($site_tagline) . "}"."\n";

// social  colour
	$social_bg = get_theme_mod( 'social_bg', '' );
	$social_icon = get_theme_mod( 'social_icon', '#ffffff' );
	$custom .= ".social a { color: " . esc_attr($social_icon) . "; background-color:" . esc_attr($social_bg) . "}"."\n";	
	
// social  hover colour
	$social_bg_hover = get_theme_mod( 'social_bg_hover', '' );
	$social_icon_hover = get_theme_mod( 'social_icon_hover', '#cccccc' );
	$custom .= ".social a:hover { color: " . esc_attr($social_icon_hover) . "; background-color:" . esc_attr($social_bg_hover) . "}"."\n";	

// toggle button
	$toggle_border = get_theme_mod( 'toggle_border', '#d7d7d7' );
	$toggle_label = get_theme_mod( 'toggle_label', '#e7e7e7' );
	$custom .= ".toggle-button { color: " . esc_attr($toggle_label) . "; border-color:" . esc_attr($toggle_border) . "}"."\n";	

// toggle button hover
	$toggle_border_hover = get_theme_mod( 'toggle_border_hover', '#ffffff' );
	$toggle_label_hover = get_theme_mod( 'toggle_label_hover', '#ffffff' );
	$custom .= ".toggle-button:hover { color: " . esc_attr($toggle_label_hover) . "; border-color:" . esc_attr($toggle_border_hover) . "}"."\n";	

// buttons
	$button_bg_colour = get_theme_mod( 'button_bg_colour', '#838588' );
	$button_text_colour = get_theme_mod( 'button_text_colour', '#ffffff' );
	$custom .= ".btn,button,input[type=\"submit\"],input[type=\"reset\"] { color: " . esc_attr($button_text_colour) . "; background-color:" . esc_attr($button_bg_colour) . "}"."\n";	

// buttons hover
	$button_bg_on_hover = get_theme_mod( 'button_bg_on_hover', '#6a6c6f' );
	$button_text_on_hover = get_theme_mod( 'button_text_on_hover', '#ffffff' );
	$custom .= ".btn:hover,button:hover,input[type=\"submit\"]:hover,input[type=\"reset\"]:hover { color: " . esc_attr($button_text_on_hover) . "; background-color:" . esc_attr($button_bg_on_hover) . "}"."\n";	

// headings
	$heading_colour = get_theme_mod( 'heading_colour', '#424242' );
	$custom .= "h1, h2, h3, h4, h5, h6, .entry-title a { color: " . esc_attr($heading_colour) . ";}"."\n";	

// subtitle
	$subtitle_colour = get_theme_mod( 'subtitle_colour', '#222222' );
	$custom .= ".subtitle { color: " . esc_attr($subtitle_colour) . ";}"."\n";	

// pagination
	$pagination_text = get_theme_mod( 'pagination_text', '#7599c5' );
	$pagination_bg = get_theme_mod( 'pagination_bg', '#f5f5f5' );
	$custom .= ".pagination .page-numbers { color: " . esc_attr($pagination_text) . "; background-color:" . esc_attr($pagination_bg) . "}"."\n";	

// pagination hover
	$pagination_current_text_color = get_theme_mod( 'pagination_current_text_color', '#ffffff' );
	$pagination_current_background = get_theme_mod( 'pagination_bg', '#94a3b6' );
	$custom .= ".pagination .page-numbers:hover,.pagination .page-numbers.current { color: " . esc_attr($pagination_current_text_color) . "; background-color:" . esc_attr($pagination_current_background) . "}"."\n";	

// menu
	$menu_link_colour = get_theme_mod( 'menu_link_colour', '#ffffff' );
	$custom .= ".primary-navigation .nav-menu li a,
	.primary-navigation .menu-item-has-children > a:after,
	.primary-navigation .menu-item-has-children > a:hover:after,
	.primary-navigation li.home.current-menu-item a, 
	.site-navigation a { color: " . esc_attr($menu_link_colour) . ";}"."\n";	

// menu hover active
	$menu_link_hover_colour = get_theme_mod( 'menu_link_hover_colour', '#d1c4a5' );
	$custom .= ".site-navigation li.current_page_item a,
	.primary-navigation li.current-menu-item a, 
	.primary-navigation a:hover, 
	.primary-navigation .sub-menu a:hover,
	.primary-navigation .nav-menu > li > a:hover { color: " . esc_attr($menu_link_hover_colour) . ";}"."\n";	

// menu item size
	$menu_font_size = get_theme_mod( 'menu_font_size', '1.438rem' );
	$submenu_font_size = get_theme_mod( 'submenu_font_size', '1.063rem' );
	$custom .= ".primary-navigation li, .site-navigation li { font-size: " . esc_attr($menu_font_size) . ";}
		.primary-navigation .sub-menu li { font-size: " . esc_attr($submenu_font_size) . ";}"."\n";	

// heading sizes
	$h1_font_size = get_theme_mod( 'h1_font_size', '2rem' );
	$h2_font_size = get_theme_mod( 'h2_font_size', '1.75rem' );
	$h3_font_size = get_theme_mod( 'h3_font_size', '1.5rem' );
	$h4_font_size = get_theme_mod( 'h4_font_size', '1.25rem' );
	$h5_font_size = get_theme_mod( 'h5_font_size', '1rem' );
	$h6_font_size = get_theme_mod( 'h6_font_size', '0.875rem' );
	$bottom_widget_title_size = get_theme_mod( 'bottom_widget_title_size', '1.125rem' );
	$custom .= "h1 { font-size: " . esc_attr($h1_font_size) . ";} h2 { font-size: " . esc_attr($h2_font_size) . ";}	h3 { font-size: " . esc_attr($h3_font_size) . ";}	h4 { font-size: " . esc_attr($h4_font_size) . ";}
	h5 { font-size: " . esc_attr($h5_font_size) . ";}	h6 { font-size: " . esc_attr($h6_font_size) . ";} #bottom-sidebar h4 { font-size: " . esc_attr($bottom_widget_title_size) . ";}"."\n";	

// main content text size
	$content_text_size = get_theme_mod( 'content_text_size', '0.875rem' );
	$comment_text_size = get_theme_mod( 'comment_text_size', '0.813rem' );
	$custom .= ".site-content { font-size: " . esc_attr($content_text_size) . ";} .comment-text { font-size: " . esc_attr($comment_text_size) . ";}"."\n";	

// sidebar width	
	$sidebar_width = get_theme_mod( 'sidebar_width', '33' );
	$custom .= "@media (min-width: 992px) {
		.sidebar { width: " . esc_attr($sidebar_width) . "%;} 
		.site-content,	.secondary{margin-left: " . esc_attr($sidebar_width) . "%;}}"."\n";
				
// float menu up		
	if( esc_attr(get_theme_mod( 'sidebar_menu_up', 0 ) ) ) {
		$custom .= "@media (min-width: 992px) {
			.site-branding { display: block;} }"."\n";
	}

// article width	
	if( esc_attr(get_theme_mod( 'content_width', 1 ) ) ) {
		$custom .= "@media (min-width: 1200px) {
			.hentry { max-width: 100%;} }"."\n";
	}		

// Post aligment of center or left
	$blogalign = esc_attr(get_theme_mod( 'blog_alignment', 'left' ) );            
	switch ($blogalign) {
	// Centered
	case "center" :
		$custom .= '.more-link:before {margin: 20px auto;}
		.wp-post-image {margin: 20px auto 30px;}
		.category-header, .category-description,
		.search-results .page-header, 
		.blog #colophon, 
		.page-links,
		.page-template-template-centered #colophon,
		.blog .hentry,.archive .page-header, 
		.format-aside p {text-align:center;}';
	break;
	// Left
	case "left" :
		$custom .= '.more-link:before {margin: 20px 0;}
		.wp-post-image {margin: 20px 0 30px;}
		.format-quote blockquote {margin-left:0;}
		.search-results .page-header, 
		.page-links,.hentry,
		.archive .page-header, 
		.format-aside p {text-align: left;}';
	break;			
	}


	
	//Output all the styles
	wp_add_inline_style( 'seasonal-style', $custom );	
}
add_action( 'wp_enqueue_scripts', 'seasonal_inline_styles' );	