<?php
// -> Disziplin: steuert die Filter-Buttons im Work-Modul und die Kanäle (CH 01–04) im About-Modul
register_taxonomy(
    'collection_discipline',
    ['collection'],
    [
        'label' => 'Disziplin',
        'labels' => [
            'name' => 'Disziplinen',
            'singular_name' => 'Disziplin',
            'menu_name' => 'Disziplinen',
            'all_items' => 'Alle Disziplinen',
            'edit_item' => 'Disziplin bearbeiten',
            'view_item' => 'Disziplin ansehen',
            'update_item' => 'Disziplin updaten',
            'add_new_item' => 'Neue Disziplin hinzufügen',
        ],
        'public' => true,
        // -> keine eigenen Archivseiten: gefiltert wird auf dem One-Pager
        'publicly_queryable' => false,
        'show_in_rest' => true,
        'show_in_nav_menus' => false,
        'show_admin_column' => true,
        'query_var' => false,
        'hierarchical' => true,
        'rewrite' => false,
    ],
);
