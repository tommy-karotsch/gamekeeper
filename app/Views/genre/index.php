<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="collection-wrapper">

    <aside class="collection-sidebar">
        <h2>Navigation</h2>
        <ul>
            <li><a href="/gamekeeper/public/?url=game/index">Tous les jeux</a></li>
            <li><a href="/gamekeeper/public/?url=platform/index">Plateformes</a></li>
            <li><a href="/gamekeeper/public/?url=genre/index" class="active">Genres</a></li>
        </ul>
    </aside>

    <div class="collection-main">
        <div class="collection-topbar">
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

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>