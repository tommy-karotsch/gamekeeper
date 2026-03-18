<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamekeeper — Plateformes</title>
</head>
<body>

    <h1>Plateformes</h1>

    <a href="/gamekeeper/public/?url=platform/create">Ajouter une plateforme</a>

    <?php if (empty($platforms)): ?>
        <p>Aucune plateforme pour le moment.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($platforms as $platform): ?>
                <li>
                    <?= htmlspecialchars($platform['name']) ?>
                    <a href="/gamekeeper/public/?url=platform/delete&id=<?= $platform['id'] ?>">
                        Supprimer
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</body>
</html>