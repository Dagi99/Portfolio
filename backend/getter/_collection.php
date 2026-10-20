<?php
// -> Getter für den CPT "Collection" und die Disziplinen

// -> Alle Daten eines Projekts für Karte und Case Study
function get_collection_by_id(int $id): array {
    $disciplines = get_terms_of_post($id, 'collection_discipline');
    $loop_video = carbon_get_post_meta($id, 'loop_video');
    $thumbnail = carbon_get_post_meta($id, 'thumbnail');
    $has_case = (bool) carbon_get_post_meta($id, 'has_case');

    return [
        'id' => $id,
        'title' => get_the_title($id),
        'url' => $has_case ? get_permalink($id) : false,
        'teaser' => carbon_get_post_meta($id, 'teaser'),
        'year' => carbon_get_post_meta($id, 'year'),
        'type' => carbon_get_post_meta($id, 'type'),
        'subtitle' => carbon_get_post_meta($id, 'subtitle'),
        'team' => carbon_get_post_meta($id, 'team'),
        'thumbnail' => $thumbnail ? get_media_by_id($thumbnail, 'l') : false,
        'thumbnail_large' => $thumbnail ? get_media_by_id($thumbnail, 'xl') : false,
        'loop_video' => $loop_video ? wp_get_attachment_url($loop_video) : false,
        'disciplines' => $disciplines,
        // -> Slugs als Leerzeichen-Liste für das data-Attribut des Filters
        'discipline_slugs' => implode(' ', array_column($disciplines, 'slug')),
        'tools' => array_column(get_terms_of_post($id, 'collection_tool'), 'name'),
        'roles' => array_column(get_terms_of_post($id, 'collection_role'), 'name'),
    ];
}

// -> Mehrere Projekte laden: ausgewählte IDs in dieser Reihenfolge, sonst alle nach "Reihenfolge"
function get_collection_items(array $ids = []): array {
    $args = [
        'post_type' => 'collection',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'fields' => 'ids',
        'no_found_rows' => true,
    ];
    if (!empty($ids)) {
        $args['post__in'] = $ids;
        $args['orderby'] = 'post__in';
    } else {
        $args['orderby'] = ['menu_order' => 'ASC', 'date' => 'DESC'];
    }
    $items = [];
    foreach (get_posts($args) as $index => $id) {
        $item = get_collection_by_id($id);
        $item['number'] = pad_number($index + 1);
        $items[] = $item;
    }
    return $items;
}

// -> Disziplinen mit Kanal-Nummer, sortiert nach Kanal (CH 01 …)
function get_disciplines(bool $only_used = true): array {
    $terms = get_terms([
        'taxonomy' => 'collection_discipline',
        'hide_empty' => $only_used,
    ]);
    if (empty($terms) || is_wp_error($terms)) {
        return [];
    }
    $disciplines = array_map(function ($term) {
        $channel = (int) carbon_get_term_meta($term->term_id, 'channel');
        return [
            'name' => $term->name,
            'slug' => $term->slug,
            'description' => $term->description,
            'channel' => $channel,
            'channel_label' => 'CH ' . pad_number($channel ?: 0),
        ];
    }, $terms);
    // -> Disziplinen ohne Kanal-Nummer landen am Ende
    usort($disciplines, fn ($a, $b) => ($a['channel'] ?: 999) <=> ($b['channel'] ?: 999));
    return $disciplines;
}

// -> Nächstes Projekt (für den Link am Ende einer Case Study)
function get_next_collection_item(int $current_id): array|false {
    $items = array_values(array_filter(
        get_collection_items(),
        fn ($item) => $item['url'] !== false
    ));
    if (count($items) < 2) {
        return false;
    }
    foreach ($items as $index => $item) {
        if ($item['id'] === $current_id) {
            return $items[($index + 1) % count($items)];
        }
    }
    return $items[0];
}
