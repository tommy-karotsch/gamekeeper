<?php require_once __DIR__ . '/../layout/header.php'; ?>

<main style="padding: 0;">
    <div class="collection-wrapper">

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

        <div class="collection-main">

            <div class="collection-topbar">
                <h1>Ma collection</h1>
                <a href="/gamekeeper/public/?url=game/index">+ Ajouter des jeux</a>
            </div>

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

                            <a href="/gamekeeper/public/?url=game/show&id=<?= $game['game_id'] ?>">
                                <div class="game-card-cover">
                                    <?php if (!empty($game['cover_image'])): ?>
                                        <img src="<?= htmlspecialchars($game['cover_image']) ?>"
                                            alt="<?= htmlspecialchars($game['game_title']) ?>">
                                    <?php else: ?>
                                        🎮
                                    <?php endif; ?>
                                </div>
                                <div class="game-card-body">
                                    <p class="game-card-title">
                                        <?= htmlspecialchars($game['game_title']) ?>
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

                            <!-- Statut -->
                            <div class="game-card-actions">
                                <form method="POST"
                                      action="/gamekeeper/public/?url=collection/updateStatus">
                                    <input type="hidden" name="game_id"
                                           value="<?= $game['game_id'] ?>">
                                    <select name="status"
                                            onchange="this.form.submit()"
                                            class="status-select">
                                        <option value="wish_list"
                                            <?= $game['status'] === 'wish_list' ? 'selected' : '' ?>>
                                            Liste de souhaits
                                        </option>
                                        <option value="playing"
                                            <?= $game['status'] === 'playing' ? 'selected' : '' ?>>
                                            En cours
                                        </option>
                                        <option value="completed"
                                            <?= $game['status'] === 'completed' ? 'selected' : '' ?>>
                                            Terminé
                                        </option>
                                        <option value="abandoned"
                                            <?= $game['status'] === 'abandoned' ? 'selected' : '' ?>>
                                            Abandonné
                                        </option>
                                    </select>
                                </form>
                            </div>

                            <!-- Temps de jeu -->
                            <div class="game-card-playtime">
                                <label style="font-size:11px; color:#999; text-transform:uppercase;
                                              letter-spacing:1px; display:block; margin-bottom:4px;">
                                    Heures jouées
                                </label>
                                <form method="POST"
                                      action="/gamekeeper/public/?url=collection/updatePlaytime">
                                    <input type="hidden" name="game_id"
                                           value="<?= $game['game_id'] ?>">
                                    <input type="number" name="playtime"
                                           value="<?= $game['playtime'] ?>"
                                           min="0" placeholder="ex: 42"
                                           class="playtime-input">
                                    <button type="submit" class="btn-playtime">✓</button>
                                </form>
                            </div>

                            <!-- Retirer -->
                            <a class="btn-delete"
                               href="/gamekeeper/public/?url=collection/remove&game_id=<?= $game['game_id'] ?>"
                               onclick="return confirm('Retirer ce jeu de ta collection ?')">
                                Retirer de la collection
                            </a>

                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>