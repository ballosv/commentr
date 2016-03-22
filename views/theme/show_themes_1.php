<?php 
// Theme laden
$theme = $this->getViewData('theme'); 
// Subthemes laden
$subthemes = $this->getViewData('subthemes');
$currentPage = $this->getViewData('current_page');
$totalPages = $this->getViewData('total_pages');
$prevPage = ($currentPage - 1) > 0 ? $currentPage - 1 : $currentPage;
$nextPage = ($currentPage + 1) > $totalPages ? $currentPage : $currentPage + 1;
// Meinungen laden
$opinions = $this->getViewData('opinions');
$totalOpinionsCount = $this->getViewData('total_opinions_count');
// Likes laden
$likes = $this->getViewData('likes');
// Kommentare laden
//$comments = $this->getViewData('comments');

?>
<h1><?= $theme['name']; ?></h1>
<p><?= $theme['teaser']; ?></p>
<div id="filter">
    <p>Anzeige pro Seite: </p>
    <ul>
        <li><a href="<?= BASE_URL . '/theme/show-themes/' . $theme['link'] . '?pgn=1&ldc=5'; ?>">5</a></li>
        <li><a href="<?= BASE_URL . '/theme/show-themes/' . $theme['link'] . '?pgn=1&ldc=10'; ?>">10</a></li>
        <li><a href="<?= BASE_URL . '/theme/show-themes/' . $theme['link'] . '?pgn=1&ldc=20'; ?>">20</a></li>
    </ul>
</div>
<ul id="subthemes">
    <?php foreach ($subthemes as $subtheme): ?>
    <li class="subtheme">
        <h2><?= $subtheme['name']; ?></h2>
        <p><?= $subtheme['date']; ?></p>
        <a href="<?= BASE_URL . '/user/new-opinion/' . $theme['link'] . '/' . $subtheme['link']; ?>">Deine Meinung</a>
        <?php if(!empty($opinions)): ?>
        <ul id="opinions">
            <?php foreach($opinions[$subtheme['id']] as $data): ?>
            <?php
            $loadOpinionsCount = (count($opinions[$subtheme['id']]) + DEFAULT_LOAD_COUNT) > $totalOpinionsCount[$subtheme['id']] ? $totalOpinionsCount[$subtheme['id']] : (count($opinions[$subtheme['id']]) + DEFAULT_LOAD_COUNT);
            ?>
            <li class="opinion">
                <h3><?= $data['title']; ?></h3>
                <p><?= $data['text']; ?></p>
                <p><?= $data['date']; ?></p>
                <div class="rating">
                    <p class="like"><span class="count"><?= $likes[$data['id']]['likes'] !== NULL ? $likes[$data['id']]['likes'] : 0; ?> </span><a href="<?= BASE_URL . '/user/like/' . $subtheme['link'] . DIRECTORY_SEPARATOR . $data['id']; ?>">Zustimmen</a></p>
                    <p class="dislike"><span class="count"><?= $likes[$data['id']]['dislikes'] !== NULL ? $likes[$data['id']]['dislikes'] : 0; ?> </span><a href="<?= BASE_URL . '/user/dislike/' . $subtheme['link'] . DIRECTORY_SEPARATOR . $data['id']; ?>">Ablehnen</a></p>
                </div>
                <p>Anzahl Kommentare: <?= $data['comments']; ?></p>
                <a href="<?= BASE_URL . '/user/new-comment/' . $subtheme['link'] . DIRECTORY_SEPARATOR . $data['id']; ?>">Kommentieren</a>
                <a href="<?= BASE_URL . '/theme/show-themes/' . $theme['link'] . DIRECTORY_SEPARATOR . 0 . DIRECTORY_SEPARATOR . $loadSubthemeCount . DIRECTORY_SEPARATOR . 'load-comments' . DIRECTORY_SEPARATOR . 0 . DIRECTORY_SEPARATOR . $loadOpinionsCount; ?>">load comments</a>
                <ul class="comments">
                <?php foreach ($comments[$data['id']] as $comment): ?>
                    <li>
                        <h4><?= $comment['title']; ?></h4>
                        <p>Geschrieben von: <?= $comment['username']; ?></p>
                        <p><?= $comment['text']; ?></p>
                    </li>
                <?php endforeach; ?>
                </ul>
            </li>
            <?php endforeach; ?>
        </ul>
        <a href="<?= BASE_URL . '/theme/show-theme/' . $theme['link'] . DIRECTORY_SEPARATOR . $subtheme['link'] . '?pgn=1'; ?>">open</a>
        <!-- Anzeigen eines load-more-btn um mehr opinions zu laden.  -->
        <?php // if(count($opinions[$subtheme['id']]) != $loadOpinionsCount): ?>
        <!--<a href="//<?= BASE_URL . '/theme/show-themes/' . $theme['link'] . DIRECTORY_SEPARATOR . $currentPage . DIRECTORY_SEPARATOR . 'load-more-opinions' . DIRECTORY_SEPARATOR . $loadOpinionsCount; ?>">load more</a>-->
        <?php // endif; ?>
        <?php endif; ?>
        <ul></ul>
    </li>
    <?php endforeach; ?>
</ul>
<?php if($totalPages > 1): ?>
<?php if($prevPage != $currentPage): ?>
<a href="<?= BASE_URL . '/theme/show-themes/' . $theme['link'] . '?pgn=' . $prevPage; ?>">zurück</a>
<?php endif; ?>
<?php for ($i = 1 ; $i <= $totalPages ; $i++): ?>
<a href="<?= BASE_URL . '/theme/show-themes/' . $theme['link'] . '?pgn=' . $i; ?>"><?= $i; ?></a>
<?php endfor; ?>
<?php if($nextPage > $currentPage): ?>
<a href="<?= BASE_URL . '/theme/show-themes/' . $theme['link'] . '?pgn=' . $nextPage; ?>">weiter</a>
<?php endif; ?>
<?php endif; ?>