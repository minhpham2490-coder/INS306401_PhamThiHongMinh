<?php 
require 'db.php';
// Lấy danh sách để đổ vào dropdown
$students = $pdo->query("SELECT id, name FROM students")->fetchAll();
$courses = $pdo->query("SELECT id, title FROM courses")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("INSERT INTO enrollments (student_id, course_id) VALUES (?, ?)");
    $stmt->execute([$_POST['student_id'], $_POST['course_id']]);
    header("Location: enrollment_list.php");
}
?>
<h2>Đăng ký khóa học mới</h2>
<form method="POST">
    Chọn sinh viên: 
    <select name="student_id">
        <?php foreach ($students as $s): ?>
            <option value="<?= $s['id'] ?>"><?= $s['name'] ?></option>
        <?php endforeach; ?>
    </select><br><br>

    Chọn khóa học: 
    <select name="course_id">
        <?php foreach ($courses as $c): ?>
            <option value="<?= $c['id'] ?>"><?= $c['title'] ?></option>
        <?php endforeach; ?>
    </select><br><br>
    
    <button type="submit">Đăng ký</button>
</form>
