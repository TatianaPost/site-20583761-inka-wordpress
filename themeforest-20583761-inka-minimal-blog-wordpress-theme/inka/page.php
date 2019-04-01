<?php
/**
 * Default Page Template
 *
 * @package Inka
 * @since   Inka 1.0.0
 */

get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<!-- Page Section -->
	<section class="section-wrap pt-70">
		<div class="container">

			<!-- Title -->
			<h1 class="page-title text-center"><?php the_title(); ?></h1>

			<!-- Image -->
			<?php if( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'full', array( 'class' => 'page__featured-img' ) ); ?>
			<?php endif; ?>

			<div class="row">		

				<div class="blog__content <?php
					if ( 'left-sidebar' == deo_layout_type( 'page' ) ) {
						echo esc_attr( 'col-md-8 blog__content--right' );
					} elseif ( 'right-sidebar' == deo_layout_type( 'page' ) ) {
						echo esc_attr( 'col-md-8' );
					} elseif ( 'fullwidth' == deo_layout_type( 'page' ) ) {
						echo esc_attr( 'col-md-8 col-md-offset-2' );
					}
				?>">
			
					<div class="content clearfix">
						<?php the_content(); ?>
					</div>
				

					<?php
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					?>

				</div> <!-- .col -->

				<!-- Sidebar -->
				<?php
					if ( 'right-sidebar' == deo_layout_type( 'page' ) ) {
						deo_sidebar( 'right' );
					} elseif ( 'left-sidebar' == deo_layout_type( 'page' ) ) {
						deo_sidebar( 'left' );
					}
				?>

			</div>
		</div>
	</section> <!-- end page section -->

<?php endwhile; endif; ?>

<!-- Instagram -->
<?php if( is_active_sidebar( 'deo-footer-instagram' ) ) : ?>
	<?php dynamic_sidebar( 'deo-footer-instagram' ); ?>
<?php endif; ?>

<?php get_footer(); ?>