<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamekeeper - Inscription</title>
</head>
<body>
    <h1>Inscription</h1>

    <?php if(!empty($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <p><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <form method="POST" action="/gamekeeper/public/?url=user/register">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username" id="username"
               value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email"
               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm_password">Confirmer le mot de passe</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <button type="submit">S'inscrire</button>
    </form>

    <p>Déjà inscrit ? <a href="/gamekeeper/public/?url=user/login">Se connecter</a></p>
</body>
</html>