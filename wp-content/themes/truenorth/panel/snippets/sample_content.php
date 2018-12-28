<?php
// The manually-installed sample content zip files have been deprecated. This file is left for compatibility only.
// Please use the "One Click Demo Import" plugin to install sample content for this theme.
/* global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php

?>
<?php else: ?>

	<?php if ( ! CI_WHITELABEL ): ?>
		<?php $sample_content_url = apply_filters( 'truenorth_sample_content_url',
			sprintf( 'https://www.cssigniter.com/sample_content/%s.zip', TRUENORTH_NAME ),
			'https://www.cssigniter.com/sample_content/',
			TRUENORTH_NAME
		); ?>
		<?php if ( ! empty( $sample_content_url ) ): ?>
			<fieldset id="ci-panel-sample-content" class="set">
				<legend><?php _e( 'Sample Content', 'truenorth' ); ?></legend>
				<p class="guide"><?php echo sprintf( __( 'You can download sample content to help you get things started with this theme. You need to unzip the downloaded file, and then upload the resulting XML file via <a href="%s">Tools -> Import -> WordPress</a>. Please note that the images imported with the sample content are licensed, and therefore you are not allowed to use or redistribute them.', 'truenorth' ), admin_url( 'import.php' ) ); ?></p>
				<a href="<?php echo esc_url( $sample_content_url ); ?>"><?php _e( 'Download sample content', 'truenorth' ); ?></a>
			</fieldset>
		<?php endif; ?>
	<?php endif; ?>

<?php endif; */
