<?php require_once '../app/views/layout/header.php'; ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;" class="print-hide">
    <h2 style="margin-top: 0; font-size: 1.75rem; font-weight: 700; color: var(--primary);">Přehled zakázek</h2>
    
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="<?= BASE_URL ?>/index.php?url=zakazka/create" class="nav-btn-primary" style="text-decoration: none; padding: 10px 20px; font-weight: bold;">+ Nová zakázka</a>
    <?php endif; ?>
</div>

<?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1 && isset($stats) && $stats): ?>
    <div style="display: flex; justify-content: space-between; gap: 1.5rem; margin-bottom: 2rem;" class="print-hide">
        <div style="flex: 1; background: var(--card-bg); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: var(--card-shadow); text-align: center; border-bottom: 4px solid #3b82f6;">
            <p style="color: var(--text-muted); margin: 0 0 0.5rem 0; font-weight: 600; text-transform: uppercase; font-size: 0.8rem;">Aktivní zakázky</p>
            <p style="font-size: 2.2rem; font-weight: 800; color: #3b82f6; margin: 0;"><?= htmlspecialchars($stats['active_jobs'] ?? 0) ?></p>
        </div>
        <div style="flex: 1; background: var(--card-bg); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: var(--card-shadow); text-align: center; border-bottom: 4px solid var(--text-dark);">
            <p style="color: var(--text-muted); margin: 0 0 0.5rem 0; font-weight: 600; text-transform: uppercase; font-size: 0.8rem;">Celkem zakázek v DB</p>
            <p style="font-size: 2.2rem; font-weight: 800; color: var(--text-dark); margin: 0;"><?= htmlspecialchars($stats['total_jobs'] ?? 0) ?></p>
        </div>
        <div style="flex: 2; background: var(--card-bg); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: var(--card-shadow); text-align: center; border-bottom: 4px solid var(--primary);">
            <p style="color: var(--text-muted); margin: 0 0 0.5rem 0; font-weight: 600; text-transform: uppercase; font-size: 0.8rem;">Odhadovaný zisk celkem</p>
            <p style="font-size: 2.2rem; font-weight: 800; color: var(--primary); margin: 0;"><?= number_format($stats['total_revenue'] ?? 0, 0, ',', ' ') ?> Kč</p>
        </div>
    </div>
<?php endif; ?>


<div style="background: var(--card-bg); padding: 1rem 1.5rem; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: var(--card-shadow); margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;" class="print-hide">
    <form method="GET" action="<?= BASE_URL ?>/index.php" style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap; width: 100%;">
        <input type="hidden" name="url" value="zakazka/index">
        
        <div style="flex: 1; min-width: 200px;">
            <input type="text" name="search" id="liveSearch" placeholder="Hledat podle SPZ..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" style="width: 100%; padding: 0.6rem 1rem; border: 1px solid var(--border-color); border-radius: 8px; font-family: inherit; background: var(--bg-color); color: var(--text-dark);">
        </div>
        
        <div style="min-width: 150px;">
            <select name="stav" style="width: 100%; padding: 0.6rem 1rem; border: 1px solid var(--border-color); border-radius: 8px; font-family: inherit; background: var(--bg-color); color: var(--text-dark); cursor: pointer;">
                <option value="">Všechny stavy</option>
                <?php 
                $stavy = ['Přijato', 'Probíhá', 'Dokončeno', 'Zrušeno'];
                foreach ($stavy as $stavVal): 
                    $isSelected = (isset($_GET['stav']) && $_GET['stav'] === $stavVal) ? 'selected' : '';
                ?>
                    <option value="<?= htmlspecialchars($stavVal) ?>" <?= $isSelected ?>><?= htmlspecialchars($stavVal) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div style="display: flex; gap: 0.5rem;">
            <button type="submit" style="background: var(--primary-gradient); color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.2s;">
                Filtrovat
            </button>
            <?php if (!empty($_GET['search']) || !empty($_GET['stav'])): ?>
                <a href="<?= BASE_URL ?>/index.php" style="background: var(--bg-color); color: var(--text-muted); border: 1px solid var(--border-color); padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: bold; transition: 0.2s; display: inline-block;">
                    Zrušit filtr
                </a>
            <?php endif; ?>

            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                <?php 
                    // Připravíme parametry filtru pro export URL
                    $exportParams = "&search=" . urlencode($_GET['search'] ?? '') . "&stav=" . urlencode($_GET['stav'] ?? '');
                ?>
                <a href="<?= BASE_URL ?>/index.php?url=zakazka/exportCsv<?= $exportParams ?>" style="background: #10b981; color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: bold; margin-left: 10px; transition: 0.2s; display: inline-block;">
                    📥 Export do Excelu
                </a>
            <?php endif; ?>
        </div>
    </form>
</div>

<?php if (empty($zakazky)): ?>
    <div class="table-container" style="padding: 3rem; text-align: center; color: var(--text-muted); font-style: italic; background-color: var(--card-bg); border-radius: 12px; border: 1px solid var(--border-color);">
        Nebyla nalezena žádná zakázka odpovídající zadání.
    </div>
<?php else: ?>
    <div class="table-container" style="overflow-x: auto; background-color: var(--card-bg); border-radius: 12px; border: 1px solid var(--border-color); box-shadow: var(--card-shadow);">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead style="background-color: var(--bg-color); border-bottom: 2px solid var(--border-color);">
                <tr>
                    <th style="padding: 15px; font-weight: 600; color: var(--text-muted);">ID</th>
                    <th style="padding: 15px; font-weight: 600; color: var(--text-muted);">SPZ</th>
                    <th style="padding: 15px; font-weight: 600; color: var(--text-muted);">Značka a model</th>
                    <th style="padding: 15px; font-weight: 600; color: var(--text-muted);">Typ služby</th>
                    <th style="padding: 15px; font-weight: 600; color: var(--text-muted);">Cena</th>
                    <th style="padding: 15px; font-weight: 600; color: var(--text-muted);">Stav</th>
                    <th style="padding: 15px; font-weight: 600; color: var(--text-muted);">Zadal</th>
                    <th style="padding: 15px; font-weight: 600; color: var(--text-muted);">Akce</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($zakazky as $zakazka): ?>
                    <tr style="border-bottom: 1px solid var(--border-color); transition: background-color 0.2s;">
                        <td style="padding: 15px;"><?= htmlspecialchars($zakazka['id']) ?></td>
                        <td style="padding: 15px; font-weight: bold; color: var(--primary);"><?= htmlspecialchars($zakazka['spz']) ?></td>
                        <td style="padding: 15px;"><?= htmlspecialchars($zakazka['znacka_model']) ?></td>
                        <td style="padding: 15px;"><?= htmlspecialchars($zakazka['typ_sluzby']) ?></td>
                        <td style="padding: 15px; font-weight: bold;"><?= htmlspecialchars($zakazka['cena']) ?> Kč</td>
                        <td style="padding: 15px;">
                            <?php 
                                $stavColor = 'var(--text-color)';
                                if ($zakazka['stav'] == 'Přijato') $stavColor = '#f59e0b';
                                if ($zakazka['stav'] == 'Probíhá') $stavColor = '#3b82f6';
                                if ($zakazka['stav'] == 'Dokončeno') $stavColor = '#10b981';
                                if ($zakazka['stav'] == 'Zrušeno') $stavColor = '#ef4444';
                            ?>
                            <span style="color: <?= $stavColor ?>; font-weight: 600; background-color: <?= $stavColor ?>20; padding: 4px 8px; border-radius: 4px;">
                                <?= htmlspecialchars($zakazka['stav']) ?>
                            </span>
                        </td>
                        <td style="padding: 15px; font-size: 0.9em; color: var(--text-muted);"><?= htmlspecialchars($zakazka['author_name'] ?? 'Neznámý') ?></td>
                        
                        <td style="padding: 15px;">
                            <div class="actions" style="display: flex; gap: 10px; align-items: center;">
                                <a href="<?= BASE_URL ?>/index.php?url=zakazka/show/<?= $zakazka['id'] ?>" class="nav-btn-primary" style="padding: 6px 12px; text-decoration: none; font-size: 0.85em;">Detail</a>
                                
                                <?php 
                                    $isLoggedIn = isset($_SESSION['user_id']);
                                    $isOwner = $isLoggedIn && $_SESSION['user_id'] == $zakazka['user_id'];
                                    $isAdmin = $isLoggedIn && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;

                                    if ($isOwner || $isAdmin): 
                                        $adminSuffix = !$isOwner ? ' (Admin)' : '';
                                ?>
                                    <a href="<?= BASE_URL ?>/index.php?url=zakazka/edit/<?= $zakazka['id'] ?>" style="color: var(--text-dark); text-decoration: none; font-size: 0.9em; margin-left: 5px; font-weight: 600;">Upravit<?= $adminSuffix ?></a>
                                    <a href="<?= BASE_URL ?>/index.php?url=zakazka/delete/<?= $zakazka['id'] ?>" onclick="return confirm('Opravdu chcete tuto zakázku smazat?')" style="color: var(--danger); text-decoration: none; font-size: 0.9em; margin-left: 5px; font-weight: 600;">Smazat<?= $adminSuffix ?></a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('liveSearch');
        const tableRows = document.querySelectorAll('tbody tr');

        if(searchInput) {
            // Zavěsíme posluchač na každé stisknutí klávesy
            searchInput.addEventListener('keyup', function(e) {
                // Převedeme hledaný text na malá písmena
                const term = e.target.value.toLowerCase();

                // Projdeme všechny řádky v tabulce
                tableRows.forEach(row => {
                    // Vezmeme veškerý text v daném řádku
                    const rowText = row.textContent.toLowerCase();
                    
                    // Pokud řádek obsahuje hledaný text, ukážeme ho. Jinak ho skryjeme.
                    if(rowText.includes(term)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
            
            // Zabráníme odeslání formuláře klávesou Enter (už to není potřeba)
            searchInput.addEventListener('keydown', function(e) {
                if(e.key === 'Enter') {
                    e.preventDefault();
                }
            });
        }
    });
</script>

<?php require_once '../app/views/layout/footer.php'; ?>