<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>To Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="box">
    <div class="input-container">
        <input type="text" id="taskInput" placeholder="<Teks to do>" />
        <button onclick="addTask()">Tambah</button>
    </div>

    <div id="taskList"></div>

    <br>
    <a href="logout.php">Logout</a>
</div>

<script src="script.js"></script>
</body>
</html>
