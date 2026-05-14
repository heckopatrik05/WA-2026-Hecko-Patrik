<?php require_once '../app/views/layout/header.php'; ?>

<h2 style="margin-top: 0; margin-bottom: 1.5rem; font-size: 1.75rem; font-weight: 700;">Dostupné knihy</h2>

<?php if (empty($books)): ?>
    <div class="table-container" style="padding: 3rem; text-align: center; color: var(--text-muted); font-style: italic;">
        V databázi se zatím nenachází žádné knihy.
    </div>
<?php else: ?>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Název knihy</th>
                    <th>Autor</th>
                    <th>Kategorie</th>
                    <th>Rok vydání</th>
                    <th>Cena</th>
                    <th>Akce</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?= htmlspecialchars($book['id']) ?></td>
                        <td style="font-weight: 600; color: var(--text-dark);"><?= htmlspecialchars($book['title']) ?></td>
                        <td><?= htmlspecialchars($book['author']) ?></td>
                        <td class="px-6 py-4 text-emerald-400 font-medium"><?= htmlspecialchars($book['category_name'] ?? 'Nezařazeno') ?></td>
                        <td><?= htmlspecialchars($book['year']) ?></td>
                        <td><?= htmlspecialchars($book['price']) ?> Kč</td>
                        
                        <td>
                            <div class="actions">
                                <a href="<?= BASE_URL ?>/index.php?url=book/show/<?= $book['id'] ?>" class="action-btn btn-detail">Detail</a>
                                
                                <?php 
                                    // Pomocné proměnné pro čistší kód
                                    $isLoggedIn = isset($_SESSION['user_id']);
                                    $isOwner = $isLoggedIn && $_SESSION['user_id'] === $book['created_by'];
                                    $isAdmin = $isLoggedIn && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;

                                    // Zobrazíme, pokud je uživatel autor, NEBO pokud je administrátor
                                    if ($isOwner || $isAdmin): 
                                        
                                        // Pokud kniha není jeho vlastní (tzn. je to admin zasahující cizímu uživateli), použijeme jiné styly
                                        $editBtnClass = $isOwner ? 'btn-edit' : 'btn-edit-admin';
                                        $deleteBtnClass = $isOwner ? 'btn-delete' : 'btn-delete-admin';
                                        $adminSuffix = !$isOwner ? ' (Admin)' : '';
                                    ?>
                                        <a href="<?= BASE_URL ?>/index.php?url=book/edit/<?= $book['id'] ?>" class="action-btn <?= $editBtnClass ?>">Upravit<?= $adminSuffix ?></a>
                                        <a href="<?= BASE_URL ?>/index.php?url=book/delete/<?= $book['id'] ?>" onclick="return confirm('Opravdu chcete tuto knihu smazat?')" class="action-btn <?= $deleteBtnClass ?>">Smazat<?= $adminSuffix ?></a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php require_once '../app/views/layout/footer.php'; ?>