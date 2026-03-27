<?php 
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("INSERT INTO students (name, email, phone, course) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_POST['name'], $_POST['email'], $_POST['phone'], $_POST['course']]);
    header("Location: index.php");
}
?>
<h2>Thêm sinh viên</h2>
<form method="POST">
    Tên: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    SĐT: <input type="text" name="phone"><br>
    Khóa học: <input type="text" name="course"><br>
    <button type="submit">Lưu</button>
</form>