<!DOCTYPE html>
<html lang="cs" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HEČKO Detailing</title>
    <style>
    /* =========================================
       PRÉMIOVÉ CSS PRO CELOU APLIKACI
       ========================================= */
    :root {
        /* Barvy pro světlý režim - Detailing Téma */
        --primary: #ff6600; /* Oranžová z loga */
        --primary-light: #ff8533;
        --primary-gradient: linear-gradient(135deg, #ff6600 0%, #e65c00 100%);
        --bg-color: #F8FAFC;
        --card-bg: #FFFFFF;
        --text-dark: #0F172A;
        --text-muted: #64748B;
        --border-color: #E2E8F0;
        
        /* Notifikace zůstávají stejné */
        --danger: #E11D48;
        --danger-bg: #FFF1F2;
        --success: #10B981;
        --success-bg: #ECFDF5;
        --warning: #F59E0B;
        --warning-bg: #FFFBEB;
        
        /* Efekty */
        --focus-ring: rgba(255, 102, 0, 0.15);
        --glow-shadow: 0 10px 25px -5px rgba(255, 102, 0, 0.3);
        --card-shadow: 0 20px 40px -5px rgba(0,0,0,0.05), 0 8px 16px -8px rgba(0,0,0,0.01);
    }

    /* BARVY PRO TMAVÝ REŽIM (Dark Mode) */
    [data-theme="dark"] {
        --bg-color: #121212;
        --card-bg: #1E1E1E;
        --text-dark: #F8FAFC;
        --text-muted: #94A3B8;
        --border-color: #333333;
        --card-shadow: 0 20px 40px -5px rgba(0,0,0,0.3);
        
        --danger-bg: rgba(225, 29, 72, 0.2);
        --success-bg: rgba(16, 185, 129, 0.2);
        --warning-bg: rgba(245, 158, 11, 0.2);
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        background-color: var(--bg-color);
        color: var(--text-dark);
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        -webkit-font-smoothing: antialiased;
        transition: background-color 0.3s, color 0.3s;
    }

    * { box-sizing: border-box; }

    /* HLAVIČKA A NAVIGACE */
    header {
        background-color: var(--card-bg);
        border-bottom: 1px solid var(--border-color);
        padding: 1rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 10;
        transition: background-color 0.3s;
    }
    
    header img.logo { height: 50px; display: block; }
    
    nav ul { list-style: none; margin: 0; padding: 0; display: flex; gap: 1.5rem; align-items: center; }
    nav a { text-decoration: none; color: var(--text-dark); font-weight: 500; transition: color 0.2s ease; font-size: 0.95rem; }
    nav a:hover { color: var(--primary); }
    
    .nav-btn-primary {
        background: var(--primary-gradient); color: white !important; padding: 0.5rem 1.25rem;
        border-radius: 8px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 2px 4px rgba(255, 102, 0, 0.2);
    }
    .nav-btn-primary:hover { transform: translateY(-1px); box-shadow: var(--glow-shadow); }

    .nav-btn-secondary {
        background: var(--text-dark); color: var(--bg-color) !important; padding: 0.5rem 1.25rem;
        border-radius: 8px; font-weight: 600; transition: all 0.3s ease;
    }
    .nav-btn-secondary:hover { transform: translateY(-1px); opacity: 0.9; }

    #theme-toggle {
        background: none; border: 1px solid var(--border-color); color: var(--text-dark);
        padding: 6px 12px; border-radius: 8px; cursor: pointer; font-size: 1rem;
        transition: all 0.2s;
    }
    #theme-toggle:hover { border-color: var(--primary); color: var(--primary); }

    /* HLAVNÍ OBSAH */
    main { flex: 1; max-width: 1200px; width: 100%; margin: 0 auto; padding: 3rem 1rem; }

    /* NOTIFIKACE */
    .notifications-container { margin-bottom: 2rem; display: flex; flex-direction: column; gap: 0.75rem; }
    .alert { padding: 1rem 1.5rem; border-radius: 10px; font-weight: 500; font-size: 0.95rem; display: flex; align-items: center; }
    .alert-success { background-color: var(--success-bg); color: var(--success); border-left: 4px solid var(--success); }
    .alert-error { background-color: var(--danger-bg); color: var(--danger); border-left: 4px solid var(--danger); }
    .alert-notice { background-color: var(--warning-bg); color: var(--warning); border-left: 4px solid var(--warning); }

    /* FORMULÁŘE */
    .form-container { background: var(--card-bg); max-width: 800px; width: 100%; margin: 0 auto; border-radius: 20px; padding: 2.5rem; box-shadow: var(--card-shadow); border: 1px solid var(--border-color); transition: background-color 0.3s; }
    .form-header { margin-bottom: 2rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem; }
    .form-header h2 { margin: 0 0 0.5rem 0; font-size: 1.875rem; color: var(--text-dark); font-weight: 800; letter-spacing: -0.02em; }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
    .full-width { grid-column: 1 / -1; }
    .input-group { display: flex; flex-direction: column; width: 100%; }
    label { font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--text-muted); }
    label span.required { color: var(--danger); }
    
    input[type="text"], input[type="number"], input[type="email"], input[type="password"], textarea, select { 
        width: 100%; padding: 0.8rem 1rem; 
        border: 1px solid var(--border-color); border-radius: 10px; 
        font-family: inherit; font-size: 0.95rem;
        background-color: var(--bg-color); color: var(--text-dark);
        transition: all 0.2s; 
    }
    input:focus, textarea:focus, select:focus { 
        outline: none; border-color: var(--primary-light); 
        background-color: var(--card-bg); box-shadow: 0 0 0 3px var(--focus-ring); 
    }
    
    .submit-btn { 
        background: var(--primary-gradient); color: white; border: none; 
        padding: 1rem 2rem; border-radius: 10px; font-weight: 600; font-size: 1rem;
        cursor: pointer; width: 100%; transition: all 0.3s ease; 
    }
    .submit-btn:hover { transform: translateY(-2px); box-shadow: var(--glow-shadow); }
    
    .file-dropzone { 
        background-color: var(--bg-color); border: 2px dashed var(--border-color); 
        border-radius: 12px; padding: 2rem; text-align: center; cursor: pointer; 
        transition: all 0.3s; 
    }
    .file-dropzone:hover { background-color: rgba(255, 102, 0, 0.05); border-color: var(--primary-light); }
    .file-dropzone input { display: none; }
    
    .back-link { display: inline-flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; color: var(--text-muted); text-decoration: none; font-weight: 500; transition: 0.2s; }
    .back-link:hover { color: var(--primary); transform: translateX(-4px); }
    
    @media (max-width: 600px) {
        .form-grid { grid-template-columns: 1fr; }
        header { flex-direction: column; gap: 1rem; text-align: center; }
        nav ul { flex-wrap: wrap; justify-content: center; }
    }

    /* PATIČKA */
    footer { text-align: center; padding: 2rem; color: var(--text-muted); font-size: 0.875rem; margin-top: auto; border-top: 1px solid var(--border-color); background-color: var(--card-bg); }

    /* =========================================
       TISKOVÝ FORMÁT (Předávací protokol)
       ========================================= */
    @media print {
        /* TRIK NA VYPNUTÍ VÝCHOZÍHO TEXTU PROHLÍŽEČE (URL dole A TITULEK nahoře) */
        @page {
            margin: 0; 
        }

        body {
            /* Když jsme smazali okraje papíru nahoře, musíme to obsahu vykompenzovat, 
               aby se text nelepil úplně na fyzickou hranu papíru */
            padding: 2cm !important; 
        }

        /* Skryjeme vše, co na papíře nedává smysl */
        header, footer, .back-link, .comments-section, .notifications-container, #theme-toggle, .print-hide {
            display: none !important;
        }

        /* Resetujeme barvy a stíny pro úsporu inkoustu */
        body, .form-container, main {
            background: white !important;
            color: black !important;
            box-shadow: none !important;
            border: none !important;
            margin: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
        }

        /* Přidáme oficiální hlavičku na papír */
        .form-container::before {
            content: "PŘEDÁVACÍ PROTOKOL - HEČKO DETAILING";
            display: block;
            font-size: 22px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid black;
        }

        /* Přidáme kolonky pro podpisy na konec detailu */
        .form-container::after {
            content: "Datum převzetí: ......................... \A\A Podpis technika: ......................... \A\A Podpis zákazníka: .........................";
            white-space: pre-wrap;
            display: block;
            margin-top: 60px;
            font-size: 16px;
            font-weight: bold;
            line-height: 2;
        }
        
        /* Fotky v tisku trochu zmenšíme, aby se vešly na stránku */
        img {
            max-width: 200px !important;
            max-height: 150px !important;
        }
    }
    </style>
</head>
<body>

    <header>
        <a href="<?= BASE_URL ?>/index.php">
            <img src="<?= BASE_URL ?>/images/Logo.png" alt="HEČKO Detailing" class="logo">
        </a>
        
        <nav>
            <ul>
                <li><a href="<?= BASE_URL ?>/index.php">Přehled zakázek</a></li>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <li>
                        <a href="<?= BASE_URL ?>/index.php?url=zakazka/create" class="nav-btn-primary">+ Nová zakázka</a>
                    </li>
                    <li style="color: var(--text-muted); font-size: 0.9rem; padding: 0 10px;">
                        Ahoj, <span style="color: var(--text-dark); font-weight: bold;"><?= htmlspecialchars($_SESSION['user_name']) ?></span>
                        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                            <span style="background-color: var(--danger); color: white; padding: 2px 6px; border-radius: 4px; font-size: 0.7rem; font-weight: bold; margin-left: 5px;">Admin</span>
                        <?php endif; ?>
                    </li>
                    <li><a href="<?= BASE_URL ?>/index.php?url=auth/profile">Profil</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?url=auth/logout" style="color: var(--danger); font-weight: bold;">Odhlásit</a></li>
                <?php else: ?>
                    <li><a href="<?= BASE_URL ?>/index.php?url=auth/login">Přihlásit</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?url=auth/register" class="nav-btn-secondary">Registrace</a></li>
                <?php endif; ?>
                
                <li><button id="theme-toggle" title="Přepnout tmavý/světlý režim">🌓</button></li>
            </ul>
        </nav>
    </header>

    <script>
        const toggleBtn = document.getElementById('theme-toggle');
        const htmlDoc = document.documentElement;
        
        // Načtení volby uživatele z paměti
        const savedTheme = localStorage.getItem('theme') || 'light';
        htmlDoc.setAttribute('data-theme', savedTheme);

        toggleBtn.addEventListener('click', () => {
            const currentTheme = htmlDoc.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            htmlDoc.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        });
    </script>

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