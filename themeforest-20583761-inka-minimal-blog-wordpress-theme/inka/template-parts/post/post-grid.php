<?php
/**
 * @package Inka
 * 
 * Grid Post Type
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry small-post'); ?>>
	
	<!-- Post thumb -->
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry__img-holder">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'medium', array( 'class' => 'entry__img' ) ); ?>
			</a>
		</div>
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

	<?php
	// Excerpt
	if ( get_theme_mod( 'deo_post_excerpt_show', true ) ) : ?>
		<div class="entry__excerpt text-center mb-0">
			<?php the_excerpt(); ?>
			<div class="entry__read-more-container">
				<a href="<?php the_permalink(); ?>" class="entry__read-more"><?php esc_html_e('Read Full Story', 'inka') ?></a>
			</div>
		</div>
	<?php endif; ?>
	
</article><!-- #post-## -->