<?php

class BookController {

    // 0. Výchozí metoda pro zobrazení úvodní stránky
    public function index() {
        // V dalších krocích se zde přidá komunikace s Modelem pro získání dat z databáze
        // (např. načtení všech uložených knih)
        
        // Nyní se pouze načte (vloží) připravený soubor s HTML strukturou
        require_once '../app/views/books/books_list.php';
    }

    // 1. Zobrazení formuláře pro přidání nové knihy
    public function create() {
        // Zde se pouze načte (vloží) připravený soubor s HTML formulářem
        require_once '../app/views/books/book_create.php';
    }
}