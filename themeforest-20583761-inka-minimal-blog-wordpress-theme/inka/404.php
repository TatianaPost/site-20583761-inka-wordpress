<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Inka
 */

get_header(); ?>

<section class="section-wrap blog-section pt-70">
	<div class="container">

		<!-- Page Title -->
		<h1 class="page-title text-center">
			<?php echo esc_html__('404 Page not found', 'inka') ?>
		</h1>

		<div class="row">

			<div class="col-md-6 col-md-offset-3">

				<p class="text-center mb-20"><?php echo esc_html__('Don\'t fret! Let\'s get you back on track. Perhaps searching can help', 'inka') ?></p>
				<?php get_search_form(); ?>

			</div><!-- .col -->

		</div>
	</div>
</section>

<!-- Instagram -->
<?php if( is_active_sidebar( 'deo-footer-instagram' ) ) : ?>
	<?php dynamic_sidebar( 'deo-footer-instagram' ); ?>
<?php endif; ?>

<?php get_footer(); ?>