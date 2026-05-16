<!DOCTYPE html>
<html lang="cs" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HEČKO Detailing</title>
    <style>
    /* =========================================
       ULTIMÁTNÍ PRÉMIOVÝ DESIGN - HEČKO DETAILING
       ========================================= */
    
    /* Import luxusního moderního fontu Outfit */
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;800&display=swap');

    :root {
        /* --- SVĚTLÝ REŽIM (Čistý a elegantní jako keramická ochrana) --- */
        --primary: #ff6600; 
        --primary-light: #ff8533;
        --primary-gradient: linear-gradient(135deg, #ff6600 0%, #d85700 100%);
        --bg-color: #f4f7f9; /* Velmi jemná perleťová šedá */
        
        /* Skleněný efekt pro karty */
        --card-bg: rgba(255, 255, 255, 0.75); 
        --card-backdrop: blur(20px);
        
        --text-dark: #0f172a;
        --text-muted: #64748b;
        --border-color: rgba(15, 23, 42, 0.08);
        
        /* Notifikace */
        --danger: #ef4444; --danger-bg: rgba(239, 68, 68, 0.1);
        --success: #10b981; --success-bg: rgba(16, 185, 129, 0.1);
        --warning: #f59e0b; --warning-bg: rgba(245, 158, 11, 0.1);
        
        /* Prostorové efekty */
        --focus-ring: rgba(255, 102, 0, 0.2);
        --glow-shadow: 0 12px 30px -10px rgba(255, 102, 0, 0.5);
        --card-shadow: 0 20px 40px -10px rgba(0,0,0,0.05), inset 0 1px 0 rgba(255,255,255,0.5);
    }

    /* =========================================
       LUXUSNÍ DYNAMICKÉ POZADÍ (Animovaný gradient)
       ========================================= */
    body {
        /* Světlý režim - velmi jemné stříbrno-bílé přelévání */
        background: linear-gradient(-45deg, #f8fafc, #e2e8f0, #ffffff, #f1f5f9) !important;
        background-size: 400% 400% !important;
        animation: gradientBG 15s ease infinite !important;
        /* Zajištění, aby pozadí bylo i fixní při scrollování */
        background-attachment: fixed !important; 
    }
    
    [data-theme="dark"] body {
        /* Tmavý režim - temné, hluboké modro-černé odstíny (působí jako prémiový lak auta) */
        background: linear-gradient(-45deg, #0f172a, #1e293b, #020617, #0f172a) !important;
        background-size: 400% 400% !important;
    }

    /* Samotná plynulá animace, která hýbe pozadím */
    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* =========================================
       GLASSMORPHISM (Efekt matného skla pro kontejnery)
       ========================================= */
    .form-container, .table-container, .auth-container {
        /* Poloprůhledné bílé pozadí */
        background: rgba(255, 255, 255, 0.6) !important;
        /* Tohle dělá to kouzlo - rozmaže všechno, co je fyzicky za tímto oknem */
        backdrop-filter: blur(16px) !important;
        -webkit-backdrop-filter: blur(16px) !important;
        /* Jemný bílý rámeček, aby to vypadalo jako opravdová hrana skla */
        border: 1px solid rgba(255, 255, 255, 0.8) !important;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.05) !important;
    }

    [data-theme="dark"] .form-container, 
    [data-theme="dark"] .table-container, 
    [data-theme="dark"] .auth-container {
        /* Tmavé poloprůhledné pozadí pro Dark Mode */
        background: rgba(15, 23, 42, 0.6) !important;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3) !important;
    }
    
    /* Vypnutí efektu pro tisk, aby na papíře zůstala klasická čistá bílá bez stínů */
    @media print {
        body { background: white !important; animation: none !important; }
        .form-container, .table-container { background: transparent !important; backdrop-filter: none !important; border: none !important; box-shadow: none !important; }
    }

    /* --- TMAVÝ REŽIM (High-end sportovní interiér) --- */
    [data-theme="dark"] {
        --bg-color: #050507; /* Temná, téměř absolutní černá */
        
        /* Skleněný efekt v tmavém provedení */
        --card-bg: rgba(20, 21, 26, 0.65); 
        --text-dark: #f8fafc;
        --text-muted: #94a3b8;
        --border-color: rgba(255, 255, 255, 0.06);
        
        --card-shadow: 0 25px 50px -12px rgba(0,0,0,0.7), inset 0 1px 0 rgba(255,255,255,0.05);
        
        --danger-bg: rgba(239, 68, 68, 0.15);
        --success-bg: rgba(16, 185, 129, 0.15);
        --warning-bg: rgba(245, 158, 11, 0.15);
    }

    /* =========================================
       ZÁKLADNÍ STRUKTURA A TYPOGRAFIE
       ========================================= */
    html { scroll-behavior: smooth; }

    body {
        font-family: 'Outfit', sans-serif;
        background-color: var(--bg-color);
        color: var(--text-dark);
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        -webkit-font-smoothing: antialiased;
        transition: background-color 0.4s ease, color 0.4s ease;
        /* Jemný gradient přes celou obrazovku pro luxusnější pocit */
        background-image: radial-gradient(circle at 50% 0%, rgba(255, 102, 0, 0.03) 0%, transparent 70%);
    }

    * { box-sizing: border-box; }

    /* Vlastní design posuvníku */
    ::-webkit-scrollbar { width: 8px; height: 8px; }
    ::-webkit-scrollbar-track { background: rgba(150, 150, 150, 0.3); }
    ::-webkit-scrollbar-thumb { background: rgba(150, 150, 150, 0.3); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--primary); }

    /* =========================================
       HLAVIČKA (Plovoucí Glassmorphism)
       ========================================= */
    header {
        background-color: var(--card-bg);
        backdrop-filter: var(--card-backdrop);
        -webkit-backdrop-filter: var(--card-backdrop);
        border-bottom: 1px solid var(--border-color);
        padding: 1rem 2.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.1);
    }
    
    header img.logo { height: 45px; display: block; transition: transform 0.3s; }
    header img.logo:hover { transform: scale(1.05); }
    
    nav ul { list-style: none; margin: 0; padding: 0; display: flex; gap: 2rem; align-items: center; }
    nav a { text-decoration: none; color: var(--text-dark); font-weight: 500; letter-spacing: 0.3px; transition: color 0.2s ease; font-size: 0.95rem; }
    nav a:hover { color: var(--primary); }

    /* =========================================
       TLAČÍTKA (Světoznámý Glow Efekt)
       ========================================= */
    .nav-btn-primary, .submit-btn {
        background: var(--primary-gradient); 
        color: #ffffff !important; 
        padding: 0.6rem 1.5rem;
        border-radius: 10px; 
        font-weight: 700; 
        letter-spacing: 0.5px;
        border: none;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
        box-shadow: var(--glow-shadow);
        text-transform: uppercase;
        font-size: 0.9rem;
    }
    .nav-btn-primary:hover, .submit-btn:hover { 
        transform: translateY(-3px); 
        box-shadow: 0 15px 35px -5px rgba(255, 102, 0, 0.6); 
    }

    /* =========================================
       PANELY A KARTY (Formuláře, Tabulky, Dashboard)
       ========================================= */
    main { flex: 1; max-width: 1250px; width: 100%; margin: 0 auto; padding: 3rem 1.5rem; animation: fadeIn 0.6s ease-out forwards; }

    .form-container, .table-container, [style*="background: var(--card-bg)"] { 
        background: var(--card-bg) !important; 
        backdrop-filter: var(--card-backdrop) !important;
        -webkit-backdrop-filter: var(--card-backdrop) !important;
        border-radius: 20px !important; 
        padding: 2.5rem; 
        box-shadow: var(--card-shadow) !important; 
        border: 1px solid var(--border-color) !important; 
        transition: transform 0.3s ease, box-shadow 0.3s ease; 
    }
    
    .form-header { margin-bottom: 2.5rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1.5rem; }
    .form-header h2 { margin: 0 0 0.5rem 0; font-size: 2.2rem; color: var(--text-dark); font-weight: 800; letter-spacing: -0.03em; }

    /* =========================================
       FORMULÁŘOVÁ POLÍČKA
       ========================================= */
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
    .full-width { grid-column: 1 / -1; }
    .input-group { display: flex; flex-direction: column; width: 100%; }
    label { font-size: 0.85rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; }
    label span.required { color: var(--primary); }
    
    input[type="text"], input[type="number"], input[type="email"], input[type="password"], textarea, select { 
        width: 100%; padding: 1rem 1.2rem; 
        border: 1px solid var(--border-color); 
        border-radius: 12px; 
        font-family: 'Outfit', sans-serif; font-size: 1rem; font-weight: 500;
        background-color: rgba(0,0,0,0.02); color: var(--text-dark);
        transition: all 0.3s ease; 
    }
    
    [data-theme="dark"] input, [data-theme="dark"] select, [data-theme="dark"] textarea {
        background-color: rgba(0,0,0,0.2);
    }

    input:focus, textarea:focus, select:focus { 
        outline: none; border-color: var(--primary); 
        background-color: transparent; 
        box-shadow: 0 0 0 4px var(--focus-ring); 
        transform: translateY(-1px);
    }

    /* =========================================
       TABULKY (Elegantní výpis zakázek)
       ========================================= */
    table { width: 100%; border-collapse: separate; border-spacing: 0; }
    th { 
        background: transparent !important; 
        color: var(--text-muted) !important; 
        text-transform: uppercase; 
        font-size: 0.75rem; 
        font-weight: 800;
        letter-spacing: 1px; 
        border-bottom: 2px solid var(--border-color);
        padding: 1rem !important;
    }
    tbody tr { transition: all 0.2s ease; }
    tbody tr:hover { 
        background: rgba(255, 102, 0, 0.03) !important; 
        transform: scale(1.005); 
    }
    td { 
        border-bottom: 1px solid var(--border-color) !important; 
        padding: 1.2rem 1rem !important;
        font-weight: 500;
    }

    /* =========================================
       CHYTRÉ PŘEPÍNÁNÍ LOGA (Dark/Light Mode)
       ========================================= */
    
    /* Ve výchozím stavu je tmavé logo schované */
    .logo-dark { 
        display: none !important; 
    }
    
    /* Jakmile se zapne tmavý režim, schováme světlé logo a ukážeme tmavé */
    [data-theme="dark"] .logo-light { 
        display: none !important; 
    }
    [data-theme="dark"] .logo-dark { 
        display: block !important; 
    }

    /* OCHRANA PŘI TISKU: Na papír vždy tiskneme původní logo, i z Dark Modu */
    @media print {
        .logo-dark { 
            display: none !important; 
        }
        .logo-light { 
            display: block !important; 
        }
    }

    /* =========================================
       ANIMACE A DROBNOSTI
       ========================================= */
    @keyframes fadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }

    .back-link { display: inline-flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; color: var(--text-muted); text-decoration: none; font-weight: 600; transition: 0.2s; }
    .back-link:hover { color: var(--primary); transform: translateX(-5px); }

    footer { text-align: center; padding: 2.5rem; color: var(--text-muted); font-size: 0.85rem; margin-top: auto; border-top: 1px solid var(--border-color); background-color: transparent; font-weight: 500; }

    /* =========================================
       PROFESIONÁLNÍ TISKOVÝ DOKLAD (Čistý & Oficiální)
       ========================================= */
    @media print {
        /* TRIK PROTI PROHLÍŽEČI: Nulový margin zabrání vytištění URL adresy a názvu okna */
        @page { 
            margin: 0; 
            size: A4 portrait;
        }
        
        body { 
            /* Jelikož jsme zrušili okraje papíru, musíme to nahradit vnitřním odsazením, aby text nebyl nalepený na hraně */
            padding: 1.5cm 2cm !important; 
            background: #ffffff !important; 
            color: #000000 !important; 
            font-family: 'Outfit', sans-serif !important;
        }

        /* 1. SKRYTÍ VŠEHO WEBOVÉHO A NEŽÁDOUCÍHO */
        nav, footer, .back-link, .print-hide, button, .submit-btn, .toast-container, #theme-toggle { 
            display: none !important; 
        }

        textarea, label[for="popis_stavu"], label[for="komentar"] {
            display: none !important;
        }

        /* 2. OFICIÁLNÍ HLAVIČKA S LOGEM A ÚDAJI */
        header { 
            position: static !important;
            background: transparent !important;
            padding: 0 0 20px 0 !important;
            border-bottom: 3px solid #000000 !important;
            box-shadow: none !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: flex-end !important;
        }
        
        header img.logo {
            display: block !important;
            max-height: 60px !important;
        }

        /* Odstraněn duplicitní název, zbyly jen firemní údaje */
        header::after {
            content: "IČO: 12345678\A Tel: +420 123 456 789\A info@heckodetailing.cz";
            white-space: pre-wrap;
            text-align: right;
            font-size: 12px;
            line-height: 1.5;
            font-weight: 700;
            color: #000000 !important;
        }

        /* Vykreslení QR kódu v pravém horním rohu dokumentu */
        .qr-print-only {
            display: block !important;
            position: absolute !important;
            top: 20px !important;
            right: 20px !important;
            text-align: center !important;
        }
        
        .qr-print-only img {
            max-width: 80px !important;
            max-height: 80px !important;
            border: none !important;
            margin: 0 !important;
        }

        /* 3. RESET KONTEJNERŮ */
        main { padding: 20px 0 !important; max-width: 100% !important; }
        .form-container { box-shadow: none !important; border: none !important; padding: 0 !important; background: transparent !important; }
        
        /* 4. NADPIS DOKUMENTU */
        .form-header { border-bottom: 1px solid #cccccc !important; padding-bottom: 10px !important; margin-bottom: 30px !important; }
        .form-header h2 { font-size: 24px !important; text-transform: uppercase; letter-spacing: 1px; color: #000000 !important; margin: 0 !important; }
        .form-header p { display: none !important; }
        .form-header::after { content: "OFICIÁLNÍ PŘEDÁVACÍ PROTOKOL / ZAKÁZKA"; display: block; font-size: 12px; font-weight: 800; color: #666666 !important; margin-top: 5px; letter-spacing: 2px; }

        /* 5. ČISTÁ MŘÍŽKA ÚDAJŮ */
        .form-grid { display: grid !important; grid-template-columns: 1fr 1fr !important; gap: 20px 40px !important; }
        .input-group { border-bottom: 1px solid #eeeeee !important; padding-bottom: 5px !important; }
        
        label { font-size: 10px !important; color: #888888 !important; text-transform: uppercase !important; margin-bottom: 2px !important; letter-spacing: 0.5px !important; display: block !important; }
        
        input, select { 
            border: none !important; background: transparent !important; font-size: 15px !important; font-weight: 700 !important; color: #000000 !important; padding: 0 !important; margin: 0 !important; width: 100% !important; box-shadow: none !important; -webkit-appearance: none; 
        }

        /* V tisku chceme VŽDY jen světlé logo (originál) */
        header img.logo-light {
            display: block !important;
            max-height: 60px !important;
        }
        
        /* Tmavé logo při tisku absolutně zakážeme */
        header img.logo-dark {
            display: none !important;
        }

        /* 7. PROFESIONÁLNÍ PODPISOVÝ BOX DOLE */
        .form-container::after {
            content: "Tento dokument stvrzuje předání vozidla k provedení služeb / převzetí vozidla po dokončení služeb ve výše uvedeném stavu.\A\A V Liberci dne: .........................\A\A\A ........................................................ \00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0 ........................................................ \A Zástupce HEČKO Detailing \00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0 Zákazník";
            display: block;
            margin-top: 50px;
            padding-top: 20px;
            border-top: 2px solid #000000;
            white-space: pre-wrap;
            font-size: 12px;
            line-height: 1.8;
            font-weight: 500;
            page-break-inside: avoid;
        }
        
    }

    /* =========================================
       LOADING ANIMACE (Ochrana tlačítek)
       ========================================= */
    .btn-loading { position: relative; pointer-events: none; opacity: 0.8; }
    .spinner { display: inline-block; width: 16px; height: 16px; margin-right: 8px; border: 2px solid rgba(255, 255, 255, 0.3); border-radius: 50%; border-top-color: #ffffff; animation: spin 0.8s linear infinite; vertical-align: middle; }
    @keyframes spin { to { transform: rotate(360deg); } }

    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1.5rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color, #e2e8f0);
        flex-wrap: wrap;
        gap: 10px;
    }
    .pagination-info {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-dark, #333);
        opacity: 0.8;
    }
    .pagination-buttons {
        display: flex;
        gap: 5px;
    }
    .page-btn {
        display: inline-block;
        padding: 8px 14px;
        border: 1px solid var(--border-color, #e2e8f0);
        background: var(--card-bg, #ffffff);
        color: var(--text-dark, #333);
        text-decoration: none;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }
    .page-btn:hover {
        background: var(--primary, #ff6600);
        color: white !important;
        border-color: var(--primary, #ff6600);
    }
    .page-btn.active {
        background: var(--primary, #ff6600);
        color: white !important;
        border-color: var(--primary, #ff6600);
        cursor: default;
    }
</style>
<script>
    // Tento kód se spustí okamžitě při načítání hlavičky, aby se zabránilo probliknutí
    
    // 1. Zjistíme, jestli má uživatel už něco uloženo z minula
    const savedTheme = localStorage.getItem('hecko-theme');
    
    // 2. Zjistíme, jestli má uživatel celý Windows/Mac nastavený do tmavého režimu
    const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    
    // 3. Aplikujeme téma
    if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
        document.documentElement.setAttribute('data-theme', 'dark');
    }

    // 4. Přidání funkce na tlačítko (až když je zbytek stránky načtený)
    document.addEventListener('DOMContentLoaded', function() {
        const themeToggleBtn = document.getElementById('theme-toggle');
        
        // Nastavení správné ikonky podle aktuálního stavu
        const currentTheme = document.documentElement.getAttribute('data-theme');
        themeToggleBtn.innerHTML = currentTheme === 'dark' ? '☀️' : '🌙';
        
        // Co se stane po kliknutí
        themeToggleBtn.addEventListener('click', function() {
            let targetTheme = 'light';
            
            // Pokud jsme ve světlém, přepneme na tmavý a naopak
            if (document.documentElement.getAttribute('data-theme') !== 'dark') {
                targetTheme = 'dark';
                this.innerHTML = '☀️'; // Změníme ikonku na sluníčko
            } else {
                this.innerHTML = '🌙'; // Změníme ikonku na měsíc
            }
            
            // Aplikujeme téma na HTML dokument
            document.documentElement.setAttribute('data-theme', targetTheme);
            
            // Uložíme volbu navždy do paměti prohlížeče
            localStorage.setItem('hecko-theme', targetTheme);
        });
    });
</script>
</head>
<body>

    <header>
        <a href="<?= BASE_URL ?>/index.php">
            <img src="<?= BASE_URL ?>/images/Logo.png" class="logo logo-light" alt="HEČKO Detailing">
            <img src="<?= BASE_URL ?>/images/Logo2.png" class="logo logo-dark" alt="HEČKO Detailing">
        </div>
        </a>

       
        
        <nav>
            <ul>
                <li class="print-hide">
                    <button id="theme-toggle" title="Přepnout tmavý/světlý režim" style="background: rgba(15, 23, 42, 0.05); border: 1px solid var(--border-color); color: var(--text-dark); width: 40px; height: 40px; border-radius: 12px; cursor: pointer; font-size: 1.2rem; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                        🌙
                    </button>
                </li>
                <li><a href="<?= BASE_URL ?>/index.php">Přehled zakázek</a></li>

                <ul style="display: flex; list-style: none; gap: 15px; margin: 0; padding: 0; align-items: center;">
            
            <?php if (isset($_SESSION['user_id'])): ?>
                
                <li style="display: flex; align-items: center; gap: 12px; margin-right: 15px; border-right: 1px solid var(--border-color); padding-right: 15px;" class="print-hide">
                    
                    <?php 
                        // 1. Získání jména a vytvoření iniciál (první 2 písmena, velkým písmem)
                        $displayName = $_SESSION['user_name'] ?? $_SESSION['username'] ?? 'Uživatel';
                        $initials = mb_strtoupper(mb_substr($displayName, 0, 2, 'UTF-8'), 'UTF-8');
                        
                        // 2. Generování unikátní barvy na základě jména (stejné jméno = stejná barva)
                        $hash = md5($displayName);
                        $hue = hexdec(substr($hash, 0, 3)) % 360; // Barva v kruhu 0-360
                        $avatarColor = "hsl($hue, 70%, 45%)"; // Sytost 70%, světlost 45% (aby byl bílý text dobře čitelný)
                    ?>

                    <div style="width: 42px; height: 42px; border-radius: 50%; background-color: <?= $avatarColor ?>; color: white; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.1rem; letter-spacing: 1px; box-shadow: 0 4px 10px rgba(0,0,0,0.15); border: 2px solid var(--card-bg);">
                        <?= htmlspecialchars($initials) ?>
                    </div>

                    <div style="display: flex; flex-direction: column; line-height: 1.2;">
                        <span style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; font-weight: 600;">Přihlášen jako</span>
                        <strong style="color: var(--primary); font-size: 0.95rem;">
                            <?= htmlspecialchars($displayName) ?>
                        </strong>
                    </div>
                    
                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                        <span style="background: var(--danger); color: white; font-size: 0.65rem; padding: 2px 5px; border-radius: 4px; font-weight: bold; text-transform: uppercase; margin-left: 5px;">Admin</span>
                    <?php endif; ?>
                </li>

                <li><a href="<?= BASE_URL ?>/index.php?url=auth/profile" style="text-decoration: none; color: var(--text-dark); font-weight: 600;">Můj profil</a></li>
                
                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                    <li><a href="<?= BASE_URL ?>/index.php?url=auth/userList" style="color: #ef4444; font-weight: bold; text-decoration: none;">Správa uživatelů</a></li>
                <?php endif; ?>
                
                <li><a href="<?= BASE_URL ?>/index.php?url=auth/logout" class="nav-btn-logout" style="text-decoration: none;">Odhlásit</a></li>

            <?php else: ?>
                
                <li><a href="<?= BASE_URL ?>/index.php?url=auth/login" style="text-decoration: none; color: var(--text-dark); font-weight: 600;">Přihlásit se</a></li>
                <li><a href="<?= BASE_URL ?>/index.php?url=auth/register" class="nav-btn-primary" style="text-decoration: none;">Registrace</a></li>
                
            <?php endif; ?> </ul>
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