<h1>Admin-Dashboard</h1>
<nav>
    <ul>
        <li><a href="<?php BASE_URL . '/dashboard/createNewTheme' ?>">Neues Thema hinzufügen</a></li>
    </ul>
</nav>
<div id="theme-list">
    <ul>
        <?php foreach ($this->getViewData() as $theme): ?>
        <li>
            <h2><?php echo $theme['name']; ?></h2>
            <p><?php echo $theme['teaser']; ?></p>
        </li>
        <?php endforeach; ?>
    </ul>
    
</div>