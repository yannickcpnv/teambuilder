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
                <h2>Application pour les joutes du CPNV</h2>
                <h3>Version: Début Examen - Yannick</h3>
            </hgroup>
            <?php
            if (isset($_SESSION['web-user'])): ?>
                <div class="flex flex-end">
                    <p>
                        Vous êtes connecté en tant que :
                        <a href="?action=read-profil">
                            <strong><?= unserialize($_SESSION['web-user'])->name ?></strong>
                        </a>
                    </p>
                </div>
                <div>
                    <a href="?action=member-teams&member-id=<?= unserialize($_SESSION['web-user'])->id ?>"
                       role="button">
                        Mes équipes
                    </a>
                    <a href="?action=members-list"
                       role="button">
                        Liste des membres
                    </a>
                    <a href="?action=moderators-list"
                       role="button">
                        Liste des modérateurs
                    </a>
                    <a class="outline"
                       href="?action=create-team"
                       role="button">
                        <i class='fas fa-plus'></i>
                    </a>
                </div>
            <?php
            endif ?>
        </header>
    </div>
    <main class="container">
        <?= $content ?>
        <?php if (isset($_GET['action']) && $_GET['action'] != 'home') include 'home-button.php' ?>
    </main>
</body>
</html>
