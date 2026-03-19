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
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/gamekeeper/public/?url=user/profile">
                <?= htmlspecialchars($_SESSION['username']) ?>
            </a>
            <span class="separator">|</span>
            <a href="/gamekeeper/public/?url=user/logout">Se déconnecter</a>
        <?php else: ?>
            <a href="/gamekeeper/public/?url=user/login">Se connecter</a>
            <span class="separator">|</span>
            <a href="/gamekeeper/public/?url=user/register">S'inscrire</a>
        <?php endif; ?>
    </nav>
</header>