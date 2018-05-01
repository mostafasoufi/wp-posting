<?php

namespace WP_Posting;

/**
 * Class Metabox
 * @package WP_Posting
 */
class Posting
{
    /**
     * @var array
     */
    private $website = array('api_url', 'username', 'password');

    /**
     * @var int
     */
    private $attachment_id = 0;

    /**
     * @var string
     */
    private $post_status = 'draft';

    /**
     * Constructor.
     */
    public function __construct()
    {
        // Initial metabox
        new Metabox;

        add_action('publish_post', array($this, 'publish_post'));

        // Set website credential
        $this->website = array(
            'api_url' => '',
            'username' => '',
            'password' => '',
        );
    }

    /**
     * Publish post to another websites
     * @param $post_id
     * @return void
     */
    public function publish_post($post_id)
    {
        // Check post id
        if (!$_POST['posting_website_id']) {
            return;
        }

        // Get data
        $posting_website_id = $_POST['posting_website_id'];

        // Check the post has attachment
        if (has_post_thumbnail($post_id)) {
            $this->attachment_id = $this->send_attachment($post_id);
        }

        // Set post status
        if ($_POST['posting_status']) {
            if ($_POST['posting_status'] == 'publish') {
                $this->post_status = 'publish';
            } elseif ($_POST['posting_status'] == 'draft') {
                $this->post_status = 'draft';
            }
        }

        // Submit post
        $this->send_post($post_id);
    }

    /**
     * @param $post_id
     * @return bool
     */
    private function send_attachment($post_id)
    {
        // Get attachment ID
        $attachment_id = get_post_thumbnail_id($post_id);
        $attachment_info = get_attached_file($attachment_id);

        if (!$attachment_info) {
            return false;
        }

        $file = @fopen($attachment_info, 'r');
        $file_size = filesize($attachment_info);
        $file_data = fread($file, $file_size);

        $data = array(
            'method' => 'POST',
            'headers' => array(
                'Authorization' => $this->get_authorization(),
                'Content-Disposition' => 'attachment; filename="' . basename($attachment_info) . '"',
            ),
            'body' => $file_data
        );

        // Send data
        $response = wp_remote_post($this->website['api_url'] . '/wp/v2/media', $data);

        if (is_wp_error($response)) {
            return false;
        }

        $response_code = wp_remote_retrieve_response_code($response);

        if ($response_code == 200 or $response_code == 201) {
            $body = json_decode($response['body']);

            if (isset($body->id)) {
                return $body->id;
            }
        }
    }

    /**
     * @param $post_id
     * @return bool
     */
    private function send_post($post_id)
    {
        // Get post
        $post = get_post($post_id);

        $data = array(
            'method' => 'POST',
            'headers' => array(
                'Authorization' => $this->get_authorization(),
            ),
            'body' => array(
                'title' => $post->post_title,
                'content' => $post->post_content,
                'featured_media' => $this->attachment_id,
                'status' => $this->post_status,
                'format' => get_post_format($post_id),
            )
        );

        // Send data
        $response = wp_remote_post($this->website['api_url'] . '/wp/v2/posts', $data);

        if (is_wp_error($response)) {
            return false;
        }

        $response_code = wp_remote_retrieve_response_code($response);

        if ($response_code == 200 or $response_code == 201) {
            $body = json_decode($response['body']);

            if (isset($body->id)) {
                return $body->id;
            }
        }
    }

    /**
     * Get Authorization
     * @return string
     */
    private function get_authorization()
    {
        return 'Basic ' . base64_encode($this->website['username'] . ':' . $this->website['password']);
    }
}

new Posting;