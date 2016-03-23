<h1>Kommentar zu einer Meinung abgeben</h1>
<form method="post" action="/user/create-new-comment/<?= $this->getViewData('topic_link') . DIRECTORY_SEPARATOR . $this->getViewData('opinion_id'); ?>">
    <input type='text' name='comment-title' />
    <br />
    <textarea name="comment-text"></textarea>
    <br />
    <input type='submit' value='Meinung abgeben' />
</form>
<a href="<?= Url::getTempUrl('theme_page'); ?>">zurück</a>