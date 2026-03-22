<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/gamekeeper/assets/css/style.css">
    <title>GameKeeper</title>
</head>
<body>

<header>
    <a href="/gamekeeper/public/" class="header-logo">
        <img src="/gamekeeper/assets/img/logo-manette.png" alt="Logo GameKeeper">
        <span>GameKeeper</span>
        <div class="logo-separator"></div>
    </a>

    <nav class="header-nav">

        <a href="/gamekeeper/public/?url=game/index">🎮 Catalogue</a>

        <?php if (isset($_SESSION['user_id'])): ?>

            <span class="separator">|</span>
            <a href="/gamekeeper/public/?url=collection/index">📚 Ma collection</a>

            <?php if ($_SESSION['role'] === 'admin'): ?>
                <span class="separator">|</span>
                <a href="/gamekeeper/public/?url=platform/index">🖥 Plateformes</a>
                <span class="separator">|</span>
                <a href="/gamekeeper/public/?url=genre/index">🏷 Genres</a>
            <?php endif; ?>

            <span class="separator">|</span>

            <!-- ✅ Badge supprimé — le username seul suffit -->
            <a href="/gamekeeper/public/?url=user/profile" class="nav-username">
                👤 <?= htmlspecialchars($_SESSION['username']) ?>
            </a>
            <a href="/gamekeeper/public/?url=user/logout" class="nav-logout">
                Déconnexion
            </a>

        <?php else: ?>

            <span class="separator">|</span>
            <a href="/gamekeeper/public/?url=user/login">Se connecter</a>
            <a href="/gamekeeper/public/?url=user/register" class="nav-register">
                S'inscrire
            </a>

        <?php endif; ?>

    </nav>
</header>