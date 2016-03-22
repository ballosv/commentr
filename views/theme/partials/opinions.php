<ul id="opinions">
    <?php foreach($opinions as $opinion): ?>
    <li class="opinion">
        <h3><?= $opinion['title']; ?></h3>
        <p><?= $opinion['text']; ?></p>
        <p><?= $opinion['date']; ?></p>
        <div class="rating">
            <p class="like"><span class="count"><?= $likes[$opinion['id']]['likes'] !== NULL ? $likes[$opinion['id']]['likes'] : 0; ?> </span><a href="<?= BASE_URL . '/user/like/' . $subtheme['link'] . DIRECTORY_SEPARATOR . $opinion['id']; ?>">Zustimmen</a></p>
            <p class="dislike"><span class="count"><?= $likes[$opinion['id']]['dislikes'] !== NULL ? $likes[$opinion['id']]['dislikes'] : 0; ?> </span><a href="<?= BASE_URL . '/user/dislike/' . $subtheme['link'] . DIRECTORY_SEPARATOR . $opinion['id']; ?>">Ablehnen</a></p>
        </div>
        <p>Anzahl Kommentare: <?= $opinion['comments']; ?></p>
        <a href="<?= BASE_URL . '/user/new-comment/' . $subtheme['link'] . DIRECTORY_SEPARATOR . $opinion['id']; ?>">Kommentieren</a>
        <a href="<?= BASE_URL . '/theme/show-theme/' . $theme['link'] . DIRECTORY_SEPARATOR . $subtheme['link'] . '?pgn=' . $currentPage . '&com=' . $opinion['id']; ?>">load comments</a>
        <?php include 'comments.php'; ?>
    </li>
    <?php endforeach; ?>
</ul>