<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamekeeper - Profil</title>
</head>
<body>
    <h1>Mon profil </h1>

    <p>Bienvenue, <?=  htmlspecialchars($user['username']) ?></p>
    <p>Email : <?= htmlspecialchars($user['email']) ?></p>
    <p>Membre depuis : <?= htmlspecialchars($user['created_at']) ?></p>

    <a href="/gamekeeper/public/?url=user/logout">Se déconnecter</a>

    <?php if(!empty($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if(!empty($success)): ?>
        <p><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>


    <h2>Modifier mes informations</h2>
    <form method="POST" action="/gamekeeper/public/?url=user/edit">
        <input type="hidden" name="type" value="info">

        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" id="username" value="<?= htmlspecialchars($user['username']) ?>" required>

        <label for="email">Email :</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" required>

        <button type="submit">Mettre à jour</button>
    </form>

    <h2>Changer mon mot de passe</h2>
    <form method="POST" action="/gamekeeper/public/?url=user/edit">
        <input type="hidden" name="type" value="password">

        <label for="current_password">Mot de passe actuel :</label>
        <input type="password" name="current_password" id="current_password" required>

        <label for="confirm_password">Confirmer le nouveau mot de passe</label>
        <input type="password" name="confirm_password" id="confirm_password" required>

        <button type="submit">Changer le mot de passe</button>
    </form>

    <h2>Supprimer mon compte</h2>
    
    <form method="POST" action="/gamekeeper/public/?url=user/delete">

        <label for="delete_password">Confirmez votre mot de passe</label>
        <input type="password" name="password" id="delete_password" required>

        <button type="submit">Supprimer mon compte</button>
    </form>

</body>
</html> 