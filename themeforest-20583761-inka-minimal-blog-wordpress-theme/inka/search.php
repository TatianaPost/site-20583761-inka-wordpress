<?php
/**
 * The template for displaying search results pages.
 *
 * @package Inka
 */

get_header(); ?>

<section class="section-wrap blog-section pt-70">
	<div class="container">

		<!-- Page Title -->
		<h1 class="page-title text-center"><?php printf( esc_html__( 'Search Results for: %s', 'inka' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

		<div class="row">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<div class="col-md-4">
					<article id="post-<?php the_ID(); ?>" <?php post_class('entry small-post'); ?>>

						<!-- Post thumb -->
						<?php if ( has_post_thumbnail() ) : ?>
							<figure class="entry__img-holder">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'medium', array( 'class' => 'entry__img' ) ); ?>
								</a>
							</figure>
						<?php endif; ?>

						<!-- Entry header -->
						<div class="entry__header">

							<!-- Category -->
							<?php echo deo_category_meta(); ?>

							<!-- Title -->
							<?php the_title( sprintf( '<h2 class="entry__title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

							<!-- Meta -->
							<ul class="entry__meta">
								<?php echo deo_date_meta(); ?>
							</ul>

						</div> <!-- .entry-header -->

					</article><!-- #post-## -->
				</div> <!-- end col -->

			<?php endwhile; ?>

			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>

		</div> <!-- .row -->

		<?php deo_paging_nav(); ?>

	</div>
</section>

<!-- Instagram -->
<?php if( is_active_sidebar( 'deo-footer-instagram' ) ) : ?>
	<?php dynamic_sidebar( 'deo-footer-instagram' ); ?>
<?php endif; ?>

<?php get_footer(); ?>