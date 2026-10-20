<?php
$menu = get_menu_by_slug('footer');
$footer = get_globals_footer();
?>

<footer data-layout="footer">
    <div class="footer-inner">
        <p class="footer-signal"><?= esc_html($footer['signal']) ?></p>
        <?php if (!empty($menu)): ?>
            <nav class="footer-nav" aria-label="Footer">
                <ul>
                    <?php foreach ($menu as $item): ?>
                        <li>
                            <a
                                href="<?= esc_url($item['url']) ?>"
                                <?= $item['target'] ? 'target="' . esc_attr($item['target']) . '" rel="noopener"' : '' ?>
                            ><?= esc_html($item['title']) ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        <?php endif; ?>
        <a class="footer-top" href="#top">Back to top ↑</a>
        <p class="footer-copyright"><?= esc_html($footer['copyright']) ?></p>
    </div>
</footer>
