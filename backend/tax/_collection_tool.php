<?php
// -> Tool: Software und Hardware, die im Projekt verwendet wurde (Karte + Case-Study-Kopf)
register_taxonomy(
    'collection_tool',
    ['collection'],
    [
        'label' => 'Tool',
        'labels' => [
            'name' => 'Tools',
            'singular_name' => 'Tool',
            'menu_name' => 'Tools',
            'all_items' => 'Alle Tools',
            'edit_item' => 'Tool bearbeiten',
            'view_item' => 'Tool ansehen',
            'update_item' => 'Tool updaten',
            'add_new_item' => 'Neues Tool hinzufügen',
            'separate_items_with_commas' => 'Tools mit Kommas trennen',
            'choose_from_most_used' => 'Aus den meistverwendeten Tools wählen',
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
