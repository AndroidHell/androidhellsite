<?php
/**
 * The template for displaying status post formats
 *
 * @package Seasonal
 * 
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>  itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">

    <header class="entry-header">
    
     <?php echo get_avatar( get_the_author_meta( 'ID' ), 70 ); ?>
     
     <?php seasonal_post_header(); ?>
     
        <div class="category-list">      
            <?php 
			$format = get_post_format();
				if ( current_theme_supports( 'post-formats', $format ) ) {
					printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
					sprintf( '<span class="screen-reader-text">%s </span>', esc_html_x( 'Format', 'Used before post format.', 'seasonal' ) ),
					esc_url( get_post_format_link( $format ) ),
					get_post_format_string( $format )
				);
			}
	 		?>         
        </div>      

 		<div class="entry-meta">
            <?php seasonal_entry_meta(); ?>
        </div>
    </header><!-- .entry-header -->

 

  <div class="entry-content" itemprop="text">
    <?php the_content(); ?>
  </div><!-- .entry-content -->
  
</article><!-- #post-## -->

