<?php
/**
 * The template used for displaying page content
 *
 * @package Seasonal
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>  itemscope="itemscope" itemtype="http://schema.org/CreativeWork">
  <div class="article-body" itemprop="articleBody">
      <header class="entry-header">
        <?php 
          the_title( '<h1 class="entry-title" itemprop="name">', '</h1>' );
          
          
          if( esc_attr(get_theme_mod( 'show_edit', 1 ) ) ) {
                  edit_post_link( esc_html__( 'Edit this Post', 'seasonal' ), '<div class="entry-meta"><span class="edit-link post-meta">', '</span></div>' );
                }
        ?>
      </header>
    
    	<?php seasonal_post_thumbnail(); ?>
    
        <div class="entry-content" itemprop="text">
          <?php 
          the_content();
          
          wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'seasonal' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
            'pagelink'    => ' %',
            'separator'   => ', ',
          ) );
            ?>
          </div>
    
    	<footer class="entry-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter"></footer>
    </div>
</article>
