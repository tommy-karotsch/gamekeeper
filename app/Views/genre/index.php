<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamekeeper - Genres</title>
</head>
<body>
    
    <h1>Genres</h1>
        <a href="/gamekeeper/public/?url=genre/create">Ajouter un genre</a>

    <?php if(empty($genres)): ?>
        <p>Aucun genre pour le moment</p>
    <?php else: ?>
        <ul>
            <?php foreach($genres as $genre): ?>
                <li>
                    <?= htmlspecialchars($genre['name']) ?>
                    <a href="/gamekeeper/public/?url=genre/delete&id=<?= $genre['id'] ?>">Supprimer</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html> 