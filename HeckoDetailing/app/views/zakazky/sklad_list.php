<?php require_once '../app/views/layout/header.php'; ?>

<style>
    /* Styly pro zobrazení na monitoru počítače */
    .print-checkbox-col {
        display: none; /* Na monitoru standardně schováno */
        width: 40px;
        text-align: center;
    }

    .checkbox-square {
        width: 14px;
        height: 14px;
        border: 1.5px solid #4b5563;
        border-radius: 3px;
        margin: 0 auto;
        background: #ffffff;
    }

    /* TYTO STYLY SE AKTIVUJÍ POUZE PŘI KLIKNUTÍ NA TLAČÍTKO TISK */
    @media print {
        /* 1. Skrytí kompletního menu, patičky a samotného tlačítka */
        header, footer, .no-print, button, .nav, .btn-primary {
            display: none !important;
        }
        
        /* 2. Reset pozadí na čistě bílé a písma na černé pro úsporu toneru */
        body {
            background: #ffffff !important;
            color: #000000 !important;
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 8.5pt !important;
            padding: 0;
            margin: 0;
        }
        
        main, .container, .content-wrapper {
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
            background: none !important;
        }

        /* 3. Aktivace sloupce pro křížky */
        .print-checkbox-col {
            display: table-cell !important;
        }

        /* 4. Odstranění stínů a průhlednosti z kontejneru tabulky */
        .table-container {
            background: none !important;
            border: none !important;
            box-shadow: none !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
            padding: 0 !important;
            margin: 0 !important;
            overflow: visible !important;
        }

        /* 5. FIXACE ŠÍŘKY TABULKY - Klíčový prvek proti přetékání stránky */
        table {
            width: 100% !important;
            border-collapse: collapse !important;
            table-layout: fixed !important; 
            color: #000000 !important;
            margin-top: 10px !important;
        }

        table th {
            background: #1f2937 !important;
            color: #ffffff !important;
            border: 1px solid #1f2937 !important;
            padding: 6px 4px !important;
            text-transform: uppercase;
            font-size: 7.5pt !important;
        }

        table td {
            border: 1px solid #e5e7eb !important;
            color: #000000 !important;
            padding: 6px 4px !important;
            background: transparent !important;
            font-size: 8.5pt !important;
            /* Automatické zalamování textu uvnitř buněk */
            word-wrap: break-word !important;
            overflow-wrap: break-word !important;
        }
        
        /* 6. Přesné definice šířek sloupců na papíře v % (celkem 100 %) */
        table th:nth-child(1), table td:nth-child(1) { width: 5% !important; }  /* [✓] */
        table th:nth-child(2), table td:nth-child(2) { width: 12% !important; } /* Značka */
        table th:nth-child(3), table td:nth-child(3) { width: 28% !important; } /* Název */
        table th:nth-child(4), table td:nth-child(4) { width: 10% !important; } /* Cena/Ks */
        table th:nth-child(5), table td:nth-child(5) { width: 11% !important; } /* Skladem */
        table th:nth-child(6), table td:nth-child(6) { width: 10% !important; } /* Status */
        table th:nth-child(7), table td:nth-child(7) { width: 12% !important; } /* Dokoupit */
        table th:nth-child(8), table td:nth-child(8) { width: 12% !important; } /* Náklady */

        .print-title {
            color: #111111 !important;
            font-size: 18pt !important;
            margin: 0 0 5px 0 !important;
        }
        
        .low-stock-row {
            background-color: #f9fafb !important;
        }

        .sum-box {
            background: none !important;
            border: 1px solid #d1d5db !important;
            box-shadow: none !important;
            color: #000000 !important;
            padding: 10px !important;
            margin-top: 15px !important;
        }
        
        .sum-box strong {
            color: #000000 !important;
        }
    }
</style>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <div>
        <h2 style="margin-top: 0; font-size: 1.75rem; font-weight: 700; color: var(--primary);" class="print-title">Interní sklad chemie a přípravků</h2>
        <p style="margin: 0; color: var(--text-muted);" class="no-print">Přehled produktů, aktuální zásoby a kalkulace pro doplnění skladu.</p>
    </div>
    
    <button onclick="window.print();" class="no-print" style="background: var(--primary); color: white; border: none; padding: 10px 18px; border-radius: 8px; font-weight: bold; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: opacity 0.2s;" onmouseover="this.style.opacity=0.9" onmouseout="this.style.opacity=1">
        🖨️ Vytisknout arch pro křížky
    </button>
</div>

<div class="table-container" style="overflow-x: auto;" >
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr>
                <th class="print-checkbox-col">[✓]</th>
                <th>Značka</th>
                <th>Název produktu</th>
                <th>Cena/Ks</th>
                <th>Stav na skladě</th>
                <th>Status</th>
                <th>Potřeba dokoupit</th>
                <th>Cena doplnění</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $celkemZaNakup = 0;
            foreach ($produkty as $p): 
                $chybi = max(0, $p['minimum'] - $p['skladem']);
                $cenaDoplneni = $chybi * $p['cena_ks'];
                $celkemZaNakup += $cenaDoplneni;

                $isNedostatek = $p['skladem'] < $p['minimum'];
                $statusText = $p['skladem'] == 0 ? 'VYPRODÁNO' : ($isNedostatek ? 'NÍZKÝ STAV' : 'OK');
                $statusColor = $p['skladem'] == 0 ? '#ef4444' : ($isNedostatek ? '#f59e0b' : '#10b981');
                
                $rowClass = $isNedostatek ? 'low-stock-row' : '';
                $rowStyle = $isNedostatek ? 'background-color: ' . $statusColor . '08;' : '';
            ?>
                <tr style="<?= $rowStyle ?>" class="<?= $rowClass ?>">
                    <td class="print-checkbox-col">
                        <div class="checkbox-square"></div>
                    </td>
                    <td style="color: var(--text-muted); font-weight: bold;"><?= htmlspecialchars($p['znacka']) ?></td>
                    <td style="color: var(--text-dark); font-weight: 600;"><?= htmlspecialchars($p['nazev']) ?></td>
                    <td><?= number_format($p['cena_ks'], 0, ',', ' ') ?> Kč</td>
                    <td>
                        <strong style="color: <?= $p['skladem'] == 0 ? '#ef4444' : 'inherit' ?>;">
                            <?= $p['skladem'] ?> <?= htmlspecialchars($p['jednotka']) ?>
                        </strong>
                        <span style="font-size: 0.85rem; color: var(--text-muted);"> (Min: <?= $p['minimum'] ?>)</span>
                    </td>
                    <td>
                        <span style="color: <?= $statusColor ?>; font-weight: 600; background-color: <?= $statusColor ?>15; padding: 4px 8px; border-radius: 4px; font-size: 0.85em;">
                            <?= $statusText ?>
                        </span>
                    </td>
                    <td style="font-weight: bold; color: <?= $chybi > 0 ? 'var(--primary)' : '#10b981' ?>;">
                        <?= $chybi > 0 ? '+ ' . $chybi . ' ' . htmlspecialchars($p['jednotka']) : 'Dostatek' ?>
                    </td>
                    <td style="font-weight: bold;">
                        <?= $cenaDoplneni > 0 ? number_format($cenaDoplneni, 0, ',', ' ') . ' Kč' : '-' ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="sum-box" style="background: var(--card-bg); backdrop-filter: var(--card-backdrop); -webkit-backdrop-filter: var(--card-backdrop); border: 1px solid var(--border-color); box-shadow: var(--card-shadow); padding: 1.5rem; border-radius: 12px; margin-top: 1.5rem; display: flex; justify-content: flex-end; align-items: center; gap: 15px;">
    <span style="text-transform: uppercase; font-weight: 700; color: var(--text-muted); font-size: 0.9rem;">Odhadované náklady na doplnění skladu:</span>
    <strong style="font-size: 1.6rem; color: var(--primary); font-weight: 800;"><?= number_format($celkemZaNakup, 0, ',', ' ') ?> Kč</strong>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>