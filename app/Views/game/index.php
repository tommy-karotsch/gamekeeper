<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="collection-wrapper">

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

    <div class="collection-main">

        <div class="collection-topbar">
            <h1>Tous les jeux</h1>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="/gamekeeper/public/?url=game/create">+ Ajouter un jeu</a>
            <?php endif; ?>
        </div>

        <?php if (empty($games)): ?>
            <div class="empty-state">
                <p>Aucun jeu pour le moment.</p>
            </div>
        <?php else: ?>
            <div class="games-grid">
                <?php foreach ($games as $game): ?>
                    <div class="game-card">

                        <a href="/gamekeeper/public/?url=game/show&id=<?= $game['id'] ?>">
                            <div class="game-card-cover">
                                <?php if (!empty($game['cover_image'])): ?>
                                    <img src="<?= htmlspecialchars($game['cover_image']) ?>"
                                        alt="<?= htmlspecialchars($game['title']) ?>">
                                <?php else: ?>
                                    🎮
                                <?php endif; ?>
                            </div>
                            <div class="game-card-body">
                                <p class="game-card-title">
                                    <?= htmlspecialchars($game['title']) ?>
                                </p>
                                <!-- Tags plateformes -->
                                <div class="game-card-tags">
                                    <?php
                                    $platforms = explode(', ', $game['platform_names'] ?? '');
                                    foreach ($platforms as $platform):
                                        if (empty(trim($platform))) continue;
                                    ?>
                                        <span class="tag tag-platform">
                                            🖥 <?= htmlspecialchars(trim($platform)) ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                                <!-- Tags genres -->
                                <div class="game-card-tags">
                                    <?php
                                    $genres = explode(', ', $game['genre_names'] ?? '');
                                    foreach ($genres as $genre):
                                        if (empty(trim($genre))) continue;
                                    ?>
                                        <span class="tag tag-genre">
                                            🏷 <?= htmlspecialchars(trim($genre)) ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </a>

                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                            <div class="game-card-actions">
                                <a class="btn-edit"
                                   href="/gamekeeper/public/?url=game/edit&id=<?= $game['id'] ?>">
                                    Modifier
                                </a>
                                <a class="btn-delete"
                                   href="/gamekeeper/public/?url=game/delete&id=<?= $game['id'] ?>"
                                   onclick="return confirm('Supprimer ce jeu ?')">
                                    Supprimer
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['user_id']) && (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin')): ?>
                            <div class="game-card-actions">
                                <a class="btn-submit"
                                   href="/gamekeeper/public/?url=collection/add&game_id=<?= $game['id'] ?>">
                                    + Ma collection
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