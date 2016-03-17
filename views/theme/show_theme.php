<?php 
$theme = $this->getViewData('theme'); 
$subthemes = $this->getViewData('subthemes');
$totalSubthemeCount = $this->getViewData('total_subtheme_count');
$loadSubthemeCount = (count($subthemes) + DEFAULT_LOAD_COUNT) > $totalSubthemeCount ? $totalSubthemeCount : (count($subthemes) + DEFAULT_LOAD_COUNT);
$opinions = $this->getViewData('opinions');
$comments = $this->getViewData('comments');
$likes = $this->getViewData('likes');
?>
<h1><?= $theme['name']; ?></h1>
<p><?= $theme['teaser']; ?></p>

<ul id="subthemes">
    <?php foreach ($subthemes as $subtheme): ?>
    <li>
        <h2><?= $subtheme['name']; ?></h2>
        <p><?= $subtheme['date']; ?></p>
        <a href="<?= BASE_URL . '/user/new-opinion/' . $theme['link'] . '/' . $subtheme['link']; ?>">Deine Meinung</a>
        <?php if(!empty($this->getViewData('opinions'))): ?>
        <ul>
            <?php foreach( $opinions[$subtheme['id']] as $data): ?>
            <li>
                <h3><?= $data['title']; ?></h3>
                <p><?= $data['text']; ?></p>
                <div class="rating">
                    <p class="like"><span class="count"><?= $likes[$data['id']]['likes'] !== NULL ? $likes[$data['id']]['likes'] : 0; ?> </span><a href="<?= BASE_URL . '/user/like/' . $subtheme['link'] . DIRECTORY_SEPARATOR . $data['id']; ?>">Zustimmen</a></p>
                    <p class="dislike"><span class="count"><?= $likes[$data['id']]['dislikes'] !== NULL ? $likes[$data['id']]['dislikes'] : 0; ?> </span><a href="<?= BASE_URL . '/user/dislike/' . $subtheme['link'] . DIRECTORY_SEPARATOR . $data['id']; ?>">Ablehnen</a></p>
                </div>
                <p>Anzahl Kommentare: <?= $data['comments']; ?></p>
                <a href="<?= BASE_URL . '/user/new-comment/' . $subtheme['link'] . DIRECTORY_SEPARATOR . $data['id']; ?>">Kommentieren</a>
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
        <?php endif; ?>
        <ul></ul>
    </li>
    <?php endforeach; ?>
</ul>
<?php if(count($subthemes) != $loadSubthemeCount): ?>
<a href="<?= BASE_URL . '/theme/show-theme/' . $theme['link'] . DIRECTORY_SEPARATOR . 0 . DIRECTORY_SEPARATOR . $loadSubthemeCount; ?>">Show more</a>
<?php endif; ?>


