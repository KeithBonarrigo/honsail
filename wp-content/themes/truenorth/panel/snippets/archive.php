<?php global $ci, $ci_defaults, $load_defaults, $content_width; ?>
<?php if ($load_defaults===TRUE): ?>
<?php

	$ci_defaults['archive_no']  	= '5';
	$ci_defaults['archive_week'] 	= 'enabled';
	$ci_defaults['archive_month'] 	= 'enabled';
	$ci_defaults['archive_year'] 	= 'enabled';

?>
<?php else: ?>

	<fieldset id="ci-panel-archive">
		<legend><?php _e('Archive', 'truenorth'); ?></legend>
		<fieldset class="set">
			<p class="guide"><?php _e('The number of the latest posts displayed in the archive page.', 'truenorth'); ?></p>
			<?php ci_panel_input('archive_no', __('Number of latest posts', 'truenorth')); ?>
		</fieldset>
		<fieldset>
			<p class="guide"><?php _e('Use the following options to display various types of archives.', 'truenorth'); ?></p>
			<?php ci_panel_checkbox('archive_week', 'enabled', __('Display weekly archive', 'truenorth')); ?>
			<?php ci_panel_checkbox('archive_month', 'enabled', __('Display monthly archive', 'truenorth')); ?>
			<?php ci_panel_checkbox('archive_year', 'enabled', __('Display yearly archive', 'truenorth')); ?>
		</fieldset>
	</fieldset>

<?php endif; ?>