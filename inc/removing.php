<?php

class SCHP_REMOVER
{

    public $pages_to_remove = ['edit-comments.php', 'edit.php?post_type=page', 'themes.php', 'tools.php'];
    public $roles_to_remove = ['subscriber', 'contributor', 'author', 'editor'];

    public function __construct()
    {
        add_action('init', [$this, 'remove_default_roles']);
        add_action('init', [$this, 'block_pages']);
        add_action('admin_menu', [$this, 'hide_default_post_types']);
        add_action('wp_dashboard_setup', [$this, 'remove_dashboard_widgets']);
    }

    public function remove_default_roles()
    {
        global $wp_roles;

        if (!isset($wp_roles)) {
            $wp_roles = new WP_Roles();
        }

        foreach ($this->roles_to_remove as $role) {
            if (isset($wp_roles->roles[$role])) {
                unset($wp_roles->roles[$role]);
                unset($wp_roles->role_objects[$role]);
            }
        }
    }

    public function hide_default_post_types()
    {

        foreach ($this->pages_to_remove as $page) {
            remove_menu_page($page);
        }

        remove_submenu_page('index.php', 'update-core.php');
    }

    public function block_pages()
    {

        foreach ($this->pages_to_remove as $page) {
            if (strpos($_SERVER['REQUEST_URI'], $page) !== false) {
                wp_die('Você está utilizando o SchoolPlu, portanto não precisa acessar essa página. <a href="' . admin_url('/index.php') . '">Voltar</a>');
            }
        }
    }

    public function remove_dashboard_widgets()
    {
        global $wp_meta_boxes;
        unset($wp_meta_boxes['dashboard']['normal']['core']);
        unset($wp_meta_boxes['dashboard']['side']['core']);
    }
}


new SCHP_REMOVER();
