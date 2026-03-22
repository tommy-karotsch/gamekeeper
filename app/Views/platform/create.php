<?php require_once __DIR__ . '/../layout/header.php'; ?>

<main>
    <div class="form-container">

        <h1>Ajouter une plateforme</h1>

        <form method="POST" action="/gamekeeper/public/?url=platform/store">
            <div class="form-group">
                <label for="name">Nom de la plateforme</label>
                <input type="text" id="name" name="name"
                       placeholder="ex: PlayStation 5" required>
            </div>
            <button type="submit" class="btn-submit">Ajouter</button>
        </form>

        <a class="link-back" href="/gamekeeper/public/?url=platform/index">
            ← Retour à la liste
        </a>

    </div>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>