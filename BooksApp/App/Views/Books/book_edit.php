<?php require_once '../app/views/layout/header.php'; ?>

<a href="<?= BASE_URL ?>/index.php" class="back-link">&larr; Zpět na seznam</a>

<div class="form-container">
    <div class="form-header">
        <h2>Upravit knihu (ID: <?= htmlspecialchars($book['id']) ?>)</h2>
    </div>
    
    <form action="<?= BASE_URL ?>/index.php?url=book/update/<?= htmlspecialchars($book['id']) ?>" method="post">
        <div class="form-grid">
            <div class="input-group full-width">
                <label>ID v databázi (nelze měnit)</label>
                <input type="text" value="<?= htmlspecialchars($book['id']) ?>" readonly>
            </div>
            <div class="input-group full-width">
                <label for="title">Název knihy <span class="required">*</span></label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($book['title']) ?>" required>
            </div>
            <div class="input-group">
                <label for="author">Autor <span class="required">*</span></label>
                <input type="text" id="author" name="author" value="<?= htmlspecialchars($book['author']) ?>" required>
            </div>
            <div class="input-group">
                <label for="isbn">ISBN<span class="required">*</span></label>
                <input type="text" id="isbn" name="isbn" value="<?= htmlspecialchars($book['isbn'] ?? '') ?>">
            </div>
            <div class="input-group">
                <label for="category">Kategorie *</label>
                <select id="category" name="category" required>
                    <option value="">-- Vyberte kategorii --</option>
                    
                    <?php foreach ($categories as $cat): ?>
                        <?php 
                        // Zkontrolujeme, zda ID aktuálně vykreslované kategorie odpovídá ID kategorie, kterou má kniha uloženou
                        $isSelected = ($book['category'] == $cat['id']) ? 'selected' : ''; 
                        ?>
                        
                        <option value="<?= htmlspecialchars($cat['id']) ?>" <?= $isSelected ?>>
                            <?= htmlspecialchars($cat['name']) ?>
                        </option>
                    <?php endforeach; ?>
                    
                </select>
            </div>

            <div class="input-group">
                <label for="subcategory">Podkategorie</label>
                <input type="text" id="subcategory" name="subcategory" value="<?= htmlspecialchars($book['subcategory'] ?? '') ?>">
            </div>
            <div class="input-group">
                <label for="year">Rok <span class="required">*</span></label>
                <input type="number" id="year" name="year" value="<?= htmlspecialchars($book['year']) ?>" required>
            </div>
            <div class="input-group">
                <label for="price">Cena (CZK)</label>
                <input type="number" id="price" name="price" step="0.5" value="<?= htmlspecialchars($book['price'] ?? '') ?>">
            </div>
            <div class="input-group full-width">
                <label for="link">Odkaz</label>
                <input type="text" id="link" name="link" value="<?= htmlspecialchars($book['link'] ?? '') ?>">
            </div>
            <div class="input-group full-width">
                <label for="description">Popis</label>
                <textarea id="description" name="description" rows="5"><?= htmlspecialchars($book['description'] ?? '') ?></textarea>
            </div>  
            <div class="input-group full-width" style="margin-top: 0.5rem;">
                <label>Obrázky obálky </label>
                <label class="file-dropzone">
                    <span id="file-title" style="font-weight: 600; color: var(--primary); font-size: 1rem; margin-bottom: 0.25rem;">
                        + Klikněte pro výběr souborů
                    </span>
                    <span id="file-info" style="font-size: 0.875rem; color: var(--text-muted);">
                        Podporované formáty: JPG, PNG, WebP
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
    // Najdeme naše HTML prvky podle ID
    const fileInput = document.getElementById('images');
    const fileTitle = document.getElementById('file-title');
    const fileInfo = document.getElementById('file-info');

    // Posloucháme událost 'change' (změna hodnoty v inputu)
    fileInput.addEventListener('change', function(event) {
        const files = event.target.files;
        
        if (files.length === 0) {
            // Uživatel výběr zrušil
            fileTitle.textContent = 'Klikněte pro výběr souborů';
            fileTitle.className = 'text-sm text-slate-400 font-semibold';
            fileInfo.textContent = 'Žádné soubory nebyly vybrány';
        } else if (files.length === 1) {
            // Vybrán 1 soubor - ukážeme jeho název
            fileTitle.textContent = 'Soubor připraven';
            fileTitle.className = 'text-sm text-blue-400 font-bold';
            fileInfo.textContent = files[0].name;
        } else {
            // Vybráno více souborů - ukážeme počet
            fileTitle.textContent = 'Soubory připraveny';
            fileTitle.className = 'text-sm text-blue-400 font-bold';
            fileInfo.textContent = 'Vybráno celkem: ' + files.length + ' souborů';
        }
    });
</script>

<?php require_once '../app/views/layout/footer.php'; ?>