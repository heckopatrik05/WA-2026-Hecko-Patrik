<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikace Knihovna</title>
    <style>
        /* =========================================
           Sjednocené CSS pro celou aplikaci
           ========================================= */
        :root {
            --primary: #4F46E5;
            --primary-hover: #4338CA;
            --bg-color: #F8FAFC;
            --card-bg: #FFFFFF;
            --text-dark: #0F172A;
            --text-muted: #64748B;
            --border-color: #E2E8F0;
            --danger: #E11D48;
            --danger-bg: #FFE4E6;
            --success: #16A34A;
            --success-bg: #DCFCE7;
            --warning: #EA580C;
            --warning-bg: #FFEDD5;
            --focus-ring: rgba(79, 70, 229, 0.15);
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
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        header h1 { margin: 0; font-size: 1.25rem; font-weight: 700; color: var(--primary); }
        nav ul { list-style: none; margin: 0; padding: 0; display: flex; gap: 1.5rem; align-items: center; }
        nav a { text-decoration: none; color: var(--text-muted); font-weight: 500; transition: color 0.2s ease; }
        nav a:hover { color: var(--primary); }
        nav a[href*="create"] {
            background-color: var(--primary); color: white; padding: 0.5rem 1rem;
            border-radius: 6px; font-weight: 600; box-shadow: 0 2px 4px rgba(79, 70, 229, 0.2);
        }
        nav a[href*="create"]:hover { background-color: var(--primary-hover); color: white; }

        /* HLAVNÍ OBSAH */
        main {
            flex: 1; max-width: 1200px; width: 100%; margin: 0 auto; padding: 3rem 1rem;
        }

        /* NOTIFIKACE */
        .notifications-container { margin-bottom: 2rem; display: flex; flex-direction: column; gap: 0.5rem; }
        .alert { padding: 1rem 1.5rem; border-radius: 8px; font-weight: 500; font-size: 0.95rem; border: 1px solid transparent; }
        .alert-success { background-color: var(--success-bg); color: var(--success); border-color: #BBF7D0; }
        .alert-error { background-color: var(--danger-bg); color: var(--danger); border-color: #FECDD3; }
        .alert-notice { background-color: var(--warning-bg); color: var(--warning); border-color: #FED7AA; }

        /* TABULKA */
        .table-container { background: var(--card-bg); border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.03); overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        thead { background-color: #F8FAFC; border-bottom: 2px solid var(--border-color); }
        th { padding: 1rem 1.5rem; font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); }
        td { padding: 1rem 1.5rem; border-bottom: 1px solid var(--border-color); vertical-align: middle; }
        tbody tr:hover { background-color: #F1F5F9; }
        .actions { display: flex; gap: 0.5rem; }
        .action-btn { text-decoration: none; padding: 0.35rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 500; transition: 0.2s; }
        .btn-detail { background-color: #EEF2FF; color: var(--primary); }
        .btn-edit { background-color: #F1F5F9; color: var(--text-dark); }
        .btn-delete { background-color: var(--danger-bg); color: var(--danger); }
        .btn-delete:hover { background-color: var(--danger); color: white; }

        /* FORMULÁŘE (Create & Edit) */
        .form-container { background: var(--card-bg); max-width: 800px; width: 100%; margin: 0 auto; border-radius: 16px; padding: 3rem; box-shadow: 0 20px 40px rgba(0,0,0,0.04); }
        .form-header { margin-bottom: 2.5rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1.5rem; }
        .form-header h2 { margin: 0 0 0.5rem 0; font-size: 1.75rem; color: var(--text-dark); }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
        .full-width { grid-column: 1 / -1; }
        .input-group { display: flex; flex-direction: column; width: 100%; }
        label { font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem; }
        label span.required { color: var(--danger); }
        input[type="text"], input[type="number"], textarea { width: 100%; padding: 0.875rem 1rem; border: 1px solid var(--border-color); border-radius: 8px; font-family: inherit; transition: 0.2s; }
        input:focus:not([readonly]), textarea:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 4px var(--focus-ring); }
        input[readonly] { background-color: #E2E8F0; color: var(--text-muted); cursor: not-allowed; }
        .submit-btn { background-color: var(--primary); color: white; border: none; padding: 1rem 2rem; border-radius: 8px; font-weight: 600; cursor: pointer; width: 100%; transition: 0.2s; }
        .submit-btn:hover { background-color: var(--primary-hover); transform: translateY(-1px); }
        .file-dropzone { border: 2px dashed var(--border-color); border-radius: 12px; padding: 2.5rem 1rem; text-align: center; cursor: pointer; display: flex; flex-direction: column; }
        .file-dropzone input { display: none; }
        .back-link { display: inline-block; margin-bottom: 1.5rem; color: var(--text-muted); text-decoration: none; font-weight: 500; }
        
        @media (max-width: 600px) {
            .form-grid { grid-template-columns: 1fr; }
            .form-container { padding: 1.5rem; }
            header { flex-direction: column; gap: 1rem; }
        }
        
        /* PATIČKA */
        footer { text-align: center; padding: 2rem; color: var(--text-muted); font-size: 0.875rem; border-top: 1px solid var(--border-color); margin-top: auto; }
    </style>
</head>
<body>

    <header>
        <h1>Aplikace Knihovna</h1>
        <nav>
            <ul>
                <li><a href="<?= BASE_URL ?>/index.php">Seznam knih</a></li>
                <li><a href="<?= BASE_URL ?>/index.php?url=book/create">+ Přidat novou knihu</a></li>
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