<?php
/**
 * Plugin Name: WP-Posting
 * Description: Send Post/Page to another WordPress
 * Plugin URI:
 * Version:     1.0
 * Author:      Mostafa Soufi
 * Author URI:  http://mostafa-soufi.ir
 * License:     MIT
 * Text Domain: wp-posting
 */
add_action('plugins_loaded', array(WP_Posting::get_instance(), 'plugin_setup'));

class WP_Posting
{
    /**
     * Plugin instance.
     *
     * @see get_instance()
     * @type object
     */
    protected static $instance = NULL;

    /**
     * URL to this plugin's directory.
     *
     * @type string
     */
    public $plugin_url = '';

    /**
     * Path to this plugin's directory.
     *
     * @type string
     */
    public $plugin_path = '';

    /**
     * Access this plugin’s working instance
     *
     * @wp-hook plugins_loaded
     * @since   2012.09.13
     * @return  object of this class
     */
    public static function get_instance()
    {
        NULL === self::$instance and self::$instance = new self;
        return self::$instance;
    }

    /**
     * Used for regular plugin work.
     *
     * @wp-hook plugins_loaded
     * @since   2012.09.10
     * @return  void
     */
    public function plugin_setup()
    {
        $this->plugin_url = plugins_url('/', __FILE__);
        $this->plugin_path = plugin_dir_path(__FILE__);
        $this->load_language('wp-posting');
        $this->load_classes();
    }

    /**
     * Constructor. Intentionally left empty and public.
     *
     * @see plugin_setup()
     * @since 2012.09.12
     */
    public function __construct()
    {
    }

    /**
     * Loads translation file.
     *
     * Accessible to other classes to load different language files (admin and
     * front-end for example).
     *
     * @wp-hook init
     * @param   string $domain
     * @since   2012.09.11
     * @return  void
     */
    public function load_language($domain)
    {
        load_plugin_textdomain(
            $domain,
            FALSE,
            $this->plugin_path . '/languages'
        );
    }

    public function load_classes()
    {
        $files = array(
            '/Setting',
            '/Metabox',
            '/Posting',
        );
        foreach ($files as $file) {
            include_once dirname(__FILE__) . '/includes' . $file . '.php';
        }
    }
}