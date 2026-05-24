<?php
class Sklad {
    private $conn;
    private $table_name = "sklad_produkty";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Načtení všech produktů ze skladu
    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY nazev ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Načtení jednoho produktu podle ID
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Přidání nového produktu
    public function create($nazev, $znacka, $cena_ks, $skladem, $minimum, $jednotka) {
        $query = "INSERT INTO " . $this->table_name . " (nazev, znacka, cena_ks, skladem, minimum, jednotka) 
                  VALUES (:nazev, :znacka, :cena_ks, :skladem, :minimum, :jednotka)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':nazev', $nazev);
        $stmt->bindParam(':znacka', $znacka);
        $stmt->bindParam(':cena_ks', $cena_ks);
        $stmt->bindParam(':skladem', $skladem);
        $stmt->bindParam(':minimum', $minimum);
        $stmt->bindParam(':jednotka', $jednotka);
        
        return $stmt->execute();
    }

    // Úprava stávajícího produktu
    public function update($id, $nazev, $znacka, $cena_ks, $skladem, $minimum, $jednotka) {
        $query = "UPDATE " . $this->table_name . " 
                  SET nazev = :nazev, znacka = :znacka, cena_ks = :cena_ks, skladem = :skladem, minimum = :minimum, jednotka = :jednotka 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':nazev', $nazev);
        $stmt->bindParam(':znacka', $znacka);
        $stmt->bindParam(':cena_ks', $cena_ks);
        $stmt->bindParam(':skladem', $skladem);
        $stmt->bindParam(':minimum', $minimum);
        $stmt->bindParam(':jednotka', $jednotka);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }

    // Smazání produktu
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>