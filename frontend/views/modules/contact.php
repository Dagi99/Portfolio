<?php
$data = $args['data'];
$form = $data['form_shortcode'] ? do_shortcode($data['form_shortcode']) : '';
?>

<section data-module="contact" class="panel" id="contact" aria-labelledby="contact-title">
    <div class="contact-intro">
        <?php if ($data['kicker']): ?>
            <p class="kicker"><?= esc_html($data['kicker']) ?></p>
        <?php endif; ?>
        <h2 class="contact-title" id="contact-title">
            <?= esc_html($data['title']) ?>
            <?php if ($data['title_accent']): ?>
                <span class="accent"><?= esc_html($data['title_accent']) ?></span>
            <?php endif; ?>
        </h2>
        <?php if ($data['text']): ?>
            <p class="contact-text"><?= esc_html($data['text']) ?></p>
        <?php endif; ?>

        <?php if ($data['email'] || !empty($data['socials'])): ?>
            <div class="contact-links">
                <?php if ($data['email']): ?>
                    <a class="contact-email" href="mailto:<?= esc_attr(antispambot($data['email'])) ?>"><?= esc_html(antispambot($data['email'])) ?></a>
                <?php endif; ?>
                <?php if (!empty($data['socials'])): ?>
                    <ul class="socials" aria-label="Social links">
                        <?php foreach ($data['socials'] as $social): ?>
                            <li><a href="<?= esc_url($social['url']) ?>" target="_blank" rel="noopener"><?= esc_html($social['label']) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="contact-form">
        <?php if ($form): ?>
            <?= $form ?>
        <?php elseif ($data['email']): ?>
            <p class="contact-fallback">Write me directly — I usually reply within a few days.</p>
            <a class="button" href="mailto:<?= esc_attr(antispambot($data['email'])) ?>">Send an e-mail →</a>
        <?php endif; ?>
    </div>
</section>
