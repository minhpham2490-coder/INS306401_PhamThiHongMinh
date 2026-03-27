<?php 
require 'db.php';
// Xử lý Xóa nếu có id truyền vào
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header("Location: index.php");
}
$students = $pdo->query("SELECT * FROM students")->fetchAll();
?>

<h2>Danh sách sinh viên</h2>
<a href="create.php">Thêm sinh viên mới</a><br><br>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th><th>Tên</th><th>Email</th><th>Khóa học</th><th>Hành động</th>
    </tr>
    <?php foreach ($students as $s): ?>
    <tr>
        <td><?= $s['id'] ?></td>
        <td><?= htmlspecialchars($s['name']) ?></td>
        <td><?= htmlspecialchars($s['email']) ?></td>
        <td><?= htmlspecialchars($s['course']) ?></td>
        <td>
            <a href="edit.php?id=<?= $s['id'] ?>">Sửa</a> | 
            <a href="index.php?delete=<?= $s['id'] ?>" onclick="return confirm('Xóa nhé?')">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>