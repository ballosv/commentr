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
$allOpinions = $this->getViewData('opinions');
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
        
        <?php $opinions = $allOpinions[$subtheme['id']]; ?>
        <?php if(!empty($opinions)): ?>
        <?php include 'partials/opinions.php'; ?>
        <a href="<?= BASE_URL . '/theme/open-theme/' . $theme['link'] . DIRECTORY_SEPARATOR . $subtheme['link'] . '?pgn=1'; ?>">open</a>
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