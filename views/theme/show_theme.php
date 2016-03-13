<?php 
$theme = $this->getViewData('theme'); 
$subthemes = $this->getViewData('subthemes');
$opinions = $this->getViewData('opinions');
$comments = $this->getViewData('comments');
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
                    <p class="like"><span class="count">0 </span><a href="#">Zustimmen</a></p>
                    <p class="dislike"><span class="count">0 </span><a href="#">Ablehnen</a></p>
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


