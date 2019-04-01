<?php
/**
 * The template for displaying archive pages.
 *
 * @package Inka
 */

get_header();
?>

<section class="section-wrap blog-section pt-70">
	<div class="container">

		<!-- Page Title -->
		<h1 class="page-title text-center">
			<?php
				if ( is_category() ) :
					single_cat_title();

				elseif ( is_tag() ) :
					single_tag_title();

				elseif ( is_author() ) :
					printf( __( 'Author: %s', 'inka' ), '<span class="vcard">' . get_the_author() . '</span>' );

				elseif ( is_day() ) :
					printf( __( 'Day: %s', 'inka' ), '<span>' . get_the_date() . '</span>' );

				elseif ( is_month() ) :
					printf( __( 'Month: %s', 'inka' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'inka' ) ) . '</span>' );

				elseif ( is_year() ) :
					printf( __( 'Year: %s', 'inka' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'inka' ) ) . '</span>' );

				elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
					_e( 'Asides', 'inka' );

				elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
					_e( 'Galleries', 'inka' );

				elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
					_e( 'Images', 'inka' );

				elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
					_e( 'Videos', 'inka' );

				elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
					_e( 'Quotes', 'inka' );

				elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
					_e( 'Links', 'inka' );

				elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
					_e( 'Statuses', 'inka' );

				elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
					_e( 'Audios', 'inka' );

				elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
					_e( 'Chats', 'inka' );

				else :
					_e( 'Archives', 'inka' );

				endif;
			?>

			<?php
				// Show an optional term description.
				$term_description = term_description();
				if ( ! empty( $term_description ) ) :
					printf( '<small class="taxonomy-description">%s</small>', $term_description );
				endif;
			?>
		</h1> <!-- .page title -->		

		<div class="row">
			
			<!-- Content -->
			<div class="blog__content <?php
				if ( 'left-sidebar' == deo_layout_type( 'archives' ) ) {
					echo esc_attr( 'col-md-8 blog__content--right' );
				} elseif ( 'right-sidebar' == deo_layout_type( 'archives' ) ) {
					echo esc_attr( 'col-md-8' );
				} elseif ( 'fullwidth' == deo_layout_type( 'archives' ) ) {
					echo esc_attr( 'col-md-12' );
				}
			?>">

				<?php
					$archive_columns = get_theme_mod( 'deo_archives_columns', 'col-md-4' );
					set_query_var( 'deo_archives_columns', $archive_columns );

					switch( get_theme_mod( 'deo_archives_post_layout_type', 'grid' ) ) {

						case ( 'grid' ) :
							get_template_part( 'template-parts/post/grid-layout' );
							break;

						case ( 'list' ) :
							get_template_part( 'template-parts/post/list-layout' );
							break;

						default:
							get_template_part( 'template-parts/post/grid-layout' );
					}
				?>

				<?php deo_paging_nav(); ?>

			</div> <!-- .blog__content -->


			<!-- Sidebar -->
			<?php
				if ( 'right-sidebar' == deo_layout_type( 'archives' ) ) {
					deo_sidebar( 'right' );
				} elseif ( 'left-sidebar' == deo_layout_type( 'archives' ) ) {
					deo_sidebar( 'left' );
				}
			?>

		</div> <!-- .row -->
	</div>
</section>

<!-- Instagram -->
<?php if( is_active_sidebar( 'deo-footer-instagram' ) ) : ?>
	<?php dynamic_sidebar( 'deo-footer-instagram' ); ?>
<?php endif; ?>

<?php get_footer();  ?>