<?php 
require 'db.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$s = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("UPDATE students SET name=?, email=?, phone=?, course=? WHERE id=?");
    $stmt->execute([$_POST['name'], $_POST['email'], $_POST['phone'], $_POST['course'], $id]);
    header("Location: index.php");
}
?>
<h2>Sửa sinh viên</h2>
<form method="POST">
    Tên: <input type="text" name="name" value="<?= $s['name'] ?>"><br>
    Email: <input type="email" name="email" value="<?= $s['email'] ?>"><br>
    SĐT: <input type="text" name="phone" value="<?= $s['phone'] ?>"><br>
    Khóa học: <input type="text" name="course" value="<?= $s['course'] ?>"><br>
    <button type="submit">Cập nhật</button>
</form>