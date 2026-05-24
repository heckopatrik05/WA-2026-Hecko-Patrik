<?php require_once '../app/views/layout/header.php'; ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
    <h2 style="color: var(--primary);">Sklad produktů a chemie</h2>
    <a href="<?= BASE_URL ?>/index.php?url=sklad/create" class="submit-btn" style="text-decoration: none; padding: 10px 20px; width: auto;">+ Přidat produkt</a>
</div>

<div style="overflow-x: auto;">
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 2rem; background: var(--bg-color); border: 1px solid var(--border-color); border-radius: 8px; overflow: hidden;">
        <thead style="background-color: var(--primary); color: white;">
            <tr>
                <th style="padding: 12px; text-align: left;">Název produktu</th>
                <th style="padding: 12px; text-align: left;">Značka</th>
                <th style="padding: 12px; text-align: center;">Skladem</th>
                <th style="padding: 12px; text-align: center;">Min. zásoba</th>
                <th style="padding: 12px; text-align: right;">Cena / ks</th>
                <th style="padding: 12px; text-align: center;">Akce</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($polozky)): ?>
                <tr><td colspan="6" style="padding: 1rem; text-align: center;">Sklad je momentálně prázdný.</td></tr>
            <?php else: ?>
                <?php foreach ($polozky as $item): ?>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 12px;"><strong><?= htmlspecialchars($item['nazev']) ?></strong></td>
                        <td style="padding: 12px; color: var(--text-dark);"><?= htmlspecialchars($item['znacka']) ?></td>
                        
                        <?php 
                        // Kontrola kritického minima
                        $nedostatek = $item['skladem'] <= $item['minimum'];
                        $mnozstviColor = $nedostatek ? 'color: var(--danger); font-weight: bold;' : '';
                        ?>
                        
                        <td style="padding: 12px; text-align: center; <?= $mnozstviColor ?>">
                            <?= htmlspecialchars($item['skladem']) ?> <?= htmlspecialchars($item['jednotka']) ?>
                        </td>
                        <td style="padding: 12px; text-align: center; color: var(--text-muted);">
                            <?= htmlspecialchars($item['minimum']) ?> <?= htmlspecialchars($item['jednotka']) ?>
                        </td>
                        <td style="padding: 12px; text-align: right;">
                            <?= htmlspecialchars($item['cena_ks']) ?> Kč
                        </td>
                        <td style="padding: 12px; text-align: center;">
                            <a href="<?= BASE_URL ?>/index.php?url=sklad/edit/<?= $item['id'] ?>" style="color: var(--primary); text-decoration: none; font-weight: bold; margin-right: 15px; font-size: 0.9rem;">Upravit</a>
                            <a href="<?= BASE_URL ?>/index.php?url=sklad/delete/<?= $item['id'] ?>" onclick="return confirm('Opravdu smazat tento produkt ze skladu?')" style="color: var(--danger); text-decoration: none; font-weight: bold; font-size: 0.9rem;">Smazat</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>