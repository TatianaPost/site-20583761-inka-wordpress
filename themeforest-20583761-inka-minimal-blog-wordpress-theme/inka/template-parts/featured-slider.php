
<!-- Featured Slider -->
	<section class="hero">
		<div id="owl-hero" class="owl-carousel owl-theme">

			<?php

				$number_posts = ( get_theme_mod( 'deo_featured_slider_posts_settings', '3' ) );
				$string_ID = ( get_theme_mod( 'deo_featured_slider_posts_id_settings', '' ) );
				$post_ID = ( !empty( $string_ID ) ) ? array_map( 'intval', explode(',', $string_ID )) : '';
				$categories = deo_categories_dropdown();

				$post_category = ( get_theme_mod( 'deo_featured_slider_categories_settings', $categories[0] ) );

				$args = array(
					'post_type'      => 'post',
					'post__in'       => $post_ID,
					'ignore_sticky_posts' => true,
					'posts_per_page' => $number_posts,
					'cat'            => $post_category,
					'orderby'        => 'post__in',
					'meta_query' => array(
						array(
							'key' => '_thumbnail_id'
						)
					),
				);

				$featured_query = new WP_Query( $args );

				if( $featured_query->have_posts() ) :

					while( $featured_query->have_posts() ) : $featured_query->the_post(); ?>

						<div class="hero__slide">
							<article class="entry hero__slide-entry">

								<div class="hero__entry-img-holder entry__img-holder bottom-gradient" <?php if ( has_post_thumbnail() ) : ?>style="background-image: url(<?php the_post_thumbnail_url(); ?>);"<?php endif; ?> >
									<a href="<?php the_permalink(); ?>" class="hero__slide-url"></a>
									<div class="entry__header">
										<?php echo deo_category_meta(); ?>
										<?php the_title( sprintf( '<h2 class="entry__title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
									</div>
								</div>

							</article>
						</div>

					<?php
					endwhile;

				endif;
			?>

		</div> <!-- end owl -->
	</section> <!-- end hero slider -->