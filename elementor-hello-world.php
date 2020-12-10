<?php
/**
 * Plugin Name: Opacity Change
 * Description: This is a plugin that changes the opacity.
 * Plugin URI:  https://sivacreative.com/
 * Version:     1.0.0
 * Author:      Siva Creative
 * Author URI:  https://sivacreative.com/
 * Text Domain: elementor-hello-world
<<<<<<< HEAD
 * Settings URI: https://sivacreative.com/
=======
 * Elementor tested up to: 3.0.0
 * Elementor Pro tested up to: 3.0.0
>>>>>>> 4fa494f9f4e12727f07a394ad09ec86bc9d42033
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


define( 'OPACITY_PLUGIN', '1.4.3' );
define( 'OPACITY_PLUGIN_PREVIOUS_STABLE_VERSION', '1.4.2' );

define( 'OPACITY_PLUGIN__FILE__', __FILE__ );
define( 'OPACITY_PLUGIN_PLUGIN_BASE', plugin_basename( OPACITY_PLUGIN__FILE__ ) );
define( 'OPACITY_PLUGIN_PATH', plugin_dir_path( OPACITY_PLUGIN__FILE__ ) );

define( 'OPACITY_PLUGIN_MODULES_PATH', OPACITY_PLUGIN_PATH . 'modules/' );
define( 'OPACITY_PLUGIN_URL', plugins_url( '/', OPACITY_PLUGIN__FILE__ ) );
define( 'OPACITY_PLUGIN_ASSETS_URL', OPACITY_PLUGIN_URL . 'assets/' );
define( 'OPACITY_PLUGIN_MODULES_URL', OPACITY_PLUGIN_URL . 'modules/' );


/**
 * Main Elementor Hello World Class
 *
 * The init class that runs the Hello World plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.2.0
 */
final class Elementor_Hello_World {

	/**
	 * Plugin Version
	 *
	 * @since 1.2.1
	 * @var string The plugin version.
	 */
	const VERSION = '1.2.1';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.2.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.2.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		// Load translation
		add_action( 'init', array( $this, 'i18n' ) );

		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 * Fired by `init` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'elementor-hello-world' );
	}

	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function init() {
		
		
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}
		
		
	
		add_action( 'elementor/elements/categories_registered', array($this,'add_elementor_widget_categories'));
		add_action( 'init', array($this,'myplugin_register_settings') );
		add_action('admin_menu', array($this,'myplugin_register_options_page'));
		add_action( 'admin_notices', 'opacity_change_admin_mesage' );
		add_action( 'admin_init', 'my_plugin_notice_dismissed' );
		add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );
		add_action('admin_bar_menu',  array($this,'add_toolbar_items'), 100);
		
		
		if ( is_admin() ) {
				add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( &$this, 'plugin_manage_link' ), 10, 4 );
						}
		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'plugin.php' );
		require_once( 'options_page.php' );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-hello-world' ),
			'<strong>' . esc_html__( 'Elementor Hello World', 'elementor-hello-world' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-hello-world' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-hello-world' ),
			'<strong>' . esc_html__( 'Elementor Hello World', 'elementor-hello-world' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-hello-world' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-hello-world' ),
			'<strong>' . esc_html__( 'OPACITY_PLUGIN', 'elementor-hello-world' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'elementor-hello-world' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
	
	
	public function add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'siva-plugins',
		[
			'title' => __( 'Siva Plugins', 'plugin-name' ),
			'icon' => 'fa fa-plug',
		]
	);
	$elements_manager->add_category(
		'second-category',
		[
			'title' => __( 'Second Category', 'plugin-name' ),
			'icon' => 'fa fa-plug',
		]
	);

}

public function myplugin_register_settings() {
   add_option( 'myplugin_option_name', 'This is my option value.');
   register_setting( 'myplugin_options_group', 'myplugin_option_name', 'myplugin_callback' );
   add_option( 'myplugin_option_id', 'This is my option id.');
   register_setting( 'myplugin_options_group', 'myplugin_option_id', 'myplugin_callback' );
}

public function myplugin_register_options_page() {
	
  add_options_page('Page Title', 'Opacity Change', 'manage_options', 'myplugin', 'myplugin_options_page');
  
}



public function add_toolbar_items($admin_bar){
    $admin_bar->add_menu( array(
        'id'    => 'opacity-change-siva',
        'title' => 'Opacity Change',
        'href'  => '/wp-admin/options-general.php?page=myplugin',
        'meta'  => array(
            'title' => __('Go To Plugin'),            
        ),
    ));






}


public function plugin_manage_link( $actions, $plugin_file, $plugin_data, $context ) {

    // add a 'Configure' link to the front of the actions list for this plugin

    return array_merge( array( 'configure' => '<a href="/wp-admin/options-general.php?page=myplugin">Settings</a>' ), $actions );

}
	
//end nc_settings_link()

}

// Instantiate Elementor_Hello_World.
new Elementor_Hello_World();


