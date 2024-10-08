<?php

/**
 * Source code for second post in the WordPress settings series.  
 * @link    https://timscheman.com/blog/add-wordpress-settings-without-a-plugin/
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
            'setting_field_one'     => '',
            'setting_field_two'     => '',
            'setting_field_three'   => '',
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
    $value    = $settings[$args['label_for']] ?? '';

    printf(
        '<input type="text" id="%1$s" name="ltdi_theme_settings[%1$s]" value="%2$s" />',
        $args['label_for'],
        $value
    );
};

function ltdi_setting_sanitization($input)
{
    $output = [];
   
   foreach($input as $key => $value) {

       if (isset( $input[$key])) {
           $output[$key] = strip_tags(stripslashes($input[ $key ]));
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
