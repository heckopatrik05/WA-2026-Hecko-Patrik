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
                        <td><?= htmlspecialchars($book['year']) ?></td>
                        <td><?= htmlspecialchars($book['price']) ?> Kč</td>
                        
                        <td>
                            <div class="actions">
                                <a href="<?= BASE_URL ?>/index.php?url=book/show/<?= $book['id'] ?>" class="action-btn btn-detail">Detail</a>
                                
                                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $book['created_by']): ?>
                                    <a href="<?= BASE_URL ?>/index.php?url=book/edit/<?= $book['id'] ?>" class="action-btn btn-edit">Upravit</a>
                                    <a href="<?= BASE_URL ?>/index.php?url=book/delete/<?= $book['id'] ?>" onclick="return confirm('Opravdu chcete tuto knihu smazat?')" class="action-btn btn-delete">Smazat</a>
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