<?php require_once __DIR__ . '/../layout/header.php'; ?>

<main>
    <div class="admin-wrapper">

        <div class="admin-topbar">
            <h1>🖥 Plateformes</h1>
            <a href="/gamekeeper/public/?url=platform/create" class="btn-admin-add">
                + Ajouter une plateforme
            </a>
        </div>

        <div class="admin-list">
            <?php if (empty($platforms)): ?>
                <p class="admin-empty">Aucune plateforme pour le moment.</p>
            <?php else: ?>
                <?php foreach ($platforms as $platform): ?>
                    <div class="admin-list-item">
                        <span><?= htmlspecialchars($platform['name']) ?></span>
                        <a class="btn-admin-delete"
                           href="/gamekeeper/public/?url=platform/delete&id=<?= $platform['id'] ?>"
                           onclick="return confirm('Supprimer cette plateforme ?')">
                            Supprimer
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>