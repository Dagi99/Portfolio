<?php
$menu = get_menu_by_slug('main');
$label = get_globals_site_label();
$availability = get_globals_availability();
$last_index = count($menu) - 1;
?>

<a class="skip-link" href="#content">Skip to content</a>

<header data-layout="header">
    <div class="header-inner">
        <a class="brand" href="<?= esc_url(home_url('/')) ?>">
            <span class="brand-name"><?= esc_html(get_bloginfo('name')) ?></span>
            <?php if ($label): ?>
                <span class="brand-label"><?= esc_html($label) ?></span>
            <?php endif; ?>
        </a>

        <?php if ($availability): ?>
            <p class="status">
                <?php if ($availability['show_status']): ?>
                    <span class="status-dot" aria-hidden="true"></span>
                <?php endif; ?>
                <?= esc_html($availability['text']) ?>
            </p>
        <?php endif; ?>

        <?php if (!empty($menu)): ?>
            <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="main-nav" aria-label="Open menu">
                <span aria-hidden="true"></span>
            </button>
            <nav class="nav" id="main-nav" aria-label="Main">
                <ul>
                    <?php foreach ($menu as $index => $item): ?>
                        <li>
                            <a
                                href="<?= esc_url($item['url']) ?>"
                                <?= $index === $last_index ? 'class="is-pill"' : '' ?>
                                <?= $item['target'] ? 'target="' . esc_attr($item['target']) . '" rel="noopener"' : '' ?>
                            ><?= esc_html($item['title']) ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</header>
