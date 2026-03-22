<?php require_once __DIR__ . '/../layout/header.php'; ?>

<main>
<div class="game-form-wrapper">

    <h1>✏️ Modifier un jeu</h1>

    <form method="POST" action="/gamekeeper/public/?url=game/update&id=<?= $game['id'] ?>">
        <div class="game-form-grid">

            <!-- Colonne gauche -->
            <div class="game-form-left">

                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" id="title" name="title"
                           value="<?= htmlspecialchars($game['title']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4">
                        <?= htmlspecialchars($game['description'] ?? '') ?>
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="release_date">Date de sortie</label>
                    <input type="date" id="release_date" name="release_date"
                           value="<?= htmlspecialchars($game['release_date'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="cover_image">Image de couverture (URL)</label>
                    <input type="text" id="cover_image" name="cover_image"
                           value="<?= htmlspecialchars($game['cover_image'] ?? '') ?>"
                           placeholder="https://...">
                </div>

            </div>

            <!-- Colonne droite -->
            <div class="game-form-right">

                <?php
                    $currentPlatformIds = !empty($game['platform_ids'])
                        ? explode(',', $game['platform_ids']) : [];
                    $currentGenreIds = !empty($game['genre_ids'])
                        ? explode(',', $game['genre_ids']) : [];
                ?>

                <div class="form-group">
                    <span class="form-section-label">Plateformes disponibles</span>
                    <div class="checkbox-container">
                        <?php foreach ($platforms as $platform): ?>
                            <label class="checkbox-label">
                                <input type="checkbox"
                                       name="platform_ids[]"
                                       value="<?= $platform['id'] ?>"
                                       <?= in_array($platform['id'], $currentPlatformIds) ? 'checked' : '' ?>>
                                <?= htmlspecialchars($platform['name']) ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="form-group">
                    <span class="form-section-label">Genres</span>
                    <div class="checkbox-container">
                        <?php foreach ($genres as $genre): ?>
                            <label class="checkbox-label">
                                <input type="checkbox"
                                       name="genre_ids[]"
                                       value="<?= $genre['id'] ?>"
                                       <?= in_array($genre['id'], $currentGenreIds) ? 'checked' : '' ?>>
                                <?= htmlspecialchars($genre['name']) ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>

            <!-- Actions -->
            <div class="game-form-actions">
                <button type="submit" class="btn-submit" style="width:auto; padding: 12px 30px;">
                    Mettre à jour
                </button>
                <a class="link-back" href="/gamekeeper/public/?url=game/index">
                    ← Retour à la liste
                </a>
            </div>

        </div>
    </form>

</div>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>