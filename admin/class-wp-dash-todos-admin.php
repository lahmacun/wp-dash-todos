<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://zahidefe.net
 * @since      1.0.0
 *
 * @package    Wp_Dash_Todos
 * @subpackage Wp_Dash_Todos/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Dash_Todos
 * @subpackage Wp_Dash_Todos/admin
 * @author     Mustafa Zahid EFE <wordpress@zahidefe.net>
 */
class Wp_Dash_Todos_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Dash_Todos_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Dash_Todos_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-dash-todos-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Dash_Todos_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Dash_Todos_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-dash-todos-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Adds the dashboard box
	 */
	public function wdt_dashboard_box() {
		global $wp_meta_boxes;

		wp_add_dashboard_widget('wdt_todo_list', __( 'WP Dash Todo\'s', 'wdt' ), [ $this, 'wdt_dashboard_box_content' ] );
	}

	/**
	 * Adds to dashboard box content
	 */
	public function wdt_dashboard_box_content() {
		$todos = get_user_meta( get_current_user_id(), 'wdt_todos', true );
		ob_start();
		include_once WDT_PATH . 'admin/partials/todo-canvas.php';
		ob_get_flush();
	}

	/**
	 * Handles the ajax request to save to do data
	 */
	public function wdt_save_todos() {
		if ( isset( $_POST['action'] ) && $_POST['action'] === 'wdt_save_todos' ) {
			if (!isset($_POST['todo_items'])) {
				echo wp_json_encode(['status' => 'failure', 'message' => __( 'todo_items parameter is mandatory.', 'wdt' )]);
				wp_die();
			}

			$todo_items = str_replace('\\', '', ($_POST['todo_items']));
			$todo_items = json_decode( $todo_items, true );
			if (!$todo_items) {
				echo wp_json_encode(['status' => 'failure', 'message' => __( 'Please send a valid json.', 'wdt' ) ]);
				wp_die();
			}

			update_user_meta(get_current_user_id(), 'wdt_todos', $todo_items);
			echo wp_json_encode(['status' => 'success']);
			wp_die();
		}
	}
}
