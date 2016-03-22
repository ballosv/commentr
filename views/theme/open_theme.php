<?php 
$subtheme = $this->getViewData('subtheme');
$opinions = $this->getViewData('opinions');
$likes = $this->getViewData('likes');
?>

<h1><?= $subtheme['name']; ?></h1>
<h2>Thema: <?= $this->getViewData('theme')['name']; ?></h2>
<a href="<?= BASE_URL . '/theme/show-themes/' . $this->getViewData('theme')['link'] . '?pgn=1'; ?>">zurück</a>

<?php include 'partials/opinions.php'; ?>
