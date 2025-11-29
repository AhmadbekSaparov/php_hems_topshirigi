<?php
require_once 'User.php';
$user = new User();
if ($_POST) {
    if (isset($_POST['add'])) {
        $user->create($_POST['name'], $_POST['email']);
    }
    if (isset($_POST['delete'])) {
        $user->delete($_POST['id']);
    }
    if (isset($_POST['update'])) {
        $user->update($_POST['id'], $_POST['name'], $_POST['email']);
    }
    
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$users = $user->getAll();
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saparov Ahmadbek</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .container { max-width: 1000px; }
        h1 { color: #343a40; }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Barcha foydalanuvchilar</h1>
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <strong>Yangi foydalanuvchi qo'shish</strong>
        </div>
        <div class="card-body">
            <form method="POST" class="row g-3">
                <div class="col-md-5">
                    <input type="text" name="name" class="form-control" placeholder="Ism" required>
                </div>
                <div class="col-md-5">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" name="add" class="btn btn-success w-100">Qo‘shish</button>
                </div>
            </form>
        </div>
    </div>

    
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>ID</th>
                    <th>Ism</th>
                    <th>Email</th>
                    <th>Qoshilgan vaqti</th>
                    <th>Amallar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                <tr>
                    <td class="text-center"><?= $u['id'] ?></td>
                    <td><?= htmlspecialchars($u['name']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td class="text-center"><?= $u['created_at'] ?></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $u['id'] ?>">
                            Tahrirlash
                        </button>

                        <form method="POST" style="display:inline;" onsubmit="return confirm('Rostan o‘chirmoqchimisiz?');">
                            <input type="hidden" name="id" value="<?= $u['id'] ?>">
                            <button type="submit" name="delete" class="btn btn-danger btn-sm">O‘chirish</button>
                        </form>
                    </td>
                </tr>

                <div class="modal fade" id="editModal<?= $u['id'] ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST">
                                <div class="modal-header">
                                    <h5 class="modal-title">Foydalanuvchini tahrirlash</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                    <div class="mb-3">
                                        <label>Ism</label>
                                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($u['name']) ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($u['email']) ?>" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                                    <button type="submit" name="update" class="btn btn-primary">Saqlash</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>