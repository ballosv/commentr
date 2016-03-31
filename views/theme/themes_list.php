<?php 
$themes = $this->getViewData('themes');

$currentPage = $this->getViewData('current_page');
$totalPages = $this->getViewData('total_pages');
$prevPage = ($currentPage - 1) > 0 ? $currentPage - 1 : $currentPage;
$nextPage = ($currentPage + 1) > $totalPages ? $currentPage : $currentPage + 1;
?>
<h2>Themenliste</h2>
<div id="theme-filter">
    <h4>Sortieren:</h4>
    <ul>
        <li><a href="<?= BASE_URL . '/theme/themes-list?pgn=' . $currentPage . '&sort=relevance'; ?>">Aktualität</a></li>
        <li><a href="<?= BASE_URL . '/theme/themes-list?pgn=' . $currentPage . '&sort=new'; ?>">Datum</a></li>
        <li><a href="<?= BASE_URL . '/theme/themes-list?pgn=' . $currentPage . '&sort=topics'; ?>">Topics</a></li>
        <li><a href="<?= BASE_URL . '/theme/themes-list?pgn=' . $currentPage . '&sort=opinions'; ?>">Meinungen</a></li>
        <li><a href="<?= BASE_URL . '/theme/themes-list?pgn=' . $currentPage . '&sort=comments'; ?>">Kommentare</a></li>
        <li><a href="<?= BASE_URL . '/theme/themes-list?pgn=' . $currentPage . '&sort=last-update'; ?>">Letzte Aktivität</a></li>
    </ul>
</div>
<div class="theme-list">
    <ul>
        <?php foreach ($themes as $theme): ?>
        <li class="theme">
            <h3><?= $theme['name']; ?></h3>
            <p><?= $theme['teaser']; ?></p>
            <?php if(DEBUG_MODE): ?>
            <p><?= $theme['level_count']; ?></p>
            <p>Topics: <?= $theme['topics_count']; ?></p>
            <p>Topic-Punkte: <?= $theme['topic_level']; ?></p>
            <p>Meinungen: <?= $theme['opinion_level']; ?></p>
            <p>Kommentare: <?= $theme['comment_level']; ?></p>
            <?php endif; ?>
            <a href="<?= BASE_URL . '/theme/show-theme/' . $theme['link'] . '?pgn=1'; ?>">Anzeigen</a>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php if($totalPages > 1): ?>
    <?php if($prevPage != $currentPage): ?>
    <a href="<?= BASE_URL . '/theme/themes-list?pgn=' . $prevPage . '&sort=' . Url::getSubParams()['sort']; ?>">zurück</a>
    <?php endif; ?>
    <?php for ($i = 1 ; $i <= $totalPages ; $i++): ?>
    <a href="<?= BASE_URL . '/theme/themes-list?pgn=' . $i . '&sort=' . Url::getSubParams()['sort']; ?>"><?= $i; ?></a>
    <?php endfor; ?>
    <?php if($nextPage > $currentPage): ?>
    <a href="<?= BASE_URL . '/theme/themes-list?pgn=' . $nextPage . '&sort=' . Url::getSubParams()['sort']; ?>">weiter</a>
    <?php endif; ?>
    <?php endif; ?>
</div>

