<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamekeeper — Ajouter une plateforme</title>
</head>
<body>

    <h1>Ajouter une plateforme</h1>

    <form method="POST" action="/gamekeeper/public/?url=platform/store">
        <label for="name">Nom</label>
        <input type="text" id="name" name="name" required>
        <button type="submit">Ajouter</button>
    </form>

    <a href="/gamekeeper/public/?url=platform/index">Retour</a>

</body>
</html>