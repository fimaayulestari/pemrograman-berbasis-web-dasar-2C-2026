<?php
include '../auth/cek_login.php';
include '../config/koneksi.php';

if(isset($_POST['simpan'])){

    $user_id = $_SESSION['id'];

    $judul = $_POST['judul'];
    $catatan = $_POST['catatan'];
    $tanggal = $_POST['tanggal'];
    $prioritas = $_POST['prioritas'];
    $status = $_POST['status'];

    $stmt = $conn->prepare(
        "INSERT INTO tasks
        (user_id,judul,catatan,tanggal,prioritas,status)
        VALUES(?,?,?,?,?,?)"
    );

    $stmt->bind_param(
        "isssss",
        $user_id,
        $judul,
        $catatan,
        $tanggal,
        $prioritas,
        $status
    );

    $stmt->execute();

    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kegiatan</title>
    <style>
        #tanggal::-webkit-calendar-picker-indicator {
            display: none;
        }
    </style>

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
                   class="flex items-center gap-3 hover:bg-indigo-50 px-5 py-4 rounded-2xl transition">

                    📊 Dashboard

                </a>
            </li>

            <li>
                <a href="tambah.php"
                   class="flex items-center gap-3 bg-indigo-600 text-white px-5 py-4 rounded-2xl font-semibold shadow-lg">

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

        <div class="bg-white/70 backdrop-blur-xl p-10 rounded-3xl shadow-2xl">

            <h1 class="text-5xl font-black text-gray-800 mb-2">
                Tambah Kegiatan ✨
            </h1>

            <p class="text-gray-500 mb-10 text-lg">
                Buat kegiatan baru
            </p>

            <form method="POST">

                <div class="mb-6">

                    <label class="font-semibold text-gray-700">
                        Judul
                    </label>

                    <input
                        type="text"
                        name="judul"
                        required
                        class="w-full border border-gray-200 p-4 rounded-2xl mt-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    >

                </div>

                <div class="mb-6">

                    <label class="font-semibold text-gray-700">
                        Catatan
                    </label>

                    <textarea
                        name="catatan"
                        rows="5"
                        class="w-full border border-gray-200 p-4 rounded-2xl mt-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    ></textarea>

                </div>

                <?php
                $today = date('Y-m-d');
                ?>

                <div class="grid grid-cols-3 gap-5 mb-8">

                    <div>

                        <label class="font-semibold text-gray-700">
                            Deadline
                        </label>

                        <select
                            id="deadline"
                            class="w-full border border-gray-200 p-4 rounded-2xl mt-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            onchange="ubahTanggal()"
                        >

                            <option value="0">
                                Hari Ini
                            </option>

                            <option value="1">
                                Besok
                            </option>

                            <option value="2">
                                2 Hari Lagi
                            </option>

                            <option value="3">
                                3 Hari Lagi
                            </option>

                            <option value="7">
                                1 Minggu Lagi
                            </option>

                        </select>

                    </div>

                    <div>

                        <label class="font-semibold text-gray-700">
                            Tanggal
                        </label>

                        <input
                            type="date"
                            id="tanggal"
                            name="tanggal"
                            required
                            value="<?= $today ?>"
                            class="w-full border border-gray-200 p-4 rounded-2xl mt-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        >

                    </div>

                    <div>

                        <label class="font-semibold text-gray-700">
                            Prioritas
                        </label>

                        <select
                            name="prioritas"
                            class="w-full border border-gray-200 p-4 rounded-2xl mt-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        >

                            <option>Rendah</option>
                            <option>Sedang</option>
                            <option>Tinggi</option>

                        </select>

                    </div>

                </div>

                <div class="mb-8">

                    <label class="font-semibold text-gray-700">
                        Status
                    </label>

                    <select
                        name="status"
                        class="w-full border border-gray-200 p-4 rounded-2xl mt-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    >

                        <option>Belum</option>
                        <option>Proses</option>
                        <option>Selesai</option>

                    </select>

                </div>

                <button
                    type="submit"
                    name="simpan"
                    class="bg-indigo-600 hover:bg-indigo-700 hover:scale-105 transition text-white px-8 py-4 rounded-2xl font-semibold shadow-xl">

                    Simpan

                </button>

            </form>

        </div>

    </div>

</div>

</body>

<script>
    

function ubahTanggal(){

    let hari = document.getElementById('deadline').value;

    let tanggal = new Date();

    tanggal.setDate(tanggal.getDate() + parseInt(hari));

    let tahun = tanggal.getFullYear();

    let bulan = String(tanggal.getMonth() + 1).padStart(2,'0');

    let hariTanggal = String(tanggal.getDate()).padStart(2,'0');

    let hasil = tahun + '-' + bulan + '-' + hariTanggal;

    document.getElementById('tanggal').value = hasil;
}

</script>
</html>