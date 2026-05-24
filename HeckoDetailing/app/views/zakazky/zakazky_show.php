<?php require_once '../app/views/layout/header.php'; ?>

<a href="<?= BASE_URL ?>/index.php" class="back-link" style="margin-top: 1rem;">&larr; Zpět na seznam</a>

<div class="form-container" style="margin-bottom: 2rem;">
    
    <div class="form-header" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h2 style="margin-bottom: 0.5rem; color: var(--primary);">SPZ: <?= htmlspecialchars($zakazka['spz']) ?></h2>
            <p style="font-size: 1.2rem; margin-top: 0; font-weight: bold; color: var(--text-dark);"><?= htmlspecialchars($zakazka['znacka_model']) ?></p>
        </div>
        
        <div style="display: flex; gap: 15px; align-items: center;">
            <button onclick="window.print()" class="print-hide" style="background: var(--text-dark); color: var(--bg-color); border: none; padding: 8px 15px; border-radius: 8px; cursor: pointer; font-weight: bold; transition: 0.2s;">
                🖨️ Vytisknout protokol
            </button>
            
            <?php 
                $stavColor = 'var(--text-color)';
                if ($zakazka['stav'] == 'Přijato') $stavColor = '#f59e0b';
                if ($zakazka['stav'] == 'Probíhá') $stavColor = '#3b82f6';
                if ($zakazka['stav'] == 'Dokončeno') $stavColor = '#10b981';
                if ($zakazka['stav'] == 'Zrušeno') $stavColor = '#ef4444';
            ?>
            <span style="color: <?= $stavColor ?>; font-weight: 600; background-color: <?= $stavColor ?>20; padding: 6px 12px; border-radius: 6px; font-size: 1.1rem;">
                <?= htmlspecialchars($zakazka['stav']) ?>
            </span>
        </div>
    </div>

    <div style="margin-bottom: 2rem; line-height: 1.6; display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; color: var(--text-dark);">
        <div>
            <p><strong>Typ služby:</strong> <?= htmlspecialchars($zakazka['typ_sluzby']) ?></p>
            <p><strong>Cena:</strong> <?= htmlspecialchars($zakazka['cena'] ? $zakazka['cena'] . ' Kč' : 'Zatím neurčena') ?></p>
        </div>
        <div style="grid-column: 1 / -1;">
            <p><strong>Popis stavu a poznámky:</strong><br><?= nl2br(htmlspecialchars($zakazka['popis_stavu'] ?: 'Bez dalších poznámek')) ?></p>
        </div>
    </div>

    <?php 
    if (!empty($zakazka['images'])) {
        $images = json_decode($zakazka['images'], true);
        if (is_array($images) && count($images) > 0) {
            echo '<div style="margin-bottom: 2rem;" class="print-hide">';
            echo '<h3 style="margin-bottom: 1rem; font-size: 1.1rem;">Fotografie vozidla</h3>';
            echo '<div style="display: flex; gap: 15px; flex-wrap: wrap;">';
            
            foreach ($images as $img) {
                echo '<img src="' . BASE_URL . '/uploads/' . htmlspecialchars($img) . '" class="lightbox-trigger" alt="Fotografie vozidla" style="max-width: 250px; max-height: 200px; border-radius: 8px; border: 1px solid var(--border-color); object-fit: cover; box-shadow: 0 2px 4px rgba(0,0,0,0.1); cursor: pointer; transition: transform 0.2s;">';
            }
            
            echo '</div></div>';
        }
    }
    ?>

    <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 2rem 0;">

    <div class="comments-section">
        <h3 style="margin-bottom: 1.5rem;">Komentáře a dotazy k zakázce</h3>

        <?php if (isset($_SESSION['user_id'])): ?>
            <form action="<?= BASE_URL ?>/index.php?url=zakazka/addComment/<?= $zakazka['id'] ?>" method="post" style="margin-bottom: 2.5rem;">
                <div class="input-group full-width">
                    <label for="content">Napište zprávu:</label>
                    <textarea id="content" name="content" rows="3" required placeholder="Máte dotaz nebo upřesnění k této zakázce?"></textarea>
                </div>

                <button type="submit" class="submit-btn" style="margin-top: 0.5rem; width: auto; padding: 0.6rem 1.5rem;">Odeslat komentář</button>
            </form>
        <?php else: ?>
            <p style="color: var(--text-muted); font-style: italic; background: var(--bg-color); padding: 1rem; border-radius: 8px; border: 1px solid var(--border-color);">
                Pro přidávání komentářů se musíte <a href="<?= BASE_URL ?>/index.php?url=auth/login" style="color: var(--primary); font-weight: bold;">přihlásit</a>.
            </p>
        <?php endif; ?>

        <div class="comments-list" style="display: flex; flex-direction: column; gap: 1rem;">
            <?php if (empty($comments)): ?>
                <p style="color: var(--text-muted);">Zatím žádné komentáře.</p>
            <?php else: ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment" style="background: var(--bg-color); padding: 1.25rem; border-radius: 8px; border: 1px solid var(--border-color);">
                        
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; align-items: center; border-bottom: 1px solid var(--border-color); padding-bottom: 0.5rem;">
                            <div>
                                <strong style="color: var(--primary); font-size: 1.05rem;"><?= htmlspecialchars($comment['nickname'] ?: $comment['username']) ?></strong>
                                <span style="font-size: 0.8rem; color: var(--text-muted); margin-left: 10px;"><?= date('d.m.Y H:i', strtotime($comment['created_at'])) ?></span>
                            </div>
                            
                            <?php 
                                // Oprávnění: Smazat komentář může ten, kdo ho napsal, nebo administrátor
                                $isLoggedIn = isset($_SESSION['user_id']);
                                $isCommentOwner = $isLoggedIn && $_SESSION['user_id'] == $comment['user_id'];
                                $isAdmin = $isLoggedIn && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
                                
                                if ($isCommentOwner || $isAdmin):
                            ?>
                                <div style="display: flex; gap: 8px;">
                                    <?php if ($isCommentOwner): // Upravit může jen vlastník ?>
                                        <a href="<?= BASE_URL ?>/index.php?url=zakazka/editComment/<?= $comment['id'] ?>" style="color: var(--primary); font-size: 0.85rem; text-decoration: none; font-weight: bold; background: rgba(255, 102, 0, 0.1); padding: 4px 8px; border-radius: 4px;">Upravit</a>
                                    <?php endif; ?>
                                    
                                    <a href="<?= BASE_URL ?>/index.php?url=zakazka/deleteComment/<?= $comment['id'] ?>" onclick="return confirm('Opravdu chcete trvale smazat tento komentář?')" style="color: var(--danger); font-size: 0.85rem; text-decoration: none; font-weight: bold; background: var(--danger-bg); padding: 4px 8px; border-radius: 4px;">Smazat</a>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <p style="margin: 0; color: var(--text-dark); padding-top: 0.5rem;"><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<div id="lightbox" style="display: none; position: fixed; z-index: 9999; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(15, 23, 42, 0.9); backdrop-filter: blur(5px); justify-content: center; align-items: center;">
    <span id="lightbox-close" style="position: absolute; top: 20px; right: 30px; color: white; font-size: 40px; font-weight: bold; cursor: pointer; transition: color 0.2s;">&times;</span>
    <img id="lightbox-img-large" src="" style="max-width: 90%; max-height: 90%; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); border: 2px solid #334155;">
</div>

<script>
    // Získáme potřebné prvky z HTML
    const lightbox = document.getElementById('lightbox');
    const lightboxImgLarge = document.getElementById('lightbox-img-large');
    const lightboxClose = document.getElementById('lightbox-close');
    const thumbnails = document.querySelectorAll('.lightbox-trigger');

    // 1. Otevření lightboxu po kliknutí na náhled
    thumbnails.forEach(thumbnail => {
        // Přidáme malý hover efekt na fotky (aby uživatel věděl, že se dá kliknout)
        thumbnail.addEventListener('mouseenter', () => thumbnail.style.transform = 'scale(1.03)');
        thumbnail.addEventListener('mouseleave', () => thumbnail.style.transform = 'scale(1)');

        thumbnail.addEventListener('click', function() {
            lightboxImgLarge.src = this.src; // Zkopíruje adresu malé fotky do velké
            lightbox.style.display = 'flex'; // Zobrazí tmavý překryv
            document.body.style.overflow = 'hidden'; // Zabrání scrollování stránky v pozadí
        });
    });

    // 2. Funkce pro zavření lightboxu
    function closeLightbox() {
        lightbox.style.display = 'none';
        document.body.style.overflow = 'auto'; // Vrátí možnost scrollování
    }

    // Zavření po kliknutí na křížek
    lightboxClose.addEventListener('click', closeLightbox);
    
    // Zavření po kliknutí kamkoliv do tmavého pozadí (mimo samotnou fotku)
    lightbox.addEventListener('click', function(event) {
        if (event.target === lightbox) {
            closeLightbox();
        }
    });

    // Zavření po stisknutí klávesy ESC na klávesnici (Profi detail!)
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && lightbox.style.display === 'flex') {
            closeLightbox();
        }
    });
</script>

<?php require_once '../app/views/layout/footer.php'; ?>