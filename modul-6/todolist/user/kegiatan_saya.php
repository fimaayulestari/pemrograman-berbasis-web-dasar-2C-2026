<?php
include '../auth/cek_login.php';
include '../config/koneksi.php';

$user_id = $_SESSION['id'];

$stmt = $conn->prepare(
    "SELECT * FROM tasks
    WHERE user_id=?
    ORDER BY id DESC"
);

$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kegiatan Saya</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex">

    <div class="w-72 bg-white h-screen p-6 shadow-lg">

        <h1 class="text-3xl font-bold text-indigo-600 mb-12">
            To-Do List
        </h1>

        <ul class="space-y-4">

            <li>
                <a href="dashboard.php"
                class="flex items-center gap-3 hover:bg-indigo-50 px-5 py-4 rounded-2xl transition">

                    📊 Dashboard

                </a>
            </li>

            <li>
                <a href="tambah.php"
                class="flex items-center gap-3 hover:bg-indigo-50 px-5 py-4 rounded-2xl transition">

                    ➕ Tambah Kegiatan

                </a>
            </li>

            <li>
                <a href="kegiatan_saya.php"
                class="flex items-center gap-3 bg-indigo-600 text-white px-5 py-4 rounded-2xl font-semibold shadow-lg">

                    📋 Kegiatan Saya

                </a>
            </li>

            <li>
                <a href="../auth/logout.php"
                class="flex items-center gap-3 hover:bg-red-100 text-red-500 px-5 py-4 rounded-2xl transition">

                    🚪 Logout

                </a>
            </li>

        </ul>

    </div>

    <div class="flex-1 p-10">

        <div class="flex justify-between items-center mb-10">

            <div>

                <h1 class="text-4xl font-bold">
                    📋 Kegiatan Saya
                </h1>

                <p class="text-gray-500 mt-2">
                    Daftar seluruh kegiatan pengguna
                </p>

            </div>

            <a href="tambah.php"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-4 rounded-2xl font-semibold transition hover:scale-105">
            + Tambah Kegiatan
            </a>

        </div>

        <div class="bg-gradient-to-r from-indigo-500 to-purple-500 p-8 rounded-3xl text-white shadow-2xl mb-8">

            <h1 class="text-3xl font-black">
                Halo, <?= htmlspecialchars($_SESSION['nama']); ?> 👋
            </h1>

            <p class="mt-3 text-lg opacity-90">
                Pantau seluruh kegiatan dan progress harian 🚀
            </p>

        </div>

        <div class="bg-white p-8 rounded-3xl shadow">

            <table class="w-full">

                <thead>

                    <tr class="border-b text-gray-500">

                        <th class="text-left p-4">No</th>
                        <th class="text-left p-4">Judul</th>
                        <th class="text-left p-4">Catatan</th>
                        <th class="text-left p-4">Tanggal</th>
                        <th class="text-left p-4">Prioritas</th>
                        <th class="text-left p-4">Status</th>
                        <th class="text-left p-4">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    <?php
                    $no = 1;

                    while($row = $result->fetch_assoc()) :
                    ?>

                    <tr class="border-b hover:bg-indigo-50 transition duration-300">

                        <td class="p-4 font-semibold">
                            <?= $no++; ?>
                        </td>

                        <td class="p-4 font-semibold text-gray-700">
                            <?= htmlspecialchars($row['judul']); ?>
                        </td>

                        <td class="p-4 text-gray-600">
                            📝 <?= htmlspecialchars($row['catatan'] ?? ''); ?>
                        </td>

                        <td class="p-4 min-w-[170px] text-gray-600 whitespace-nowrap">
                            📅 <?= htmlspecialchars($row['tanggal']); ?>
                        </td>

                        <td class="p-4 min-w-[170px]">

                            <?php
                            if($row['prioritas'] == 'Tinggi'){
                                $prioritas = 'bg-red-100 text-red-600';
                            }
                            elseif($row['prioritas'] == 'Sedang'){
                                $prioritas = 'bg-yellow-100 text-yellow-600';
                            }
                            else{
                                $prioritas = 'bg-green-100 text-green-600';
                            }
                            ?>

                            <span class="<?= $prioritas; ?> inline-flex items-center gap-1 px-4 py-2 rounded-full text-sm font-semibold whitespace-nowrap">

                                ⚡ <?= htmlspecialchars($row['prioritas']); ?>

                            </span>

                        </td>

                        <td class="p-4">

                            <?php
                            $status = $row['status'];

                            if($status == 'Selesai'){
                                $warna = 'bg-green-100 text-green-600';
                            }
                            elseif($status == 'Proses'){
                                $warna = 'bg-blue-100 text-blue-600';
                            }
                            else{
                                $warna = 'bg-red-100 text-red-600';
                            }
                            ?>

                            <span class="<?= $warna; ?> px-4 py-2 rounded-full text-sm font-semibold">

                                <?= htmlspecialchars($status); ?>

                            </span>

                        </td>

                        <td class="p-4">

                            <div class="flex items-center gap-2">

                                <a href="edit.php?id=<?= $row['id']; ?>"
                                class="bg-yellow-400 hover:bg-yellow-500 hover:scale-105 transition text-white px-4 py-2 rounded-xl text-sm font-medium shadow">

                                    Edit

                                </a>

                                <a href="hapus.php?id=<?= $row['id']; ?>"
                                onclick="return confirm('Yakin ingin menghapus?')"
                                class="bg-red-500 hover:bg-red-600 hover:scale-105 transition text-white px-4 py-2 rounded-xl text-sm font-medium shadow">

                                    Hapus

                                </a>

                            </div>

                        </td>

                    </tr>

                    <?php endwhile; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>