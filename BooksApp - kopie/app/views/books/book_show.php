<?php require_once '../app/views/layout/header.php'; ?>

<div class="form-container">
    <a href="<?= BASE_URL ?>/index.php" class="back-link">&larr; Zpět na seznam</a>
    
    <div class="form-header">
        <h2><?= htmlspecialchars($book['title']) ?></h2>
        <p>Autor: <strong><?= htmlspecialchars($book['author']) ?></strong></p>
    </div>

    <div style="margin-bottom: 2rem; line-height: 1.6;">
        <p><strong>ISBN:</strong> <?= htmlspecialchars($book['isbn']) ?></p>
        <p><strong>Rok vydání:</strong> <?= htmlspecialchars($book['year']) ?></p>
        <p><strong>Popis:</strong><br><?= nl2br(htmlspecialchars($book['description'])) ?></p>
    </div>

    <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 2rem 0;">

    <div class="comments-section">
        <h3>Komentáře</h3>

        <?php if (isset($_SESSION['user_id'])): ?>
            <form action="<?= BASE_URL ?>/index.php?url=book/addComment/<?= $book['id'] ?>" method="post" style="margin-bottom: 2rem;">
                <div class="input-group full-width">
                    <label for="content">Napište svůj názor:</label>
                    <textarea id="content" name="content" rows="3" required placeholder="Vaše zpráva..."></textarea>
                </div>
                <button type="submit" class="submit-btn" style="margin-top: 0.5rem; width: auto; padding: 0.6rem 1.5rem;">Odeslat komentář</button>
            </form>
        <?php else: ?>
            <p style="color: var(--text-muted); font-style: italic;">Pro přidávání komentářů se musíte <a href="<?= BASE_URL ?>/index.php?url=auth/login">přihlásit</a>.</p>
        <?php endif; ?>

        <div class="comments-list" style="display: flex; flex-direction: column; gap: 1rem;">
            <?php if (empty($comments)): ?>
                <p style="color: var(--text-muted);">Zatím žádné komentáře. Buďte první!</p>
            <?php else: ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment" style="background: #f8fafc; padding: 1rem; border-radius: 8px; border: 1px solid var(--border-color);">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <strong style="color: var(--primary);"><?= htmlspecialchars($comment['nickname'] ?: $comment['username']) ?></strong>
                            <span style="font-size: 0.8rem; color: var(--text-muted);"><?= date('d.m.Y H:i', strtotime($comment['created_at'])) ?></span>
                        </div>
                        <p style="margin: 0;"><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>