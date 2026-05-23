<?php 
include '../auth/cek_login.php';
include '../config/koneksi.php';

if($_SESSION['role'] != 'admin'){
    header("Location: ../user/dashboard.php");
}

$total_user = $conn->query(
    "SELECT COUNT(*) as total FROM users"
)->fetch_assoc()['total'];

$total_admin = $conn->query(
    "SELECT COUNT(*) as total FROM users WHERE role='admin'"
)->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-indigo-100 via-white to-purple-100 min-h-screen">

<div class="flex">

    <div class="w-72 min-h-screen bg-white/70 backdrop-blur-xl shadow-2xl p-6 border-r">

        <div class="mb-12">

            <h1 class="text-4xl font-black text-indigo-600">
                Admin.
            </h1>

            <p class="text-gray-500 mt-2">
                Management Dashboard
            </p>

        </div>

        <ul class="space-y-3">

            <li>
                <a href="dashboard.php"
                   class="flex items-center gap-3 bg-indigo-600 text-white px-5 py-4 rounded-2xl font-semibold shadow-lg">

                    📊 Dashboard

                </a>
            </li>

            <li>
                <a href="users.php"
                   class="flex items-center gap-3 hover:bg-indigo-50 px-5 py-4 rounded-2xl transition">

                    👤 Data User

                </a>
            </li>

            <li>
                <a href="../auth/logout.php"
                   class="flex items-center gap-3 hover:bg-red-50 text-red-500 px-5 py-4 rounded-2xl transition">

                    🚪 Logout

                </a>
            </li>

        </ul>

    </div>

    <div class="flex-1 p-10">

        <div class="mb-10">

            <h1 class="text-5xl font-black text-gray-800">
                Dashboard Admin 👋
            </h1>

            <p class="text-gray-500 text-lg mt-3">
                Monitoring pengguna aplikasi
            </p>

        </div>

        <div class="grid grid-cols-2 gap-6">

            <div class="bg-white/70 backdrop-blur-xl p-8 rounded-3xl shadow-2xl">

                <div class="text-5xl mb-4">
                    👤
                </div>

                <p class="text-gray-500">
                    Total User
                </p>

                <h1 class="text-5xl font-black mt-3 text-gray-800">
                    <?= $total_user ?>
                </h1>

            </div>

            <div class="bg-white/70 backdrop-blur-xl p-8 rounded-3xl shadow-2xl">

                <div class="text-5xl mb-4">
                    🛡️
                </div>

                <p class="text-gray-500">
                    Total Admin
                </p>

                <h1 class="text-5xl font-black mt-3 text-gray-800">
                    <?= $total_admin ?>
                </h1>

            </div>

        </div>

        <div class="mt-10 bg-white/70 backdrop-blur-xl p-8 rounded-3xl shadow-2xl">

            <h2 class="text-3xl font-black text-gray-800 mb-4">
                🔒 Privasi Pengguna
            </h2>

            <p class="text-gray-600 text-lg leading-relaxed">
                Admin hanya dapat melihat jumlah pengguna aplikasi 
                tanpa melihat detail kegiatan user untuk menjaga privasi data pengguna.
            </p>

        </div>

    </div>

</div>

</body>
</html>