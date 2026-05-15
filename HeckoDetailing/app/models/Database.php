<?php

class Database {
    private $host = "localhost";
    // TADY SI UPRAV NÁZEV DATABÁZE podle toho, jak sis ji pojmenoval v phpMyAdmin
    private $db_name = "wa_2026_sem-projekt_ph"; 
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        
        // Odpojí připojení k databázi tím, že změní proměnnou $this->conn na null.
        $this->conn = null;
        
        try {
            // PDO (PHP Data Objects) – Bezpečné a univerzální připojení k databázi
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            
            // Nastavení kódování na UTF-8, aby fungovala česká diakritika
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Výpis pro testování je zakomentovaný, aby nerozbíjel přesměrování a design
            // echo "Připojení k databázi bylo úspěšné!<br>";
            
        } catch (PDOException $exception) {
            echo "Chyba připojení: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

// Pro otestování připojení stačí tento soubor spustit
// V produkci a MVC frameworku toto volání na konci souboru nepotřebujeme, 
// připojení si zavolá až konkrétní Controller nebo Model.

// $database = new Database();
// $database->getConnection();