<?php require_once '../app/views/layout/header.php'; ?>

<a href="<?= BASE_URL ?>/index.php?url=zakazka/show/<?= $comment['zakazka_id'] ?>" class="back-link" style="margin-top: 1rem;">&larr; Zpět na detail zakázky</a>

<div class="form-container" style="margin-bottom: 2rem; max-width: 600px;">
    <div class="form-header">
        <h2>Upravit váš komentář</h2>
        <p style="color: var(--text-muted);">Upravte text zprávy níže a uložte změny.</p>
    </div>

    <form action="<?= BASE_URL ?>/index.php?url=zakazka/updateComment/<?= $comment['id'] ?>" method="post">
        <div class="form-grid">
            <div class="input-group full-width">
                <label for="content">Obsah komentáře:</label>
                <textarea id="content" name="content" rows="4" required><?= htmlspecialchars($comment['content']) ?></textarea>
            </div>
            
            <div class="input-group full-width" style="margin-top: 0.5rem;">
                <button type="submit" class="submit-btn">Uložit změny</button>
            </div>
        </div>
    </form>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>