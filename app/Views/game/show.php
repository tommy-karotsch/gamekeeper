<?php

require_once __DIR__ . '/../layout/header.php';

?>
<main>
    <div class="form-container">

        <?php if (!empty($game['cover_image'])): ?>
            <img src="<?= htmlspecialchars($game['cover_image']) ?>"
                alt="<?= htmlspecialchars($game['title']) ?>"
                style="width:100%; border-radius:12px; margin-bottom:20px; object-fit:cover; max-height:300px;">
        <?php endif; ?>
        <h1><?= htmlspecialchars($game['title']) ?></h1>

        <div class="game-info">
        <p><strong>Plateforme(s) :</strong> <?= htmlspecialchars($game['platform_names'] ?? 'Non renseignée') ?></p>
        <p><strong>Genre(s) :</strong> <?= htmlspecialchars($game['genre_names'] ?? 'Non renseigné') ?></p>
        </div>
        <p><strong>Date de sortie :</strong>
            <?= $game['release_date']
                ? date('d/m/Y', strtotime($game['release_date']))
                : 'Non renseignée' ?>
        </p>
        <br>

        <p><strong>Description :</strong></p>
        <p><?= htmlspecialchars($game['description'] ?? 'Aucune description.') ?></p>

        <br>

        <div class="container-bottom">
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <a class="btn-edit"
               href="/gamekeeper/public/?url=game/edit&id=<?= $game['id'] ?>">
                Modifier
            </a>
        <?php endif; ?>

        <a class="link-back" href="/gamekeeper/public/?url=game/index">← Retour à la liste</a>
        
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>