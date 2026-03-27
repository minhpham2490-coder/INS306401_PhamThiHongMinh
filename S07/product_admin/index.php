<?php
require_once 'Database.php';
$db = Database::getInstance()->getConnection();

// Lấy danh mục cho dropdown [cite: 150]
$categories = $db->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);

// Xử lý tìm kiếm an toàn với Prepared Statements [cite: 149, 153]
$search = $_GET['search'] ?? '';
$sql = "SELECT p.*, c.category_name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id 
        WHERE p.name LIKE :search";

$stmt = $db->prepare($sql);
$stmt->execute([':search' => "%$search%"]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Admin</title>
    <style>
        .low-stock { background-color: #ffcccc; } /* Màu đỏ cho stock < 10 [cite: 152] */
    </style>
</head>
<body>
    <h2>Quản lý sản phẩm</h2>
    
    <form method="GET">
        <input type="text" name="search" placeholder="Tìm tên..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Tìm kiếm</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th><th>Tên</th><th>Giá</th><th>Danh mục</th><th>Kho</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $p): ?>
                <tr class="<?= $p['stock'] < 10 ? 'low-stock' : '' ?>">
                    <td><?= $p['id'] ?></td>
                    <td><?= htmlspecialchars($p['name']) ?></td>
                    <td>$<?= $p['price'] ?></td>
                    <td><?= $p['category_name'] ?></td>
                    <td><?= $p['stock'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>