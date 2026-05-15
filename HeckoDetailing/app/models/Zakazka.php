<?php

class Zakazka {
    // Definice, že proměnná $db musí být vždy instancí třídy PDO
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;    
    }

    // Vytvoření nové zakázky (dříve knihy)
    public function create(
        string $spz,
        string $znacka_model,
        string $typ_sluzby,
        string $popis_stavu,
        float $cena,
        string $stav,
        array $images,
        int $userId 
    ): bool {
        // Zápis do tabulky zakazky
        $sql = "INSERT INTO zakazky (spz, znacka_model, typ_sluzby, popis_stavu, cena, stav, images, user_id)
                VALUES (:spz, :znacka_model, :typ_sluzby, :popis_stavu, :cena, :stav, :images, :user_id)";
        
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':spz' => $spz,
            ':znacka_model' => $znacka_model,
            ':typ_sluzby' => $typ_sluzby,
            ':popis_stavu' => $popis_stavu,
            ':cena' => $cena,
            ':stav' => $stav,
            ':images' => json_encode($images), // Uložení obrázků ve formátu JSON (stejně jako u knih)
            ':user_id' => $userId 
        ]);
    }

    // Získání zakázek z databáze (s filtrem a stránkováním)
    public function getAll($search = '', $stav = '', $limit = 5, $offset = 0) {
        $sql = "SELECT zakazky.*, users.username AS author_name 
                FROM zakazky 
                LEFT JOIN users ON zakazky.user_id = users.id 
                WHERE 1=1"; 
        
        $params = [];

        if (!empty($search)) {
            $sql .= " AND spz LIKE :search";
            $params[':search'] = '%' . $search . '%';
        }

        if (!empty($stav)) {
            $sql .= " AND stav = :stav";
            $params[':stav'] = $stav;
        }

        // Zabezpečení proti SQL injection pro LIMIT a OFFSET
        $limit = intval($limit);
        $offset = intval($offset);
        
        $sql .= " ORDER BY zakazky.id DESC LIMIT $limit OFFSET $offset";
                
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // NOVÉ: Spočítá celkový počet zakázek (nutné pro výpočet počtu stránek)
    public function getTotalCount($search = '', $stav = '') {
        $sql = "SELECT COUNT(*) as total FROM zakazky WHERE 1=1";
        $params = [];

        if (!empty($search)) {
            $sql .= " AND spz LIKE :search";
            $params[':search'] = '%' . $search . '%';
        }

        if (!empty($stav)) {
            $sql .= " AND stav = :stav";
            $params[':stav'] = $stav;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row['total'];
    }

    // Získání jedné konkrétní zakázky podle jejího ID
    public function getById($id) {
        $sql = "SELECT * FROM zakazky WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        // Používá se fetch(), protože očekáváme maximálně jeden výsledek
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Aktualizace existující zakázky
    public function update(
        $id, $spz, $znacka_model, $typ_sluzby, 
        $popis_stavu, $cena, $stav, $images = [],
        $userId = null 
    ) {
        $sql = "UPDATE zakazky 
                SET spz = :spz, 
                    znacka_model = :znacka_model, 
                    typ_sluzby = :typ_sluzby, 
                    popis_stavu = :popis_stavu, 
                    cena = :cena, 
                    stav = :stav, 
                    images = :images,
                    updated_by = :updated_by 
                WHERE id = :id";
                
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':spz' => $spz,
            ':znacka_model' => $znacka_model,
            ':typ_sluzby' => $typ_sluzby,
            ':popis_stavu' => $popis_stavu,
            ':cena' => $cena,
            ':stav' => $stav,
            ':images' => json_encode($images),
            ':updated_by' => $userId // Pro případnou auditní stopu, kdo provedl úpravu
        ]);
    }

    // Trvalé smazání zakázky z databáze
    public function delete($id) {
        $sql = "DELETE FROM zakazky WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([':id' => $id]);
    }
    // Získání celkových statistik pro administrátora
    public function getStatistics() {
        $sql = "SELECT 
                    COUNT(id) as total_jobs,
                    SUM(cena) as total_revenue,
                    SUM(CASE WHEN stav = 'Přijato' OR stav = 'Probíhá' THEN 1 ELSE 0 END) as active_jobs
                FROM zakazky";
                
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}