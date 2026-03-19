<?php require_once __DIR__ . '/../layout/header.php'; ?>

<main>
    <div class="form-container">

        <h1>Inscription</h1>

        <?php if (!empty($errors)): ?>
            <ul class="form-errors">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <p class="form-success"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>

        <form method="POST" action="/gamekeeper/public/?url=user/register">

            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username"
                       value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                       placeholder="Ton pseudo" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email"
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                       placeholder="exemple@email.com" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password"
                       placeholder="8 caractères minimum" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirmer le mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password"
                       placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-submit">S'inscrire</button>

        </form>

        <p class="form-link">
            Déjà un compte ?
            <a href="/gamekeeper/public/?url=user/login">Se connecter</a>
        </p>

    </div>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>