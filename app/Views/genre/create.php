<?php require_once __DIR__ . '/../layout/header.php'; ?>

<main>
    <div class="form-container">

        <h1>Ajouter un genre</h1>

        <form method="POST" action="/gamekeeper/public/?url=genre/store">
            <div class="form-group">
                <label for="name">Nom du genre</label>
                <input type="text" id="name" name="name"
                       placeholder="ex: FPS" required>
            </div>
            <button type="submit" class="btn-submit">Ajouter</button>
        </form>

        <a class="link-back" href="/gamekeeper/public/?url=genre/index">
            ← Retour à la liste
        </a>

    </div>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>