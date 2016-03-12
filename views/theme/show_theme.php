<?php 
$theme = $this->getViewData('theme'); 
$subthemes = $this->getViewData('subthemes');
$opinions = $this->getViewData('opinions');
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
                <a href="#">Kommentieren</a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <ul></ul>
    </li>
    <?php endforeach; ?>
</ul>


