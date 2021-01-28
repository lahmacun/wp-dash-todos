<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://zahidefe.net
 * @since      1.0.0
 *
 * @package    Wp_Dash_Todos
 * @subpackage Wp_Dash_Todos/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wp_Dash_Todos
 * @subpackage Wp_Dash_Todos/includes
 * @author     Mustafa Zahid EFE <wordpress@zahidefe.net>
 */
class Wp_Dash_Todos_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-dash-todos',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
