<?php 
$themes = $this->getViewData('themes');
$totalCount = $this->getViewData('total_theme_count');
$loadCount = (count($themes) + DEFAULT_LOAD_COUNT) > $totalCount ? $totalCount : (count($themes) + DEFAULT_LOAD_COUNT);
?>
<h1>Startseite</h1>
<div id="theme-list">
    <ul>
        <?php foreach ($themes as $theme): ?>
        <li class="theme">
            <h2><?= $theme['name']; ?></h2>
            <p><?= $theme['teaser']; ?></p>
            <a href="<?= BASE_URL . '/theme/show-themes/' . $theme['link'] . '?pgn=1'; ?>">Anzeigen</a>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php if(count($themes) != $loadCount): ?>
    <a href="<?= BASE_URL . '/index/load-themes/' . $loadCount; ?>">Show more</a>
    <?php endif; ?>
</div>