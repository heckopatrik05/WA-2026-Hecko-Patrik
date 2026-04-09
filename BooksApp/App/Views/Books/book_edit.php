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
                <label for="isbn">ISBN</label>
                <input type="text" id="isbn" name="isbn" value="<?= htmlspecialchars($book['isbn'] ?? '') ?>">
            </div>
            <div class="input-group">
                <label for="category">Kategorie</label>
                <input type="text" id="category" name="category" value="<?= htmlspecialchars($book['category'] ?? '') ?>">
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
            <div class="input-group full-width">
                <button type="submit" class="submit-btn">Uložit změny</button>
            </div>
        </div>
    </form>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>