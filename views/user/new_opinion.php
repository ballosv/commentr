<h1>Neue Meinung abgeben</h1>
<form method="post" action="/user/create-new-opinion/<?= $this->getViewData('theme_id'); ?>">
    <input type='text' name='opinion-title' />
    <br />
    <textarea name="opinion-text"></textarea>
    <br />
    <input type='submit' value='Meinung abgeben' />
</form>
<a href="<?= Url::getTempUrl('theme_page'); ?>">zurück</a>