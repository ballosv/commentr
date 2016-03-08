<h1>Neues Thema erstellen</h1>
<form method="post" action="<?= BASE_URL . '/admin/create-new-theme' ?>">
    <input type="text" name="name" />
    <br />
    <select name="category">
        <option value="0">Kategorie wählen</option>
        <?php foreach($this->getViewData('categories') as $category): ?>
        <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
        <?php endforeach; ?>
    </select>
    <br />
    <select name="parent-theme">
        <option value="0">Übergeordnetes Thema wählen</option>
        <?php foreach($this->getViewData('themes') as $theme): ?>
        <option value="<?= $theme['id']; ?>"><?= $theme['name']; ?></option>
        <?php endforeach; ?>
    </select>
    <br />
    <textarea name="teaser"></textarea>
    <br />
    <input type="submit" value="Neues Thema erstellen" />
</form>