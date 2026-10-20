<?php
$project = get_collection_by_id(get_the_ID());
$next = get_next_collection_item(get_the_ID());
$meta = array_filter([
    'Year' => $project['year'],
    'Type' => $project['type'],
    'My role' => implode(', ', $project['roles']),
    'Tools' => implode(', ', $project['tools']),
    'Team' => $project['team'],
]);
?>

<main data-page="collection" id="content">
    <header class="case-head">
        <nav class="case-breadcrumb" aria-label="Breadcrumb">
            <a href="<?= esc_url(home_url('/#work')) ?>">Work</a>
            <?php if (!empty($project['disciplines'])): ?>
                <span aria-hidden="true">/</span>
                <span><?= esc_html(implode(', ', array_column($project['disciplines'], 'name'))) ?></span>
            <?php endif; ?>
        </nav>

        <h1 class="case-title"><?= esc_html($project['title']) ?></h1>

        <?php if ($project['subtitle']): ?>
            <p class="case-subtitle"><?= esc_html($project['subtitle']) ?></p>
        <?php endif; ?>

        <?php if ($project['teaser']): ?>
            <p class="case-lead"><?= esc_html($project['teaser']) ?></p>
        <?php endif; ?>

        <?php if (!empty($meta)): ?>
            <dl class="case-meta">
                <?php foreach ($meta as $label => $value): ?>
                    <div class="case-meta-item">
                        <dt><?= esc_html($label) ?></dt>
                        <dd><?= nl2br(esc_html($value)) ?></dd>
                    </div>
                <?php endforeach; ?>
            </dl>
        <?php endif; ?>
    </header>

    <?php if ($project['thumbnail_large'] && $project['thumbnail_large']['src']): ?>
        <figure class="case-hero">
            <img
                src="<?= esc_url($project['thumbnail_large']['src']) ?>"
                alt="<?= esc_attr($project['thumbnail_large']['alt']) ?>"
                width="<?= (int) $project['thumbnail_large']['width'] ?>"
                height="<?= (int) $project['thumbnail_large']['height'] ?>"
            >
        </figure>
    <?php endif; ?>

    <div class="case-modules">
        <?php render_modules(); ?>
    </div>

    <footer class="case-foot">
        <?php if ($next): ?>
            <a class="case-next" href="<?= esc_url($next['url']) ?>">
                <span class="case-next-label">Next project</span>
                <span class="case-next-title"><?= esc_html($next['title']) ?> <span class="accent" aria-hidden="true">→</span></span>
            </a>
        <?php else: ?>
            <a class="case-next" href="<?= esc_url(home_url('/#work')) ?>">
                <span class="case-next-label">Back to</span>
                <span class="case-next-title">All work <span class="accent" aria-hidden="true">→</span></span>
            </a>
        <?php endif; ?>
    </footer>
</main>
