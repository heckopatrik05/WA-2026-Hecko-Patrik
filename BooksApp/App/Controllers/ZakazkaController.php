<?php

class ZakazkaController {
    
   // 0. Výchozí metoda pro zobrazení úvodní stránky (seznam zakázek)
    public function index() {
        require_once '../app/models/Database.php';
        require_once '../app/models/Zakazka.php';

        $database = new Database();
        $db = $database->getConnection();

        // --- NOVÉ: Záchyt parametrů z formuláře ---
        $search = htmlspecialchars($_GET['search'] ?? '');
        $stavFilter = htmlspecialchars($_GET['stav'] ?? '');

        $zakazkaModel = new Zakazka($db);
        // Předáme parametry do modelu
        $zakazky = $zakazkaModel->getAll($search, $stavFilter); 
        
        // Načtení statistik pro administrátora
        $stats = null;
        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
            $stats = $zakazkaModel->getStatistics();
        }
        
        // Načtení šablony pro seznam zakázek
        require_once '../app/views/zakazky/zakazky_list.php';
    }

    // 1. Zobrazení formuláře pro přidání nové zakázky
    public function create() {
        if (!isset($_SESSION['user_id'])) {
            $this->addErrorMessage('Pro přidání zakázky se musíte nejprve přihlásit.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }
        
        require_once '../app/views/zakazky/zakazky_create.php';
    }

    // 2. Zpracování dat odeslaných z formuláře (uložení nové zakázky)
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if (!isset($_SESSION['user_id'])) {
                $this->addErrorMessage('Pro uložení zakázky musíte být přihlášeni.');
                header('Location: ' . BASE_URL . '/index.php?url=auth/login');
                exit;
            }
            $userId = $_SESSION['user_id'];

            // 1. Získání a očištění textových dat pro detailing
            $spz = htmlspecialchars($_POST['spz'] ?? '');
            $znacka_model = htmlspecialchars($_POST['znacka_model'] ?? '');
            $typ_sluzby = htmlspecialchars($_POST['typ_sluzby'] ?? '');
            $popis_stavu = htmlspecialchars($_POST['popis_stavu'] ?? '');
            $cena = (float)($_POST['cena'] ?? 0);
            $stav = htmlspecialchars($_POST['stav'] ?? 'Přijato');

            // Zpracování nahraných souborů
            $uploadedImages = $this->processImageUploads();

            // 2. Komunikace s databází a modelem
            require_once '../app/models/Database.php';
            require_once '../app/models/Zakazka.php';

            $database = new Database();
            $db = $database->getConnection();
            $zakazkaModel = new Zakazka($db);
            
            $isSaved = $zakazkaModel->create(
                $spz, $znacka_model, $typ_sluzby, $popis_stavu, 
                $cena, $stav, $uploadedImages, $userId
            );

            // 3. Vyhodnocení výsledku a přesměrování
            if ($isSaved) {
                $this->addSuccessMessage('Zakázka byla úspěšně uložena.');
                header('Location: ' . BASE_URL . '/index.php');
                exit;
            } else {
                $this->addErrorMessage('Nepodařilo se uložit zakázku do databáze.');
            }
            
        } else {
            $this->addNoticeMessage('Pro přidání zakázky je nutné odeslat formulář.');
        }
    }

    // 3. Smazání existující zakázky
    public function delete($id = null) {
        if (!isset($_SESSION['user_id'])) {
            $this->addErrorMessage('Pro smazání zakázky se musíte nejprve přihlásit.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        if (!$id) {
            $this->addErrorMessage('Nebylo zadáno ID zakázky ke smazání.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        require_once '../app/models/Database.php';
        require_once '../app/models/Zakazka.php';

        $database = new Database();
        $db = $database->getConnection();
        $zakazkaModel = new Zakazka($db);

        $zakazka = $zakazkaModel->getById($id);

        if (!$zakazka) {
            $this->addErrorMessage('Zakázka nebyla nalezena, pravděpodobně již byla smazána.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        $isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;

        if ($zakazka['user_id'] !== $_SESSION['user_id'] && !$isAdmin) {
            $this->addErrorMessage('Nemáte oprávnění smazat tuto zakázku.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        if ($zakazkaModel->delete($id)) {
            $this->addSuccessMessage('Zakázka byla úspěšně smazána.');
        } else {
            $this->addErrorMessage('Nastala chyba. Zakázku se nepodařilo smazat.');
        }

        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }

    // 4. Zobrazení formuláře pro úpravu existující zakázky
    public function edit($id = null) {
    if (!$id) {
        // Pokud chybí ID, vrátí tě to na seznam - to může vypadat, že to "nic nedělá"
        header('Location: ' . BASE_URL . '/index.php'); 
        exit;
    }

    require_once '../app/models/Database.php';
    require_once '../app/models/Zakazka.php';

    $db = (new Database())->getConnection();
    $zakazkaModel = new Zakazka($db);
    $zakazka = $zakazkaModel->getById($id);

    if (!$zakazka) {
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }

    // Tady je kontrola oprávnění - pokud nejsi majitel ani admin, hodí tě to zpět
    $isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
    if ($zakazka['user_id'] != $_SESSION['user_id'] && !$isAdmin) {
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }

    require_once '../app/views/zakazky/zakazky_edit.php';
}

    // 5. Zpracování dat odeslaných z editačního formuláře
    public function update($id = null) {
        if (!$id) {
            $this->addErrorMessage('Nebylo zadáno ID zakázky k aktualizaci.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if (!isset($_SESSION['user_id'])) {
                $this->addErrorMessage('Pro uložení změn se musíte nejprve přihlásit.');
                header('Location: ' . BASE_URL . '/index.php?url=auth/login');
                exit;
            }

            require_once '../app/models/Database.php';
            require_once '../app/models/Zakazka.php';

            $database = new Database();
            $db = $database->getConnection();
            $zakazkaModel = new Zakazka($db);

            $zakazka = $zakazkaModel->getById($id);

            $isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;

            if (!$zakazka || ($zakazka['user_id'] !== $_SESSION['user_id'] && !$isAdmin)) {
                $this->addErrorMessage('Nemáte oprávnění ukládat změny u této zakázky.');
                header('Location: ' . BASE_URL . '/index.php');
                exit;
            }

            $spz = htmlspecialchars($_POST['spz'] ?? '');
            $znacka_model = htmlspecialchars($_POST['znacka_model'] ?? '');
            $typ_sluzby = htmlspecialchars($_POST['typ_sluzby'] ?? '');
            $popis_stavu = htmlspecialchars($_POST['popis_stavu'] ?? '');
            $cena = (float)($_POST['cena'] ?? 0);
            $stav = htmlspecialchars($_POST['stav'] ?? 'Přijato');

            $uploadedImages = $this->processImageUploads();
            $userId = $_SESSION['user_id'];

            $isUpdated = $zakazkaModel->update(
                $id, $spz, $znacka_model, $typ_sluzby, 
                $popis_stavu, $cena, $stav, $uploadedImages, $userId
            );

            if ($isUpdated) {
                $this->addSuccessMessage('Zakázka byla úspěšně upravena.');
                header('Location: ' . BASE_URL . '/index.php?url=zakazka/show/' . $id);
                exit;
            } else {
                $this->addErrorMessage('Nastala chyba. Změny se nepodařilo uložit.');
            }
            
        } else {
            $this->addNoticeMessage('Pro úpravu zakázky je nutné odeslat formulář.');
        }
    }

    // 6. Detail zakázky a zobrazení komentářů
    public function show($id = null) {
        if (!$id) {
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        require_once '../app/models/Database.php';
        require_once '../app/models/Zakazka.php';
        require_once '../app/models/Comment.php'; 

        $db = (new Database())->getConnection();
        $zakazkaModel = new Zakazka($db);
        $commentModel = new Comment($db);

        $zakazka = $zakazkaModel->getById($id);
        $comments = $commentModel->getByZakazkaId($id); 

        if (!$zakazka) {
            $this->addErrorMessage('Zakázka nebyla nalezena.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        require_once '../app/views/zakazky/zakazky_show.php';
    }

    // 7. Přidání komentáře k zakázce
    public function addComment($zakazkaId = null) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $zakazkaId && isset($_SESSION['user_id'])) {
            $content = htmlspecialchars($_POST['content'] ?? '');
            
            if (!empty(trim($content))) {
                require_once '../app/models/Database.php';
                require_once '../app/models/Comment.php';
                
                $db = (new Database())->getConnection();
                $commentModel = new Comment($db);
                
                $commentModel->addComment($zakazkaId, $_SESSION['user_id'], $content);
                $this->addSuccessMessage('Komentář byl úspěšně přidán.');
            } else {
                $this->addErrorMessage('Komentář nesmí být prázdný.');
            }
        }
        header('Location: ' . BASE_URL . '/index.php?url=zakazka/show/' . $zakazkaId);
        exit;
    }

    // 8. Smazání komentáře (CRUD požadavek)
    public function deleteComment($commentId = null) {
        if (!isset($_SESSION['user_id']) || !$commentId) {
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        require_once '../app/models/Database.php';
        require_once '../app/models/Comment.php';
        
        $db = (new Database())->getConnection();
        $commentModel = new Comment($db);
        
        $comment = $commentModel->getById($commentId);
        
        if ($comment) {
            $isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
            
            // Komentář může smazat pouze jeho autor nebo administrátor
            if ($comment['user_id'] == $_SESSION['user_id'] || $isAdmin) {
                $commentModel->deleteComment($commentId);
                $this->addSuccessMessage('Komentář byl smazán.');
            } else {
                $this->addErrorMessage('Nemáte oprávnění smazat tento komentář.');
            }
            // Návrat zpět na detail zakázky
            header('Location: ' . BASE_URL . '/index.php?url=zakazka/show/' . $comment['zakazka_id']);
            exit;
        }
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }

    // --- Pomocná metoda pro zpracování nahrávání obrázků ---
    protected function processImageUploads() {
        $uploadedFiles = [];
        $uploadDir = __DIR__ . '/../../public/uploads/'; 
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
            $fileCount = count($_FILES['images']['name']);

            for ($i = 0; $i < $fileCount; $i++) {
                if ($_FILES['images']['error'][$i] === UPLOAD_ERR_OK) {
                    
                    $tmpName = $_FILES['images']['tmp_name'][$i];
                    $originalName = basename($_FILES['images']['name'][$i]);
                    $fileExtension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
                    if (!in_array($fileExtension, $allowedExtensions)) {
                        continue; 
                    }

                    // ZMĚNA: Prefix obrázku z 'book_' na 'zakazka_'
                    $newName = 'zakazka_' . uniqid() . '_' . substr(md5(mt_rand()), 0, 4) . '.' . $fileExtension;
                    $targetFilePath = $uploadDir . $newName;

                    if (move_uploaded_file($tmpName, $targetFilePath)) {
                        $uploadedFiles[] = $newName; 
                    }
                }
            }
        }
        return $uploadedFiles;
    }

    // --- Pomocné metody pro systém notifikací ---
    protected function addSuccessMessage($message) {
        $_SESSION['messages']['success'][] = $message;
    }

    protected function addNoticeMessage($message) {
        $_SESSION['messages']['notice'][] = $message;
    }

    protected function addErrorMessage($message) {
        $_SESSION['messages']['error'][] = $message;
    }
}