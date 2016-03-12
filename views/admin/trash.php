<h1>Deaktivierte Themen</h1>
<div id="theme-list">
    <?php if(empty($this->getViewData('trash-themes'))): ?>
    <p>Keine Themen im Papierkorb</p>
    <?php endif; ?>
    <ul>
        <?php foreach ($this->getViewData('trash-themes') as $theme): ?>
        <li class="theme">
            <h2><?= $theme['name']; ?></h2>
            <p><?= $theme['teaser']; ?></p>
            <a href="<?= BASE_URL . '/admin/activate-theme/' . $theme['link']; ?>">aktivieren</a>
        </li>
        <?php endforeach; ?>
    </ul>
</div>