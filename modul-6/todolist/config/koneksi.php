<?php
$conn = new mysqli("localhost", "root", "", "db_todolist");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>