<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Seasonal
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
 

 
function seasonal_body_classes( $classes ) {
	if( ! esc_attr(get_theme_mod( 'show_preloader', 1 ) ) ) {
		$classes[] = 'loaded';
	}

	return $classes;
}
add_filter( 'body_class', 'seasonal_body_classes' );




if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function seasonal_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'seasonal' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'seasonal_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function seasonal_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'seasonal_render_title' );
endif;

/**
 * Move the More Link outside from the contents last summary paragraph tag.
 */
if ( ! function_exists( 'seasonal_move_more_link' ) ) :
	function seasonal_move_more_link($link) {
			$link = '<p class="read-more">'.$link.'</p>';
			return $link;
		}
	add_filter('the_content_more_link', 'seasonal_move_more_link');
endif;

/**
 * Adding a customizable Read More link to excerpts outside of the paragraph.
 */
if ( ! function_exists( 'seasonal_new_excerpt_more' ) ) : 
function seasonal_new_excerpt_more( $more ) {
	return '<span class="excerpt-ellipsis">...</span><p><a class="more-link" href="'. get_permalink( get_the_ID() ) . '" itemprop="url">' . esc_html__('Continue Reading', 'seasonal') . '</a></p>';
}
add_filter( 'excerpt_more', 'seasonal_new_excerpt_more' );
endif;


/**
 * Prevent page scroll after clicking read more to load the full post.
 */
if ( ! function_exists( 'seasonal_remove_more_link_scroll' ) ) : 
	function seasonal_remove_more_link_scroll( $link ) {
		$link = preg_replace( '|#more-[0-9]+|', '', $link );
		return $link;
		}
	add_filter( 'the_content_more_link', 'seasonal_remove_more_link_scroll' );
endif;	


/**
 * Special thanks to Justin Tadlock for this.
 *
 * http://justintadlock.com/archives/2012/08/27/post-formats-quote
 */

function seasonal_my_quote_content( $content ) {

	/* Check if we're displaying a 'quote' post. */
	if ( has_post_format( 'quote' ) ) {

		/* Match any <blockquote> elements. */
		preg_match( '/<blockquote.*?>/', $content, $matches );

		/* If no <blockquote> elements were found, wrap the entire content in one. */
		if ( empty( $matches ) )
			$content = "<blockquote>{$content}</blockquote>";
	}

	return $content;
}
add_filter( 'the_content', 'seasonal_my_quote_content' );

/**
 * Customize the More Link label on post summaries.
 */	
function seasonal_custom_readmore() {
    $custom_readmore = get_theme_mod( 'custom_readmore' ) ? get_theme_mod( 'custom_readmore' ) : esc_html__( 'Continue Reading', 'seasonal' );
  
    return '<a class="more-link" href="' . esc_url( get_permalink() ). '">' . esc_html( $custom_readmore ) . '</a>';
  }
  
add_filter( 'the_content_more_link', 'seasonal_custom_readmore', 10, 2  );


/**
 * Print the attached image with a link to the next attached image.
 * Maximum width is 1140 pixels for this theme.
 */
if ( ! function_exists( 'seasonal_the_attached_image' ) ) :

function seasonal_the_attached_image() {
	$post                = get_post();

	$attachment_size     = apply_filters( 'seasonal_attachment_size', array( 1140, 1140 ) );
	$next_attachment_url = wp_get_attachment_url();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;


/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 * Custom filter for changing the default archive title labels.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
 
if ( ! function_exists( 'seasonal_the_archive_title' ) ) :

function seasonal_the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( ( '%s' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( esc_html__( 'Posts Tagged with %s', 'seasonal' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( esc_html__( 'Articles by %s', 'seasonal' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( esc_html__( 'Articles from: %s', 'seasonal' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'seasonal' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( esc_html__( 'Articles from %s', 'seasonal' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'seasonal' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( esc_html__( 'Articles from %s', 'seasonal' ), get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'seasonal' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = esc_html_x( 'Asides', 'post format archive title', 'seasonal' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = esc_html_x( 'Galleries', 'post format archive title', 'seasonal' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = esc_html_x( 'Images', 'post format archive title', 'seasonal' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = esc_html_x( 'Videos', 'post format archive title', 'seasonal' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = esc_html_x( 'Quotes', 'post format archive title', 'seasonal' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = esc_html_x( 'Links', 'post format archive title', 'seasonal' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = esc_html_x( 'Statuses', 'post format archive title', 'seasonal' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = esc_html_x( 'Audio', 'post format archive title', 'seasonal' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = esc_html_x( 'Chats', 'post format archive title', 'seasonal' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( esc_html__( 'Archives: %s', 'seasonal' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( esc_html__( '%1$s: %2$s', 'seasonal' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = esc_html__( 'Archives', 'seasonal' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;  // WPCS: XSS OK.
	}
}
endif;

if ( ! function_exists( 'seasonal_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function seasonal_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;  // WPCS: XSS OK.
	}
}
endif;


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function seasonal_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'seasonal_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'seasonal_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so seasonal_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so seasonal_categorized_blog should return false.
		return false;
	}
}


/**
 * Flush out the transients used in seasonal_categorized_blog.
 */
function seasonal_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'seasonal_categories' );
}
add_action( 'edit_category', 'seasonal_category_transient_flusher' );
add_action( 'save_post',     'seasonal_category_transient_flusher' );
