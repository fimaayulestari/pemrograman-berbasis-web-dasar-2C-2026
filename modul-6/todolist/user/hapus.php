<?php
include '../auth/cek_login.php';
include '../config/koneksi.php';

$id = $_GET['id'];

$stmt = $conn->prepare(
    "DELETE FROM tasks WHERE id=?"
);

$stmt->bind_param("i", $id);

$stmt->execute();

header("Location: dashboard.php");
?>