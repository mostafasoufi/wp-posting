<?php

namespace WP_Posting;

/**
 * Class Metabox
 * @package WP_Posting
 */
class Setting
{
    /**
     * @var mixed|string|void
     */
    public $options;

    /**
     * Setting constructor.
     */
    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_admin_menu'));

        $this->options = get_option('wpposting_websites');
    }

    public function add_admin_menu()
    {
        add_options_page('WP-Posting Setting', 'WP-Posting Setting', 'manage_options', 'wp-posting', array($this, 'display_page'));
    }

    public function display_page()
    {
        include_once dirname( __FILE__ ) . "/templates/Setting.php";
    }
}

new Setting;