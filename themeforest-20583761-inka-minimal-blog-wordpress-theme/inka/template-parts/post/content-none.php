<?php
/**
 * @package Inka
 *
 * If no content
 */
?>

<article <?php post_class('entry'); ?>>

	<!-- Article -->
	<div class="entry__article text-center">
		<h3><?php esc_html_e( 'There is no content to display', 'inka' ); ?></h3>

		<div class="col-md-6 col-md-offset-3">
			<p class="mb-20"><?php esc_html_e( 'Don\'t fret! Let\'s get you back on track. Perhaps searching can help', 'inka' ) ?></p>
			<?php get_search_form(); ?>
		</div><!-- .col -->

	</div> <!-- .entry-wrap -->

</article><!-- #post-## -->