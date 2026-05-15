<?php

class AuthController {

    // 0. Výchozí metoda (zabrání chybě, když uživatel zadá jen url=auth)
    public function index() {
        if (isset($_SESSION['user_id'])) {
            // Pokud je přihlášený, přesměrujeme ho na profil
            header('Location: ' . BASE_URL . '/index.php?url=auth/profile');
        } else {
            // Pokud není přihlášený, přesměrujeme ho na login
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
        }
        exit;
    }

    // 1. Zobrazení registračního formuláře
    public function register() {
        require_once '../app/views/auth/register.php';
    }

    // 2. Zpracování dat z registrace
    public function storeUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['username'] ?? '');
            $email = htmlspecialchars($_POST['email'] ?? '');
            $firstName = htmlspecialchars($_POST['first_name'] ?? '');
            $lastName = htmlspecialchars($_POST['last_name'] ?? '');
            $nickname = htmlspecialchars($_POST['nickname'] ?? '');
            
            $password = $_POST['password'] ?? '';
            $passwordConfirm = $_POST['password_confirm'] ?? '';

            if (empty($username) || empty($email) || empty($password)) {
                $this->addErrorMessage('Vyplňte prosím všechna povinná pole.');
                header('Location: ' . BASE_URL . '/index.php?url=auth/register');
                exit;
            }

            if ($password !== $passwordConfirm) {
                $this->addErrorMessage('Zadaná hesla se neshodují.');
                header('Location: ' . BASE_URL . '/index.php?url=auth/register');
                exit;
            }

            if (strlen($password) < 8 || !preg_match('/[0-9]/', $password)) {
                $this->addErrorMessage('Vaše heslo je příliš slabé. Musí mít alespoň 8 znaků a obsahovat minimálně 1 číslo.');
                header('Location: ' . BASE_URL . '/index.php?url=auth/register');
                exit;
            }

            require_once '../app/models/Database.php';
            require_once '../app/models/User.php';
            
            $db = (new Database())->getConnection();
            $userModel = new User($db);

            if ($userModel->register($username, $email, $password, $firstName, $lastName, $nickname)) {
                $this->addSuccessMessage('Registrace byla úspěšná. Nyní se můžete přihlásit.');
                header('Location: ' . BASE_URL . '/index.php?url=auth/login');
                exit;
            } else {
                $this->addErrorMessage('Uživatel s tímto e-mailem již existuje.');
                header('Location: ' . BASE_URL . '/index.php?url=auth/register');
                exit;
            }
        }
    }

    // 3. Zobrazení přihlašovacího formuláře
    public function login() {
        require_once '../app/views/auth/login.php';
    }

    // 4. Zpracování přihlášení
    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = htmlspecialchars($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            require_once '../app/models/Database.php';
            require_once '../app/models/User.php';
            
            $db = (new Database())->getConnection();
            $userModel = new User($db);

            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['is_admin'] = $user['is_admin']; 
                $_SESSION['user_name'] = !empty($user['nickname']) ? $user['nickname'] : $user['username'];

                if (isset($_POST['remember'])) {
                    // Cookie se jmenuje 'remember_user', obsahuje ID uživatele a platí 30 dní (86400 sekund = 1 den)
                    setcookie('remember_user', $user['id'], time() + (86400 * 30), "/");
                }

                $this->addSuccessMessage('Vítejte zpět v Hečko Detailing, ' . $_SESSION['user_name'] . '!');
                header('Location: ' . BASE_URL . '/index.php');
                exit;
            } else {
                $this->addErrorMessage('Nesprávný e-mail nebo heslo.');
                header('Location: ' . BASE_URL . '/index.php?url=auth/login');
                exit;
            }
        }
    }

    // Zobrazení seznamu uživatelů (pouze pro admina)
    public function userList() {
        // Kontrola, zda je uživatel přihlášen a je to admin
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        require_once '../app/models/Database.php';
        require_once '../app/models/User.php';
        $db = (new Database())->getConnection();
        $userModel = new User($db);

        $users = $userModel->getAll();
        require_once '../app/views/auth/user_list.php';
    }

    // 5. Odhlášení uživatele
    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['is_admin']);
        
        setcookie('remember_user', '', time() - 3600, "/");

        $this->addSuccessMessage('Byli jste úspěšně odhlášeni.');
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }

    // --- NOVÉ METODY PRO CRUD PROFILU (Zadání) ---

    // 6. Zobrazení profilu (Read)
    public function profile($id = null) {
        if (!$id && isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
        }

        if (!$id) {
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        require_once '../app/models/Database.php';
        require_once '../app/models/User.php';
        $db = (new Database())->getConnection();
        $userModel = new User($db);
        $user = $userModel->findById($id);

        require_once '../app/views/auth/profile.php'; // Tuto šablonu budeme muset vytvořit
    }

    // 7. Smazání uživatele (Delete - pouze Admin nebo vlastník)
    public function deleteUser($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        // Kontrola: Smazat může jen Admin (požadavek ze zadání)
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
            $this->addErrorMessage('Pouze administrátor může mazat uživatelské účty.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/profile/' . $id);
            exit;
        }

        require_once '../app/models/Database.php';
        require_once '../app/models/User.php';
        $db = (new Database())->getConnection();
        $userModel = new User($db);

        if ($userModel->delete($id)) {
            $this->addSuccessMessage('Uživatel byl úspěšně smazán.');
            // Pokud admin smazal sám sebe (nepravděpodobné, ale možné), odhlásíme ho
            if ($_SESSION['user_id'] == $id) {
                $this->logout();
            } else {
                header('Location: ' . BASE_URL . '/index.php');
            }
            exit;
        }
    }

    // Tato metoda odpovídá části "profile_edit" v URL: url=auth/profile_edit
    public function profile_edit() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        require_once '../app/models/Database.php';
        require_once '../app/models/User.php';
        $db = (new Database())->getConnection();
        $userModel = new User($db);

        // Načteme data aktuálního uživatele, aby byla v políčkách formuláře
        $user = $userModel->findById($_SESSION['user_id']);

        // TADY načítáš ten svůj soubor
        require_once '../app/views/auth/profile_edit.php'; 
    }

    // Uložení změn profilu (Update - save)
    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            require_once '../app/models/Database.php';
            require_once '../app/models/User.php';
            
            $db = (new Database())->getConnection();
            $userModel = new User($db);

            // 1. Bezpečné načtení dat z formuláře (přidáno ?? '' proti pádům PHP)
            $firstName = htmlspecialchars($_POST['first_name'] ?? '');
            $lastName = htmlspecialchars($_POST['last_name'] ?? '');
            $nickname = htmlspecialchars($_POST['nickname'] ?? '');
            $email = htmlspecialchars($_POST['email'] ?? '');

            // 2. Volání modelu pro aktualizaci v DB
            $success = $userModel->update(
                $_SESSION['user_id'], 
                $firstName, 
                $lastName, 
                $nickname, 
                $email
            );

            // 3. Vyhodnocení a notifikace
            if ($success) {
                // Aktualizujeme jméno v session, pokud se změnilo
                if (!empty($nickname)) {
                    $_SESSION['user_name'] = $nickname;
                }
                $this->addSuccessMessage('Profil byl úspěšně aktualizován.');
            } else {
                $this->addErrorMessage('Při aktualizaci profilu nastala chyba (např. e-mail už existuje).');
            }
            
            // 4. Přesměrování zpět na profil
            header('Location: ' . BASE_URL . '/index.php?url=auth/profile');
            exit;
        }

        // Záchytná síť, pokud by sem někdo přišel jinak než odesláním formuláře
        header('Location: ' . BASE_URL . '/index.php?url=auth/profile');
        exit;
    }

    // Smazání uživatelského účtu (Delete)
    public function deleteAccount($id = null) {
        // Pokud není předáno ID v URL, vezmeme ID právě přihlášeného uživatele (chce smazat sám sebe)
        if (!$id && isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
        }

        // Zabezpečení: Pokud se nepřihlásil, vyhodíme ho
        if (!$id || !isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        // Oprávnění: Uživatel může smazat sám sebe, NEBO to může udělat administrátor
        $isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
        
        if ($_SESSION['user_id'] != $id && !$isAdmin) {
            $this->addErrorMessage('Nemáte oprávnění smazat tento účet.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/profile');
            exit;
        }

        require_once '../app/models/Database.php';
        require_once '../app/models/User.php';
        $db = (new Database())->getConnection();
        $userModel = new User($db);

        // Volání mazání nad databází
        if ($userModel->delete($id)) {
            
            // Pokud uživatel smazal sám sebe, musíme ho rovnou odhlásit a vyčistit mu Session
            if ($_SESSION['user_id'] == $id) {
                unset($_SESSION['user_id']);
                unset($_SESSION['user_name']);
                unset($_SESSION['is_admin']);
                
                $this->addSuccessMessage('Váš účet byl trvale smazán. Mrzí nás, že odcházíte.');
                header('Location: ' . BASE_URL . '/index.php');
            } else {
                // Pokud admin smazal někoho jiného, zůstává přihlášený
                $this->addSuccessMessage('Uživatelský účet byl úspěšně odstraněn.');
                header('Location: ' . BASE_URL . '/index.php');
            }
            exit;
            
        } else {
            $this->addErrorMessage('Nastala chyba při mazání účtu.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/profile');
            exit;
        }
    }

    // --- Pomocné metody pro notifikace ---
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