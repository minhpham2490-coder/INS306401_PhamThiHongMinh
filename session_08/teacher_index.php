<?php 
require 'db.php'; // Đảm bảo file db.php của bạn đã kết nối đúng school_db

// Xử lý Xóa giáo viên
if (isset($_GET['delete'])) {
    try {
        $stmt = $pdo->prepare("DELETE FROM teachers WHERE id = ?");
        $stmt->execute([$_GET['delete']]);
        header("Location: teacher_index.php");
        exit;
    } catch (PDOException $e) {
        echo "Lỗi khi xóa: " . $e->getMessage();
    }
}

// Lấy danh sách giáo viên
$teachers = $pdo->query("SELECT * FROM teachers")->fetchAll();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Giáo viên</title>
</head>
<body>
    <h2>Hệ thống quản lý trường học</h2>
    
    <nav style="background: #eee; padding: 10px; margin-bottom: 20px;">
        <a href="index.php">Quản lý Sinh viên</a> | 
        <a href="teacher_index.php"><b>Quản lý Giáo viên</b></a>
    </nav>

    <h3>Danh sách giáo viên</h3>
    <a href="teacher_create.php">Thêm giáo viên mới</a><br><br>

    <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse;">
        <tr style="background: #f2f2f2;">
            <th>ID</th>
            <th>Họ và Tên</th>
            <th>Email</th>
            <th>Môn giảng dạy</th>
            <th>Số điện thoại</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($teachers as $t): ?>
        <tr>
            <td><?= $t['id'] ?></td>
            <td><?= htmlspecialchars($t['name']) ?></td>
            <td><?= htmlspecialchars($t['email']) ?></td>
            <td><?= htmlspecialchars($t['subject']) ?></td>
            <td><?= htmlspecialchars($t['phone']) ?></td>
            <td>
                <a href="teacher_edit.php?id=<?= $t['id'] ?>">Sửa</a> | 
                <a href="teacher_index.php?delete=<?= $t['id'] ?>" 
                   onclick="return confirm('Bạn có chắc chắn muốn xóa giáo viên này?')">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>