<?php
// Tên host chính là tên service của database trong docker-compose
$host = 'db'; 
$db   = 'student_db';
$user = 'root';
$pass = 'root123';

// Kết nối Database
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý Thêm sinh viên
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $conn->query("INSERT INTO students (name, email) VALUES ('$name', '$email')");
    header("Location: index.php");
}

// Xử lý Xóa sinh viên
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM students WHERE id=$id");
    header("Location: index.php");
}

// Lấy danh sách
$result = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html>
<head><title>Quản lý Sinh viên</title></head>
<body>
    <h2>Danh sách Sinh viên</h2>
    <form method="POST">
        Họ tên: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit" name="add">Thêm mới</button>
    </form>
    <br>
    <table border="1" cellpadding="10">
        <tr><th>ID</th><th>Họ tên</th><th>Email</th><th>Hành động</th></tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><a href="?delete=<?= $row['id'] ?>">Xóa</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>