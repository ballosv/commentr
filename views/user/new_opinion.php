<h1>Neue Meinung abgeben</h1>
<form method="post" action="/user/create-new-opinion/<?= $this->getViewData('theme_link'); ?>/<?= $this->getViewData('topic_id'); ?>">
    <input type='text' name='opinion-title' />
    <br />
    <textarea name="opinion-text"></textarea>
    <br />
    <input type='hidden' name="topic_id" value="<?= $this->getViewData('topic_id'); ?>" />
    <input type='submit' value='Meinung abgeben' />
</form>
<a href="<?= Url::getTempUrl('theme_page'); ?>">zurück</a>