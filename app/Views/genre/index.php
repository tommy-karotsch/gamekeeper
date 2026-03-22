<?php require_once __DIR__ . '/../layout/header.php'; ?>

<main>
    <div class="admin-wrapper">

        <div class="admin-topbar">
            <h1>🏷 Genres</h1>
            <a href="/gamekeeper/public/?url=genre/create" class="btn-admin-add">
                + Ajouter un genre
            </a>
        </div>

        <div class="admin-list">
            <?php if (empty($genres)): ?>
                <p class="admin-empty">Aucun genre pour le moment.</p>
            <?php else: ?>
                <?php foreach ($genres as $genre): ?>
                    <div class="admin-list-item">
                        <span><?= htmlspecialchars($genre['name']) ?></span>
                        <a class="btn-admin-delete"
                           href="/gamekeeper/public/?url=genre/delete&id=<?= $genre['id'] ?>"
                           onclick="return confirm('Supprimer ce genre ?')">
                            Supprimer
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>