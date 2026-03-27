<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> -->
    <title>Knihovna - Seznam knih</title>
</head>
<body>
    <header>
        <h1>Aplikace Knihovna</h1>
        
        <nav>
            <ul>
                <!-- Poznámka: do odkazu href se musí dát reálná absolutní/úplná cesta k souboru index.php -->
                <li><a href="<?= BASE_URL ?>/index.php/">Seznam knih (Domů)</a></li>
                <li><a href="<?= BASE_URL ?>/index.php?url=book/create/">Přidat novou knihu</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Dostupné knihy</h2>
        
        <p>Zde se brzy objeví seznam knih načtený z databáze.</p>
        
        </main>

    <footer>
        <p>&copy; WA 2026 - Výukový projekt</p>
    </footer>
</body>
</html>