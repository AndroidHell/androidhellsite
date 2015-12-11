<?php
/**
 * Custom template tags
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Seasonal
 */



/**
 * Blog post header
 * Displays the post title with or without the sticky label.
 * Displays categories in the summary view with option to show or hide.
 */

if ( ! function_exists( 'seasonal_post_header' ) ) :

function seasonal_post_header() { 

   if( is_sticky() && is_home() ) :
      printf( '<span class="featured">%s</span>', esc_attr(get_theme_mod( 'sticky_post_label' )) ? esc_html( get_theme_mod( 'sticky_post_label' ) ) : esc_html__( 'Featured', 'seasonal' ) );
    endif;
    
    if ( is_single() ) :
	
        echo '<h1 class="entry-title"  itemprop="headline">';		
		if(the_title( '', '', false ) !='') the_title(); 
			else esc_html_e('Untitled', 'seasonal'); 
		echo '</h1>';
	  
    else :
	
      echo '<h2 class="entry-title"  itemprop="headline"><a href="' .esc_url( get_permalink() ) .'">';		
		if(the_title( '', '', false ) !='') the_title(); 
			else esc_html_e('Untitled', 'seasonal'); 
		echo '</a></h2>';
	  
    endif;
}
endif;

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'Continue reading' link.
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
if ( ! function_exists( 'seasonal_excerpt_more' ) && ! is_admin() ) :

function seasonal_excerpt_more( $more ) {
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( esc_html__( 'Continue reading %s', 'seasonal' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
		);
	return ' &hellip; ' . $link;
}
endif;


if ( ! function_exists( 'seasonal_post_thumbnail' ) ) : 
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function seasonal_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
        <?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title(), 'itemprop' => "image")); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php
			the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title(), 'itemprop' => "image"));
		?>
	</a>

	<?php endif; // End is_singular()
}
endif; 
 

if ( ! function_exists( 'seasonal_entry_meta' ) ) :
  /**
   * Prints HTML with meta information for the categories, post date.
   */
  function seasonal_entry_meta() {
    if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) && get_theme_mod( 'show_posted_date', 1 ) ) {
      seasonal_posted_on( sprintf( '%s', esc_html_x( 'Posted on', 'Used before publish date.', 'seasonal' ) ) );
    }

	if ( 'post' == get_post_type() ) {
		if ( is_singular() || is_multi_author() ) {
			if (esc_attr(get_theme_mod( 'show_post_author', 1 ))):
			printf( '<span class="byline post-meta" itemprop="author" itemscope="" itemtype="http://schema.org/Person"><span class="author vcard">%1$s <a class="url fn n" href="%2$s" itemprop="url"><span itemprop="name">%3$s</span></a></span></span>',
				esc_html_x( 'Author', 'Used before post author name.', 'seasonal' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				get_the_author()
			);
			endif;
		}	
	}
			
	if( esc_attr(get_theme_mod( 'show_edit', 1 ) ) ) {
              edit_post_link( esc_html__( 'Edit this Post', 'seasonal' ), '<span class="edit-link post-meta">', '</span>' );
            }		
  	}
endif;

/**
 * Prints HTML with date the post was created.
 */
if ( ! function_exists( 'seasonal_posted_on' ) ) :

  function seasonal_posted_on( $before = '', $after = '' ) {
    $time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time>';

    $time_string = sprintf( $time_string,
      esc_attr( get_the_date( 'c' ) ),
      get_the_date()
    );

    printf( '<span class="posted-on post-meta">%s %s%s</span>', $before, $time_string, $after );
  }
endif;

/**
 * Prints HTML with post categories list.
 */
if ( ! function_exists( 'seasonal_categories_list' ) ) :

  function seasonal_categories_list() {
    $categories_list = get_the_category_list( esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'seasonal' ) );
    if ( $categories_list && seasonal_categorized_blog() && is_single() ) {
      printf( '<span class="category-label">%1$s</span> <span itemprop="genre">%2$s</span>',
				esc_html_x( 'Categories:', 'Used before category names.', 'seasonal' ), $categories_list );			  
   		}
		else {
			printf( '<span class="category-links" itemprop="genre">%s</span>', $categories_list );
		}
  }
endif;

/**
 * Prints HTML with post tags list.
 */
if ( ! function_exists( 'seasonal_tags_list' ) ) :

  function seasonal_tags_list() {
	
	$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'seasonal' ) );
		if ( $tags_list ) {
			printf( '<span class="tag-list"><span class="tags-label">%1$s</span> %2$s</span>',
				esc_html_x( 'Tags:', 'Used before tag names.', 'seasonal' ),
				$tags_list
			);
		}	
  }
endif;


/**
 * Check if post has more tag.
 */
function seasonal_has_more() {
  global $post;
  
  if( is_singular() )
    return false;
  
  if( strpos( $post->post_content, '<!--more-->' ) )
    return true;
  
  return false;
}


/**
 * Blog pagination when more than one page of post summaries.
 *
 * @since Seasonal 1.0.0
 */

if ( ! function_exists( 'seasonal_blog_pagination' ) ) :
function seasonal_blog_pagination() {	
	the_posts_pagination( array(
		'prev_text'      => '<span class="previous">' . esc_html__( 'Prev', 'seasonal' ) . '</span>',		
		'next_text'      => '<span class="next">' . esc_html__( 'Next', 'seasonal' ) . '</span>',		
		'before_page_number' => ''
	) );	
}
endif;

/**
 * Single Post previous or next navigation.
 *
 * @since Seasonal 1.0.0
 */

if ( ! function_exists( 'seasonal_post_pagination' ) ) :
function seasonal_post_pagination() {
	the_post_navigation( array(	
		'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next Article', 'seasonal' ) . '</span> ' .
			'<span class="screen-reader-text">' . esc_html__( 'Next Article:', 'seasonal' ) . '</span> ' .
			'<span class="post-title">%title</span>',
			
		'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous Article', 'seasonal' ) . '</span> ' .
			'<span class="screen-reader-text">' . esc_html__( 'Previous Article:', 'seasonal' ) . '</span> ' .
			'<span class="post-title">%title</span>',
	) );
}
endif;

/**
 * Multi-page navigation.
 *
 * @since Seasonal 1.0.0
 */

if ( ! function_exists( 'seasonal_multipage_nav' ) ) :
function seasonal_multipage_nav() {
	wp_link_pages( array(
		'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'seasonal' ) . '</span>',
		'after'       => '</div>',
		'link_before' => '<span>',
		'link_after'  => '</span>',
		'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'seasonal' ) . ' </span>%',
		'separator'   => ', ',
	) );	
	
}
endif;



