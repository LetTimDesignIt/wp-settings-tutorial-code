<?php

/**
 * Source code for eigth post in the WordPress settings series.  
 * @link    https://timscheman.com/blog/add-wordpress-settings-checkbox/
 * @author  https://timscheman.com/
 */

function ltdi_register_settings()
{
    add_settings_section(
        'ltdi_theme_settings_section',
        __('Theme Settings', 'ltdi'),
        'ltdi_section_introduction',
        'ltdi_theme_settings'
    );

    if (false == get_option('ltdi_theme_settings')) {
        $defaults = [
            'setting_field_one'             => '',
            'setting_field_two'             => '',
            'setting_field_three'           => '',
            'setting_textarea_field'        => '',
            'setting_wp_editor_field'       => '',
            'setting_password_field'        => '',
            'setting_select_field'          => '1',
            'setting_radio_button_field'    => 'value-01',
            'setting_checkbox_field'        => [] /* Add new default */
        ];
        add_option('ltdi_theme_settings', $defaults);
    }

    add_settings_field(
        'setting_field_one',
        __('Setting Field One', 'ltdi'),
        'ltdi_get_text_input',
        'ltdi_theme_settings',
        'ltdi_theme_settings_section',
        [
	        'label_for' => 'setting_field_one',
	        'class'     => 'setting_field_one'
        ]	
    );

    add_settings_field(
        'setting_field_two',
        __('Setting Field Two', 'ltdi'),
        'ltdi_get_text_input',
        'ltdi_theme_settings',
        'ltdi_theme_settings_section',
        [
            'label_for' => 'setting_field_two',
	        'class'     => 'setting_field_two'
        ]
    );

    add_settings_field(
        'setting_field_three',
        __('Setting Field Three', 'ltdi'),
        'ltdi_get_text_input',
        'ltdi_theme_settings',
        'ltdi_theme_settings_section',
        [
	        'label_for' => 'setting_field_three',
	        'class'     => 'setting_field_three'
        ]	
    );

    add_settings_field(
        'setting_textarea_field',
        __('Textarea Setting', 'ltdi'),
        'ltdi_get_textarea_input',
        'ltdi_theme_settings',
        'ltdi_theme_settings_section',
        [
	        'label_for' => 'setting_textarea_field',
	        'class'     => 'setting_textarea_field'
        ]	
    );

    add_settings_field(
        'setting_wp_editor_field',
        __('WP Editor Setting', 'ltdi'),
        'ltdi_get_editor_input',
        'ltdi_theme_settings',
        'ltdi_theme_settings_section',
        [
	        'label_for' => 'setting_wp_editor_field',
	        'class'     => 'setting_wp_editor_field'
        ]	
    );

    add_settings_field(
        'setting_password_field',
        __('Password Setting', 'ltdi'),
        'ltdi_get_password_input',
        'ltdi_theme_settings',
        'ltdi_theme_settings_section',
        [
	        'label_for' => 'setting_password_field',
	        'class'     => 'setting_password_field'
        ]	
    );

    add_settings_field(
        'setting_select_field',
        __('Select Setting', 'ltdi'),
        'ltdi_get_select_input',
        'ltdi_theme_settings',
        'ltdi_theme_settings_section',
        [
            'label_for' => 'setting_select_field',
            'class'     => 'setting_select_field',
            'options' => [
                [
                    'value' => '1',
                    'label' => 'Option One'
                ],
                [
                    'value' => '2',
                    'label' => 'Option Two'
                ],
                [
                    'value' => '3',
                    'label' => 'Option Three'
                ]
            ]
        ]
    );

    add_settings_field(
        'setting_radio_button_field',
        __('Radio Button Setting', 'ltdi'),
        'ltdi_get_radio_input',
        'ltdi_theme_settings',
        'ltdi_theme_settings_section',
        [
            'label_for' => 'setting_radio_button_field',
            'class'     => 'setting_radio_button_field',
            'options' => [
                [
                    'value' => 'value-01',
                    'label' => 'Option One'
                ],
                [
                    'value' => 'value-02',
                    'label' => 'Option Two'
                ],
                [
                    'value' => 'value-03',
                    'label' => 'Option Three'
                ]
            ]
        ]
    );

    /**
     * New Code: adding Checkbox input via the callback "ltdi_get_checkbox_input".
     */
    add_settings_field(
        'setting_checkbox_field',
        __('Checkbox Setting', 'ltdi'),
        'ltdi_get_checkbox_input',
        'ltdi_theme_settings',
        'ltdi_theme_settings_section',
        [
            'label_for' => 'setting_checkbox_field',
            'class'     => 'setting_checkbox_field',
            'options' => [
                [
                    'value' => '1',
                    'label' => 'Option One'
                ],
                [
                    'value' => '2',
                    'label' => 'Option Two'
                ],
                [
                    'value' => '3',
                    'label' => 'Option Three'
                ]
            ]
        ]
    );
    
    register_setting(
        'ltdi_theme_settings',
        'ltdi_theme_settings',
        'ltdi_setting_sanitization'
    );
}
add_action('admin_init', 'ltdi_register_settings');

function ltdi_section_introduction()
{
    echo __('This is the Section Introduction', 'ltdi');
}

function ltdi_get_text_input($args)
{
    $settings = \get_option('ltdi_theme_settings');
    $value = $settings[$args['label_for']] ?? '';

    printf(
        '<input type="text" id="%1$s" name="ltdi_theme_settings[%1$s]" value="%2$s" />',
        $args['label_for'],
        $value
    );
};

function ltdi_get_textarea_input($args)
{
    $settings = \get_option('ltdi_theme_settings');
    $value    = $settings[$args['label_for']] ?? '';
 
    printf(
        '<textarea id="%1$s" name="ltdi_theme_settings[%1$s]" rows="8" cols="100">%2$s</textarea>',
        $args['label_for'],
        $value
    );
}

function ltdi_get_editor_input($args)
{
    $settings = \get_option('ltdi_theme_settings');
    $value    = $settings[$args['label_for']] ?? '';
    $editor_id = 'ltdi_theme_settings[' . $args['label_for'] . ']';
    $options = [
		'media_buttons' => false
    ];

    echo \wp_editor($value, $editor_id, $options);
}

function ltdi_get_password_input($args)
{
    $settings = \get_option('ltdi_theme_settings');
    $value    = $settings[$args['label_for']] ?? '';

    printf(
		'<input type="password" id="%1$s" name="ltdi_theme_settings[%1$s]" value="%2$s" />',
		$args['label_for'],
		$value
	);
}

function ltdi_get_select_input($args)
{
    $settings = \get_option('ltdi_theme_settings');

    printf(
		'<select id="%1$s" name="ltdi_theme_settings[%1$s]" />',
		$args['label_for']
	);

	foreach ($args['options'] as $option) {
		$selected = selected($settings[$args['label_for']], $option['value'], false);

		printf(
			'<option value="%1$s" %3$s>%2$s</option>',
			$option['value'],
			$option['label'],
			$selected
		);
	}
}

function ltdi_get_radio_input($args)
{
    $nameAttr = "ltdi_theme_settings[{$args['label_for']}]";
    $settings = \get_option('ltdi_theme_settings');
    
    echo '<fieldset>';
    foreach ($args['options'] as $option) {
        $checked = checked($settings[$args['label_for']], $option['value'], false);

        printf(
            '<input type="radio" name="%1$s" value="%2$s" %5$s /><label for="%4$s">%3$s</label>',
            $nameAttr,
            $option['value'],
            $option['label'],
            $args['label_for'],
            $checked
        );
    }
    echo '</fieldset>';
}

/**
 * New Code: "ltdi_get_checkbox_input" callback that builds the HTML for the Checkbox input.
 */
function ltdi_get_checkbox_input($args)
{
    $settings = \get_option('ltdi_theme_settings');
    $selected = false;
    
    echo '<fieldset>';
    foreach ($args['options'] as $option) {
        
        $nameAttr = "ltdi_theme_settings[{$args['label_for']}][]";

		if (!empty($settings[$args['label_for']])) {
			$selected = in_array($option['value'], $settings[$args['label_for']]);
		}

        $checked = \checked($selected, true, false);

        printf(
            '<input type="checkbox" name="%1$s" value="%2$s" %5$s /><label for="%4$s">%3$s</label>',
            $nameAttr,
            $option['value'],
            $option['label'],
            $args['label_for'],
            $checked
        );
    }
    echo '</fieldset>';
}

function ltdi_setting_sanitization($input)
{
    $output = [];
   
   foreach($input as $key => $value) {
        if (!isset($input[$key])) {
            continue;
        }

        if (is_array($value)) {
			foreach($value as $index => $innerValue) {
				$output[$key][$index] = strip_tags(stripslashes($innerValue) );
			}
		} else {
			$output[$key] = strip_tags(stripslashes($input[$key]));
		}
   }

   return apply_filters('ltdi_setting_validation', $output, $input);
}

function ltid_settings_page_callback()
{
	echo '<div class="wrap">';
	echo __('<h1>This is the page content</h1>', 'ltdi');
	echo '<form method="post" action="options.php">';

	settings_fields('ltdi_theme_settings');
	do_settings_sections('ltdi_theme_settings');
	submit_button();

	echo '</form>';
	echo '</div';
}

function ltdi_get_settings_menu()
{
    add_options_page(
		__('LTDI Theme Options', 'ltdi'),
		__('LTDI Theme Options', 'ltdi'),
		'manage_options',
		'ltdi-options.php',
		'ltid_settings_page_callback'
	);
}
add_action('admin_menu', 'ltdi_get_settings_menu');
