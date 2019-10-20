<?php
use WebPConvert\WebPConvert;

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://ionutlupu.work
 * @since      1.0.0
 *
 * @package    Webp_Transformer
 * @subpackage Webp_Transformer/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Webp_Transformer
 * @subpackage Webp_Transformer/admin
 * @author     Ionut Lupu <lupu.ionut@pm.me>
 */
class Webp_Transformer_Admin {

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
		 * defined in Webp_Transformer_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Webp_Transformer_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

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
		 * defined in Webp_Transformer_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Webp_Transformer_Loader will then create the relationship
		 * be
         tween the defined hooks and the functions defined in this
		 * class.
		 */
	}

   public function generate_webp($metadata, $id) {
        $upload_dir = wp_upload_dir();
        $files = [];

        if (!empty($metadata)) {
            $original = [];
            $original['file'] = $upload_dir['basedir'] . '/' . $metadata['file'];
            $original['width'] = $metadata['width'];
            $original['height'] = $metadata['height'];
            $files[] = $original;

            if (!empty($metadata['sizes'])) {
                foreach ($metadata['sizes'] as $k => $file) {
                    $file['file'] = $upload_dir['path'] . '/' . $file['file'];
                    $files[] = $file;
                }
            }
        }

        $this->_generate_webp($files);
        return $metadata;
    }

    private function _generate_webp($files) {
        if (!empty($files)) {
            $original = $files[0];
            foreach ($files as $file) {
                if (!file_exists($file['file'])) {
                    $image = wp_get_image_editor($original['file']);
                    $image->resize($file['width'], $file['height']);
                    $image->save($file['file']);
                }
                $destination = $file['file'] . '.webp';
                WebPConvert::convert($file['file'], $destination, []);
            }
        }
    }
}
