<?php
class Comment {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;    
    }

    // 1. Získání všech komentářů k jedné konkrétní zakázce (Read)
    public function getByZakazkaId($zakazkaId) {
        $sql = "SELECT c.*, u.username, u.nickname 
                FROM comments c 
                JOIN users u ON c.user_id = u.id 
                WHERE c.zakazka_id = :zakazka_id 
                ORDER BY c.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':zakazka_id' => $zakazkaId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2. Přidání nového komentáře (Create)
    public function addComment($zakazkaId, $userId, $content) {
        $sql = "INSERT INTO comments (zakazka_id, user_id, content) VALUES (:zakazka_id, :user_id, :content)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':zakazka_id' => $zakazkaId,
            ':user_id' => $userId,
            ':content' => $content
        ]);
    }

    // 3. Získání jednoho konkrétního komentáře podle jeho ID
    public function getById($id) {
        $sql = "SELECT * FROM comments WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 4. Úprava existujícího komentáře (Update)
    public function updateComment($id, $content) {
        $sql = "UPDATE comments SET content = :content WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':content' => $content
        ]);
    }

    // 5. Smazání komentáře (Delete)
    public function deleteComment($id) {
        $sql = "DELETE FROM comments WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}