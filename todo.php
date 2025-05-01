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
    <input type="text" id="taskInput" placeholder="<Teks to do>" />
    <button onclick="addTask()">Tambah</button>
    <ul id="taskList"></ul>
    <br>
    <a href="logout.php">Logout</a>
</div>

<script src="script.js"></script>
</body>
</html>
