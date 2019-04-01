<?php
/**
 * Grid posts template file.
 *
 * @package Inka
 */
?>

<!-- First Post Large Layout -->
<?php if ( have_posts() ) : ?>

	<div class="row">

		<?php

			while ( have_posts() ) : the_post();
				// first post
				if( $wp_query->current_post == 0 ) : ?>
					<div class="large-post">
						<div class="col-md-12">
							<?php get_template_part( 'template-parts/post/post-large', get_post_format() ); ?>
						</div>
					</div>

				<?php else : ?>
					<div class="col-md-6">
						<?php get_template_part( 'template-parts/post/post-grid', get_post_format() ); ?>
					</div>
				<?php endif;
			endwhile;

		?>

	</div> <!-- .row -->


	<?php else : ?>
		<?php get_template_part( 'template-parts/post/content', 'none' ); ?>
<?php endif; ?>