<?php

class SCHP_ROLES
{

    public function __construct()
    {
        add_action('init', [$this, 'create_student_role']);
        add_action('init', [$this, 'create_teacher_role']);
    }

    public function create_student_role()
    {
        add_role('aluno', 'Aluno', [
            'read'         => true,
            'edit_profile' => true,
        ]);
    }
    public function create_teacher_role()
    {
        add_role('professor', 'Professor', [
            'read'         => true,
            'edit_profile' => true,
            'edit_published_posts' => true,
            'upload_files' => true,
            'publish_posts' => true,
            'delete_published_posts' => true
        ]);
    }
}

new SCHP_ROLES();
