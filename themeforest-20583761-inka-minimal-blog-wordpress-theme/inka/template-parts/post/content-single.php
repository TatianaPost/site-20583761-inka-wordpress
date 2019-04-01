<?php
/**
 * Single post
 *
 * @package Inka
 */
?>

<article id="post-<?php the_ID(); ?>" class="entry" <?php post_class(); ?>>

	<!-- Entry header -->
	<div class="entry__header">

		<!-- Category -->
		<?php echo deo_category_meta(); ?>

		<!-- Title -->
		<h1 class="single-post__entry-title"><?php the_title(); ?></h1>

		<!-- Date / Comments -->
		<ul class="entry__meta">
			<?php echo deo_date_meta(); ?>
			<?php echo deo_comments_meta(); ?>
		</ul>

	</div> <!-- .entry-header -->


	<!-- Post thumb -->
	<?php
		if ( has_post_thumbnail() ) {
			$post_format = get_post_format( $post->ID );

			switch ( $post_format ) {
				case 'gallery':
				case 'video':
				case 'audio':
					break;

				default: ?>
					<figure class="single-post__entry-img-holder entry__img-holder">
						<?php the_post_thumbnail( 'large', array( 'class' => 'entry__img' ) ); ?>
					</figure>
				<?php
			}
		}
	?>


	<!-- Article -->
	<div class="entry__article">

		<?php the_content(); ?>

		<!-- WP Link Pages -->
		<?php
			$args = array(
				'before'           => '<div class="entry-pages">' . esc_html__( 'Pages:', 'inka' ),
				'after'            => '</div>',
				'link_before'      => '',
				'link_after'       => '',
				'next_or_number'   => 'number',
				'separator'        => ' ',
				'nextpagelink'     => esc_html__( 'Next page', 'inka' ),
				'previouspagelink' => esc_html__( 'Previous page', 'inka' ),
				'pagelink'         => '%',
				'echo'             => 1
				);

			wp_link_pages( $args );
		?>

	</div><!-- .entry-article -->

	<!-- Tags / Share -->
	<?php if( get_theme_mod( 'deo_posts_tags_settings', true ) || get_theme_mod( 'deo_posts_share_settings', true ) ) : ?>
		<div class="entry__share-tags">
			<div class="row">
			
			<?php if( get_theme_mod( 'deo_posts_tags_settings', true ) ) : ?>
				<div class="col-md-6">					
					<div class="entry-tags">
						<?php the_tags( null, ', ', '' ); ?>
					</div>					
				</div>
			<?php endif; ?>
			
			<?php if( function_exists( 'deo_social_sharing_buttons' ) && get_theme_mod( 'deo_posts_share_settings', true ) ) : ?>
				<div class="col-md-6">				
					<div class="entry-share">
						<span><?php esc_html_e( 'Share:', 'inka' ); ?></span>
						<?php echo deo_social_sharing_buttons(); ?>
					</div>				
				</div>
			<?php endif; ?>				

			</div> <!-- end row -->
		</div> <!-- end tags / share -->
	<?php endif; ?>

</article><!-- #post-## -->
