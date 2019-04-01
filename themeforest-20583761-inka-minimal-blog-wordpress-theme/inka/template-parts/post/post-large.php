<?php
/**
 * @package Inka
 *
 * Full Post Format
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>

	<!-- Entry header -->
	<div class="entry__header">

		<!-- Category -->
		<?php echo deo_category_meta(); ?>

		<!-- Title -->
		<?php the_title( sprintf( '<h2 class="entry__title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	</div> <!-- .entry-header -->

	<!-- Post thumb -->
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry__img-holder">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'large', array( 'class' => 'entry__img' ) ); ?>
			</a>
		</div>
	<?php endif; ?>


	<!-- Content -->
	<div class="entry__body">
		<?php
		// Excerpt
		if ( get_theme_mod( 'deo_post_excerpt_show', true ) ) : ?>
			<div class="entry__excerpt">
				<?php the_excerpt(); ?>
				<div class="entry__read-more-container">
					<a href="<?php the_permalink(); ?>" class="entry__read-more"><?php esc_html_e('Read Full Story', 'inka') ?></a>
				</div>
			</div>
		<?php endif; ?>

		<!-- Entry Footer -->
		<?php if ( get_theme_mod( 'deo_posts_date_settings', true ) || get_theme_mod( 'deo_posts_comments_settings', true ) || get_theme_mod( 'deo_posts_share_settings', true ) ) : ?>
			<div class="entry__footer clearfix">
				<ul class="entry__meta">
					<?php echo deo_date_meta(); ?>
					<?php echo deo_comments_meta(); ?>
				</ul>

				<?php if ( function_exists( 'deo_social_sharing_buttons' ) ) { echo deo_social_sharing_buttons(); } ?>
			</div>
		<?php endif; ?>

	</div> <!-- .entry body -->

</article><!-- #post-## -->