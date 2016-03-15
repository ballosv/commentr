<?php $themes = $this->getViewData('themes'); ?>
<h1>Startseite</h1>
<div id="theme-list">
    <ul>
        <?php foreach ($themes as $theme): ?>
        <li class="theme">
            <h2><?= $theme['name']; ?></h2>
            <p><?= $theme['teaser']; ?></p>
            <a href="<?= BASE_URL . '/theme/show-theme/' . $theme['link']; ?>">Anzeigen</a>
        </li>
        <?php endforeach; ?>
    </ul>
    <a href="<?= BASE_URL . '/index/load-themes/' . 0 . DIRECTORY_SEPARATOR . (count($themes) + DEFAULT_LOAD_COUNT); ?>">Show more</a>
</div>