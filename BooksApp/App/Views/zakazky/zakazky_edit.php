<?php require_once '../app/views/layout/header.php'; ?>

<a href="<?= BASE_URL ?>/index.php" class="back-link" style="margin-top: 1rem;">&larr; Zpět na seznam</a>

<div class="form-container" style="margin-bottom: 2rem;">
    <div class="form-header">
        <h2>Upravit zakázku (ID: <?= htmlspecialchars($zakazka['id']) ?>)</h2>
        <p style="color: var(--text-muted);">Změňte údaje nebo aktualizujte stav zakázky.</p>
    </div>
    
    <form action="<?= BASE_URL ?>/index.php?url=zakazka/update/<?= htmlspecialchars($zakazka['id']) ?>" method="post" enctype="multipart/form-data">
        <div class="form-grid">
            
            <div class="input-group">
                <label for="spz">SPZ vozidla <span class="required">*</span></label>
                <input type="text" id="spz" name="spz" value="<?= htmlspecialchars($zakazka['spz']) ?>" required>
            </div>
            
            <div class="input-group">
                <label for="znacka_model">Značka a model <span class="required">*</span></label>
                <input type="text" id="znacka_model" name="znacka_model" value="<?= htmlspecialchars($zakazka['znacka_model']) ?>" required>
            </div>
            
            <div class="input-group">
                <label for="typ_sluzby">Typ služby <span class="required">*</span></label>
                <select id="typ_sluzby" name="typ_sluzby" required>
                    <?php 
                    $sluzby = [
                        'Čištění interiéru', 'Čištění exteriéru', 'Jednokrokové leštění laku', 
                        'Vícekrokové leštění laku', 'Keramická ochrana laku', 'Ochrana oken a kol', 
                        'Kompletní detailing', 'Jiná služba'
                    ];
                    foreach ($sluzby as $sluzba): 
                        $isSelected = (isset($zakazka['typ_sluzby']) && $zakazka['typ_sluzby'] == $sluzba) ? 'selected' : '';
                    ?>
                        <option value="<?= htmlspecialchars($sluzba) ?>" <?= $isSelected ?>>
                            <?= htmlspecialchars($sluzba) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="input-group">
                <label for="stav">Stav zakázky <span class="required">*</span></label>
                <select id="stav" name="stav" required>
                    <?php 
                    $stavy = ['Přijato', 'Probíhá', 'Dokončeno', 'Zrušeno'];
                    foreach ($stavy as $stav): 
                        $isSelectedStav = (isset($zakazka['stav']) && $zakazka['stav'] == $stav) ? 'selected' : '';
                    ?>
                        <option value="<?= htmlspecialchars($stav) ?>" <?= $isSelectedStav ?>>
                            <?= htmlspecialchars($stav) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="input-group">
                <label for="cena">Cena (Kč)</label>
                <input type="number" id="cena" name="cena" step="1" value="<?= htmlspecialchars($zakazka['cena'] ?? '') ?>">
            </div>

            <div class="input-group full-width">
                <label for="popis_stavu">Popis stavu laku a poznámky</label>
                <textarea id="popis_stavu" name="popis_stavu" rows="4"><?= htmlspecialchars($zakazka['popis_stavu'] ?? '') ?></textarea>
            </div>    
            
            <div class="input-group full-width" style="margin-top: 0.5rem;">
                <label>Přidat nové fotografie vozidla</label>
                <label class="file-dropzone">
                    <span id="file-title" style="font-weight: 600; color: var(--primary); font-size: 1rem; margin-bottom: 0.25rem;">
                        + Klikněte pro výběr fotek
                    </span>
                    <span id="file-info" style="font-size: 0.875rem; color: var(--text-muted);">
                        Podporované formáty: JPG, PNG, WebP (Při nahrání nových se staré zachovají, nebo uprav logiku dle potřeby)
                    </span>
                    <input type="file" id="images" name="images[]" multiple accept="image/*">
                </label>
            </div>  
            
            <div class="input-group full-width">
                <button type="submit" class="submit-btn">Uložit změny</button>
            </div>
        </div>
    </form>
</div>

<script>
    // JS pro zobrazení názvů/počtu souborů po vybrání
    const fileInput = document.getElementById('images');
    const fileTitle = document.getElementById('file-title');
    const fileInfo = document.getElementById('file-info');

    fileInput.addEventListener('change', function(event) {
        const files = event.target.files;
        
        if (files.length === 0) {
            fileTitle.textContent = '+ Klikněte pro výběr fotek';
            fileTitle.style.color = 'var(--primary)';
            fileInfo.textContent = 'Žádné fotky nebyly vybrány';
        } else if (files.length === 1) {
            fileTitle.textContent = 'Fotografie připravena';
            fileTitle.style.color = 'var(--success)';
            fileInfo.textContent = files[0].name;
        } else {
            fileTitle.textContent = 'Fotografie připraveny';
            fileTitle.style.color = 'var(--success)';
            fileInfo.textContent = 'Vybráno celkem: ' + files.length + ' fotek';
        }
    });
</script>

<?php require_once '../app/views/layout/footer.php'; ?>