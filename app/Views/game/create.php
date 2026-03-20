<?php

require_once __DIR__ . '/../layout/header.php';

require_once __DIR__ . '/../layout/footer.php';

?>
<main>
    <div class="form-container">

        <h1>Ajouter un jeu</h1>

        <form method="POST" action="/gamekeeper/public/?url=game/store">

            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label for="release_date">Date de sortie</label>
                <input type="date" id="release_date" name="release_date">
            </div>

            <div class="form-group">
                <label for="platform_id">Plateforme</label>
                <select id="platform_id" name="platform_id" required>
                    <option value="">-- Choisir --</option>
                    <?php foreach ($platforms as $platform): ?>
                        <option value="<?= $platform['id'] ?>">
                            <?= htmlspecialchars($platform['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="genre_id">Genre</label>
                <select id="genre_id" name="genre_id" required>
                    <option value="">-- Choisir --</option>
                    <?php foreach ($genres as $genre): ?>
                        <option value="<?= $genre['id'] ?>">
                            <?= htmlspecialchars($genre['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn-submit">Ajouter le jeu</button>

        </form>

        <a class="link-back" href="/gamekeeper/public/?url=game/index">← Retour à la liste</a>

    </div>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>