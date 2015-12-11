<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package Seasonal
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">


<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'seasonal' ); ?></a>    
        <div class="sidebar">
            <div class="sidebar-inner">          
                      
              <header id="masthead" class="site-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader" role="banner">
                <div class="site-branding">
                <?php         
                // Header logo image
                  if( get_header_image() ) : ?>
                  
                      <div class="header-image" itemscope itemtype="http://schema.org/Organization">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url">
                          <img src="<?php header_image(); ?>" height="<?php esc_attr( get_custom_header()->height ); ?>" 
                          width="<?php esc_attr( get_custom_header()->width ); ?>" alt="<?php esc_attr( get_bloginfo( 'title' ) ); ?>" itemprop="logo" />
                        </a>
                      </div>                 
                <?php 
                  endif;            
                // Site title & tagline
                if( get_theme_mod( 'show_site_title', 1 ) ) : ?>
                            <div class="site-title" itemprop="headline"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>                            
                        <?php endif; ?>
					  
            	<?php if ( get_theme_mod( 'show_tagline', 1 ) ) : {
                        $description = get_bloginfo( 'description', 'display' );
                        if ( $description || is_customize_preview() ) : ?>
                            <div class="site-description" itemprop="description"><?php echo $description; ?></div>
                        <?php endif;				 		  		  
					  }
				endif;		  
				  
				  
                  // Social links
                  if ( has_nav_menu( 'social' ) ) :
                        echo '<nav class="social-menu" role="navigation">';
                            
                        wp_nav_menu( array(
                            'theme_location' => 'social',
                            'depth'          => 1,
                            'container' => false,
                            'menu_class'         => 'social',
                            'link_before'    => '<span class="screen-reader-text">',
                            'link_after'     => '</span>',
                        ) );
                            
                        echo '</nav>';
                    endif;          
                ?>
                <div class="secondary-navigation">
                    <div class="toggle-buttons">
                      <?php if ( has_nav_menu( 'primary' ) ) : 
					  $mobile_menu_label = esc_attr(get_theme_mod( 'mobile_menu_label', 'Menu' ) );
					  ?>
                        <button class="nav-toggle toggle-button"><?php echo $mobile_menu_label; ?></button>
                      <?php endif; ?>             
                    </div>
                </div>    
                            
                <nav class="site-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement" role="navigation">
               
                <?php 
                // Primary Menu
                      wp_nav_menu( array( 
                            'theme_location'  => 'primary',  
                            'menu_class'      => 'nav-menu',
                            'container'       => 'nav',  
                            'container_class' => 'primary-navigation'
                      ) ); 
                ?>                 
              
                </nav><!-- .site-navigation -->
                
                </div><!-- .site-branding -->
                       
              </header><!-- .site-header -->
             
            </div><!-- .sidebar-inner -->
        </div><!-- .sidebar -->
  
  <div id="content" class="site-content">