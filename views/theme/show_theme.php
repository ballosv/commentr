<?php 
$theme = $this->getViewData('theme'); 
$subthemes = $this->getViewData('subthemes');
?>
<h1><?= $theme['name']; ?></h1>
<p><?= $theme['teaser']; ?></p>

<ul id="subthemes">
    <?php foreach ($subthemes as $subtheme): ?>
    <li>
        <h2><?= $subtheme['name']; ?></h2>
        <p><?= $subtheme['date']; ?></p>
        <a href="<?= BASE_URL . '/user/new-opinion/' . $subtheme['id']; ?>">Deine Meinung</a>
    </li>
    <?php endforeach; ?>
</ul>


