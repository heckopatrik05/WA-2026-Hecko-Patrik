<?php
// Nastartování relací pro ukládání dočasných dat (Flash zprávy, přihlášení atd.)
session_start();

// --- NOVÉ: Automatické přihlášení přes Cookie ---
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_user'])) {
    require_once '../app/models/Database.php';
    require_once '../app/models/User.php';
    
    $db = (new Database())->getConnection();
    $userModel = new User($db);
    
    // Zkusíme najít uživatele podle ID uloženého v Cookie
    $user = $userModel->findById($_COOKIE['remember_user']);
    
    if ($user) {
        // Obnovíme Session pro tohoto uživatele
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nickname'] ?: $user['username'];
        $_SESSION['is_admin'] = $user['is_admin'];
    } else {
        // Pokud uživatel už v DB neexistuje (např. byl smazán adminem), smažeme i neplatnou Cookie
        setcookie('remember_user', '', time() - 3600, "/");
    }
}
// --- KONEC Automatického přihlášení ---

// Pro účely výuky a ladění na lokálním serveru (např. XAMPP) 
// je vhodné zapnout kompletní zobrazování chyb.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Dynamické zjištění základní adresy aplikace
// Vypočítá absolutní cestu ke složce, ve které běží tento index.php
$baseDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
define('BASE_URL', $baseDir);

// Načtení třídy routeru, která se postará o zpracování URL
require_once '../core/App.php';

// Inicializace aplikace a spuštění procesu routování
$app = new App();