<?php
class SkladController {

    public function index() {
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        require_once '../app/models/Database.php';
        require_once '../app/models/Sklad.php';
        
        $db = (new Database())->getConnection();
        $skladModel = new Sklad($db);
        $polozky = $skladModel->getAll();
        
        require_once '../app/views/sklad/sklad_list.php';
    }

    public function create() {
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }
        require_once '../app/views/sklad/sklad_create.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
            require_once '../app/models/Database.php';
            require_once '../app/models/Sklad.php';
            
            $db = (new Database())->getConnection();
            $skladModel = new Sklad($db);
            
            $skladModel->create(
                $_POST['nazev'], 
                $_POST['znacka'], 
                $_POST['cena_ks'], 
                $_POST['skladem'],
                $_POST['minimum'],
                $_POST['jednotka']
            );
            
            header('Location: ' . BASE_URL . '/index.php?url=sklad/index');
            exit;
        }
    }

    public function edit($id) {
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }
        require_once '../app/models/Database.php';
        require_once '../app/models/Sklad.php';
        
        $db = (new Database())->getConnection();
        $skladModel = new Sklad($db);
        $polozka = $skladModel->getById($id);
        
        if (!$polozka) {
            header('Location: ' . BASE_URL . '/index.php?url=sklad/index');
            exit;
        }

        require_once '../app/views/sklad/sklad_edit.php';
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
            require_once '../app/models/Database.php';
            require_once '../app/models/Sklad.php';
            
            $db = (new Database())->getConnection();
            $skladModel = new Sklad($db);
            
            $skladModel->update(
                $id,
                $_POST['nazev'], 
                $_POST['znacka'], 
                $_POST['cena_ks'], 
                $_POST['skladem'],
                $_POST['minimum'],
                $_POST['jednotka']
            );
            
            header('Location: ' . BASE_URL . '/index.php?url=sklad/index');
            exit;
        }
    }

    public function delete($id) {
        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
            require_once '../app/models/Database.php';
            require_once '../app/models/Sklad.php';
            
            $db = (new Database())->getConnection();
            $skladModel = new Sklad($db);
            $skladModel->delete($id);
        }
        header('Location: ' . BASE_URL . '/index.php?url=sklad/index');
        exit;
    }
}
?>