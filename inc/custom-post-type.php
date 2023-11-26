<?php

class SCHP_CUSTOM_POST_TYPE
{
    public function __construct($singular_name, $plural_name, $icon)
    {
        $this->register_this_post_type($singular_name, $plural_name, $icon);
    }

    public function register_this_post_type($singular_name, $plural_name, $icon)
    {
        register_post_type(
            strtolower($singular_name),
            array(
                'label'                 => __($singular_name, 'text_domain'),
                'description'           => __('Post Type Description', 'text_domain'),
                'labels'                => array(
                    'name'               => $plural_name,
                    'singular_name'      => $singular_name,
                    'menu_name'          => $plural_name,
                    'all_items'          => 'Todas as ' . $plural_name,
                    'add_new'            => 'Adicionar Nova',
                    'add_new_item'       => 'Adicionar Nova ' . $singular_name,
                    'edit_item'          => 'Editar ' . $singular_name,
                    'new_item'           => 'Nova ' . $singular_name,
                    'view_item'          => 'Ver ' . $singular_name,
                    'search_items'       => 'Buscar ' . $plural_name,
                ),
                'supports'              => array('title'),
                'hierarchical'          => false,
                'public'                => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_position'         => 5,
                'menu_icon'             => $icon,
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'can_export'            => true,
                'has_archive'           => true,
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
                'capability_type'       => 'page',
            )
        );
    }
}

add_action("init", function () {
    new SCHP_CUSTOM_POST_TYPE('Escola', 'Escolas', SCHP_PLUGIN_URL . 'assets/emojis/school.svg');
    new SCHP_CUSTOM_POST_TYPE('Disciplina', 'Disciplinas', SCHP_PLUGIN_URL . 'assets/emojis/books.svg');
    //https://iconduck.com/emojis/16569/books
});
