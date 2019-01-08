<?php
/**
 * Builds out customizer options
 *
 */

if ( ! function_exists( 'customizer_library_register' ) ) : /**
 * Configure settings and controls for the theme customizer
 *
 * @param  object $wp_customize The global customizer object.
 *
 * @return void
 */ {
	function customizer_library_register( $wp_customize ) {

		$customizer_library = Customizer_Library::Instance();

		$options = $customizer_library->get_options();

		// Bail early if we don't have any options.
		if ( empty( $options ) ) {
			return;
		}

		// Add the sections
		if ( isset( $options['sections'] ) ) {
			customizer_library_add_sections( $options['sections'], $wp_customize );
		}

		// Add the sections
		if ( isset( $options['panels'] ) ) {
			customizer_library_add_panels( $options['panels'], $wp_customize );
		}

		// Sets the priority for each control added
		$loop = 0;

		// Loops through each of the options
		foreach ( $options as $option ) {

			// Set blank description if one isn't set
			if ( ! isset( $option['description'] ) ) {
				$option['description'] = '';
			}

			if ( isset( $option['type'] ) ) {

				$loop ++;
				
				// Apply a default sanitization if one isn't set
				if ( ! isset( $option['sanitize_callback'] ) ) {
					$option['sanitize_callback'] = customizer_library_get_sanitization( $option['type']);
				}

				// Set blank active_callback if one isn't set
				if ( ! isset( $option['active_callback'] ) ) {
					$option['active_callback'] = '';
				}

				// Add the setting
				customizer_library_add_setting( $option, $wp_customize );

				// Priority for control
				if ( ! isset( $option['priority'] ) ) {
					$option['priority'] = $loop;
				}

				// Adds control based on control type
				switch ( $option['type'] ) {

					case 'text':
					case 'url':
					case 'select':
					case 'radio':
					case 'checkbox':
					case 'range':
					case 'number':
					case 'dropdown-pages':

						$wp_customize->add_control(
							$option['id'], $option
						);

						break;

					case 'color':

						$wp_customize->add_control(
							new WP_Customize_Color_Control(
								$wp_customize, $option['id'], $option
							)
						);

						break;

					case 'image':

						$wp_customize->add_control(
							new WP_Customize_Image_Control(
								$wp_customize,
								$option['id'], array(
									'label'             => $option['label'],
									'section'           => $option['section'],
									'sanitize_callback' => $option['sanitize_callback'],
									'priority'          => $option['priority'],
									'active_callback'   => $option['active_callback'],
									'description'      => $option['description']
								)
							)
						);

						break;

					case 'upload':

						$wp_customize->add_control(
							new WP_Customize_Upload_Control(
								$wp_customize,
								$option['id'], array(
									'label'             => $option['label'],
									'section'           => $option['section'],
									'sanitize_callback' => $option['sanitize_callback'],
									'priority'          => $option['priority'],
									'active_callback'   => $option['active_callback'],
									'description'      => $option['description']
								)
							)
						);

						break;

					case 'textarea':

						// Custom control required before WordPress 4.0
						if ( version_compare( $GLOBALS['wp_version'], '3.9.2', '<=' ) ) :

							$wp_customize->add_control(
								new Customizer_Library_Textarea(
									$wp_customize, $option['id'], $option
								)
							);

						else :

							$wp_customize->add_control( 'setting_id', array(
								$wp_customize->add_control(
									$option['id'], $option
								)
							) );

						endif;

						break;

					case 'content':
					case 'line':

						// error_log( print_r( $option ) );

						$wp_customize->add_control(
							new Customizer_Library_Content(
								$wp_customize, $option['id'], $option
							)
						);

						break;
						
					case 'repeater':

						$wp_customize->add_control(
							new Daisy_Store_Control_Repeater(
								$wp_customize, $option['id'], $option
							)
						);

						break;
						
					case 'background':

						$wp_customize->add_control(
							new Customize_Custom_Background_Control(
								$wp_customize, $option['id'], $option
							)
						);

						break;
						
					case 'iconpicker':

						$wp_customize->add_control(
							new Daisy_Store_Customize_Iconpicker_Control(
								$wp_customize, $option['id'], $option
							)
						);

						break;
					case 'radio-image':

						$wp_customize->add_control(
							new Daisy_Store_Customize_Control_Radio_Image(
								$wp_customize, $option['id'], $option
							)
						);

					break;
						
					case 'multiple-select':

						$wp_customize->add_control(
							new Daisy_Store_Customize_Control_Multiple_Select(
								$wp_customize, $option['id'], $option
							)
						);

					break;
					
					case 'multiple-checkbox':

						$wp_customize->add_control(
							new Daisy_Store_Customize_Control_Checkbox_Multiple(
								$wp_customize, $option['id'], $option
							)
						);

					break;
						
					case 'daisy_store_editor':
						$wp_customize->add_control(
							new Daisy_Store_Customize_Editor_Control(
								$wp_customize, $option['id'], $option
							)
						);
					break;
					case 'range-value':

						$wp_customize->add_control(
							new Customizer_Range_Value_Control(
								$wp_customize, $option['id'], $option
							)
						);

					break;
				}
			}
		}
	}
}

endif;

add_action( 'customize_register', 'customizer_library_register', 100 );

/**
 * Add the customizer sections
 *
 * @param  array $option
 *
 * @return void
 */
function customizer_library_add_sections( $sections, $wp_customize ) {

	foreach ( $sections as $section ) {

		if ( ! isset( $section['description'] ) ) {
			$section['description'] = FALSE;
		}

		$wp_customize->add_section( $section['id'], $section );
	}

}

/**
 * Add the customizer panels
 *
 * @param  array $option
 *
 * @return void
 */
function customizer_library_add_panels( $panels, $wp_customize ) {

	foreach ( $panels as $panel ) {

		if ( ! isset( $panel['description'] ) ) {
			$panel['description'] = FALSE;
		}

		$wp_customize->add_panel( $panel['id'], $panel );
	}

}


/**
 * Add the setting and proper sanitization
 *
 * @param  array $option
 *
 * @return void
 */
function customizer_library_add_setting( $option, $wp_customize ) {

	$settings_default = array(
		'default'              => NULL,
		'option_type'          => 'option',
		'capability'           => 'edit_theme_options',
		'theme_supports'       => NULL,
		'transport'            => NULL,
		'sanitize_callback'    => 'wp_kses_post',
		'sanitize_js_callback' => NULL,
	);

	// Settings defaults
	$settings = array_merge( $settings_default, $option );

	// Arguments for $wp_customize->add_setting
	$wp_customize->add_setting( $option['id'], array(
			'default'              => $settings['default'],
			'type'                 => $settings['option_type'],
			'capability'           => $settings['capability'],
			'theme_supports'       => $settings['theme_supports'],
			'transport'            => $settings['transport'],
			'sanitize_callback'    => $settings['sanitize_callback'],
			'sanitize_js_callback' => $settings['sanitize_js_callback'],
		)
	);



}



/**
 * Get default sanitization function for option type
 *
 * @param  array $option
 *
 * @return void
 */
function customizer_library_get_sanitization( $type ) {

	if ( 'select' == $type || 'radio' == $type ) {
		return 'customizer_library_sanitize_choices';
	}

	if ( 'checkbox' == $type ) {
		return 'customizer_library_sanitize_checkbox';
	}

	if ( 'color' == $type ) {
		return 'sanitize_hex_color';
	}

	if ( 'upload' == $type || 'image' == $type ) {
		return 'customizer_library_sanitize_file_url';
	}

	if ( 'text' == $type || 'textarea' == $type || 'iconpicker' == $type ) {
		return 'customizer_library_sanitize_text';
	}

	if ( 'url' == $type ) {
		return 'esc_url';
	}

	if ( 'range' == $type ) {
		return 'customizer_library_sanitize_range';
	}

	if ( 'dropdown-pages' == $type ) {
		return 'absint';
	}
	
	if ( 'repeater' == $type ) {
		return 'customizer_sanitize_repeater_setting';
	}
	

	// If a custom option is being used, return false
	return FALSE;
}
