<?php require_once __DIR__ . '/../layout/header.php'; ?>

<main>
<div class="home-wrapper">

    <!-- Hero -->
    <div class="home-hero">
        <h1>🎮 GameKeeper</h1>
        <p>Crée et gère ta collection de jeux vidéo personnalisée. Suis ta progression, découvre de nouveaux jeux.</p>
        <div class="home-hero-buttons">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/gamekeeper/public/?url=game/index" class="btn-hero-primary">
                    Parcourir le catalogue
                </a>
                <a href="/gamekeeper/public/?url=collection/index" class="btn-hero-secondary">
                    Ma collection
                </a>
            <?php else: ?>
                <a href="/gamekeeper/public/?url=user/register" class="btn-hero-primary">
                    Créer un compte
                </a>
                <a href="/gamekeeper/public/?url=game/index" class="btn-hero-secondary">
                    Parcourir le catalogue
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Stats globales -->
    <div>
        <h2 class="home-section-title">📊 En chiffres</h2>
        <div class="home-stats">
            <div class="home-stat-card">
                <span class="stat-number"><?= count($recentGames) ?>+</span>
                <span class="stat-text">Jeux dans le catalogue</span>
            </div>
            <div class="home-stat-card">
                <span class="stat-number"><?= count($platforms) ?></span>
                <span class="stat-text">Plateformes</span>
            </div>
            <div class="home-stat-card">
                <span class="stat-number"><?= count($genres) ?></span>
                <span class="stat-text">Genres</span>
            </div>
        </div>
    </div>

    <!-- Derniers jeux ajoutés -->
    <?php if (!empty($recentGames)): ?>
    <div>
        <h2 class="home-section-title">🕹 Derniers jeux ajoutés</h2>
        <div class="games-grid">
            <?php foreach ($recentGames as $game): ?>
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
                            <div class="game-card-tags">
                                <?php
                                $gameGenres = explode(', ', $game['genre_names'] ?? '');
                                foreach ($gameGenres as $genre):
                                    if (empty(trim($genre))) continue;
                                ?>
                                    <span class="tag tag-genre">
                                        🏷 <?= htmlspecialchars(trim($genre)) ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <div style="text-align:center; margin-top:20px;">
            <a href="/gamekeeper/public/?url=game/index" class="btn-hero-primary">
                Voir tout le catalogue →
            </a>
        </div>
    </div>
    <?php endif; ?>

    <!-- Features -->
    <div>
        <h2 class="home-section-title">✨ Fonctionnalités</h2>
        <div class="home-features">
            <div class="home-feature-card">
                <span class="feature-icon">📚</span>
                <h3>Gère ta collection</h3>
                <p>Ajoute tes jeux, suis leur statut et ton temps de jeu en un seul endroit.</p>
            </div>
            <div class="home-feature-card">
                <span class="feature-icon">🎯</span>
                <h3>Suis ta progression</h3>
                <p>En cours, terminé, abandonné ou liste de souhaits — suis chaque jeu à ta façon.</p>
            </div>
            <div class="home-feature-card">
                <span class="feature-icon">🔍</span>
                <h3>Catalogue complet</h3>
                <p>Parcours un catalogue de jeux triés par plateforme et genre.</p>
            </div>
        </div>
    </div>

</div>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>