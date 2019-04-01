<?php
/**
 * Grid posts.
 *
 * @package Inka
 */
?>

<!-- Grid Layout -->
<?php if ( have_posts() ) : ?>

	<div class="row">

		<?php while ( have_posts() ) : the_post(); ?>

			<div class="<?php echo esc_attr( $deo_archives_columns );?>">				
				<?php get_template_part( 'template-parts/post/post-grid', get_post_format() ); ?>
			</div>

		<?php endwhile; ?>

	</div> <!-- .row -->

	<?php else : ?>
		<?php get_template_part( 'template-parts/post/content', 'none' ); ?>
<?php endif; ?>