<?php require_once __DIR__ . '/../layout/header.php'; ?>

<main>
    <div class="profile-wrapper">

        <!-- Zone haute : avatar + infos -->
        <div class="profile-top">

            <!-- Avatar : initiale du username -->
            <div class="profile-avatar">
                <?= strtoupper(mb_substr($user['username'], 0, 1)) ?>
            </div>

            <!-- Carte infos -->
            <div class="profile-info-card">
                <div class="info-item">
                    <span class="info-label">Nom d'utilisateur</span>
                    <span class="info-value"><?= htmlspecialchars($user['username']) ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Email</span>
                    <span class="info-value"><?= htmlspecialchars($user['email']) ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Membre depuis</span>
                    <span class="info-value">
                        <?= date('d/m/Y', strtotime($user['created_at'])) ?>
                    </span>
                </div>
            </div>

        </div>

        <!-- Messages erreurs / succès -->
        <?php if (!empty($errors)): ?>
            <ul class="form-errors" style="margin-bottom: 20px;">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <p class="form-success" style="margin-bottom: 20px;">
                <?= htmlspecialchars($success) ?>
            </p>
        <?php endif; ?>

        <!-- Zone basse : accordéon -->
        <div class="profile-bottom">

            <!-- Section 1 : modifier infos -->
            <div class="accordion-item">
                <button class="accordion-header" onclick="toggleAccordion(this)">
                    Modifier mes informations
                    <span class="accordion-icon">▼</span>
                </button>
                <div class="accordion-body">
                    <form method="POST" action="/gamekeeper/public/?url=user/edit">
                        <input type="hidden" name="type" value="info">

                        <div class="form-group">
                            <label for="username">Nom d'utilisateur</label>
                            <input type="text" id="username" name="username"
                                   value="<?= htmlspecialchars($user['username']) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email"
                                   value="<?= htmlspecialchars($user['email']) ?>" required>
                        </div>

                        <button type="submit" class="btn-submit">Mettre à jour</button>
                    </form>
                </div>
            </div>

            <!-- Section 2 : changer mot de passe -->
            <div class="accordion-item">
                <button class="accordion-header" onclick="toggleAccordion(this)">
                    Changer mon mot de passe
                    <span class="accordion-icon">▼</span>
                </button>
                <div class="accordion-body">
                    <form method="POST" action="/gamekeeper/public/?url=user/edit">
                        <input type="hidden" name="type" value="password">

                        <div class="form-group">
                            <label for="current_password">Mot de passe actuel</label>
                            <input type="password" id="current_password"
                                   name="current_password" required>
                        </div>

                        <div class="form-group">
                            <label for="new_password">Nouveau mot de passe</label>
                            <input type="password" id="new_password"
                                   name="new_password" required>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Confirmer le nouveau mot de passe</label>
                            <input type="password" id="confirm_password"
                                   name="confirm_password" required>
                        </div>

                        <button type="submit" class="btn-submit">Changer le mot de passe</button>
                    </form>
                </div>
            </div>

            <!-- Section 3 : supprimer le compte -->
            <div class="accordion-item">
                <button class="accordion-header" onclick="toggleAccordion(this)">
                    Supprimer mon compte
                    <span class="accordion-icon">▼</span>
                </button>
                <div class="accordion-body">
                    <p style="color:#cc0000; font-size:14px; margin-bottom:16px;">
                        ⚠️ Cette action est irréversible. Ton compte sera définitivement supprimé.
                    </p>
                    <form method="POST" action="/gamekeeper/public/?url=user/delete">
                        <div class="form-group">
                            <label for="delete_password">Confirme ton mot de passe</label>
                            <input type="password" id="delete_password"
                                   name="password" required>
                        </div>
                        <button type="submit" class="btn-danger">Supprimer mon compte</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</main>

<!-- JS pour l'accordéon -->
<script>
function toggleAccordion(header) {
    const body = header.nextElementSibling;
    const isOpen = body.classList.contains('open');

    // Ferme tous les accordéons ouverts
    document.querySelectorAll('.accordion-body').forEach(b => b.classList.remove('open'));
    document.querySelectorAll('.accordion-header').forEach(h => h.classList.remove('active'));

    // Ouvre celui cliqué si il était fermé
    if (!isOpen) {
        body.classList.add('open');
        header.classList.add('active');
    }
}
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>