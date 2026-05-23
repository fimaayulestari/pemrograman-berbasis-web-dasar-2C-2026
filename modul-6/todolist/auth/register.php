<?php
include '../config/koneksi.php';

if(isset($_POST['register'])){

    $nama = $_POST['nama'];
    $email = $_POST['email'];

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    $stmt = $conn->prepare(
        "INSERT INTO users(nama,email,password)
         VALUES(?,?,?)"
    );

    $stmt->bind_param(
        "sss",
        $nama,
        $email,
        $password
    );

    $stmt->execute();

    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="bg-white w-[420px] p-10 rounded-3xl shadow-xl">

    <div class="text-center mb-8">

        <div class="text-6xl mb-4">
            📋
        </div>

        <h1 class="text-4xl font-bold">
            To-Do List
        </h1>

        <p class="text-gray-500 mt-2">
            Buat akun baru
        </p>

    </div>

    <form method="POST">

        <div class="mb-4">

            <label class="font-semibold">
                Nama
            </label>

            <input
                type="text"
                name="nama"
                required
                class="w-full border mt-2 p-4 rounded-xl"
            >

        </div>

        <div class="mb-4">

            <label class="font-semibold">
                Email
            </label>

            <input
                type="email"
                name="email"
                required
                class="w-full border mt-2 p-4 rounded-xl"
            >

        </div>

        <div class="mb-6">

            <label class="font-semibold">
                Password
            </label>

            <input
                type="password"
                name="password"
                required
                class="w-full border mt-2 p-4 rounded-xl"
            >

        </div>

        <button
            type="submit"
            name="register"
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white p-4 rounded-xl font-semibold"
        >
            Register
        </button>

    </form>

</div>

</body>
</html>