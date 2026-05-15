<?php require_once '../app/views/layout/header.php'; ?>

<div class="form-container" style="margin-top: 2rem; margin-bottom: 2rem;">
    <div class="form-header">
        <h2>Přihlášení</h2>
        <p style="color: var(--text-muted);">Vítejte zpět v systému HEČKO Detailing.</p>
    </div>

    <form action="<?= BASE_URL ?>/index.php?url=auth/authenticate" method="post">
        <div class="form-grid">
            
            <div class="input-group full-width">
                <label for="email">E-mailová adresa <span class="required">*</span></label>
                <input type="email" id="email" name="email" required autofocus>
            </div>

            <div class="input-group full-width">
                <label for="password">Heslo <span class="required">*</span></label>
                <div style="position: relative;">
                    <input type="password" id="password" name="password" required style="width: 100%; padding-right: 40px;">
                    <button type="button" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; font-size: 1.2rem; padding: 0;" title="Zobrazit heslo">
                        👁️
                    </button>
                </div>
            </div>

            <div class="input-group full-width" style="margin-top: 1rem; display: flex; align-items: center; gap: 10px; flex-direction: row;">
                <input type="checkbox" id="remember" name="remember" style="width: auto; cursor: pointer; transform: scale(1.2);">
                <label for="remember" style="color: var(--text-muted); font-size: 0.95rem; cursor: pointer; margin: 0;">Pamatuj si mě (na 30 dní)</label>
            </div>

            <div class="input-group full-width" style="margin-top: 0.5rem;">
                <button type="submit" class="submit-btn">Přihlásit se</button>
            </div>
            
        </div>
    </form>
    
    <div style="text-align: center; margin-top: 1.5rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem;">
        <p style="color: var(--text-muted);">
            Nemáte ještě účet? 
            <a href="<?= BASE_URL ?>/index.php?url=auth/register" style="color: var(--primary); font-weight: bold; text-decoration: none; transition: 0.2s;">
                Zaregistrujte se
            </a>
        </p>
    </div>
</div>

<script>
    const passwordInput = document.getElementById('password');
    const togglePasswordBtn = document.getElementById('togglePassword');

    togglePasswordBtn.addEventListener('click', function () {
        // Zjistíme aktuální typ a přepneme ho (password <-> text)
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        // Změna ikonky oka
        this.textContent = type === 'password' ? '👁️' : '🙈';
    });
</script>

<?php require_once '../app/views/layout/footer.php'; ?>