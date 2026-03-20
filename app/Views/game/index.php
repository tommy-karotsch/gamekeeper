<?php

require_once __DIR__ . '/../layout/header.php';

require_once __DIR__ . '/../layout/footer.php';

?>
<div class="collection-wrapper">

    <!-- Sidebar gauche -->
    <aside class="collection-sidebar">
        <h2>Navigation</h2>
        <ul>
            <li>
                <a href="/gamekeeper/public/?url=game/index" class="active">
                    Tous les jeux
                </a>
            </li>
            <?php if (isset($_SESSION['user_id'])): ?>
            <li>
                <a href="/gamekeeper/public/?url=collection/index">
                    Ma collection
                </a>
            </li>
            <?php endif; ?>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <li>
                <a href="/gamekeeper/public/?url=platform/index">Plateformes</a>
            </li>
            <li>
                <a href="/gamekeeper/public/?url=genre/index">Genres</a>
            </li>
            <?php endif; ?>
        </ul>
    </aside>

    <!-- Zone principale -->
    <div class="collection-main">

        <!-- Barre du haut -->
        <div class="collection-topbar">
            <h1>Tous les jeux</h1>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="/gamekeeper/public/?url=game/create">+ Ajouter un jeu</a>
            <?php endif; ?>
        </div>

        <!-- Liste des jeux -->
        <?php if (empty($games)): ?>
            <div class="empty-state">
                <p>Aucun jeu pour le moment.</p>
            </div>
        <?php else: ?>
            <div class="games-grid">
                <?php foreach ($games as $game): ?>
                    <div class="game-card">
                        <a href="/gamekeeper/public/?url=game/show&id=<?= $game['id'] ?>">
                            <div class="game-card-cover">🎮</div>
                            <div class="game-card-body">
                                <p class="game-card-title">
                                    <?= htmlspecialchars($game['title']) ?>
                                </p>
                                <p class="game-card-meta">
                                    <?= htmlspecialchars($game['platform_name']) ?>
                                    · <?= htmlspecialchars($game['genre_name']) ?>
                                </p>
                            </div>
                        </a>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                            <div class="game-card-actions">
                                <a class="btn-edit"
                                   href="/gamekeeper/public/?url=game/edit&id=<?= $game['id'] ?>">
                                    Modifier
                                </a>
                                <a class="btn-delete"
                                   href="/gamekeeper/public/?url=game/delete&id=<?= $game['id'] ?>">
                                    Supprimer
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>