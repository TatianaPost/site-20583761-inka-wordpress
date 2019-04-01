<?php
/**
 * The main template file.
 *
 * @package Inka
 * @since   Inka 1.0.0
 */

get_header();

$page_layout = get_theme_mod( 'deo_blog_layout_type', 'right-sidebar' );
$sidebar_position = isset( $_GET['sidebar'] ) ? $_GET['sidebar'] : 'right';
$post_layout = isset( $_GET['layout'] ) ? $_GET['layout'] : 'grid';

if ( get_theme_mod( 'deo_featured_slider_show_settings', true ) ) {
	get_template_part( 'template-parts/featured-slider' );
} elseif ( get_theme_mod( 'deo_featured_hero_show_settings', false ) ) {
	set_theme_mod( 'deo_featured_slider_show_settings', false );
	get_template_part( 'template-parts/featured-hero' );
}

?>

<!-- Blog Standard -->
<section class="section-wrap blog-section pb-60">
	<div class="container">
		<div class="row">

			<!-- Content -->
			<div class="blog__content mb-60 <?php
				if ( DEOPRODUCTION ) {
					switch( deo_layout_type( 'blog' ) ) {

						case ( 'left-sidebar' ) :
							echo esc_attr( 'col-md-8 blog__content--right' );
							break;

						case ( 'right-sidebar' ) :
							echo esc_attr( 'col-md-8' );
							break;
						
						case ( 'fullwidth' ) :
							echo esc_attr('col-md-12');
							break;

						default:
							echo esc_attr( 'col-md-8' );
					}
				} else {
					if ( 'left' == $sidebar_position ) {
						set_theme_mod( 'deo_blog_layout_type', 'left-sidebar' );
						echo esc_attr( 'col-md-8 blog__content--right' );
					} elseif ( 'right' == $sidebar_position ) {
						set_theme_mod( 'deo_blog_layout_type', 'right-sidebar' );
						echo esc_attr( 'col-md-8' );
					}
				}
			
			?>">

				<!-- Grid / List Layout -->
				<?php
					if ( DEOPRODUCTION ) {
						switch( get_theme_mod( 'deo_post_layout_type', 'grid' ) ) {

							case ( 'grid' ) :
								get_template_part( 'template-parts/post/grid-first-large-layout' );
								break;

							case ( 'list' ) :
								get_template_part( 'template-parts/post/list-layout' );
								break;

							default:
								get_template_part( 'template-parts/post/grid-first-large-layout' );
						}
					} else {
						switch( $post_layout ) {

							case ( 'grid' ) :
								set_theme_mod( 'deo_post_layout_type', 'grid' );
								get_template_part( 'template-parts/post/grid-first-large-layout' );
								break;

							case ( 'list' ) :
								set_theme_mod( 'deo_post_layout_type', 'list' );
								get_template_part( 'template-parts/post/list-layout' );
								break;

							default:
								set_theme_mod( 'deo_post_layout_type', 'grid' );
								get_template_part( 'template-parts/post/grid-first-large-layout' );
						}						
					}
				?>

				<!-- Pagination -->
				<?php deo_paging_nav(); ?>

			</div> <!-- .blog-content -->

			<!-- Sidebar -->
			<?php
				if ( DEOPRODUCTION ) {
					if ( 'right-sidebar' == get_theme_mod( 'deo_blog_layout_type' ) ) {
						deo_sidebar( 'right' );
					} elseif ( 'left-sidebar' == get_theme_mod( 'deo_blog_layout_type' ) ) {
						deo_sidebar( 'left' );
					}
				} else {
					if ( 'right' == $sidebar_position ) {
						set_theme_mod( 'deo_blog_layout_type', 'right-sidebar' );
						deo_sidebar( 'right' );
					} elseif ( 'left' == $sidebar_position ) {
						set_theme_mod( 'deo_blog_layout_type', 'left-sidebar' );
						deo_sidebar( 'left' );
					}
				}
			?>

		</div>
	</div>
</section>


<!-- Instagram -->
<?php if( is_active_sidebar( 'deo-footer-instagram' ) ) : ?>
	<?php dynamic_sidebar( 'deo-footer-instagram' ); ?>
<?php endif; ?>

<?php get_footer(); ?>