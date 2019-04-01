<?php
/**
 * The template for displaying the footer.
 *
 * @package Inka
 */
?>

<?php
	$footer_bottom_text = get_theme_mod( 'deo_footer_bottom_text', sprintf(
		esc_html__( 'Inka, made by %1$sDeoThemes%2$s' , 'inka' ),
		'<a href="https://deothemes.com">',
		'</a>'
	) );
?>


		<!-- Footer -->
		<footer class="footer">
			<div class="footer-bottom">
				<div class="container text-center">

					<?php
						if ( function_exists( 'deo_render_social_icons' ) ) {
							echo deo_render_social_icons();
						}
					?>

					<?php if( get_theme_mod( 'deo_footer_bottom_text' ) != "" ) : ?>

						<span class="copyright">
							&copy; <?php echo date('Y') . ' '; ?>
							<?php echo wp_kses_post ( $footer_bottom_text ) ?>
						</span>

					<?php endif; ?>

				</div>
			</div> <!-- .footer-bottom -->
		</footer>

		<!-- Back to top -->
		<?php if( get_theme_mod( 'deo_back_to_top_settings', true ) ) : ?>
			<div id="back-to-top">
				<a href="#top"><i class="ui-arrow-up"></i></a>
			</div>
		<?php endif; ?>

	</main> <!-- .main-wrapper -->

<?php wp_footer(); ?>
</body>
</html>
