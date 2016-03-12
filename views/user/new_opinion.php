<h1>Neue Meinung abgeben</h1>
<form method="post" action="/user/create-new-opinion/<?= $this->getViewData('subtheme_link'); ?>">
    <input type='text' name='opinion-title' />
    <br />
    <textarea name="opinion-text"></textarea>
    <br />
    <input type='hidden' name="subtheme_id" value="<?= $this->getViewData('subtheme_id'); ?>" />
    <input type='submit' value='Meinung abgeben' />
</form>
<a href="<?= Url::getTempUrl('theme_page'); ?>">zurück</a>