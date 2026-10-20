<?php
$data = $args['data'];
$lines = array_values(array_filter(array_map('trim', preg_split('/\R/', (string) $data['title']))));
$last = count($lines) - 1;
?>

<section data-module="hero" aria-label="Intro">
    <?php if (!empty($data['image']['src'])): ?>
        <img
            class="hero-image"
            src="<?= esc_url($data['image']['src']) ?>"
            alt="<?= esc_attr($data['image']['alt']) ?>"
            width="<?= (int) $data['image']['width'] ?>"
            height="<?= (int) $data['image']['height'] ?>"
            fetchpriority="high"
        >
    <?php endif; ?>
    <div class="hero-shade" aria-hidden="true"></div>

    <?php if ($data['label'] || $data['timecode']): ?>
        <div class="hero-meta">
            <?php if ($data['label']): ?>
                <span class="hero-label"><span class="rec-dot" aria-hidden="true"></span><?= esc_html($data['label']) ?></span>
            <?php endif; ?>
            <?php if ($data['timecode']): ?>
                <span class="hero-timecode"><?= esc_html($data['timecode']) ?></span>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="hero-bottom">
        <h1 class="hero-title">
            <?php foreach ($lines as $index => $line): ?>
                <span class="hero-line"><?= esc_html($line) ?><?php if ($index === $last && $data['title_accent']): ?> <span class="accent"><?= esc_html($data['title_accent']) ?></span><?php endif; ?></span>
            <?php endforeach; ?>
        </h1>

        <?php if ($data['primary_label'] || $data['secondary_label']): ?>
            <div class="hero-actions">
                <?php if ($data['secondary_label'] && $data['secondary_link']): ?>
                    <a class="button button-ghost" href="<?= esc_url($data['secondary_link']) ?>">
                        <svg aria-hidden="true" width="14" height="14" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 2l9 5-9 5z"/></svg>
                        <?= esc_html($data['secondary_label']) ?>
                    </a>
                <?php endif; ?>
                <?php if ($data['primary_label'] && $data['primary_link']): ?>
                    <a class="button" href="<?= esc_url($data['primary_link']) ?>"><?= esc_html($data['primary_label']) ?></a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
