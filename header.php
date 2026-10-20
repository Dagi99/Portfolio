<!DOCTYPE html>
<html lang="<?php bloginfo('language') ?>">
<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <link rel="preload" href="<?= get_template_directory_uri() ?>/frontend/assets/fonts/big-shoulders-display.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?= get_template_directory_uri() ?>/frontend/assets/fonts/instrument-sans.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="<?= get_template_directory_uri() ?>/frontend/styles/main.css?v=<?= wp_get_theme()->get('Version') ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover" />
    <meta name="theme-color" content="#0E0609">
    <title><?php wp_title('·', true, 'right'); bloginfo('name') ?></title>
    <?php wp_head(); ?>
</head>
<body id="top" <?php body_class() ?>>
<?php wp_body_open(); ?>
