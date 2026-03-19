<?php require_once __DIR__ . '/../layout/header.php'; ?>

<main>
    <div class="form-container">

        <h1>Connexion</h1>

        <?php if (!empty($errors)): ?>
            <ul class="form-errors">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form method="POST" action="/gamekeeper/public/?url=user/login">

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email"
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                       placeholder="exemple@email.com" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password"
                       placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-submit">Se connecter</button>

        </form>

        <p class="form-link">
            Pas encore de compte ?
            <a href="/gamekeeper/public/?url=user/register">S'inscrire</a>
        </p>

    </div>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>