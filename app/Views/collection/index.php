<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="collection-wrapper">

    <!-- Sidebar gauche -->
    <aside class="collection-sidebar">
        <h2>Navigation</h2>
        <ul>
            <li>
                <a href="/gamekeeper/public/?url=game/index">
                    Tous les jeux
                </a>
            </li>
            <li>
                <a href="/gamekeeper/public/?url=collection/index" class="active">
                    Ma collection
                </a>
            </li>
        </ul>

        <!-- Stats -->
        <?php if (!empty($stats)): ?>
        <div class="sidebar-stats">
            <h2>Mes stats</h2>
            <ul>
                <li><span>Total</span><span><?= $stats['total'] ?></span></li>
                <li><span>En cours</span><span><?= $stats['playing'] ?></span></li>
                <li><span>Terminés</span><span><?= $stats['completed'] ?></span></li>
                <li><span>Abandonnés</span><span><?= $stats['abandoned'] ?></span></li>
                <li><span>Liste de souhaits</span><span><?= $stats['wish_list'] ?></span></li>
            </ul>
        </div>
        <?php endif; ?>
    </aside>

    <!-- Zone principale -->
    <div class="collection-main">

        <!-- Barre du haut -->
        <div class="collection-topbar">
            <h1>Ma collection</h1>
            <a href="/gamekeeper/public/?url=game/index">+ Ajouter des jeux</a>
        </div>

        <!-- Liste des jeux -->
        <?php if (empty($games)): ?>
            <div class="empty-state">
                <p>Ta collection est vide.</p>
                <p>
                    <a href="/gamekeeper/public/?url=game/index"
                       style="color: var(--vert-accent);">
                        Parcourir les jeux →
                    </a>
                </p>
            </div>
        <?php else: ?>
            <div class="games-grid">
                <?php foreach ($games as $game): ?>
                    <div class="game-card">

                        <!-- Couverture -->
                        <a href="/gamekeeper/public/?url=game/show&id=<?= $game['game_id'] ?>">
                            <div class="game-card-cover">🎮</div>
                            <div class="game-card-body">
                                <p class="game-card-title">
                                    <?= htmlspecialchars($game['game_title']) ?>
                                </p>
                                <p class="game-card-meta">
                                    <?= htmlspecialchars($game['platform_name']) ?>
                                    · <?= htmlspecialchars($game['genre_name']) ?>
                                </p>
                            </div>
                        </a>

                        <!-- Formulaire statut -->
                        <div class="game-card-actions">
                            <form method="POST"
                                  action="/gamekeeper/public/?url=collection/updateStatus">
                                <input type="hidden" name="game_id"
                                       value="<?= $game['game_id'] ?>">
                                <select name="status"
                                        onchange="this.form.submit()"
                                        class="status-select">
                                    <option value="wish_list"
                                        <?= $game['status'] === 'wish_list'  ? 'selected' : '' ?>>
                                        Liste de souhaits
                                    </option>
                                    <option value="playing"
                                        <?= $game['status'] === 'playing'    ? 'selected' : '' ?>>
                                        En cours
                                    </option>
                                    <option value="completed"
                                        <?= $game['status'] === 'completed'  ? 'selected' : '' ?>>
                                        Terminé
                                    </option>
                                    <option value="abandoned"
                                        <?= $game['status'] === 'abandoned'  ? 'selected' : '' ?>>
                                        Abandonné
                                    </option>
                                </select>
                            </form>
                        </div>

                        <!-- Formulaire temps de jeu -->
                        <div class="game-card-playtime">
                            <form method="POST"
                                  action="/gamekeeper/public/?url=collection/updatePlaytime">
                                <input type="hidden" name="game_id"
                                       value="<?= $game['game_id'] ?>">
                                <input type="number" name="playtime"
                                       value="<?= $game['playtime'] ?>"
                                       min="0" placeholder="Heures jouées"
                                       class="playtime-input">
                                <button type="submit" class="btn-playtime">✓</button>
                            </form>
                        </div>

                        <!-- Bouton retirer -->
                        <div style="padding: 0 12px 12px;">
                            <a class="btn-delete"
                               href="/gamekeeper/public/?url=collection/remove&game_id=<?= $game['game_id'] ?>">
                                Retirer de la collection
                            </a>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>