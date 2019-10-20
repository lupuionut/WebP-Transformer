<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://ionutlupu.work
 * @since             1.0.0
 * @package           Webp_Transformer
 *
 * @wordpress-plugin
 * Plugin Name:       WebP Transformer
 * Plugin URI:        https://ionutlupu.work
 * Description:       Transform image in webp format during upload.
 * Version:           1.0.0
 * Author:            Ionut Lupu
 * Author URI:        https://ionutlupu.work
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       webp-transformer
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WEBP_TRANSFORMER_VERSION', '1.0.0' );

// require external libraries
require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-webp-transformer-activator.php
 */
function activate_webp_transformer() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-webp-transformer-activator.php';
	Webp_Transformer_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-webp-transformer-deactivator.php
 */
function deactivate_webp_transformer() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-webp-transformer-deactivator.php';
	Webp_Transformer_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_webp_transformer' );
register_deactivation_hook( __FILE__, 'deactivate_webp_transformer' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-webp-transformer.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_webp_transformer() {

	$plugin = new Webp_Transformer();
	$plugin->run();

}
run_webp_transformer();
