<?php

require_once __DIR__ . '/../layout/header.php';

require_once __DIR__ . '/../layout/footer.php';

?>
<main>
    <div class="form-container">

        <h1>Modifier un jeu</h1>

        <form method="POST" action="/gamekeeper/public/?url=game/update&id=<?= $game['id'] ?>">

            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" id="title" name="title"
                       value="<?= htmlspecialchars($game['title']) ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4">
                    <?= htmlspecialchars($game['description']) ?>
                </textarea>
            </div>

            <div class="form-group">
                <label for="release_date">Date de sortie</label>
                <input type="date" id="release_date" name="release_date"
                       value="<?= htmlspecialchars($game['release_date']) ?>">
            </div>

            <div class="form-group">
                <label for="platform_id">Plateforme</label>
                <select id="platform_id" name="platform_id" required>
                    <?php foreach ($platforms as $platform): ?>
                        <option value="<?= $platform['id'] ?>"
                            <?= $platform['id'] == $game['platform_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($platform['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="genre_id">Genre</label>
                <select id="genre_id" name="genre_id" required>
                    <?php foreach ($genres as $genre): ?>
                        <option value="<?= $genre['id'] ?>"
                            <?= $genre['id'] == $game['genre_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($genre['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn-submit">Mettre à jour</button>

        </form>

        <a class="link-back" href="/gamekeeper/public/?url=game/index">← Retour à la liste</a>

    </div>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>