<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> !-->
    <title>Document</title>
</head>
<body>
    <div>
        <div>
            <h2>Vytvořit knihu</h2>
            <p>Prosim vyplněte všechna pole</p>
        </div>

        <div>
            <form action="">
                <div>
                    <div>
                        <label for="title">Název knihy<span>*</span></label>
                        <input type="text" name="title" id="title" required>
                    </div>

                    <div>
                        <label for="author">Autor knihy<span>*</span></label>
                        <input type="text" name="author" id="author" required>
                    </div>

                    <div>
                        <label for="category">Kategorie<span>*</span></label>
                        <input type="text" name="category" id="category">
                    </div>

                    <div>
                        <label for="subcategory">Podkategorie<span>*</span></label>
                        <input type="text" name="subcategory" id="subcategory">
                    </div>

                    <div>
                        <label for="year">Rok vydání<span>*</span></label>
                        <input type="number" name="year" id="year">
                    </div>

                    <div>
                        <button type="submit">Vytvořit knihu do DB</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</body>
</html>