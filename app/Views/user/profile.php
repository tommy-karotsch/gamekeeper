<?php require_once __DIR__ . '/../layout/header.php'; ?>

<main>
    <div class="profile-wrapper">

        <!-- Zone haute : avatar + infos -->
        <div class="profile-top">

            <div class="profile-avatar">
                <?= strtoupper(mb_substr($user['username'], 0, 1)) ?>
            </div>

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
                <!-- ✅ AMÉLIORATION 1 : Badge rôle -->
                <div class="info-item">
                    <span class="info-label">Rôle</span>
                    <span class="role-badge <?= $user['role'] ?>">
                        <?= $user['role'] === 'admin' ? 'Admin' : 'Utilisateur' ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- ✅ AMÉLIORATION 3 : Stats de collection -->
        <?php if (!empty($stats) && $stats['total'] > 0): ?>
        <div class="profile-stats">
            <div class="stat-card">
                <span class="stat-value"><?= $stats['total'] ?></span>
                <span class="stat-label">Total</span>
            </div>
            <div class="stat-card">
                <span class="stat-value"><?= $stats['playing'] ?></span>
                <span class="stat-label">En cours</span>
            </div>
            <div class="stat-card">
                <span class="stat-value"><?= $stats['completed'] ?></span>
                <span class="stat-label">Terminés</span>
            </div>
            <div class="stat-card">
                <span class="stat-value"><?= $stats['abandoned'] ?></span>
                <span class="stat-label">Abandonnés</span>
            </div>
            <div class="stat-card">
                <span class="stat-value"><?= $stats['wish_list'] ?></span>
                <span class="stat-label">Liste de souhaits</span>
            </div>
        </div>
        <?php endif; ?>

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

            <!-- ✅ AMÉLIORATION 2 : Lien vers la collection -->
            <div class="accordion-item">
                <button class="accordion-header" onclick="toggleAccordion(this)">
                    Ma collection
                    <span class="accordion-icon">▼</span>
                </button>
                <div class="accordion-body">
                    <p style="color:#555; font-size:14px; margin-bottom:16px;">
                        Tu as <strong><?= $stats['total'] ?? 0 ?></strong> jeu(x) dans ta collection.
                    </p>
                    <a href="/gamekeeper/public/?url=collection/index" class="btn-submit"
                       style="display:block; text-align:center; text-decoration:none;">
                        Voir ma collection →
                    </a>
                </div>
            </div>

            <!-- Section 2 : changer le mot de passe -->
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
                            <label for="confirm_password">Confirmer</label>
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
                        ⚠️ Cette action est irréversible.
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

<script>
function toggleAccordion(header) {
    const body = header.nextElementSibling;
    const isOpen = body.classList.contains('open');
    document.querySelectorAll('.accordion-body').forEach(b => b.classList.remove('open'));
    document.querySelectorAll('.accordion-header').forEach(h => h.classList.remove('active'));
    if (!isOpen) {
        body.classList.add('open');
        header.classList.add('active');
    }
}
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>