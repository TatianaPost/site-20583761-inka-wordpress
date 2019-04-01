<?php
/**
 * List posts.
 *
 * @package Inka
 */
?>

<!-- List Layout -->
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'template-parts/post/post-list' ); ?>

	<?php endwhile; ?>

	<?php else : ?>
		<?php get_template_part( 'template-parts/post/content', 'none' ); ?>
<?php endif; ?>