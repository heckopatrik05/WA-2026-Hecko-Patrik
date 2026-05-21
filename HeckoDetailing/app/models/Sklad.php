<?php

class Sklad {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;    
    }

    // Načtení všech produktů ze skladu
    public function getAll() {
        $sql = "SELECT * FROM sklad_produkty ORDER BY znacka ASC, nazev ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}