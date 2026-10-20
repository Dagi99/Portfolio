<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

// -> Kanal-Nummer pro Disziplin (CH 01, CH 02 …), sortiert die Disziplinen im About- und Work-Modul
Container::make('term_meta', 'Kanal')
    ->where('term_taxonomy', '=', 'collection_discipline')
    ->add_fields([
        Field::make('text', 'channel', 'Kanal-Nummer')
            ->set_attribute('type', 'number')
            ->set_required()
            ->set_help_text('1 = CH 01. Die Beschreibung der Disziplin erscheint als Satz darunter.'),
    ]);
