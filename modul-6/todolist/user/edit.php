<?php
include '../auth/cek_login.php';
include '../config/koneksi.php';

$id = $_GET['id'];

$stmt = $conn->prepare(
    "SELECT * FROM tasks WHERE id=?"
);

$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$data = $result->fetch_assoc();

if(isset($_POST['update'])){

    $judul = $_POST['judul'];
    $catatan = $_POST['catatan'];
    $tanggal = $_POST['tanggal'];
    $prioritas = $_POST['prioritas'];
    $status = $_POST['status'];

    $update = $conn->prepare(
        "UPDATE tasks
         SET judul=?, catatan=?, tanggal=?, prioritas=?, status=?
         WHERE id=?"
    );

    $update->bind_param(
        "sssssi",
        $judul,
        $catatan,
        $tanggal,
        $prioritas,
        $status,
        $id
    );

    $update->execute();

    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

<div class="bg-white p-10 rounded-3xl shadow">

    <h1 class="text-4xl font-bold mb-8">
        Edit Kegiatan
    </h1>

    <form method="POST">

        <div class="mb-5">

            <label>Judul</label>

            <input
                type="text"
                name="judul"
                value="<?= htmlspecialchars($data['judul']); ?>"
                class="w-full border p-4 rounded-2xl mt-2"
            >

        </div>

        <div class="mb-5">

            <label>Catatan</label>

            <textarea
                name="catatan"
                class="w-full border p-4 rounded-2xl mt-2"
            ><?= htmlspecialchars($data['catatan']); ?></textarea>

        </div>

        <div class="grid grid-cols-3 gap-5 mb-8">

            <input
                type="date"
                name="tanggal"
                value="<?= $data['tanggal']; ?>"
                class="border p-4 rounded-2xl"
            >

            <select
                name="prioritas"
                class="border p-4 rounded-2xl"
            >

                <option <?= $data['prioritas']=='Rendah' ? 'selected' : '' ?>>
                    Rendah
                </option>

                <option <?= $data['prioritas']=='Sedang' ? 'selected' : '' ?>>
                    Sedang
                </option>

                <option <?= $data['prioritas']=='Tinggi' ? 'selected' : '' ?>>
                    Tinggi
                </option>

            </select>

            <select
                name="status"
                class="border p-4 rounded-2xl"
            >

                <option <?= $data['status']=='Belum' ? 'selected' : '' ?>>
                    Belum
                </option>

                <option <?= $data['status']=='Proses' ? 'selected' : '' ?>>
                    Proses
                </option>

                <option <?= $data['status']=='Selesai' ? 'selected' : '' ?>>
                    Selesai
                </option>

            </select>

        </div>

        <button
            type="submit"
            name="update"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl">
            Update
        </button>

    </form>

</div>

</body>
</html>