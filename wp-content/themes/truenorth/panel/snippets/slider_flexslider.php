<?php global $ci, $ci_defaults, $load_defaults, $content_width; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	
	$ci_defaults['slider_autoslide'] 	= 'enabled';
	$ci_defaults['slider_effect'] 		= 'fade';
	$ci_defaults['slider_direction'] 	= 'horizontal';
	$ci_defaults['slider_speed'] 		= 3000;
	$ci_defaults['slider_duration']		= 600;

?>
<?php else: ?>
		
	<fieldset id="ci-panel-slider-flexslider" class="set">
		<legend><?php _e('Main Slider', 'truenorth'); ?></legend>
		<p class="guide"><?php _e('The following options control the main slider. You may enable or disable auto-sliding by checking the appropriate option and further control its behavior.' , 'truenorth'); ?></p>
		<fieldset id="flexslider-slider-autoslide">
			<?php ci_panel_checkbox('slider_autoslide', 'enabled', __('Enable auto-slide', 'truenorth')); ?>
		</fieldset>
		<fieldset id="flexslider-slider-effect">
			<?php 
				$slider_effects = array(
					'fade' => _x('Fade', 'slider effect', 'truenorth'),
					'slide' => _x('Slide','slider effect', 'truenorth')
				);
				ci_panel_dropdown('slider_effect', $slider_effects, __('Slider Effect', 'truenorth'));
			?>
		</fieldset>
		<fieldset id="flexslider-slider-direction">
			<?php 
				$slider_direction = array(
					'horizontal' => _x('Horizontal', 'slider direction', 'truenorth'),
					'vertical' => _x('Vertical','slider direction', 'truenorth')
				);
				ci_panel_dropdown('slider_direction', $slider_direction, __('Slide Direction (only for <b>Slide</b> effect)', 'truenorth'));
			?>
		</fieldset>
		<fieldset id="flexslider-slider-speed">
			<?php ci_panel_input('slider_speed', __('Slideshow speed in milliseconds (smaller number means faster)', 'truenorth')); ?>
		</fieldset>
		<fieldset id="flexslider-slider-duration">
			<?php ci_panel_input('slider_duration', __('Animation duration in milliseconds (smaller number means faster)', 'truenorth')); ?>
		</fieldset>
	</fieldset>
		
<?php endif; ?>