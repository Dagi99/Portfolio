<?php
$data = $args['data'];
if (!$data['audio']) {
    return;
}
?>

<section data-module="soundtrack" data-player aria-label="Soundtrack">
    <button class="player-toggle" type="button" aria-label="Play soundtrack" data-player-toggle>
        <svg class="icon-play" aria-hidden="true" width="18" height="18" viewBox="0 0 14 14" fill="currentColor"><path d="M3 2l9 5-9 5z"/></svg>
        <svg class="icon-pause" aria-hidden="true" width="18" height="18" viewBox="0 0 14 14" fill="currentColor"><rect x="3" y="2" width="3" height="10"/><rect x="8" y="2" width="3" height="10"/></svg>
    </button>
    <div class="player-main">
        <div class="player-info">
            <span class="player-title"><?= esc_html($data['title']) ?></span>
            <span class="player-credit">
                <?= esc_html($data['credit']) ?>
                <span class="player-time" data-player-time>0:00</span>
            </span>
        </div>
        <div class="player-wave" data-player-wave aria-hidden="true">
            <?php for ($i = 0; $i < 96; $i++):
                // -> dekorative Wellenform, immer gleich (kein Zufall)
                $height = 18 + round(70 * abs(sin($i * 0.37) * cos($i * 0.11 + 1.3)));
            ?>
                <span style="height: <?= (int) $height ?>%"></span>
            <?php endfor; ?>
        </div>
        <input class="player-seek" type="range" min="0" max="1000" value="0" step="1" aria-label="Seek" data-player-seek>
    </div>
    <audio src="<?= esc_url($data['audio']) ?>" preload="metadata" data-player-audio></audio>
</section>
