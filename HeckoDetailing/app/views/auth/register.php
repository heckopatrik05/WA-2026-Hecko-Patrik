<?php require_once '../app/views/layout/header.php'; ?>

<div class="form-container" style="margin-top: 2rem; margin-bottom: 2rem;">
    <div class="form-header">
        <h2>Registrace nového uživatele</h2>
        <p style="color: var(--text-muted);">Vyplňte údaje pro vytvoření účtu.</p>
    </div>

    <form action="<?= BASE_URL ?>/index.php?url=auth/storeUser" method="post">
        <div class="form-grid">
            <div class="input-group">
                <label for="username">Uživatelské jméno <span class="required">*</span></label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="input-group">
                <label for="email">E-mailová adresa <span class="required">*</span></label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="input-group">
                <label for="password">Heslo <span class="required">*</span></label>
                
                <div style="position: relative;">
                    <input type="password" id="password" name="password" required style="width: 100%; padding-right: 40px;">
                    <button type="button" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; font-size: 1.2rem; padding: 0;" title="Zobrazit heslo">
                        👁️
                    </button>
                </div>
                
                <div style="margin-top: 8px; background: var(--border-color); height: 6px; border-radius: 3px; overflow: hidden;">
                    <div id="strength-bar" style="height: 100%; width: 0%; transition: all 0.3s ease;"></div>
                </div>
                
                <small id="strength-text" style="color: var(--text-muted); display: block; margin-top: 4px;">Zadejte heslo</small>
            </div>

            <div class="input-group">
                <label for="password_confirm">Potvrzení hesla <span class="required">*</span></label>
                <input type="password" id="password_confirm" name="password_confirm" required>
            </div>

            <div class="input-group full-width">
                <button type="submit" class="submit-btn">Zaregistrovat se</button>
            </div>
        </div>
    </form>
    
    <div style="text-align: center; margin-top: 1.5rem;">
        <p style="color: var(--text-muted);">Již máte účet? <a href="<?= BASE_URL ?>/index.php?url=auth/login" style="color: var(--primary); font-weight: bold; text-decoration: none;">Přihlaste se</a></p>
    </div>
</div>

<script>
    // 1. Zobrazení / Skrytí hesla (Očičko)
    const passwordInput = document.getElementById('password');
    const togglePasswordBtn = document.getElementById('togglePassword');

    togglePasswordBtn.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.textContent = type === 'password' ? '👁️' : '🙈';
    });

    // 2. Výpočet síly hesla v reálném čase
    const strengthBar = document.getElementById('strength-bar');
    const strengthText = document.getElementById('strength-text');

    passwordInput.addEventListener('input', function() {
        const val = passwordInput.value;
        let score = 0;

        if (!val) {
            strengthBar.style.width = '0%';
            strengthText.textContent = 'Zadejte heslo';
            strengthText.style.color = 'var(--text-muted)';
            return;
        }

        // Bodovací systém (max 4 body)
        if (val.length >= 8) score += 1;                  // Je dostatečně dlouhé
        if (/[A-Z]/.test(val)) score += 1;                // Obsahuje velké písmeno
        if (/[a-z]/.test(val)) score += 1;                // Obsahuje malé písmeno
        if (/[0-9]/.test(val)) score += 1;                // Obsahuje číslo

        if (score <= 2) {
            strengthBar.style.width = '33%';
            strengthBar.style.backgroundColor = '#ef4444'; 
            strengthText.textContent = 'Slabé heslo (přidejte čísla a velká písmena)';
            strengthText.style.color = '#ef4444';
        } else if (score === 3) { 
            strengthBar.style.width = '66%';
            strengthBar.style.backgroundColor = '#f59e0b'; 
            strengthText.textContent = 'Středně silné heslo';
            strengthText.style.color = '#f59e0b';
        } else if (score === 4) { 
            strengthBar.style.width = '100%';
            strengthBar.style.backgroundColor = '#10b981'; 
            strengthText.textContent = 'Velmi silné heslo!';
            strengthText.style.color = '#10b981';
        }
    });
</script>

<?php require_once '../app/views/layout/footer.php'; ?>