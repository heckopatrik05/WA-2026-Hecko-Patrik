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
            <form action="../../controllers/BookController.php" method="post" enctype="multipart/form-data">
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
                        <label for="isbn">ISBN<span>*</span></label>
                        <input type="text" name="isbn" id="isbn">
                    </div>

                    <div>
                        <label for="category">Kategorie<span>*</span></label>
                        <input type="text" name="category" id="category">
                    </div>

                    <div>
                        <label for="subcategory">Podkategorie</label>
                        <input type="text" name="subcategory" id="subcategory">
                    </div>

                    <div>
                        <label for="year">Rok vydání<span>*</span></label>
                        <input type="number" name="year" id="year">
                    </div>

                    <div>
                        <label for="price">Cena</label>
                        <input type="number" name="price" id="price" step="0.5" min="0">
                    </div>

                    <div>
                        <label for="link">Odkaz</label>
                        <input type="text" name="link" id="link">
                    </div>

                    <div>
                        <label for="description">Popis knihy</label>
                        <textarea name="description" id="description">Popis knihy:</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Obrázky (můžete nahrát více)</label>
                        <label class="flex flex-col items-center justify-center w-full p-6 border-2 border-dashed border-gray-300 rounded-2xl cursor-pointer hover:border-indigo-500 hover:bg-indigo-50 transition">
                            <span class="text-gray-600 font-medium">Klikni pro výběr souborů</span>
                            <span class="text-sm text-gray-400 mt-1">JPG / PNG / WebP – více souborů najednou</span>
                            <input type="file" id="images" name="images[]" multiple accept="image/*" class="hidden">
                        </label>
                    </div>

                    <div>
                        <button type="submit">Uložit knihu do DB</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</body>
</html>