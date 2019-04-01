<?php
/**
 * @package Inka
 *
 * List Post Type
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry list-post'); ?>>

	<!-- Post thumb -->
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry__img-holder">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'medium', array( 'class' => 'entry__img' ) ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="entry__holder">

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

		<!-- Entry body -->
		<div class="entry__body">
			<div class="entry__excerpt">
				<?php the_excerpt(); ?>
			</div>
		</div>

	</div>

</article><!-- #post-## -->
