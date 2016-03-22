<ul class="comments">
<?php foreach ($comments[$opinion['id']] as $comment): ?>
    <li>
        <h4><?= $comment['title']; ?></h4>
        <p>Geschrieben von: <?= $comment['username']; ?></p>
        <p><?= $comment['text']; ?></p>
    </li>
<?php endforeach; ?>
</ul>