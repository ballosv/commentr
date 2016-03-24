<?php 
$heroTheme = $this->getViewData('hero_theme');
$themes = $this->getViewData('themes');
$totalCount = $this->getViewData('total_theme_count');
$loadCount = (count($themes) + DEFAULT_LOAD_COUNT) > $totalCount ? $totalCount : (count($themes) + DEFAULT_LOAD_COUNT);
?>

<div id="hero-theme">
    <h2>Top-Thema</h2>
    <div class="theme">
        <h3><?= $heroTheme['name']; ?></h3>
        <p><?= $heroTheme['teaser']; ?></p>
        <a href="<?= BASE_URL . '/theme/show-themes/' . $heroTheme['link'] . '?pgn=1'; ?>">Anzeigen</a>
    </div>
</div>
    
<div id="hot-themes">
    <h2>Aktuelle Themen</h2>
    <p>Derzeit keine aktuellen Themen</p>
</div>
<div id="last-themes">
    <h2>Zuletzt hinzugefügt</h2>
    <div class="theme-list">
        <ul>
            <?php foreach ($themes as $theme): ?>
            <li class="theme">
                <h3><?= $theme['name']; ?></h3>
                <p><?= $theme['teaser']; ?></p>
                <a href="<?= BASE_URL . '/theme/show-themes/' . $theme['link'] . '?pgn=1'; ?>">Anzeigen</a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php if(count($themes) != $loadCount): ?>
        <a href="<?= BASE_URL . '/index/load-themes/' . $loadCount; ?>">Show more</a>
        <?php endif; ?>
    </div>
</div>    
    


