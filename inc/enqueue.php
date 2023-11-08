<?php


class SCHP_ENQUEUER
{

    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue_custom_admin_style']);
    }

    public function enqueue_custom_admin_style()
    {
        wp_enqueue_style('custom-admin-style', SCHP_PLUGIN_URL . 'assets/css/index.css', [], SCHP_VERSION, 'all');
    }
}

new SCHP_ENQUEUER();
