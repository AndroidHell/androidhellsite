<?php
/**
 * The default template for displaying the full single post
 *.
 * @package Seasonal
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>  itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">

    <header class="entry-header">
		<?php seasonal_post_header(); ?>             
            <div class="entry-meta">
                <?php seasonal_entry_meta(); ?>
            </div> 
            <?php if( esc_attr(get_theme_mod( 'show_single_thumbnail', 1 ) ) ) :           
                 seasonal_post_thumbnail(); 
             endif; ?>       
    </header>

 

  <div class="entry-content" itemprop="text">
    <?php the_content();
      
		// load our nav is our post is split into multiple pages
		seasonal_multipage_nav(); 
    ?>
  </div>
  
  
 <?php // For post navigation with next and previous
			if( esc_attr(get_theme_mod( 'show_next_prev', 1 ) ) ) {
			seasonal_post_pagination();	
			}
		?> 
  
  
	<?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
		 if( esc_attr(get_theme_mod( 'show_bio', 1 ) ) ) {
			get_template_part( 'author-bio' );
		 }
		endif;
	?> 
  
<footer class="entry-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
	<?php if( esc_attr(get_theme_mod( 'show_tags_list', 1 ) ) ) :
        seasonal_tags_list( '<div class="entry-tags">', '</div>' );
    endif; ?>
    <div class="category-list">      
        <?php if( esc_attr(get_theme_mod( 'show_single_categories', 1 ) ) ) :
            seasonal_categories_list();
        endif; ?>
    </div>	
</footer>
  
</article><!-- #post-## -->
