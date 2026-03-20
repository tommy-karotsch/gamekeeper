<?php

require_once __DIR__ . '/../layout/header.php';

require_once __DIR__ . '/../layout/footer.php';

?>
<main>
    <div class="form-container">

        <h1><?= htmlspecialchars($game['title']) ?></h1>

        <p><strong>Plateforme :</strong> <?= htmlspecialchars($game['platform_id']) ?></p>
        <p><strong>Genre :</strong> <?= htmlspecialchars($game['genre_id']) ?></p>
        <p><strong>Date de sortie :</strong>
            <?= $game['release_date']
                ? date('d/m/Y', strtotime($game['release_date']))
                : 'Non renseignée' ?>
        </p>
        <p><strong>Description :</strong></p>
        <p><?= htmlspecialchars($game['description'] ?? 'Aucune description.') ?></p>

        <br>

        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <a class="btn-edit"
               href="/gamekeeper/public/?url=game/edit&id=<?= $game['id'] ?>">
                Modifier
            </a>
        <?php endif; ?>

        <a class="link-back" href="/gamekeeper/public/?url=game/index">← Retour à la liste</a>

    </div>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>