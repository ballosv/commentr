<!DOCTYPE html>
<html>
    <head>
        <title>OOP-MVC</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo PUBLIC_URL; ?>/css/main.css" rel="stylesheet" type="text/css" >
        <script src="<?php echo PUBLIC_URL; ?>/js/script.js" type="text/javascript"></script>
    </head>
    <body>
        <header id="page-header">
            <div class="inner-wrap">
                <nav id="page-nav">
                    <ul>
                        <li><a href="<?php echo BASE_URL; ?>">Startseite</a></li>
                        <li>
                            <a href="<?php echo BASE_URL; ?>/help">Help</a>
                            <ul>
                                <li><a href="<?php echo BASE_URL; ?>/help/other">Sonstiges</a></li>
                            </ul>
                        </li>
                        <?php if(Session::get('login_status') == true): ?>
                            <?php if(Session::get('user_role') == 1): ?>
                            <li><a href="<?php echo BASE_URL; ?>/admin">Dashboard</a></li>
                            <?php elseif (Session::get('user_role') == 0): ?>
                            <li><a href="<?php echo BASE_URL; ?>/user">Dashboard</a></li>
                            <?php endif; ?>
                            <li><a href="<?php echo BASE_URL; ?>/user/show-profile"><?= Session::get('name'); ?></a></li>
                        <li><a href="<?php echo BASE_URL; ?>/login/logout-user">Logout</a></li>
                        <?php else: ?>
                        <li><a href="<?php echo BASE_URL; ?>/login">Login</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </header>
        <main>
            <div class="inner-wrap">
                <?php require $templateView; ?>
            </div>
        </main>
        <footer id="page-footer">
            <div class="inner-wrap">
                <?php if(DEBUG_MODE): ?>
                <div id="debug">
                    <?php echo Debug::consoleOut(); ?>
                </div>
                <?php endif; ?>
            </div>
        </footer>
    </body>
</html>
