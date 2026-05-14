<?php require_once '../app/views/layout/header.php'; ?>

<div class="form-container">
    <div class="form-header">
        <h2>Upravit profil</h2>
    </div>

    <form action="<?= BASE_URL ?>/index.php?url=auth/updateProfile" method="post">
        <div class="form-grid">
            <div class="input-group">
                <label for="first_name">Jméno</label>
                <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>">
            </div>
            <div class="input-group">
                <label for="last_name">Příjmení</label>
                <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>">
            </div>
            <div class="input-group">
                <label for="nickname">Přezdívka</label>
                <input type="text" id="nickname" name="nickname" value="<?= htmlspecialchars($user['nickname']) ?>">
            </div>
            <div class="input-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            <div class="input-group full-width">
                <button type="submit" class="submit-btn">Uložit změny</button>
            </div>
        </div>
    </form>
    
    <a href="<?= BASE_URL ?>/index.php?url=auth/profile" class="back-link" style="margin-top: 1rem; display: block;">Zrušit a zpět</a>

    <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid var(--border-color);">
        <h3 style="color: var(--danger); margin-bottom: 0.5rem; margin-top: 0;">Nebezpečná zóna</h3>
        <p style="color: var(--text-muted); margin-bottom: 1.5rem; font-size: 0.9rem;">
            Tato akce je nevratná. Váš profil bude trvale vymazán z databáze.
        </p>
        
        <a href="<?= BASE_URL ?>/index.php?url=auth/deleteAccount/<?= $user['id'] ?>" 
           onclick="return confirm('Opravdu chcete TRVALE smazat svůj účet? Tuto akci nelze vrátit zpět!')" 
           style="background: var(--danger-bg); color: var(--danger); border: 1px solid var(--danger); padding: 0.8rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: bold; display: inline-block; transition: 0.2s;">
           Smazat můj účet
        </a>
    </div>

</div>

<?php require_once '../app/views/layout/footer.php'; ?>
    <a href="<?= BASE_URL ?>/index.php?url=auth/profile" class="back-link" style="margin-top: 1rem; display: block;">Zrušit a zpět</a>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>