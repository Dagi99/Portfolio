<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

// -> Konfiguration der verschiedenen Module
//    Seiten (One-Pager, Impressum, Datenschutz) und Projekte der Collection (Case Study)
//    bauen ihren Inhalt aus denselben Modulen auf.
Container::make('post_meta', 'Module')
    ->where('post_type', '=', 'page')
    ->or_where('post_type', '=', 'collection')
    ->add_fields([
        Field::make('complex', 'modules', 'Module')
            // -> hero: Startbild mit grosser Headline (One-Pager)
            ->add_fields('hero', 'Hero', [
                Field::make('image', 'image', 'Bild')->set_required(),
                Field::make('text', 'label', 'Label oben links')
                    ->set_attribute('placeholder', 'Still · Coira da Notg')
                    ->set_width(60),
                Field::make('text', 'timecode', 'Timecode oben rechts')
                    ->set_attribute('placeholder', 'TC 00:00:02:16')
                    ->set_width(40),
                Field::make('textarea', 'title', 'Titel')
                    ->set_rows(3)
                    ->set_required()
                    ->set_help_text('Jede Zeile wird eine eigene Titelzeile.'),
                Field::make('text', 'title_accent', 'Titel-Akzent (Magenta)')
                    ->set_attribute('placeholder', 'react.')
                    ->set_help_text('Wird in Magenta an die letzte Zeile angehängt.'),
                Field::make('text', 'primary_label', 'Button 1 Text')->set_width(50),
                Field::make('text', 'primary_link', 'Button 1 Link')
                    ->set_attribute('placeholder', '/#work')
                    ->set_width(50),
                Field::make('text', 'secondary_label', 'Button 2 Text')->set_width(50),
                Field::make('text', 'secondary_link', 'Button 2 Link')
                    ->set_attribute('placeholder', '/work/coira-da-notg/')
                    ->set_width(50),
            ])
            // -> about: Vorstellung + Kanäle (Disziplinen)
            ->add_fields('about', 'About', [
                Field::make('text', 'kicker', 'Kicker')
                    ->set_default_value('Allegra — hello')
                    ->set_width(40),
                Field::make('text', 'title', 'Titel')
                    ->set_default_value('About')
                    ->set_required()
                    ->set_width(60),
                Field::make('textarea', 'lead', 'Lead')->set_rows(3)->set_required(),
                Field::make('textarea', 'text', 'Text')->set_rows(4),
                Field::make('checkbox', 'show_disciplines', 'Disziplinen als Kanäle anzeigen')
                    ->set_option_value('yes')
                    ->set_default_value(true),
            ])
            // -> work: Projekt-Grid aus der Collection mit Filter
            ->add_fields('work', 'Work', [
                Field::make('text', 'title', 'Titel')
                    ->set_default_value('Work')
                    ->set_required(),
                Field::make('checkbox', 'show_filter', 'Filter nach Disziplin anzeigen')
                    ->set_option_value('yes')
                    ->set_default_value(true),
                Field::make('association', 'projects', 'Projekte')
                    ->set_types([
                        ['type' => 'post', 'post_type' => 'collection'],
                    ])
                    ->set_help_text('Leer lassen = alle Projekte, sortiert nach "Reihenfolge".'),
            ])
            // -> contact: Headline, Text, Formular und Social Links
            ->add_fields('contact', 'Kontakt', [
                Field::make('text', 'kicker', 'Kicker')
                    ->set_default_value('Open channel')
                    ->set_width(40),
                Field::make('text', 'title', 'Titel')
                    ->set_default_value("Let's make something")
                    ->set_required()
                    ->set_width(60),
                Field::make('text', 'title_accent', 'Titel-Akzent (Magenta)')
                    ->set_default_value('move.'),
                Field::make('textarea', 'text', 'Text')->set_rows(3),
                Field::make('text', 'form_shortcode', 'Formular-Shortcode (Contact Form 7)')
                    ->set_attribute('placeholder', '[contact-form-7 id="…" title="Kontakt"]'),
                Field::make('checkbox', 'show_contact', 'E-Mail und Social Links anzeigen')
                    ->set_option_value('yes')
                    ->set_default_value(true),
            ])
            // -> chapter: nummeriertes Kapitel einer Case Study (01 The idea …)
            ->add_fields('chapter', 'Kapitel', [
                Field::make('text', 'number', 'Nummer')
                    ->set_attribute('placeholder', '01')
                    ->set_width(20),
                Field::make('text', 'title', 'Titel')
                    ->set_required()
                    ->set_width(80),
                Field::make('textarea', 'text', 'Text')
                    ->set_rows(6)
                    ->set_required()
                    ->set_help_text('Leere Zeile = neuer Absatz.'),
            ])
            // -> film: eingebettetes Video (Vimeo/YouTube) oder eigene Videodatei
            ->add_fields('film', 'Film', [
                Field::make('oembed', 'video_url', 'Video-Link (Vimeo / YouTube)'),
                Field::make('file', 'video_file', 'oder Videodatei (MP4)')
                    ->set_type(['video']),
                Field::make('image', 'poster', 'Vorschaubild (nur bei Videodatei)'),
                Field::make('text', 'label', 'Label')
                    ->set_default_value('Full film'),
            ])
            // -> gallery: Film-Stills, Behind the Scenes
            ->add_fields('gallery', 'Galerie', [
                Field::make('media_gallery', 'images', 'Bilder')
                    ->set_type(['image'])
                    ->set_required(),
                Field::make('select', 'columns', 'Spalten')
                    ->set_options(['2' => '2 Spalten', '3' => '3 Spalten'])
                    ->set_default_value('2'),
                Field::make('checkbox', 'show_captions', 'Bildunterschriften anzeigen')
                    ->set_option_value('yes')
                    ->set_help_text('Verwendet die Beschriftung aus der Mediathek.'),
            ])
            // -> soundtrack: Audio-Player für eigene Musik
            ->add_fields('soundtrack', 'Soundtrack', [
                Field::make('file', 'audio', 'Audiodatei (MP3)')
                    ->set_type(['audio'])
                    ->set_required(),
                Field::make('text', 'title', 'Titel')
                    ->set_required()
                    ->set_width(60),
                Field::make('text', 'credit', 'Credit')
                    ->set_default_value('Composed by Dagi')
                    ->set_width(40),
            ])
            // -> text: Fliesstext, z.B. für Impressum und Datenschutz
            ->add_fields('text', 'Text', [
                Field::make('text', 'title', 'Titel'),
                Field::make('rich_text', 'text', 'Text')->set_required(),
            ])
            // -> SETTINGS
            ->set_layout('tabbed-vertical')
    ]);

// -> Funktion, um die Module und die entsprechenden Templates auf der Seite zu laden
function render_modules (): void {
    $modules = carbon_get_the_post_meta('modules');
    if (empty($modules)) {
        return;
    }
    foreach ($modules as $module) {
        // -> Modifiziere die Daten des Moduls, falls nötig, basierend auf dem Modultyp
        switch ($module['_type']) {
            case 'hero':
                $module['image'] = get_media_by_id($module['image'], 'xl');
                break;
            case 'about':
                $module['disciplines'] = $module['show_disciplines'] ? get_disciplines(false) : [];
                break;
            case 'work':
                $ids = array_map(fn ($item) => (int) $item['id'], $module['projects'] ?? []);
                $module['projects'] = get_collection_items($ids);
                $module['filters'] = $module['show_filter'] ? get_disciplines(true) : [];
                break;
            case 'contact':
                $module['email'] = $module['show_contact'] ? get_globals_email() : false;
                $module['socials'] = $module['show_contact'] ? get_globals_socials() : [];
                break;
            case 'film':
                $module['embed'] = $module['video_url'] ? get_video_embed($module['video_url']) : '';
                $module['video_file'] = $module['video_file'] ? wp_get_attachment_url($module['video_file']) : '';
                $module['poster'] = $module['poster'] ? get_media_by_id($module['poster'], 'xl') : false;
                break;
            case 'gallery':
                $module['images'] = array_map(fn ($id) => get_media_by_id($id, 'l'), $module['images'] ?? []);
                break;
            case 'soundtrack':
                $module['audio'] = $module['audio'] ? wp_get_attachment_url($module['audio']) : '';
                break;
        }
        // -> Laden des Templates basierend auf dem Modultyp und weitergeben der Daten
        get_template_part(
            'frontend/views/modules/' . $module['_type'],
            null,
            [
                'data' => $module
            ]
        );
    }
}
