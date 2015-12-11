<?php
/**
 * The template for displaying the footer info
 *
 * @package Seasonal
 */
?>


<footer id="colophon" class="site-footer" role="contentinfo">		        
 
			<nav id="footer-nav" role="navigation">
            	<?php wp_nav_menu( array( 
						'theme_location' => 'footer', 
						'fallback_cb' => false, 
						'depth' => 1,
						'container' => false, 
						'menu_id' => 'footer-menu', 
					) ); 
				?>
          	</nav> 
  
		<div class="site-info copyright">
          <?php _e('Copyright &copy;', 'seasonal'); ?> 
          <?php echo date('Y'); ?> <?php echo esc_html(get_theme_mod( 'copyright', 'Your Name' )); ?>.&nbsp;<?php esc_html_e('All rights reserved.', 'seasonal'); ?>
		</div>          

</footer>