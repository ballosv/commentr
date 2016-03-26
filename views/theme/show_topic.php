<?php 
$theme = $this->getViewData('theme');
$topic = $this->getViewData('topics');
$opinions = $this->getViewData('opinions');
$likes = $this->getViewData('likes');

$currentPage = $this->getViewData('current_page');
$totalPages = $this->getViewData('total_pages');
$prevPage = ($currentPage - 1) > 0 ? $currentPage - 1 : $currentPage;
$nextPage = ($currentPage + 1) > $totalPages ? $currentPage : $currentPage + 1;

$comments = $this->getViewData('comments');
?>

<div id="content">
    <h1><?= $topic['name']; ?></h1>
    <h2>Thema: <?= $theme['name']; ?></h2>
    <a href="<?= BASE_URL . '/theme/show-theme/' . $theme['link'] . '?pgn=1'; ?>">zurück</a>

    <?php include 'partials/opinions.php'; ?>

    <?php if($totalPages > 1): ?>
    <?php if($prevPage != $currentPage): ?>
    <a href="<?= BASE_URL . '/theme/show-theme/' . $theme['link'] . DIRECTORY_SEPARATOR . $topic['link'] . '?pgn=' . $prevPage; ?>">zurück</a>
    <?php endif; ?>
    <?php for ($i = 1 ; $i <= $totalPages ; $i++): ?>
    <a href="<?= BASE_URL . '/theme/show-theme/' . $theme['link'] . DIRECTORY_SEPARATOR . $topic['link'] . '?pgn=' . $i; ?>"><?= $i; ?></a>
    <?php endfor; ?>
    <?php if($nextPage > $currentPage): ?>
    <a href="<?= BASE_URL . '/theme/show-theme/' . $theme['link'] . DIRECTORY_SEPARATOR . $topic['link'] . '?pgn=' . $nextPage; ?>">weiter</a>
    <?php endif; ?>
    <?php endif; ?>
</div>

<?php if(!empty($comments)): ?>
<div id="comments">
    <h2>Kommentare</h2>
    <ul>
        <?php foreach ($comments as $comment): ?>
        <li>
            <h5><?= $comment['title']; ?></h5>
            <p><?= $comment['date']; ?></p>
            <p><?= $comment['username'] ?> schreibt:</p>
            <p><?= $comment['text']; ?></p>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>