<h1>Registrieren-Seite</h1>
<form action="<?= BASE_URL; ?>/register/create-user" method="post">
    <label>Username</label>
    <input type="text" name="username" />
    <br />
    <label>E-Mail</label>
    <input type="text" name="email" />
    <br />
    <label>Passwort</label>
    <input type="password" name="userpass" />
    <br />
    <input type="submit" value="anmleden" />
</form>
<?php if($msgs = $this->getViewData('msg')): ?>
    <?php foreach($msgs as $msg): ?>
    <p class="<?= $this->getViewData('class') ?>"><?= $msg ?></p>
    <?php endforeach; ?>
<?php endif; ?>
<p>Sie haben bereits ein Konto? <a href="#">Hier</a> einloggen</p>
   