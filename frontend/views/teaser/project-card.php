<?php
$project = $args['data'];
$tag = $project['url'] ? 'a' : 'div';
$disciplines = implode(', ', array_column($project['disciplines'], 'name'));
?>

<<?= $tag ?> class="project-card" <?= $project['url'] ? 'href="' . esc_url($project['url']) . '"' : '' ?>>
    <div class="project-card-media">
        <?php if (!empty($project['thumbnail']['src'])): ?>
            <img
                src="<?= esc_url($project['thumbnail']['src']) ?>"
                alt="<?= esc_attr($project['thumbnail']['alt']) ?>"
                width="<?= (int) $project['thumbnail']['width'] ?>"
                height="<?= (int) $project['thumbnail']['height'] ?>"
                loading="lazy"
            >
        <?php endif; ?>
        <?php if ($project['loop_video']): ?>
            <video class="project-card-video" src="<?= esc_url($project['loop_video']) ?>" muted loop playsinline preload="none" aria-hidden="true"></video>
        <?php endif; ?>
        <span class="project-card-tag"><?= esc_html($project['number'] ?? '') ?><?= $disciplines ? ' · ' . esc_html($disciplines) : '' ?></span>
        <?php if ($project['year']): ?>
            <span class="project-card-year"><?= esc_html($project['year']) ?></span>
        <?php endif; ?>
    </div>

    <div class="project-card-body">
        <div class="project-card-head">
            <h3 class="project-card-title"><?= esc_html($project['title']) ?></h3>
            <?php if ($project['url']): ?>
                <span class="project-card-more">Case study →</span>
            <?php endif; ?>
        </div>
        <?php if ($project['teaser']): ?>
            <p class="project-card-teaser"><?= esc_html($project['teaser']) ?></p>
        <?php endif; ?>
        <?php if (!empty($project['tools'])): ?>
            <p class="project-card-tools"><?= esc_html(implode(' · ', $project['tools'])) ?></p>
        <?php endif; ?>
    </div>
</<?= $tag ?>>
