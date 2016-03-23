<h1>Neuen Topic erstellen</h1>
<form method="post" action="<?= BASE_URL . '/admin/create-new-topic' ?>" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Topic"/>
    <br />
    <select name="parent-theme">
        <option value="0">Übergeordnetes Thema wählen</option>
        <?php foreach($this->getViewData('themes') as $theme): ?>
        <option value="<?= $theme['id']; ?>"><?= $theme['name']; ?></option>
        <?php endforeach; ?>
    </select>
    <br />
    <textarea name="teaser" placeholder="Teasertext"></textarea>
    <br />
    <input type="text" name="reference_source" placeholder="Referenz angeben" />
    <br />
    <input type="file" name="image" />
    <br />
    <input type="submit" value="Neuen Topic erstellen" />
</form>