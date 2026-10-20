<?php
$data = $args['data'];
if (!$data['embed'] && !$data['video_file']) {
    return;
}
?>

<section data-module="film" aria-label="<?= esc_attr($data['label'] ?: 'Film') ?>">
    <div class="film-frame">
        <?php if ($data['label']): ?>
            <span class="film-label"><span class="rec-dot" aria-hidden="true"></span><?= esc_html($data['label']) ?></span>
        <?php endif; ?>
        <?php if ($data['embed']): ?>
            <div class="film-embed"><?= $data['embed'] ?></div>
        <?php else: ?>
            <video
                class="film-video"
                src="<?= esc_url($data['video_file']) ?>"
                <?= !empty($data['poster']['src']) ? 'poster="' . esc_url($data['poster']['src']) . '"' : '' ?>
                controls
                playsinline
                preload="metadata"
            ></video>
        <?php endif; ?>
    </div>
</section>
