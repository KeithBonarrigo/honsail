<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ( $load_defaults === true ) : ?>
<?php

	$ci_defaults['custom_css']          = '';
	$ci_defaults['custom_css_migrated'] = false;

	add_action( 'init', 'truenorth_migrate_custom_css_to_customizer' );
	function truenorth_migrate_custom_css_to_customizer() {
		if ( ! is_admin() || wp_doing_ajax() || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) ) {
			return;
		}

		global $ci;

		if ( $ci['custom_css_migrated'] || ! function_exists( 'wp_update_custom_css_post' ) ) {
			return;
		}

		// Migrate any existing theme CSS to the core option added in WordPress 4.7.
		$css = $ci['custom_css'];
		if ( $css ) {
			// Preserve any CSS already added to the core option.
			$core_css = wp_get_custom_css();

			$return = wp_update_custom_css_post( $core_css .
				PHP_EOL . PHP_EOL .
				"/* Migrated CSS from the theme's panel. */" .
				PHP_EOL .
				html_entity_decode( $css )
			);

			if ( ! is_wp_error( $return ) ) {
				// Remove the old option, so that the CSS is stored in only one place moving forward.
				$ci['custom_css']          = '';
				$ci['custom_css_migrated'] = true;
				update_option( THEME_OPTIONS, $ci );
			}
		}
	}



	// 110 is the priority. It's important to be a big number, i.e. low priority.
	// Low priority means it will execute AFTER the other hooks, hence this will override other styles previously set.
	// Custom Background has a priority of 100, so this custom css can override the background.
	add_action( 'wp_head', 'ci_custom_css', 110 );
	if ( ! function_exists( 'ci_custom_css' ) ) :
		function ci_custom_css() {
			global $ci;
			$css = $ci['custom_css'];

			if ( ! empty( $css ) ) {
				$css = "<style type=\"text/css\">\n" . $css . "</style>\n";
				echo html_entity_decode( $css );
			}
		}
	endif;
?>
<?php else : ?>

	<fieldset id="ci-panel-custom-css" class="set">
		<legend><?php esc_html_e( 'Custom CSS', 'truenorth' ); ?></legend>

		<?php if ( $ci['custom_css_migrated'] ) : ?>

			<p class="guide">
				<?php
					echo wp_kses( sprintf( __( 'Your Custom CSS was migrated to the Customizer. Please visit <a href="%s" target="_blank">Appearance → Customize → Additional CSS</a> to edit your custom CSS.', 'truenorth' ),
						esc_url( add_query_arg( array(
							'autofocus[section]' => 'custom_css',
						), admin_url( '/customize.php' ) ) )
					), truenorth_get_allowed_tags( 'guide' ) );
				?>
			</p>
			<?php
				// These are needed so that the respective $ci options won't reset. Do not remove.
				ci_panel_input( 'custom_css', '', array( 'input_type' => 'hidden' ) );
				ci_panel_input( 'custom_css_migrated', '', array( 'input_type' => 'hidden' ) );
			?>

		<?php else : ?>

			<p class="guide"><?php esc_html_e( 'Paste here any custom CSS code you might have.', 'truenorth' ); ?></p>
			<?php ci_panel_textarea( 'custom_css', __( 'CSS Code', 'truenorth' ) ); ?>

		<?php endif; ?>
	</fieldset>

<?php endif;
