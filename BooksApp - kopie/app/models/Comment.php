<?php
class Comment {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;    
    }

    public function getByBookId($bookId) {
        // Připojíme i tabulku uživatelů, abychom znali jméno/přezdívku autora komentáře
        $sql = "SELECT c.*, u.username, u.nickname 
                FROM comments c 
                JOIN users u ON c.user_id = u.id 
                WHERE c.book_id = :book_id 
                ORDER BY c.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':book_id' => $bookId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addComment($bookId, $userId, $content) {
        $sql = "INSERT INTO comments (book_id, user_id, content) VALUES (:book_id, :user_id, :content)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':book_id' => $bookId,
            ':user_id' => $userId,
            ':content' => $content
        ]);
    }
}