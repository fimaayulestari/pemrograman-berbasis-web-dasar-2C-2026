<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Interaktif Developer</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen py-10">

<div class="max-w-5xl mx-auto bg-white shadow-xl rounded-2xl p-8">

    <h1 class="text-3xl font-bold text-center text-blue-600 mb-8">
        Profil Interaktif Developer Pemula
    </h1>

    <div class="overflow-x-auto">

        <table class="w-full border border-slate-300 rounded-lg overflow-hidden">

            <tr class="bg-slate-100">
                <th class="border p-4 text-left w-1/3">Nama</th>
                <td class="border p-4">Fima Ayu Lestari</td>
            </tr>

            <tr>
                <th class="border p-4 text-left">ID Developer</th>
                <td class="border p-4">DEV2500057</td>
            </tr>

            <tr class="bg-slate-100">
                <th class="border p-4 text-left">Kota / Tgl Lahir</th>
                <td class="border p-4">Lamongan, 04 Januari 2007</td>
            </tr>

            <tr>
                <th class="border p-4 text-left">Email</th>
                <td class="border p-4">fimaayulestari04@gmail.com</td>
            </tr>

            <tr class="bg-slate-100">
                <th class="border p-4 text-left">No WhatsApp</th>
                <td class="border p-4">083833507174</td>
            </tr>

        </table>

    </div>

    <h2 class="text-2xl font-semibold mt-10 mb-6 text-slate-700">
        Form Developer
    </h2>

    <form method="POST" class="space-y-5">

        <div>
            <label class="font-medium text-slate-700">
                Framework / Tools yang Dikuasai
            </label>

            <input
                type="text"
                name="framework"
                placeholder="HTML,CSS,PHP"
                class="w-full border border-slate-300 rounded-xl p-3 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div>
            <label class="font-medium text-slate-700">
                Pengalaman Membuat Website
            </label>

            <textarea
                name="pengalaman"
                rows="5"
                class="w-full border border-slate-300 rounded-xl p-3 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            ></textarea>
        </div>

        <div>
            <label class="font-medium text-slate-700 block mb-2">
                Tools Penunjang
            </label>

            <div class="flex flex-wrap gap-4">

                <label>
                    <input type="checkbox" name="tools[]" value="VS Code">
                    VS Code
                </label>

                <label>
                    <input type="checkbox" name="tools[]" value="GitHub">
                    GitHub
                </label>

                <label>
                    <input type="checkbox" name="tools[]" value="Figma">
                    Figma
                </label>

                <label>
                    <input type="checkbox" name="tools[]" value="Postman">
                    Postman
                </label>

            </div>
        </div>

        <div>
            <label class="font-medium text-slate-700 block mb-2">
                Minat Bidang
            </label>

            <div class="flex gap-5">

                <label>
                    <input type="radio" name="bidang" value="Frontend">
                    Frontend
                </label>

                <label>
                    <input type="radio" name="bidang" value="Backend">
                    Backend
                </label>

                <label>
                    <input type="radio" name="bidang" value="Fullstack">
                    Fullstack
                </label>

            </div>
        </div>

        <div>
            <label class="font-medium text-slate-700">
                Tingkat Skill Coding
            </label>

            <select
                name="skill"
                class="w-full border border-slate-300 rounded-xl p-3 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="">-- Pilih Skill --</option>
                <option value="Dasar">Dasar</option>
                <option value="Cukup">Cukup</option>
                <option value="Profesional">Profesional</option>
            </select>
        </div>

        <button
            type="submit"
            name="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition duration-300"
        >
            Kirim Data
        </button>

    </form>

    <?php

    function tampilData($judul, $isi){

        echo "
            <tr>
                <th class='border p-4 text-left bg-slate-100'>$judul</th>
                <td class='border p-4'>$isi</td>
            </tr>
        ";
    }

    if(isset($_POST['submit'])){

        $framework = $_POST['framework'];

        $pengalaman = $_POST['pengalaman'];

        $tools = $_POST['tools'] ?? [];

        $bidang = $_POST['bidang'] ?? "";

        $skill = $_POST['skill'];

        if(
            empty($framework) ||
            empty($pengalaman) ||
            empty($tools) ||
            empty($bidang) ||
            empty($skill)
        ){

            echo "
                <div class='mt-8 bg-red-100 text-red-700 p-4 rounded-xl'>
                    Semua data harus diisi terlebih dahulu.
                </div>
            ";

        }else{

            $frameworkArray = explode(",", $framework);

            echo "
                <div class='mt-10'>
                    <h2 class='text-2xl font-bold text-slate-700 mb-5'>
                        Hasil Input Developer
                    </h2>
                </div>
            ";

            echo "<table class='w-full border border-slate-300'>";

            tampilData(
                "Framework / Tools",
                implode(", ", $frameworkArray)
                // gettype(implode(", ", $frameworkArray))
            );

            tampilData(
                "Tools Penunjang",
                implode(", ", $tools)
            );

            tampilData(
                "Minat Bidang",
                $bidang
            );

            tampilData(
                "Tingkat Skill Coding",
                $skill
            );

            echo "</table>";

            echo "
                <div class='mt-6'>
                    <h3 class='text-xl font-semibold text-slate-700 mb-3'>
                        Pengalaman Membuat Website
                    </h3>

                    <p class='text-slate-600 leading-relaxed'>
                        $pengalaman
                    </p>
                </div>
            ";

            if(count($frameworkArray) > 2){

                echo "
                    <div class='mt-5 bg-green-100 text-green-700 p-4 rounded-xl'>
                        Skill Anda cukup luas di bidang development!
                    </div>
                ";
            }
        }
    }

    ?>
    
    <div class="mt-10 flex gap-4">

        <a href="timeline.php"
           class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-3 rounded-xl">

            Kembali ke Timeline

        </a>

        <a href="blog.php"
           class="bg-slate-700 hover:bg-slate-800 text-white px-5 py-3 rounded-xl">

            Menuju Blog Developer

        </a>

    </div>

</div>

</body>
</html>