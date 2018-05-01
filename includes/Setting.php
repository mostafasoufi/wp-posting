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
    public static $option_name;

    /**
     * @var mixed|string|void
     */
    public static $options;

    /**
     * Setting constructor.
     */
    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_admin_menu'));

        Setting::$option_name = 'wpposting_websites';
        Setting::$options = get_option(Setting::$option_name);
    }

    public function add_admin_menu()
    {
        add_options_page('WP-Posting Setting', 'WP-Posting', 'manage_options', 'wp-posting', array($this, 'display_page'));
    }

    public function display_page()
    {
        if (isset($_POST['submit']) and isset($_POST['name']) and isset($_POST['username']) and isset($_POST['password']) and isset($_POST['api_url'])) {
            $this->add_website($_POST);
        }

        if (isset($_GET['page']) and isset($_GET['action']) and isset($_GET['website'])) {
            if ($_GET['action'] == 'delete') {
                $this->delete_website($_GET['website']);
            }
        }

        include_once dirname(__FILE__) . "/templates/Setting.php";
    }

    /**
     * @param $param
     */
    private function add_website($param)
    {
        // Clean param
        $_param = array();
        foreach ($param as $key => $value) {
            $_param[$key] = esc_attr($value);
        }

        if (isset(self::$options[$_param['name']])) {
            return;
        }

        $data = array(
            $_param['name'] => array(
                'username' => $_param['username'],
                'password' => $_param['password'],
                'api_url' => $_param['api_url']
            )
        );

        if (self::$options) {
            // Update option
            update_option(self::$option_name, array_merge($data, self::$options));
        } else {
            // Update option
            update_option(self::$option_name, $data);
        }
    }

    private function delete_website($website_name)
    {
        $data = self::$options;

        if (isset($data[$website_name])) {
            unset($data[$website_name]);

            // Update option
            update_option(self::$option_name, $data);

            return;
        }
    }

    public static function getWebsites($name = false)
    {
        if ($name) {
            if (empty(self::$options[$name])) {
                return false;
            }

            return self::$options[$name];
        }

        return self::$options;
    }
}

new Setting;