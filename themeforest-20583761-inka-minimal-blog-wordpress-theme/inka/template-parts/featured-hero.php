
<!-- Featured Hero -->
<section class="hero">
	<div class="container">

		<?php
			$string_ID = ( get_theme_mod( 'deo_featured_hero_posts_id_settings', '' ) );
			$post_ID = ( !empty( $string_ID ) ) ? array_map( 'intval', explode(',', $string_ID )) : '';

			$args = array(
				'post_type'      => 'post',
				'post__in'       => $post_ID,
				'ignore_sticky_posts' => true,
				'posts_per_page' => 1,
				'orderby'        => 'post__in',
				// 'order'          => 'ASC',
				'meta_query' => array(
					array(
						'key' => '_thumbnail_id'
					)
				),
			);

			$featured_query = new WP_Query( $args );

			if( $featured_query->have_posts() ) :

				while( $featured_query->have_posts() ) : $featured_query->the_post(); ?>

					<article class="entry hero__slide-entry">

						<div class="hero__entry-img-holder entry__img-holder bottom-gradient" <?php if ( has_post_thumbnail() ) : ?>style="background-image: url(<?php the_post_thumbnail_url(); ?>);"<?php endif; ?> >
							<a href="<?php the_permalink(); ?>" class="hero__slide-url"></a>
							<div class="entry__header">
								<?php echo deo_category_meta(); ?>
								<?php the_title( sprintf( '<h2 class="entry__title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
							</div>
						</div>

					</article>

				<?php
				endwhile;

			endif;
		?>

	</div>
</section> <!-- end featured hero -->