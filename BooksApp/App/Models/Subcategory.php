<?php

class Subcategory {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;    
    }

    // Načtení všech subkategorií
    public function getAll() {
        $sql = "SELECT id, name FROM subcategories ORDER BY name ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        // Vrací pole asociativních polí
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}