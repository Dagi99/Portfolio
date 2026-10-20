<?php
$data = $args['data'];
?>

<section data-module="text" class="panel">
    <?php if ($data['title']): ?>
        <h2 class="section-title"><?= esc_html($data['title']) ?></h2>
    <?php endif; ?>
    <div class="text-content">
        <?= wpautop($data['text']) ?>
    </div>
</section>
