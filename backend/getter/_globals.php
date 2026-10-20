<?php
// -> Getter für die globalen Informationen (Globales im Backend)

function get_globals_site_label(): string|false {
    $label = carbon_get_theme_option('site_label');
    return $label ?: false;
}

// -> Verfügbarkeit + Status-Punkt für den Header
function get_globals_availability(): array|false {
    $text = carbon_get_theme_option('availability');
    if (!$text) {
        return false;
    }
    return [
        'text' => $text,
        'show_status' => (bool) carbon_get_theme_option('show_status'),
    ];
}

function get_globals_email(): string|false {
    $email = carbon_get_theme_option('email');
    if (!$email || !is_email($email)) {
        return false;
    }
    return $email;
}

// -> Social Links als Liste mit Label und URL
function get_globals_socials(): array {
    $socials = carbon_get_theme_option('socials');
    if (empty($socials)) {
        return [];
    }
    return array_values(array_filter(array_map(function ($social) {
        if (empty($social['label']) || empty($social['url'])) {
            return null;
        }
        return [
            'label' => $social['label'],
            'url' => $social['url'],
        ];
    }, $socials)));
}

// -> Texte im Footer
function get_globals_footer(): array {
    $copyright = carbon_get_theme_option('footer_copyright') ?: get_bloginfo('name');
    return [
        'signal' => carbon_get_theme_option('footer_signal') ?: 'End of transmission',
        'copyright' => '© ' . wp_date('Y') . ' ' . $copyright,
    ];
}
