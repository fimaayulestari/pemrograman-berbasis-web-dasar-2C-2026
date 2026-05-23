<?php
include '../auth/cek_login.php';
include '../config/koneksi.php';

$result = $conn->query(
    "SELECT * FROM users"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>

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
                   class="flex items-center gap-3 hover:bg-indigo-50 px-5 py-4 rounded-2xl transition">

                    📊 Dashboard

                </a>
            </li>

            <li>
                <a href="users.php"
                   class="flex items-center gap-3 bg-indigo-600 text-white px-5 py-4 rounded-2xl font-semibold shadow-lg">

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

        <div class="bg-white/70 backdrop-blur-xl p-10 rounded-3xl shadow-2xl">

            <h1 class="text-5xl font-black text-gray-800 mb-3">
                Data User 👤
            </h1>

            <p class="text-gray-500 text-lg mb-10">
                Seluruh data pengguna aplikasi
            </p>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="border-b text-gray-500">

                            <th class="p-5 text-left">No</th>
                            <th class="p-5 text-left">Nama</th>
                            <th class="p-5 text-left">Email</th>
                            <th class="p-5 text-left">Role</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php
                        $no = 1;

                        while($row = $result->fetch_assoc()) :
                        ?>

                        <tr class="border-b hover:bg-indigo-50 transition">

                            <td class="p-5 font-semibold">
                                <?= $no++; ?>
                            </td>

                            <td class="p-5 font-semibold text-gray-700">
                                <?= htmlspecialchars($row['nama']); ?>
                            </td>

                            <td class="p-5 text-gray-600">
                                <?= htmlspecialchars($row['email']); ?>
                            </td>

                            <td class="p-5">

                                <?php
                                if($row['role'] == 'admin'){
                                    $role = 'bg-indigo-100 text-indigo-600';
                                }
                                else{
                                    $role = 'bg-green-100 text-green-600';
                                }
                                ?>

                                <span class="<?= $role; ?> px-4 py-2 rounded-full text-sm font-semibold">

                                    <?= htmlspecialchars($row['role']); ?>

                                </span>

                            </td>

                        </tr>

                        <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>
</html>