<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

// -> Inhaltsfeld-Konfiguration der globalen Einstellungen des Themes
Container::make('theme_options', 'Globales')
    ->add_tab('Header', [
        Field::make('text', 'site_label', 'Ort / Label neben dem Namen')
            ->set_default_value('CH · Ilanz / Chur')
            ->set_help_text('Erscheint klein neben "DAGI" im Header.'),
        Field::make('text', 'availability', 'Verfügbarkeit')
            ->set_default_value('Open for internships 2027')
            ->set_help_text('Leer lassen, um den Status auszublenden.'),
        Field::make('checkbox', 'show_status', 'Status-Punkt anzeigen')
            ->set_option_value('yes')
            ->set_default_value(true),
    ])
    ->add_tab('Kontakt', [
        Field::make('text', 'email', 'Email-Adresse Kontakt')
            ->set_attribute('type', 'email'),
        Field::make('complex', 'socials', 'Social Links')
            ->set_layout('tabbed-horizontal')
            ->add_fields([
                Field::make('text', 'label', 'Bezeichnung')
                    ->set_required()
                    ->set_width(40),
                Field::make('text', 'url', 'URL')
                    ->set_required()
                    ->set_attribute('type', 'url')
                    ->set_width(60),
            ])
            ->set_header_template('<%- label %>'),
    ])
    ->add_tab('Footer', [
        Field::make('text', 'footer_signal', 'Signal-Text im Footer')
            ->set_default_value('End of transmission'),
        Field::make('text', 'footer_copyright', 'Copyright-Text')
            ->set_default_value('Dagi · Graubünden')
            ->set_help_text('Das Jahr wird automatisch davor gesetzt.'),
    ]);
