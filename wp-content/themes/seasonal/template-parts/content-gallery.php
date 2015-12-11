<?php
/**
 * The template for displaying gallery post formats
 *
 * @package Seasonal
 * 
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>  itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">

    <header class="entry-header">
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
 
 		<?php seasonal_post_thumbnail(); ?>        
 
 		<div class="entry-meta">
            <?php seasonal_entry_meta(); ?>
        </div>
    </header><!-- .entry-header -->

 

  <div class="entry-content" itemprop="text">
    <?php
      /* translators: %s: Name of current post */
			the_content( sprintf(
				esc_html__( 'See More %s', 'seasonal' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );
			
    // load our nav is our post is split into multiple pages
	seasonal_multipage_nav(); 
    ?>
  </div><!-- .entry-content -->
  
  <footer class="entry-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
  <?php
    if( is_single() && esc_attr(get_theme_mod( 'show_tags_list', 1 ) ) ) {
      seasonal_tags_list( '<div class="entry-tags">', '</div>' );
    }
  ?>
  </footer><!-- .entry-footer -->
</article><!-- #post-## -->
