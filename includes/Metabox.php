<?php

namespace WP_Posting;

/**
 * Class Metabox
 * @package WP_Posting
 */
class Metabox
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        if (is_admin()) {
            add_action('post_submitbox_misc_actions', array($this, 'modify_metabox'));
        }
    }

    /**
     * Modify Metabox
     */
    public function modify_metabox()
    {
        include_once dirname( __FILE__ ) . "/templates/Metabox.php";
    }
}