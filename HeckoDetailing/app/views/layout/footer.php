</main>
    <footer>
        &copy; <?= date('Y') ?> HEČKO Detailing. Všechna práva vyhrazena.
    </footer>

    <script>
        // Automatická ochrana proti dvojkliku a Loading indikátor u všech formulářů
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    // Najdeme hlavní tlačítko typu submit v tomto formuláři
                    const submitBtn = this.querySelector('button[type="submit"]');
                    
                    if (submitBtn) {
                        // Pokud už má tlačítko třídu loading, znamená to, že už se odesílá - zastavíme další akci
                        if (submitBtn.classList.contains('btn-loading')) {
                            e.preventDefault();
                            return;
                        }
                        
                        // Přidáme loading třídu a změníme text na "Ukládám..." nebo "Zpracovávám..."
                        submitBtn.classList.add('btn-loading');
                        
                        // Bezpečně přepíšeme obsah tlačítka, ale zachováme jeho původní velikost
                        submitBtn.innerHTML = '<span class="spinner"></span> Zpracovávám...';
                    }
                });
            });
        });
    </script>
    
</body>
</html>