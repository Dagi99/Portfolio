<?php
$data = $args['data'];
$images = array_filter($data['images'], fn ($image) => !empty($image['src']));
if (empty($images)) {
    return;
}
?>

<section data-module="gallery" class="gallery-columns-<?= (int) $data['columns'] ?>" aria-label="Gallery">
    <?php foreach ($images as $image): ?>
        <figure class="gallery-item">
            <img
                src="<?= esc_url($image['src']) ?>"
                alt="<?= esc_attr($image['alt']) ?>"
                width="<?= (int) $image['width'] ?>"
                height="<?= (int) $image['height'] ?>"
                loading="lazy"
            >
            <?php if ($data['show_captions'] && $image['caption']): ?>
                <figcaption><?= esc_html($image['caption']) ?></figcaption>
            <?php endif; ?>
        </figure>
    <?php endforeach; ?>
</section>
