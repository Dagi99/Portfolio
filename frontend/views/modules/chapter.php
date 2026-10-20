<?php
$data = $args['data'];
?>

<section data-module="chapter">
    <div class="chapter-heading">
        <?php if ($data['number']): ?>
            <span class="chapter-number"><?= esc_html($data['number']) ?></span>
        <?php endif; ?>
        <h2 class="chapter-title"><?= esc_html($data['title']) ?></h2>
    </div>
    <div class="chapter-text">
        <?= wpautop(esc_html($data['text'])) ?>
    </div>
</section>
