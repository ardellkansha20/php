<?php
session_start();
require 'koneksi.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; 
    $password = $_POST['password'];

    // Cek apakah username sudah digunakan
    $cekUsername = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $cekUsername->bind_param("s", $username);
    $cekUsername->execute();
    $resultUsername = $cekUsername->get_result();

    if ($resultUsername->num_rows > 0) {
        $error = "Username telah terpakai!";
    } else {
        $id = rand(1000, 9999); // ID acak
        $stmt = $conn->prepare("INSERT INTO users (id, username, password) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $id, $username, $password);
        if ($stmt->execute()) {
            $success = "Registrasi berhasil. <a href='login.php'>Login sekarang</a>";
        } else {
            $error = "Registrasi gagal!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="box">
    <h2>Registrasi</h2>
    <?php if ($error) echo "<p class='error'>$error</p>"; ?>
    <?php if ($success) echo "<p class='success'>$success</p>"; ?>
    <form method="post">
        <label>Username:</label>
        <input type="text" name="username" required />
        <label>Password:</label>
        <input type="password" name="password" required />
        <br>
        <input type="submit" value="Register" />
    </form>
    <p>Sudah punya akun? <a href="login.php">Login</a></p>
</div>
</body>
</html>
