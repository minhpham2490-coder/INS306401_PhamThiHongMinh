<?php 
require 'db.php';
$sql = "SELECT e.id, s.name as student_name, c.title as course_name, e.enrolled_at 
        FROM enrollments e
        JOIN students s ON e.student_id = s.id
        JOIN courses c ON e.course_id = c.id
        ORDER BY e.enrolled_at DESC";
$enrollments = $pdo->query($sql)->fetchAll();
?>

<h2>Danh sách đăng ký học</h2>
<nav>
    <a href="index.php">Sinh viên</a> | 
    <a href="teacher_index.php">Giáo viên</a> | 
    <b>Đăng ký học</b>
</nav>
<br>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th><th>Sinh viên</th><th>Khóa học</th><th>Ngày đăng ký</th>
    </tr>
    <?php foreach ($enrollments as $e): ?>
    <tr>
        <td><?= $e['id'] ?></td>
        <td><?= htmlspecialchars($e['student_name']) ?></td>
        <td><?= htmlspecialchars($e['course_name']) ?></td>
        <td><?= $e['enrolled_at'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>