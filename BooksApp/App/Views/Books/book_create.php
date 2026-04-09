<?php require_once '../app/views/layout/header.php'; ?>

<div class="form-container">
    <div class="form-header">
        <h2>Přidat novou knihu</h2>
        <p style="color: var(--text-muted);">Vyplňte údaje a uložte knihu do databáze.</p>
    </div>
    
    <form action="<?= BASE_URL ?>/index.php?url=book/store" method="post" enctype="multipart/form-data">
        <div class="form-grid">
            <div class="input-group full-width">
                <label for="title">Název knihy <span class="required">*</span></label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="input-group">
                <label for="author">Autor <span class="required">*</span></label>
                <input type="text" id="author" name="author" required>
            </div>
            <div class="input-group">
                <label for="isbn">ISBN<span class="required">*</span></label>
                <input type="text" id="isbn" name="isbn" required>
            </div>
            <div class="input-group">
                <label for="category">Kategorie</label>
                <input type="text" id="category" name="category">
            </div>
            <div class="input-group">
                <label for="subcategory">Podkategorie</label>
                <input type="text" id="subcategory" name="subcategory">
            </div>
            <div class="input-group">
                <label for="year">Rok vydání <span class="required">*</span></label>
                <input type="number" id="year" name="year" required>
            </div>
            <div class="input-group">
                <label for="price">Cena (CZK)</label>
                <input type="number" id="price" name="price" step="0.5">
            </div>
            <div class="input-group full-width">
                <label for="link">Odkaz</label>
                <input type="text" id="link" name="link">
            </div>
            <div class="input-group full-width">
                <label for="description">Popis knihy</label>
                <textarea id="description" name="description" rows="5"></textarea>
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
                <button type="submit" class="submit-btn">Uložit knihu</button>
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