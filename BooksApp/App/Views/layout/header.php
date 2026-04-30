<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikace Knihovna</title>
    <style>
    /* =========================================
       PRÉMIOVÉ CSS PRO CELOU APLIKACI
       ========================================= */
    :root {
        /* Barvy */
        --primary: #4F46E5;
        --primary-light: #818CF8;
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        --bg-color: #F8FAFC;
        --card-bg: #FFFFFF;
        --text-dark: #0F172A;
        --text-muted: #64748B;
        --border-color: #E2E8F0;
        
        /* Notifikace */
        --danger: #E11D48;
        --danger-bg: #FFF1F2;
        --success: #10B981;
        --success-bg: #ECFDF5;
        --warning: #F59E0B;
        --warning-bg: #FFFBEB;
        
        /* Efekty */
        --focus-ring: rgba(99, 102, 241, 0.15);
        --glow-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.3);
        --card-shadow: 0 20px 40px -5px rgba(0,0,0,0.05), 0 8px 16px -8px rgba(0,0,0,0.01);
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        background-color: var(--bg-color);
        background-image: radial-gradient(circle at top right, #EEF2FF, transparent 40%), radial-gradient(circle at bottom left, #F3E8FF, transparent 40%);
        color: var(--text-dark);
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        -webkit-font-smoothing: antialiased;
    }

    * { box-sizing: border-box; }

    /* HLAVIČKA A NAVIGACE */
    header {
        background-color: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(12px);
        border-bottom: 1px solid var(--border-color);
        padding: 1rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 10;
    }
    header h1 { margin: 0; font-size: 1.25rem; font-weight: 800; background: var(--primary-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    nav ul { list-style: none; margin: 0; padding: 0; display: flex; gap: 1.5rem; align-items: center; }
    nav a { text-decoration: none; color: var(--text-muted); font-weight: 500; transition: color 0.2s ease; font-size: 0.95rem; }
    nav a:hover { color: var(--primary); }
    nav a[href*="create"] {
        background: var(--primary-gradient); color: white; padding: 0.5rem 1.25rem;
        border-radius: 8px; font-weight: 600; transition: all 0.3s ease;
    }
    nav a[href*="create"]:hover { transform: translateY(-1px); box-shadow: var(--glow-shadow); color: white; }

    /* HLAVNÍ OBSAH */
    main { flex: 1; max-width: 1200px; width: 100%; margin: 0 auto; padding: 3rem 1rem; }

    /* NOTIFIKACE */
    .notifications-container { margin-bottom: 2rem; display: flex; flex-direction: column; gap: 0.75rem; }
    .alert { padding: 1rem 1.5rem; border-radius: 10px; font-weight: 500; font-size: 0.95rem; display: flex; align-items: center; }
    .alert-success { background-color: var(--success-bg); color: #065F46; border-left: 4px solid var(--success); }
    .alert-error { background-color: var(--danger-bg); color: #9F1239; border-left: 4px solid var(--danger); }
    .alert-notice { background-color: var(--warning-bg); color: #92400E; border-left: 4px solid var(--warning); }

    /* TABULKA */
    .table-container { background: var(--card-bg); border-radius: 16px; box-shadow: var(--card-shadow); overflow-x: auto; border: 1px solid rgba(255,255,255,0.5); }
    table { width: 100%; border-collapse: separate; border-spacing: 0; text-align: left; }
    thead { background-color: #F8FAFC; }
    th { padding: 1.25rem 1.5rem; font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); letter-spacing: 0.05em; border-bottom: 2px solid var(--border-color); }
    td { padding: 1rem 1.5rem; border-bottom: 1px solid var(--border-color); vertical-align: middle; transition: background-color 0.2s; }
    tbody tr:last-child td { border-bottom: none; }
    tbody tr:hover td { background-color: #F8FAFC; }
    .actions { display: flex; gap: 0.5rem; }
    .action-btn { text-decoration: none; padding: 0.4rem 0.8rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600; transition: all 0.2s; }
    .btn-detail { background-color: #EEF2FF; color: var(--primary); }
    .btn-detail:hover { background-color: #E0E7FF; }
    .btn-edit { background-color: #F1F5F9; color: var(--text-dark); }
    .btn-edit:hover { background-color: #E2E8F0; }
    .btn-delete { background-color: var(--danger-bg); color: var(--danger); }
    .btn-delete:hover { background-color: var(--danger); color: white; }

    /* FORMULÁŘE (Zahrnuje i Login a Register) */
    .form-container { background: var(--card-bg); max-width: 800px; width: 100%; margin: 0 auto; border-radius: 20px; padding: 3rem; box-shadow: var(--card-shadow); border: 1px solid rgba(255,255,255,0.8); }
    .form-header { margin-bottom: 2.5rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1.5rem; }
    .form-header h2 { margin: 0 0 0.5rem 0; font-size: 1.875rem; color: var(--text-dark); font-weight: 800; letter-spacing: -0.02em; }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
    .full-width { grid-column: 1 / -1; }
    .input-group { display: flex; flex-direction: column; width: 100%; }
    label { font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem; color: #334155; }
    label span.required { color: var(--danger); }
    
    /* Moderní políčka (Zde jsou přidány i email a password) */
    input[type="text"], input[type="number"], input[type="email"], input[type="password"], textarea { 
        width: 100%; padding: 0.875rem 1rem; 
        border: 1px solid #CBD5E1; border-radius: 10px; 
        font-family: inherit; font-size: 0.95rem;
        background-color: #F8FAFC;
        color: var(--text-dark);
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); 
        box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.02);
    }
    input:focus:not([readonly]), textarea:focus { 
        outline: none; border-color: var(--primary-light); 
        background-color: #FFFFFF;
        box-shadow: 0 0 0 4px var(--focus-ring); 
        transform: translateY(-1px);
    }
    input[readonly] { background-color: #E2E8F0; color: var(--text-muted); cursor: not-allowed; border-color: transparent; box-shadow: none; }
    
    /* Odesílací tlačítko */
    .submit-btn { 
        background: var(--primary-gradient); color: white; border: none; 
        padding: 1.1rem 2rem; border-radius: 12px; font-weight: 600; font-size: 1rem;
        cursor: pointer; width: 100%; transition: all 0.3s ease; 
        box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.2);
    }
    .submit-btn:hover { transform: translateY(-2px); box-shadow: var(--glow-shadow); }
    
    /* Luxusní File Dropzone */
    .file-dropzone { 
        background-color: #F8FAFC;
        border: 2px dashed #CBD5E1; 
        border-radius: 16px; padding: 3rem 2rem; text-align: center; cursor: pointer; 
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
    }
    .file-dropzone:hover { 
        background-color: #EEF2FF; border-color: var(--primary-light); 
        transform: scale(1.01);
    }
    .file-dropzone input { display: none; }
    
    /* Zpět odkaz */
    .back-link { display: inline-flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; color: var(--text-muted); text-decoration: none; font-weight: 500; transition: 0.2s; }
    .back-link:hover { color: var(--primary); transform: translateX(-4px); }
    
    @media (max-width: 600px) {
        .form-grid { grid-template-columns: 1fr; }
        .form-container { padding: 2rem 1.5rem; border-radius: 16px; }
        header { flex-direction: column; gap: 1rem; text-align: center; }
    }

        /* Obal pro select */
    select {
        position: relative;
        width: 100%;
    }

    /* Samotný select */
    select {
        appearance: none; /* Odstraní ošklivý výchozí vzhled prohlížeče (Chrome/Safari/Edge/Firefox) */
        -webkit-appearance: none;
        -moz-appearance: none;
        width: 100%;
        padding: 0.6rem 2.5rem 0.6rem 1rem; /* Pravý padding je větší kvůli šipce */
        font-size: 1rem;
        font-family: inherit;
        color: #334155; /* Tmavě šedý text */
        background-color: #F8FAFC; /* Světlé pozadí odpovídající inputům */
        border: 1px solid #CBD5E1; /* Světle šedý rámeček */
        border-radius: 8px; /* Zaoblení rohů */
        outline: none;
        cursor: pointer;
        transition: all 0.3s ease; /* Plynulá animace při najetí/kliknutí */

        /* Vložení vlastní elegantní SVG šipky do pozadí */
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2364748B' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1rem center; /* Zarovnání šipky doprava */
        background-size: 1.2em; /* Velikost šipky */
    }

    /* Efekt při najetí myší (Hover) */
    select:hover {
        border-color: #94A3B8;
    }

    /* Efekt po kliknutí / aktivním stavu (Focus) */
    select:focus {
        border-color: #10B981; /* Zelená barva (emerald) pro aktivní stav */
        box-shadow: 0 0 0 1px #10B981;
        background-color: #ffffff; /* Mírné zesvětlení pozadí po kliknutí */
    }

    /* Pokud dojde k chybě (validace) */
    select:invalid {
        color: #94A3B8; /* Šedá barva pro placeholder text */
    }

    /* Volitelné: Stylování samotných option prvků (funguje jen v některých prohlížečích) */
    select option {
        color: #334155;
        background-color: #ffffff;
        padding: 10px;
    }
    
    /* PATIČKA */
    footer { text-align: center; padding: 2rem; color: var(--text-muted); font-size: 0.875rem; margin-top: auto; }
</style>
</head>
<body>

    <header>
        <h1>Aplikace Knihovna</h1>
                  <nav class="mt-4 md:mt-0">
                <ul class="flex items-center space-x-6">
                    <li>
                        <a href="<?= BASE_URL ?>/index.php" class="hover:text-blue-400 transition-colors font-medium">Seznam knih</a>
                    </li>

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li>
                            <a href="<?= BASE_URL ?>/index.php?url=book/create" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-md transition-all shadow-inner border border-blue-500">
                                + Přidat knihu
                            </a>
                        </li>
                        <li class="text-slate-400 text-sm">
                            Ahoj, <span class="text-white font-semibold tracking-wide"><?= htmlspecialchars($_SESSION['user_name']) ?></span>
                        </li>
                        <li>
                            <a href="<?= BASE_URL ?>/index.php?url=auth/logout" class="text-rose-400 hover:text-white transition-colors text-sm uppercase tracking-wider font-medium">
                                Odhlásit
                            </a>
                        </li>

                    <?php else: ?>
                        <li>
                            <a href="<?= BASE_URL ?>/index.php?url=auth/login" class="hover:text-blue-400 transition-colors font-medium">Přihlásit</a>
                        </li>
                        <li>
                            <a href="<?= BASE_URL ?>/index.php?url=auth/register" class="bg-slate-700 hover:bg-slate-600 text-white px-4 py-2 rounded-md transition-all shadow-inner border border-slate-600">
                                Registrace
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
    </header>

    <main>
        <?php if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])): ?>
            <div class="notifications-container">
                <?php foreach ($_SESSION['messages'] as $type => $messages): ?>
                    <?php foreach ($messages as $message): ?>
                        <div class="alert alert-<?= htmlspecialchars($type) ?>">
                            <?= htmlspecialchars($message) ?>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
            <?php unset($_SESSION['messages']); ?>
        <?php endif; ?>