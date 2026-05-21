<?php

class SkladController {

    public function index() {
        // Zabezpečení: Pokud uživatel není přihlášený nebo není admin, vyhodíme ho na hlavní stranu
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        require_once '../app/models/Database.php';
        require_once '../app/models/Sklad.php';

        $db = (new Database())->getConnection();
        $skladModel = new Sklad($db);
        
        // Získání dat z modelu
        $produkty = $skladModel->getAll();

        // Načtení pohledu
        require_once '../app/views/zakazky/sklad_list.php';
    }
}