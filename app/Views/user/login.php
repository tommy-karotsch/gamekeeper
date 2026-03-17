<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameKeeper - Connexion</title>
</head>
<body>
    <h1>Connexion</h1>

    <?php if(!empty($errors)): ?>
        <ul>
            <?php foreach($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

        <form method="POST" action="/gamekeeper/public/?url=user/login">

        <label for="email">Email</label>
        <input type="email" id="email" name="email"
               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Se connecter</button>

    </form>

    <p>Pas encore de compte ? <a href="/gamekeeper/public/?url=user/register">S'inscrire</a></p>

</body>
</html>