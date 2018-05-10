<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Task | <?= $title ?></title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/font-awesome/font-awesome.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="wrapper">

    <header>
        <nav class="menu">
            <ul class="menu_left">
                <?php foreach (Config::get("routes") as $link => $page): ?>
                    <?php $class = ($link == $view) ? "current" : "" ?>

                    <?php if ($link == "home") : ?>
                        <li><a href="/<?= $link ?>" class="fa fa-home <?= $class ?>"></a></li>
                    <?php else: ?>
                        <?php if ($link == "dashboard" && getSESSION("role") != "admin") continue ?>
                        <li>
                            <a href="/<?= $link ?>" class="<?= $class ?>">
                                <?= $page ?>
                            </a>
                        </li>
                    <?php endif ?>

                <?php endforeach ?>
            </ul>


            <?php
            $email = getSESSION("email");
            if ($email) {
                include_once VIEWS . DS . "template" . DS . "modules" . DS . "menuRightLogged.php";
            } else {
                include_once VIEWS . DS . "template" . DS . "modules" . DS . "menuRightLogin.php";
            }

            ?>
        </nav>

        <?php
        if (!getSESSION("email")) {
            include_once VIEWS . DS . "template" . DS . "modules" . DS . "regForm.php";
            include_once VIEWS . DS . "template" . DS . "modules" . DS . "loginForm.php";
        }
        ?>
    </header>

    <main>
        <?php echo getFlash(); ?>

        <?= $content ?>
    </main>
</div>
<script src="/js/jquery.min.js"></script>
<script src="/js/common.js"></script>
<?php if (getSESSION("role") == "admin") : ?>
    <script src="/js/dashboard.js"></script>
<?php endif ?>
</body>
</html>



