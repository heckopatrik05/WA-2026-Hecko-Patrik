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
                <label for="isbn">ISBN</label>
                <input type="text" id="isbn" name="isbn">
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
            <div class="input-group full-width">
                <button type="submit" class="submit-btn">Uložit knihu</button>
            </div>
        </div>
    </form>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>