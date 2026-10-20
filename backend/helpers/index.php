<?php
/**
 * Funktionen in dieser Datei können überall im Projekt verwendet werden.
 * Wenn eine neue globale Funktion benötigt wird, bitte hier ergänzen.
 *
 * Diese globalen Funktionen sind nicht Wordpress-spezifisch.
 */

// -> PHP-Daten in der Browser-Konsole anzeigen
function js_log(mixed ...$content): void
{
    foreach ($content as $c) {
        echo '<script>console.log(' . json_encode($c) . ')</script>';
    }
}

// -> Details einer Mediendatei anhand der ID laden
function get_media_by_id(int|string $id, string $size = 'm'): false|array
{
    $id = (int) $id;
    $data = [
        'title' => get_the_title($id),
        'alt' => get_post_meta($id, '_wp_attachment_image_alt', true) ?: get_the_title($id),
    ];
    $image = wp_get_attachment_image_src($id, $size);
    if ($image) {
        $data['src'] = $image[0];
        $data['width'] = (int) $image[1];
        $data['height'] = (int) $image[2];
        $data['caption'] = wp_get_attachment_caption($id) ?: '';
        $data['type'] = 'image';
    } else {
        $data['src'] = wp_get_attachment_url($id);
        $data['type'] = get_post_mime_type($id);
    }
    return $data;
}

// -> Ein Menu anhand des Keys laden
function get_menu_by_slug(string $slug): array
{
    $theme_locations = get_nav_menu_locations();
    if (!array_key_exists($slug, $theme_locations)) {
        return [];
    }
    $menu_obj = get_term($theme_locations[$slug], 'nav_menu');
    $menu = wp_get_nav_menu_items($menu_obj->name) ?: [];
    $items = [];
    foreach ($menu as $item) {
        $items[] = [
            'ID' => (int) $item->ID,
            'title' => $item->title,
            'url' => $item->url,
            'target' => $item->target,
        ];
    }
    return $items;
}

// -> Begriffe einer Taxonomie eines Beitrags als Array laden (Name + Slug)
function get_terms_of_post(int $id, string $taxonomy): array
{
    $terms = get_the_terms($id, $taxonomy);
    if (empty($terms) || is_wp_error($terms)) {
        return [];
    }
    return array_map(function ($term) {
        return [
            'name' => $term->name,
            'slug' => $term->slug,
        ];
    }, $terms);
}

// -> Zahl zweistellig formatieren (1 -> "01"), z.B. für Kanal-Nummern
function pad_number(int|string $number, int $length = 2): string
{
    return str_pad((string) (int) $number, $length, '0', STR_PAD_LEFT);
}

// -> Video-Link (Vimeo / YouTube) in ein Embed umwandeln, datenschutzfreundlich
function get_video_embed(string $url): string
{
    // -> YouTube ohne Tracking-Cookies laden
    $url = str_replace(['www.youtube.com/watch?v=', 'youtu.be/'], ['www.youtube-nocookie.com/embed/', 'www.youtube-nocookie.com/embed/'], $url);
    if (str_contains($url, 'youtube-nocookie.com/embed/')) {
        return sprintf(
            '<iframe src="%s" title="Video" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen loading="lazy"></iframe>',
            esc_url($url)
        );
    }
    return wp_oembed_get($url, ['width' => 1600]) ?: '';
}

// -> Vimeo-Embeds ohne Tracking laden (Do Not Track)
add_filter('oembed_fetch_url', function ($provider, $url) {
    if (str_contains($url, 'vimeo.com')) {
        $provider = add_query_arg('dnt', 'true', $provider);
    }
    return $provider;
}, 10, 2);
