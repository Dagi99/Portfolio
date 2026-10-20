<?php
// -> Rolle: was Dagi im Projekt gemacht hat (Case-Study-Kopf "My role")
register_taxonomy(
    'collection_role',
    ['collection'],
    [
        'label' => 'Rolle',
        'labels' => [
            'name' => 'Rollen',
            'singular_name' => 'Rolle',
            'menu_name' => 'Rollen',
            'all_items' => 'Alle Rollen',
            'edit_item' => 'Rolle bearbeiten',
            'view_item' => 'Rolle ansehen',
            'update_item' => 'Rolle updaten',
            'add_new_item' => 'Neue Rolle hinzufügen',
            'separate_items_with_commas' => 'Rollen mit Kommas trennen',
            'choose_from_most_used' => 'Aus den meistverwendeten Rollen wählen',
        ],
        'public' => true,
        'publicly_queryable' => false,
        'show_in_rest' => true,
        'show_in_nav_menus' => false,
        'show_admin_column' => true,
        'query_var' => false,
        'hierarchical' => false,
        'rewrite' => false,
    ],
);
