<?php require_once '../app/views/layout/header.php'; ?>

<a href="<?= BASE_URL ?>/index.php?url=sklad/index" class="back-link" style="margin-top: 1rem;">&larr; Zpět na sklad</a>

<div class="form-container" style="max-width: 600px;">
    <div class="form-header">
        <h2>Upravit produkt</h2>
    </div>

    <form action="<?= BASE_URL ?>/index.php?url=sklad/update/<?= $polozka['id'] ?>" method="post">
        <div class="form-grid">
            <div class="input-group full-width">
                <label>Název produktu:</label>
                <input type="text" name="nazev" value="<?= htmlspecialchars($polozka['nazev']) ?>" required>
            </div>

            <div class="input-group full-width">
                <label>Značka:</label>
                <input type="text" name="znacka" value="<?= htmlspecialchars($polozka['znacka']) ?>" required>
            </div>
            
            <div class="input-group">
                <label>Množství skladem:</label>
                <input type="number" step="0.01" name="skladem" value="<?= htmlspecialchars($polozka['skladem']) ?>" required>
            </div>

            <div class="input-group">
                <label>Jednotka:</label>
                <input type="text" name="jednotka" value="<?= htmlspecialchars($polozka['jednotka']) ?>" required>
            </div>
            
            <div class="input-group">
                <label>Minimální zásoba:</label>
                <input type="number" step="0.01" name="minimum" value="<?= htmlspecialchars($polozka['minimum']) ?>" required>
            </div>
            
            <div class="input-group">
                <label>Cena za kus (Kč):</label>
                <input type="number" name="cena_ks" value="<?= htmlspecialchars($polozka['cena_ks']) ?>" required>
            </div>
            
            <div class="input-group full-width" style="margin-top: 1rem;">
                <button type="submit" class="submit-btn">Uložit změny</button>
            </div>
        </div>
    </form>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>