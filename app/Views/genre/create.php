<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamekeeper - Ajouter un genre</title>
</head>
<body>
    
    <h1>Ajouter un genre</h1>
        <form method="POST" accept="/gamekeeper/public/?url=genre/store">
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" required>
            <button type="submit">Ajouter</button>
        </form>

        <a href="/gamekeeper/public/?url=genre/index">Retour</a>
</body>
</html>