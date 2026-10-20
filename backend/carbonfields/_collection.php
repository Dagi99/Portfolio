<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

// -> Projektdetails des CPT "Collection" (Karte im Work-Modul + Kopf der Case Study)
Container::make('post_meta', 'Projektdetails')
    ->where('post_type', '=', 'collection')
    ->set_priority('high')
    ->add_tab('Basis', [
        Field::make('textarea', 'teaser', 'Kurzbeschreibung')
            ->set_rows(3)
            ->set_required()
            ->set_help_text('1–2 Sätze für die Projektkarte und den Lead der Case Study.'),
        Field::make('text', 'year', 'Jahr')
            ->set_attribute('type', 'number')
            ->set_width(25),
        Field::make('text', 'type', 'Projekttyp')
            ->set_attribute('placeholder', 'Short film · night shoot')
            ->set_width(75),
        Field::make('text', 'subtitle', 'Untertitel / Übersetzung')
            ->set_attribute('placeholder', 'Romansh · "Chur by night"')
            ->set_help_text('Erscheint in Cyan unter dem Titel der Case Study.'),
        Field::make('textarea', 'team', 'Team / Credits')
            ->set_rows(3),
    ])
    ->add_tab('Medien', [
        Field::make('image', 'thumbnail', 'Thumbnail')
            ->set_required()
            ->set_help_text('16:10 oder 16:9, mind. 1600 px breit. Wird auf der Karte und als Hauptbild der Case Study verwendet.'),
        Field::make('file', 'loop_video', 'Hover-Loop')
            ->set_type(['video'])
            ->set_help_text('Optional. MP4, ohne Ton, 4–6 Sekunden. Spielt auf der Karte, solange man darauf zeigt.'),
    ])
    ->add_tab('Case Study', [
        Field::make('checkbox', 'has_case', 'Eigene Case-Study-Seite')
            ->set_option_value('yes')
            ->set_default_value(true)
            ->set_help_text('Aus: die Karte verlinkt nicht. Den Inhalt der Case Study im Bereich "Module" unten aufbauen.'),
    ]);
