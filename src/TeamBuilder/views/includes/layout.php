<?php
/** @noinspection PhpUndefinedVariableInspection */ ?>
<!doctype html>
<html lang="en"
      data-theme="light"
>
<head>
    <?php
    include_once "head-content.php" ?>
    <title>Team Builder</title>
</head>
<body>
    <div class="hero" data-theme="dark">
        <nav class="container">
            <ul>
                <li><a href="./" class="contrast"><strong>CPNV</strong></a></li>
            </ul>
        </nav>
        <header class="container">
            <hgroup>
                <h1>Team Builder</h1>
                <h2>Application for the Joutes teams in CPNV</h2>
            </hgroup>
            <?php
            if ($_SESSION['web-user']): ?>
                <div class="flex" style="justify-content: flex-end;">
                    <p>
                        Vous êtes connecté en tant que :
                        <strong><?= unserialize($_SESSION['web-user'])->name ?></strong>
                    </p>
                </div>
            <?php
            endif ?>
        </header>
    </div>
    <main class="container">
        <?= $content ?>
    </main>
</body>
</html>
