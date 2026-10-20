<?php
$data = $args['data'];
?>

<section data-module="about" class="panel" id="about" aria-labelledby="about-title">
    <div class="about-intro">
        <div class="about-heading">
            <?php if ($data['kicker']): ?>
                <p class="kicker"><?= esc_html($data['kicker']) ?></p>
            <?php endif; ?>
            <h2 class="section-title" id="about-title"><?= esc_html($data['title']) ?></h2>
        </div>
        <div class="about-text">
            <p class="about-lead"><?= esc_html($data['lead']) ?></p>
            <?php if ($data['text']): ?>
                <div class="about-body"><?= wpautop(esc_html($data['text'])) ?></div>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!empty($data['disciplines'])): ?>
        <ul class="channels">
            <?php foreach ($data['disciplines'] as $discipline): ?>
                <li class="channel">
                    <span class="channel-number"><?= esc_html($discipline['channel_label']) ?></span>
                    <h3 class="channel-title"><?= esc_html($discipline['name']) ?></h3>
                    <?php if ($discipline['description']): ?>
                        <p class="channel-text"><?= esc_html($discipline['description']) ?></p>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</section>
