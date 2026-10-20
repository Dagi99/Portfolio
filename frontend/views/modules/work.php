<?php
$data = $args['data'];
$count = count($data['projects']);
?>

<section data-module="work" class="panel" id="work" aria-labelledby="work-title">
    <div class="work-head">
        <div class="work-heading">
            <h2 class="section-title" id="work-title"><?= esc_html($data['title']) ?></h2>
            <span class="work-count" data-work-count aria-live="polite">(<?= esc_html(pad_number($count)) ?>)</span>
        </div>

        <?php if (count($data['filters']) > 1): ?>
            <div class="filter" role="group" aria-label="Filter by discipline" data-filter>
                <button class="filter-button is-active" type="button" data-filter-value="all" aria-pressed="true">All</button>
                <?php foreach ($data['filters'] as $filter): ?>
                    <button class="filter-button" type="button" data-filter-value="<?= esc_attr($filter['slug']) ?>" aria-pressed="false"><?= esc_html($filter['name']) ?></button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($count > 0): ?>
        <ul class="work-grid" data-work-grid>
            <?php foreach ($data['projects'] as $project): ?>
                <li class="work-item" data-disciplines="<?= esc_attr($project['discipline_slugs']) ?>">
                    <?php get_template_part('frontend/views/teaser/project-card', null, ['data' => $project]); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="work-empty">New projects are in the edit. Check back soon.</p>
    <?php endif; ?>
</section>
