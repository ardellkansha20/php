<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

// Ambil user_id dari username
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$userResult = $stmt->get_result();
$userData = $userResult->fetch_assoc();
$user_id = $userData['id'] ?? null;

// Menangani tambah
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['tambah'])) {
        $todo = htmlspecialchars($_POST['todo']);
        $stmt = $conn->prepare("INSERT INTO todolist (user_id, teks) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $todo);
        $stmt->execute();
    }

    // Menangani selesai
    if (isset($_POST['selesai'])) {
        $task_id = $_POST['task_id'];
        $stmt = $conn->prepare("UPDATE todolist SET selesai = 1 WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $task_id, $user_id);
        $stmt->execute();
    }

    // Menangani hapus
    if (isset($_POST['hapus'])) {
        $task_id = $_POST['task_id'];
        $stmt = $conn->prepare("DELETE FROM todolist WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $task_id, $user_id);
        $stmt->execute();
    }
    header("Location: todo.php");
    exit;
}

// Ambil semua data
$stmt = $conn->prepare("SELECT * FROM todolist WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$todos = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="box">
    <!-- Bagian Profil -->
    <div class="profile" style="text-align: center; margin-bottom: 30px;">
        <img src="ardellkansha.jpeg" alt="Foto Profil" style="width: 150px; height: 200px; border-radius: 10px;">
        <h2>Ardell Aurelio Kansha / 235314040</h2>
        <p>Selamat datang, <strong><?php echo htmlspecialchars($username); ?></strong>!</p>
    </div>

    <!-- Input To Do -->
    <form method="POST" class="input-container">
        <input type="text" name="todo" placeholder="Teks to do" required />
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <!-- Daftar To Do -->
    <div id="taskList">
        <?php while ($row = $todos->fetch_assoc()): ?>
            <form method="POST" class="task-form">
                <input type="hidden" name="task_id" value="<?php echo $row['id']; ?>">
                <input type="text" value="<?php echo htmlspecialchars($row['teks']); ?>" readonly
                       class="task-text <?php if ($row['selesai']) echo 'completed'; ?>">

                <div class="task-buttons">
                    <?php if (!$row['selesai']): ?>
                        <button type="submit" name="selesai" class="selesai-btn">Selesai</button>
                    <?php endif; ?>
                    <button type="submit" name="hapus" class="hapus-btn">Hapus</button>
                </div>
            </form>
        <?php endwhile; ?>
    </div>

    <br>
    <a href="logout.php">Logout</a>
</div>
</body>
</html>
