<?php require_once '../app/views/layout/header.php'; ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2 style="margin: 0; color: var(--primary);">Správa uživatelů</h2>
    <span style="background: var(--danger); color: white; padding: 5px 12px; border-radius: 6px; font-weight: bold; font-size: 0.9rem;">Admin sekce</span>
</div>

<div class="table-container" style="overflow-x: auto; background-color: var(--card-bg); border-radius: 12px; border: 1px solid var(--border-color); box-shadow: var(--card-shadow);">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead style="background-color: var(--bg-color); border-bottom: 2px solid var(--border-color);">
            <tr>
                <th style="padding: 15px; color: var(--text-muted);">ID</th>
                <th style="padding: 15px; color: var(--text-muted);">Uživatel / Přezdívka</th>
                <th style="padding: 15px; color: var(--text-muted);">E-mail</th>
                <th style="padding: 15px; color: var(--text-muted);">Role</th>
                <th style="padding: 15px; color: var(--text-muted);">Registrace</th>
                <th style="padding: 15px; color: var(--text-muted);">Akce</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $u): ?>
                <tr style="border-bottom: 1px solid var(--border-color);">
                    <td style="padding: 15px;"><?= $u['id'] ?></td>
                    <td style="padding: 15px;">
                        <strong style="color: var(--text-dark);"><?= htmlspecialchars($u['username']) ?></strong>
                        <br>
                        <small style="color: var(--text-muted);"><?= htmlspecialchars($u['nickname'] ?: 'bez přezdívky') ?></small>
                    </td>
                    <td style="padding: 15px;"><?= htmlspecialchars($u['email']) ?></td>
                    <td style="padding: 15px;">
                        <?php if ($u['is_admin']): ?>
                            <span style="color: #ef4444; font-weight: bold; background: #fee2e2; padding: 2px 8px; border-radius: 4px;">Admin</span>
                        <?php else: ?>
                            <span style="color: #64748b; background: #f1f5f9; padding: 2px 8px; border-radius: 4px;">Uživatel</span>
                        <?php endif; ?>
                    </td>
                    <td style="padding: 15px; font-size: 0.85rem; color: var(--text-muted);">
                        <?= date('d.m.Y', strtotime($u['created_at'])) ?>
                    </td>
                    <td style="padding: 15px;">
                        <div style="display: flex; gap: 10px;">
                            <a href="<?= BASE_URL ?>/index.php?url=auth/profile/<?= $u['id'] ?>" style="color: var(--primary); text-decoration: none; font-weight: 600; font-size: 0.9rem;">Profil</a>
                            
                            <?php if ($u['id'] != $_SESSION['user_id']): ?>
                                <a href="<?= BASE_URL ?>/index.php?url=auth/deleteAccount/<?= $u['id'] ?>" 
                                   onclick="return confirm('Opravdu chcete smazat tohoto uživatele? Tato akce je nevratná!')" 
                                   style="color: #ef4444; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Smazat</a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>