<?php
/**
 * Theme functions and definitions
 *
 * @package Inka
 */



// Categories dropdown
function deo_categories_dropdown() {

	$categories = get_categories( array(
		'orderby' => 'name',
		'parent'  => 0
	) );

	$categories_dropdown = array( '0' => esc_html__( 'All categories', 'inka' ) );
	if ( ! is_wp_error( $categories ) ) {
		foreach ( $categories as $key => $category ) {
			$categories_dropdown[$category->term_id] = $category->name;
		}
	}

	return $categories_dropdown;
}


/**
 * Post date meta
 */

function deo_date_meta() {
	if( get_theme_mod( 'deo_posts_date_settings', true ) ) {
		$posted_on = get_the_date();
		$output = '';

		if ( 'post' == get_post_type() ) :
			$output .= '<li class="entry__meta__date">' . $posted_on . '</li>';
		endif;

		return $output;
	}
}


/**
 * Post comments meta
 */
function deo_comments_meta() {
	if( get_theme_mod( 'deo_posts_comments_settings', true ) ) {
		$comments_num = get_comments_number();
		$output = '';

		if ( comments_open() ) {
			if( $comments_num == 0 ) {
				$comments = esc_html__( 'Leave a comment', 'inka' );
			} elseif ( $comments_num > 1 ) {
				$comments = $comments_num . esc_html__(' Comments', 'inka');
			} else {
				$comments = esc_html__('1 Comment', 'inka');
			}
			$comments = '<a href="' . get_comments_link() .'">' . $comments . '</a>';
		} else {
			$comments = esc_html__('Comments are closed', 'inka');
		}

		if ( 'post' == get_post_type() ) :
			$output .= '<li class="entry__meta__comments">' . $comments . '</li>';
		endif;

		return $output;
	}
}


/**
 * Post category
 */
function deo_category_meta() {
	if( get_theme_mod( 'deo_posts_category_settings', true ) ) {

		$categories = get_the_category();
		$separator = ', ';
		$categories_output = '';
		$output = '';

		if ( !empty($categories) ):
			foreach( $categories as $index => $category ):
				if ($index > 0) : $categories_output .= $separator; endif;
				$categories_output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>';
			endforeach;
		endif;

		if ( 'post' == get_post_type() ) :
			$output .= '<ul class="entry__meta">';
			$output .= '<li class="entry__meta__category">' . $categories_output . '</li>';
			$output .= '</ul>';
		endif;

		return $output;

	}
}


// Get Embedded Media
function deo_get_embedded_media( $type = array() ) {
	$content = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
	$embed = get_media_embedded_in_content( $content, $type );

	if( in_array( 'audio', $type ) ):
		$output = str_replace('?visual=true', '?visual=false', $embed[0]);
	else:
		$output = $embed[0];
	endif;
	return $output;
}


// Add responsive container to embeds
if ( ! function_exists( 'deo_embed_responsive_video' ) ) {
	function deo_embed_responsive_video( $cache, $url, $attr, $post_ID ) {
		$classes = array();

		$classes_all = array(
			'embed-responsive',
			'embed-responsive-16by9',
			'mb-32'
		);

		if ( false !== strpos( $url, 'vimeo.com' ) ) {
			$classes[] = 'embed-responsive-vimeo';
		}

		if ( false !== strpos( $url, 'youtube.com' ) ) {
			$classes[] = 'embed-responsive-youtube';
		}

		$classes = array_merge( $classes, $classes_all );
		
		if ( ! deo_is_gutenberg() ) { 
			return '<div class="' . esc_attr( implode( $classes, ' ' ) ) . '">' . $cache . '</div>';
		} else {
			return $cache;
		}
	}
	add_filter( 'embed_oembed_html', 'deo_embed_responsive_video', 10, 4 );
	add_filter( 'video_embed_html', 'deo_embed_responsive_video' ); // Jetpack
}

/**
* Gutenberg Check
**/
function deo_is_gutenberg() {
	return function_exists( 'register_block_type' ); 
}


// Grab URL Post Format
function deo_grab_url() {
	if (! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/i', get_the_content(), $links ) ) {
		return false;
	}
	return esc_url_raw( $links[1] );
}



/**
* Comments Pagination
**/

function deo_comments_pagination() {

	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :

		?>

		<nav class="comment-navigation clearfix" role="navigation">
			<h6 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'inka' ); ?></h6>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'inka' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'inka' ) ); ?></div>
		</nav><!-- #comment-nav-above -->

		<?php

	endif;
}


/**
 * Display navigation to next/previous set of posts when applicable.
 */

if ( ! function_exists( 'deo_paging_nav' ) ) {
	function deo_paging_nav() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		
		if( 'buttons' == get_theme_mod( 'deo_pagination_type', 'buttons' ) ) : ?>
			<nav class="pagination-buttons clearfix">
				<span class="screen-reader-text"><?php echo esc_html__( 'Posts navigation', 'inka' ); ?></span>
				<div class="nav-links clearfix">

					<?php if ( get_next_posts_link() ) : ?>
						<div class="pagination__link older-posts right"><?php next_posts_link( esc_html__( 'Older posts', 'inka' ) ); ?></div>
					<?php endif; ?>

					<?php if ( get_previous_posts_link() ) : ?>
						<div class="pagination__link older-posts left"><?php previous_posts_link( esc_html__( 'Newer posts', 'inka' ) ); ?></div>
					<?php endif; ?>

				</div><!-- .nav-links -->
			</nav><!-- .navigation -->
		<?php endif;

		if( 'numbers' == get_theme_mod( 'deo_pagination_type', 'buttons' ) ) : ?>
			<!-- Pagination Numbers -->
			<nav class="pagination clearfix">
				<?php $args = array(
					'prev_next'          => true,
					'prev_text'          => wp_kses( '<i class="ui-arrow-left"></i>', array( 'i' => array( 'class' => array() ) ) ),
					'next_text'          => wp_kses( '<i class="ui-arrow-right"></i>', array( 'i' => array( 'class' => array() ) ) ),
				); ?>
				<?php echo paginate_links( $args ); ?>
			</nav>
		<?php endif;
	}
}



/**
 * Display navigation to next/previous post when applicable.
 */
if ( ! function_exists( 'deo_post_nav' ) ) :
	function deo_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );
		$get_next_post = get_next_post();
		$get_previous_post = get_previous_post();

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="entry-navigation">
			<h5 class="screen-reader-text"><?php echo esc_html__( 'Post navigation', 'inka' ); ?></h5>
			<div class="clearfix">

				<?php if ( !empty( $get_next_post ) ) : ?>
					<div class="entry-navigation--left">
						<?php
							printf( '<i class="ui-angle-left"></i><span>%s</span>', esc_html('Previous Post', 'inka') );
							next_post_link( '<div class="entry-navigation__link">%link</div>', _x( '%title', 'Next post link', 'inka' ) );
						?>
					</div>
				<?php endif; ?>
				<?php if ( !empty( $get_previous_post ) ) : ?>
					<div class="entry-navigation--right">
						<?php
							printf( '<span>%s</span><i class="ui-angle-right"></i>', esc_html('Next Post', 'inka') );
							previous_post_link( '<div class="entry-navigation__link">%link</div>', _x( '%title', 'Previous post link', 'inka' ) );
						?>
					</div>
				<?php endif; ?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;


/**
 * Sidebar left
 */
if ( ! function_exists( 'deo_sidebar' ) ) :
	function deo_sidebar( $type = '' ) {
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			?>
				<aside class="col-md-4 sidebar sidebar--<?php echo esc_attr( $type ); ?>">
					<?php get_sidebar(); ?>
				</aside>
			<?php
		}
	}
endif;



/**
 * Related Posts
 */
function deo_related_posts() {
	if( get_theme_mod( 'deo_posts_related_settings', true ) ) {
		$args = array(
			'post_type'=>'post',
			'post_status' => 'publish',
			'posts_per_page' => 3,
			'post__not_in' => array(get_the_ID()),
			'ignore_sticky_posts' => true,
			'meta_query' => array(
				array(
					'key' => '_thumbnail_id'
				)
			),
		);

		$related_posts_query = new WP_Query( $args ); ?>

		<?php if ( $related_posts_query->have_posts() ) : ?>
			<div class="related-posts mt-60">
				<h5 class="heading text-center mb-40"><?php echo esc_html__( 'Related Posts', 'inka'); ?></h5>
				<div class="row">

					<?php while( $related_posts_query->have_posts() ) : $related_posts_query->the_post(); ?>

						<div class="col-md-4">
							<div class="article">

								<?php if ( has_post_thumbnail() ) : ?>

									<!-- Post thumb -->
									<div class="entry__img-holder">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'medium', array( 'class' => 'entry__img' ) ); ?>
										</a>
									</div>
								<?php endif; ?>

								<!-- Title -->
								<?php the_title( sprintf( '<h4 class="related-posts__entry-title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>

							</div> <!-- end article -->
						</div> <!-- .col -->

					<?php endwhile; ?>

					<?php wp_reset_postdata(); ?>

				</div> <!-- .row -->
			</div> <!-- .related-posts -->
		<?php endif;

	}
}


// Change Excerpt length
function deo_custom_excerpt_length( $length ) {
	$excerpt_length = get_theme_mod( 'deo_post_excerpt_words', 30 );
	return $excerpt_length;
}
add_filter( 'excerpt_length', 'deo_custom_excerpt_length', 999 );


/**
 * Tags Cloud Widget font size
 */

function deo_tag_cloud_size( $args ) {
	$args['smallest'] = 10;
	$args['largest'] = 10;
	return $args;
}
add_filter('widget_tag_cloud_args', 'deo_tag_cloud_size');


if ( ! function_exists( 'deo_layout_type' ) ) {
	/**
	 * Check layout type
	 * @return string $type Layout type
	 */
	function deo_layout_type( $type ) {
		$layout = '';

		if ( 'left-sidebar' == get_theme_mod( 'deo_' . $type .  '_layout_type', 'right-sidebar' ) ) {
			$layout = 'left-sidebar';
		}

		if ( 'right-sidebar' == get_theme_mod( 'deo_' . $type .  '_layout_type', 'right-sidebar' ) ) {
			$layout = 'right-sidebar';
		}

		if ( 'fullwidth' == get_theme_mod( 'deo_' . $type .  '_layout_type', 'right-sidebar' ) ) {
			$layout = 'fullwidth';
		}	

		return $layout;
	}
}


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function deo_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Page Layout Class
	if ( is_page() ) {
		$classes[] = deo_layout_type( 'page' );
	}

	// Blog Layout Class
	if ( is_single() || is_home() ) {
		$classes[] = deo_layout_type( 'blog' );
  }
    
  // Archives Layout Class
  if ( is_archive() ) {
    $classes[] = deo_layout_type( 'archives' );
  }

	$classes[] = '';

	return $classes;
}
add_filter( 'body_class', 'deo_body_classes' );