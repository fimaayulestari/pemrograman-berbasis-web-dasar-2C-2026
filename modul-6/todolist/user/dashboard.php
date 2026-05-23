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

$total = $conn->query(
    "SELECT COUNT(*) as total
     FROM tasks
     WHERE user_id='$user_id'"
)->fetch_assoc()['total'];

$belum = $conn->query(
    "SELECT COUNT(*) as total
     FROM tasks
     WHERE status='Belum'
     AND user_id='$user_id'"
)->fetch_assoc()['total'];

$proses = $conn->query(
    "SELECT COUNT(*) as total
     FROM tasks
     WHERE status='Proses'
     AND user_id='$user_id'"
)->fetch_assoc()['total'];

$selesai = $conn->query(
    "SELECT COUNT(*) as total
     FROM tasks
     WHERE status='Selesai'
     AND user_id='$user_id'"
)->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-indigo-100 via-white to-purple-100 min-h-screen">

<div class="flex">

    <div class="w-72 min-h-screen bg-white/70 backdrop-blur-xl shadow-2xl p-6 border-r">

        <div class="mb-12">

            <h1 class="text-4xl font-black text-indigo-600">
                To-Do List
            </h1>

            <p class="text-gray-500 mt-2">
                Productivity Dashboard
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
                <a href="tambah.php"
                   class="flex items-center gap-3 hover:bg-indigo-50 px-5 py-4 rounded-2xl transition">

                    ➕ Tambah Kegiatan

                </a>
            </li>

            <li>
                <a href="kegiatan_saya.php"
                   class="flex items-center gap-3 hover:bg-indigo-50 px-5 py-4 rounded-2xl transition">

                    📋 Kegiatan Saya

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

        <div class="flex justify-between items-center mb-10">

            <div>

                <h1 class="text-5xl font-black text-gray-800">
                    Halo, <?= htmlspecialchars($_SESSION['nama']); ?> 👋
                </h1>

                <p class="text-gray-500 text-lg mt-3">
                    Kelola seluruh kegiatan dengan lebih produktif
                </p>

            </div>

            <a href="tambah.php"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-semibold shadow-xl transition hover:scale-105">

               + Tambah Kegiatan

            </a>

        </div>

        <div class="grid grid-cols-4 gap-6 mb-10">

            <div class="bg-white/70 backdrop-blur-xl p-7 rounded-3xl shadow-xl hover:scale-105 transition">

                <div class="text-5xl mb-4">
                    📋
                </div>

                <p class="text-gray-500">
                    Total Kegiatan
                </p>

                <h1 class="text-5xl font-black mt-3 text-gray-800">
                    <?= $total ?>
                </h1>

            </div>

            <div class="bg-red-100 p-7 rounded-3xl shadow-xl hover:scale-105 transition">

                <div class="text-5xl mb-4">
                    ⏳
                </div>

                <p class="text-red-500">
                    Belum
                </p>

                <h1 class="text-5xl font-black mt-3 text-red-600">
                    <?= $belum ?>
                </h1>

            </div>

            <div class="bg-blue-100 p-7 rounded-3xl shadow-xl hover:scale-105 transition">

                <div class="text-5xl mb-4">
                    🚀
                </div>

                <p class="text-blue-500">
                    Proses
                </p>

                <h1 class="text-5xl font-black mt-3 text-blue-600">
                    <?= $proses ?>
                </h1>

            </div>

            <div class="bg-green-100 p-7 rounded-3xl shadow-xl hover:scale-105 transition">

                <div class="text-5xl mb-4">
                    ✅
                </div>

                <p class="text-green-500">
                    Selesai
                </p>

                <h1 class="text-5xl font-black mt-3 text-green-600">
                    <?= $selesai ?>
                </h1>

            </div>

        </div>

        <div class="bg-white/70 backdrop-blur-xl p-8 rounded-3xl shadow-2xl">

            <div class="flex justify-between items-center mb-8">

                <div>

                    <h1 class="text-3xl font-black text-gray-800">
                        Daftar Kegiatan
                    </h1>

                    <p class="text-gray-500 mt-2">
                        Semua aktivitas terbaru pengguna
                    </p>

                </div>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="text-gray-500 border-b">

                            <th class="text-left p-5">No</th>
                            <th class="text-left p-5">Judul</th>
                            <th class="text-left p-5">Tanggal</th>
                            <th class="text-left p-5">Prioritas</th>
                            <th class="text-left p-5">Status</th>
                            <th class="text-left p-5">Aksi</th>

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
                                <?= htmlspecialchars($row['judul']); ?>
                            </td>

                            <td class="p-5 text-gray-500">
                                <?= htmlspecialchars($row['tanggal']); ?>
                            </td>

                            <td class="p-5">
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

                                <span class="<?= $prioritas; ?> px-4 py-2 rounded-full text-sm font-semibold">

                                    ⚡ <?= htmlspecialchars($row['prioritas']); ?>

                                </span>

                            </td>

                            </td>

                            <td class="p-5">

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

                                <span class="<?= $warna; ?> px-4 py-2 rounded-full text-sm">

                                    <?= htmlspecialchars($status); ?>

                                </span>

                            </td>

                            <td class="p-5 space-x-2">

                                <a href="edit.php?id=<?= $row['id']; ?>"
                                   class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-xl shadow">

                                   Edit

                                </a>

                                <a href="hapus.php?id=<?= $row['id']; ?>"
                                   onclick="return confirm('Yakin ingin menghapus?')"
                                   class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl shadow">

                                   Hapus

                                </a>

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