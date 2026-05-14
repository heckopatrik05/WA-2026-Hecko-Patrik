<?php

class App {
    protected $controller = 'ZakazkaController';
    protected $method = 'index'; 
    protected $params = [];

    public function __construct() {
        // Získání a rozsekání URL adresy na jednotlivá slova
        $url = $this->parseUrl();

        // 1. KONTROLER: Kontrola, zda existuje soubor pro kontroler zadaný v URL
        if (isset($url[0]) && file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }

        // Načtení souboru s kontrolerem a vytvoření jeho instance
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // 2. METODA: Kontrola, zda metoda existuje v daném kontroleru
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // 3. PARAMETRY: Zbytek URL se uloží jako parametry
        $this->params = $url ? array_values($url) : [];

        // Spuštění metody s parametry
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Pomocná metoda pro zpracování URL adresy
    public function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}