<?php
// Koneksi database
$koneksi = new mysqli("localhost", "root", "", "dbplatform");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = "admin"; // sudah fix
    $password = $_POST['password'];

    // Cek apakah password sudah digunakan
    $cekPassword = $koneksi->prepare("SELECT * FROM tbplatform WHERE password = ?");
    $cekPassword->bind_param("s", $password);
    $cekPassword->execute();
    $resultPassword = $cekPassword->get_result();

    if ($resultPassword->num_rows > 0) {
        $error = "Password telah terpakai!";
    }else {$id = rand(1000, 9999);
           $stmt = $koneksi->prepare("INSERT INTO tbplatform (id, username, password) VALUES (?, ?, ?)");
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
        <input type="text" name="username" value="admin" readonly required />
        <label>Password:</label>
        <input type="password" name="password" required />
        <br>
        <input type="submit" value="Register" />
    </form>
    <p>Sudah punya akun? <a href="login.php">Login</a></p>
</div>
</body>
</html>
