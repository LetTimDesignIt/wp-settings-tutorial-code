<?php

/**
 * Source code for first post in the WordPress settings series.  
 * @link    https://timscheman.com/blog/how-to-add-a-settings-page-to-wordpress/
 * @author  https://timscheman.com/
 */

function ltid_settings_page_callback()
{
	echo __('<h1>This is the page content</h1>', 'ltdi');
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
