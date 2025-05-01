<?php
session_start();
$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'platform' && $password === 'platform') {
        $_SESSION['loggedin'] = true;
        header("Location: todo.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="box">
    <h2>Login</h2>
    <?php if ($error) echo "<p class='error'>$error</p>"; ?>
    <form method="post">
        <label>User Name :</label>
        <input type="text" name="username" required />
        <label>Password :</label>
        <input type="password" name="password" required />
        <br>
        <input type="submit" value="Submit" />
    </form>
</div>
</body>
</html>
