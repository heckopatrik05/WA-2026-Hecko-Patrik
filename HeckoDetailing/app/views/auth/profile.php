<?php require_once '../app/views/layout/header.php'; ?>

<div class="form-container">
    <div class="form-header">
        <h2>Můj profil</h2>
        <p style="color: var(--text-muted);">Zde můžete spravovat své osobní údaje.</p>
    </div>

    <div style="background: var(--bg-color); padding: 1.5rem; border-radius: 10px; border: 1px solid var(--border-color); margin-bottom: 2rem;">
        <p><strong>Uživatelské jméno:</strong> <?= htmlspecialchars($user['username']) ?></p>
        <p><strong>Jméno:</strong> <?= htmlspecialchars($user['first_name'] ?: 'Neuvedeno') ?></p>
        <p><strong>Příjmení:</strong> <?= htmlspecialchars($user['last_name'] ?: 'Neuvedeno') ?></p>
        <p><strong>Přezdívka:</strong> <?= htmlspecialchars($user['nickname'] ?: 'Neuvedeno') ?></p>
        <p><strong>E-mail:</strong> <?= htmlspecialchars($user['email']) ?></p>
    </div>

    <div style="display: flex; gap: 10px;">
        <a href="<?= BASE_URL ?>/index.php?url=auth/profile_edit" class="nav-btn-primary" style="text-decoration: none;">Upravit profil</a>
        
        <?php if ($_SESSION['is_admin']): ?>
            <span style="background: var(--danger); color: white; padding: 8px 12px; border-radius: 6px; font-weight: bold;">Administrátor</span>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>