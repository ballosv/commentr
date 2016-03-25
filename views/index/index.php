<?php 
$heroTheme = $this->getViewData('hero_theme');
$topThemes = $this->getViewData('top_themes');
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
    <div class="theme-list">
        <ul>
            <?php foreach ($topThemes as $topTheme): ?>
            <li class="theme">
                <h3><?= $topTheme['name']; ?></h3>
                <p><?= $topTheme['teaser']; ?></p>
                <?php if(DEBUG_MODE): ?>
                <p><?= $topTheme['level_count']; ?></p>
                <p>Topics: <?= $topTheme['topic_level']; ?></p>
                <p>Meinungen: <?= $topTheme['opinion_level']; ?></p>
                <p>Kommentare: <?= $topTheme['comment_level']; ?></p>
                <?php endif; ?>
                <a href="<?= BASE_URL . '/theme/show-themes/' . $topTheme['link'] . '?pgn=1'; ?>">Anzeigen</a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
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
    


