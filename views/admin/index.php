<h1>Admin-Dashboard</h1>
<h2>Hallo <?= Session::get('name'); ?></h2>
<nav>
    <ul>
        <li><a href="<?= BASE_URL . '/admin/new-theme'; ?>">Neues Thema hinzufügen</a></li>
        <li><a href="<?= BASE_URL . '/admin/show-trash'; ?>">Deaktivierte Themen anzeigen</a></li>
    </ul>
</nav>
<div id="theme-list">
    <ul>
        <?php foreach ($this->getViewData('themes') as $theme): ?>
        <li class="theme">
            <h2><?= $theme['name']; ?></h2>
            <p><?= $theme['teaser']; ?></p>
            <a href="<?= BASE_URL . '/admin/deactivate-theme/' . $theme['id']; ?>">Deaktivieren</a>
        </li>
        <?php endforeach; ?>
    </ul>
</div>