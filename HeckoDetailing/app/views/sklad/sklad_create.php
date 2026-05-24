<?php require_once '../app/views/layout/header.php'; ?>

<a href="<?= BASE_URL ?>/index.php?url=sklad/index" class="back-link" style="margin-top: 1rem;">&larr; Zpět na sklad</a>

<div class="form-container" style="max-width: 600px;">
    <div class="form-header">
        <h2>Přidat nový produkt</h2>
    </div>

    <form action="<?= BASE_URL ?>/index.php?url=sklad/store" method="post">
        <div class="form-grid">
            <div class="input-group full-width">
                <label>Název produktu:</label>
                <input type="text" name="nazev" required placeholder="Např. Autošampon Citrus">
            </div>

            <div class="input-group full-width">
                <label>Značka:</label>
                <input type="text" name="znacka" required placeholder="Např. Chemical Guys">
            </div>
            
            <div class="input-group">
                <label>Množství skladem:</label>
                <input type="number" step="0.01" name="skladem" required>
            </div>

            <div class="input-group">
                <label>Jednotka:</label>
                <input type="text" name="jednotka" required placeholder="ks, l, ml...">
            </div>
            
            <div class="input-group">
                <label>Minimální zásoba:</label>
                <input type="number" step="0.01" name="minimum" required>
            </div>
            
            <div class="input-group">
                <label>Cena za kus (Kč):</label>
                <input type="number" name="cena_ks" required>
            </div>
            
            <div class="input-group full-width" style="margin-top: 1rem;">
                <button type="submit" class="submit-btn">Uložit do skladu</button>
            </div>
        </div>
    </form>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>