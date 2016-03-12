<h1>Startseite</h1>
<div id="theme-list">
    <ul>
        <?php foreach ($this->getViewData('themes') as $theme): ?>
        <li class="theme">
            <h2><?= $theme['name']; ?></h2>
            <p><?= $theme['teaser']; ?></p>
            <a href="<?= BASE_URL . '/theme/show-theme/' . $theme['link']; ?>">Anzeigen</a>
        </li>
        <?php endforeach; ?>
    </ul>
    <a href="<?= BASE_URL . '/theme' ?>">Show more</a>
</div>