<?php
class KomentarController {
    
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
            require_once '../app/models/Database.php';
            require_once '../app/models/Komentar.php';

            $db = (new Database())->getConnection();
            $komentarModel = new Komentar($db);

            $zakazka_id = $_POST['zakazka_id'];
            $obsah = $_POST['obsah'];

            if (!empty($obsah)) {
                $komentarModel->create($zakazka_id, $_SESSION['user_id'], $obsah);
            }

            header('Location: ' . BASE_URL . '/index.php?url=zakazka/show/' . $zakazka_id);
            exit;
        }
    }

    public function delete($id) {
        require_once '../app/models/Database.php';
        require_once '../app/models/Komentar.php';

        $db = (new Database())->getConnection();
        $komentarModel = new Komentar($db);
        
        $komentar = $komentarModel->getById($id);

        if ($komentar) {
            // Pravidlo: Smazat může jen autor nebo Admin
            if ($komentar['user_id'] == $_SESSION['user_id'] || $_SESSION['is_admin'] == 1) {
                $komentarModel->delete($id);
            }
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}