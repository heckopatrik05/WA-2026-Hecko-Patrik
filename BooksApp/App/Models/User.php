<?php

class User {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;    
    }

    // 1. Registrace nového uživatele
    public function register(
        string $username, 
        string $email, 
        string $password, 
        ?string $firstName = null, 
        ?string $lastName = null, 
        ?string $nickname = null
    ): bool {
        if ($this->findByEmail($email)) {
            return false; // Email už je zabraný
        }

        // ZABEZPEČENÍ: Vytvoření bezpečného hashe z hesla
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password, first_name, last_name, nickname) 
                VALUES (:username, :email, :password, :first_name, :last_name, :nickname)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':first_name' => $firstName,
            ':last_name' => $lastName,
            ':nickname' => $nickname
        ]);
    }

    // 2. Nalezení uživatele podle emailu (použijeme při přihlašování)
    public function findByEmail(string $email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // 3. Získání uživatele podle ID (přidán sloupec is_admin)
    public function findById(int $id) {
        // !!! ZMĚNA: Přidán sloupec is_admin, abychom mohli ověřit práva k mazání
        $sql = "SELECT id, username, email, first_name, last_name, nickname, is_admin, created_at FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 4. Aktualizace uživatelského profilu (Update z CRUD) - NOVÁ METODA
    public function update(int $id, string $firstName, string $lastName, string $nickname, string $email): bool {
        $sql = "UPDATE users SET 
                first_name = :first_name, 
                last_name = :last_name, 
                nickname = :nickname, 
                email = :email 
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':first_name' => $firstName,
            ':last_name' => $lastName,
            ':nickname' => $nickname,
            ':email' => $email
        ]);
    }

    // 5. Smazání uživatele (Delete z CRUD) - NOVÁ METODA
    // Logiku, že to může udělat jen administrátor, budeme řešit v UserControlleru
    public function delete(int $id): bool {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([':id' => $id]);
    }

    // 6. Získání všech uživatelů (volitelné, ale hodí se administrátorovi pro správu) - NOVÁ METODA
    public function getAll() {
        $sql = "SELECT id, username, email, first_name, last_name, nickname, is_admin, created_at FROM users ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}