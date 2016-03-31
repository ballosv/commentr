<ul id="opinions">
    <?php foreach($opinions as $opinion): ?>
    <li class="opinion">
        <h3><?= $opinion['title']; ?></h3>
        <p><?= $opinion['text']; ?></p>
        <p><?= $opinion['date']; ?></p>
        <div class="rating">
            <p class="like"><span class="count"><?= $likes[$opinion['id']]['likes'] !== NULL ? $likes[$opinion['id']]['likes'] : 0; ?> </span><a href="<?= BASE_URL . '/user/like/' . $topic['link'] . DIRECTORY_SEPARATOR . $opinion['id']; ?>">Zustimmen</a></p>
            <p class="dislike"><span class="count"><?= $likes[$opinion['id']]['dislikes'] !== NULL ? $likes[$opinion['id']]['dislikes'] : 0; ?> </span><a href="<?= BASE_URL . '/user/dislike/' . $topic['link'] . DIRECTORY_SEPARATOR . $opinion['id']; ?>">Ablehnen</a></p>
        </div>
        <p>Anzahl Kommentare: <?= $opinion['comments']; ?></p>
        <a href="<?= BASE_URL . '/user/new-comment/' . $theme['link'] . DIRECTORY_SEPARATOR . $topic['link'] . DIRECTORY_SEPARATOR . $opinion['id']; ?>">Kommentieren</a>
        <?php if($opinion['comments'] > 0): ?>
        <a href="<?= BASE_URL . '/theme/show-theme/' . $theme['link'] . DIRECTORY_SEPARATOR . $topic['link'] . '?id=' . $topic['id'] . '&pgn=' . $currentPage . '&com=' . $opinion['id']; ?>">load comments</a>
        <?php endif; ?>
        <?php include 'comments.php'; ?>
    </li>
    <?php endforeach; ?>
</ul>