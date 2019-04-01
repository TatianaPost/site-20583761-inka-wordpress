<?php
/**
 * The template for displaying all single posts.
 *
 * @package Inka
 */

get_header(); ?>

<!-- Blog Single -->
<section class="section-wrap blog-section blog__single pt-70">
	<div class="container">
		<div class="row">

			<!-- Content -->
			<div class="blog__content mb-50 <?php
				switch( deo_layout_type( 'blog' ) ) {

					case ( 'left-sidebar' ) :
						echo esc_attr( 'col-md-8 blog__content--right' );
						break;

					case ( 'right-sidebar' ) :
						echo esc_attr( 'col-md-8' );
						break;

					case ( 'fullwidth' ) :
						echo esc_attr( 'col-md-8 col-md-offset-2' );
						break;

					default:
						echo esc_attr( 'col-md-8' );
				}
			?>">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						if ( function_exists( 'deo_save_post_views' ) ) {
							deo_save_post_views( get_the_ID() );
						}						
						get_template_part( 'template-parts/post/content-single', get_post_format() ); ?>


					<!-- Author -->
					<?php
						$author_desc = get_the_author_meta( 'description' );

						if ( ! empty( $author_desc ) ) : ?>
						<div class="entry-author clearfix">
							<?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
							<div class="entry-author__info">
								<h6 class="entry-author__name">
									<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a>
								</h6>
								<p class="mb-0"><?php the_author_meta( 'description' ); ?></p>
							</div>
						</div>
					<?php endif; ?>

					<!-- Related Posts -->
					<?php deo_related_posts(); ?>


					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					?>

				<?php endwhile; ?>
			</div> <!-- .blog-content -->

			<!-- Sidebar -->
			<?php
				if ( 'right-sidebar' == get_theme_mod( 'deo_blog_layout_type' ) ) {
					deo_sidebar( 'right' );
				} elseif ( 'left-sidebar' == get_theme_mod( 'deo_blog_layout_type' ) ) {
					deo_sidebar( 'left' );
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