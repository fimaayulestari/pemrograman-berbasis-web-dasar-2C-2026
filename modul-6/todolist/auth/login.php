<?php
session_start();
include '../config/koneksi.php';

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();

    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if($data && password_verify($password,$data['password'])){

        $_SESSION['login'] = true;
        $_SESSION['id'] = $data['id'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role'] = $data['role'];

        if($data['role'] == 'admin'){
            header("Location: ../admin/dashboard.php");
        }else{
            header("Location: ../user/dashboard.php"); 
        }

    }else{
        $error = "Email atau Password Salah";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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
            Silakan login untuk melanjutkan
        </p>

    </div>

    <?php if(isset($error)) : ?>
        <div class="bg-red-100 text-red-600 p-3 rounded-xl mb-5">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <div class="mb-5">

            <label class="font-semibold">
                Email
            </label>

            <input
                type="email"
                name="email"
                required
                class="w-full border mt-2 p-4 rounded-xl outline-none focus:ring-2 focus:ring-indigo-500"
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
                class="w-full border mt-2 p-4 rounded-xl outline-none focus:ring-2 focus:ring-indigo-500"
            >

        </div>

        <button
            type="submit"
            name="login"
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white p-4 rounded-xl font-semibold">
            Login
        </button>

    </form>

    <p class="text-center mt-6">
        Belum punya akun?
        <a href="register.php" class="text-indigo-600 font-semibold">
            Daftar
        </a>
    </p>

</div>

</body>
</html>