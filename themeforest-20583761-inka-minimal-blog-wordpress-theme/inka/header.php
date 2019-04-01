<?php
/**
 * The header for our theme.
 *
 * @package Inka
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<!-- Preloader -->
	<?php if( get_theme_mod( 'deo_preloader_settings', true ) ) : ?>
		<div class="loader-mask">
			<div class="loader">
				<div></div>
			</div>
		</div>
	<?php endif; ?>

	<!-- Navigation -->
	<header class="nav">
		<div class="nav__holder <?php if( get_theme_mod('deo_sticky_nav_settings', true ) ) : ?>nav--sticky<?php endif; ?>" >
			<div class="container relative">
				<div class="flex-parent">

					<!-- Nav-header -->
					<div class="nav__header clearfix">
						<button type="button" class="nav__icon-toggle" id="nav__icon-toggle" data-toggle="collapse" data-target="#navbar-collapse">
							<span class="sr-only"><?php echo esc_html__( 'Toggle navigation', 'inka' ); ?></span>
							<span class="nav__icon-toggle-bar"></span>
							<span class="nav__icon-toggle-bar"></span>
							<span class="nav__icon-toggle-bar"></span>
						</button>
					</div> <!-- end nav-header -->

					<?php if ( get_theme_mod( 'deo_navbar_socials_show', true ) ) : ?>
						<!-- Socials -->
						<div class="flex-child nav__socials socials socials--nobase clearfix">
							<?php
								if ( function_exists( 'deo_render_social_icons' )
									&& get_theme_mod( 'deo_nav_socials_show', true ) ) {
										echo deo_render_social_icons();
								}
							?>
						</div>
					<?php endif; ?>


					<!-- Nav-wrap -->
					<nav id="navbar-collapse" class="flex-child nav__wrap collapse navbar-collapse">
					<?php
						if (has_nav_menu('primary')) {
							wp_nav_menu( array(

								'theme_location'  => 'primary',
								'fallback_cb'			=> '__return_false',
								'container'       => false,
								'container_class' => 'flex-child nav__wrap collapse navbar-collapse',
								'container_id'    => 'navbar-collapse',
								'menu_class'      => 'nav__menu',
								'walker'          => new Deo_Walker_Nav_Primary()

							) );
						}
						?>

						
						<?php if ( get_theme_mod( 'deo_navbar_search_show', true ) ) : ?>
							<!-- Mobile Search -->
							<form method="get" class="nav__search-mobile hidden-lg hidden-md" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<input type="search" class="nav__search-mobile-input" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'inka' ); ?>" value="<?php echo get_search_query(); ?>" required name="s" />
								<button type="submit" class="nav__search-mobile-button">
									<i class="ui-search"></i>
								</button>
							</form>
						<?php endif; ?>

					</nav> <!-- end nav-wrap -->
					
					<?php if ( get_theme_mod( 'deo_navbar_search_show', true ) ) : ?>
						<!-- Search -->
						<div class="flex-child nav__search hidden-sm hidden-xs">
							<form role="search" method="get" class="nav__search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<input type="search" class="nav__search-input" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'inka' ); ?>" value="<?php echo get_search_query(); ?>" required name="s" />
								<button type="submit" class="nav__search-submit">
									<i class="ui-search"></i>
								</button>
							</form>
						</div>
					<?php endif; ?>

				</div> <!-- end flex-parent -->
			</div> <!-- end container -->
		</div> <!-- end nav-holder -->
	</header> <!-- end navigation -->


	<!-- Logo -->
	<div class="logo-wrap">
		<div class="hide">
			<h1><?php bloginfo( 'name' ) ?></h1>
		</div>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo__link">
			<?php if( get_theme_mod( 'deo_logo_image_upload' ) ) : ?>
				<img src="<?php echo esc_attr( get_theme_mod( 'deo_logo_image_upload' ) ) ?>" srcset="<?php echo esc_attr( get_theme_mod( 'deo_logo_image_upload' ) ) . ' 1x' ?>, <?php echo esc_attr( get_theme_mod( 'deo_logo_retina_image_upload' ) ) . ' 2x' ?>" class="logo" alt="<?php echo esc_attr__( 'logo', 'inka' ); ?>">
			<?php else : ?>
				<h1 class="site-title"><?php bloginfo( 'name' ) ?></h1>
			<?php endif; ?>
		</a>
	</div>

	<main class="main oh">