<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline Belajar Coding</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>

        body{
            font-family: Arial, sans-serif;
        }

        .highlight{
            color: blue;
            font-weight: bold;
        }

    </style>

</head>
<body class="bg-slate-100 py-10">

<div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-lg">

    <h1 class="text-3xl font-bold text-center text-blue-600 mb-10">
        Timeline Perjalanan Belajar Coding
    </h1>

    <?php

    $timeline = [

        [
            "tahun" => "2025",
            "kegiatan" => "Mulai masuk kuliah di jurusan Sistem Informasi"
        ],

        [
            "tahun" => "2026",
            "kegiatan" => "Awal belajar HTML"
        ],

        [
            "tahun" => "2026",
            "kegiatan" => "Membuat website sederhana pertama"
        ],

        [
            "tahun" => "2026",
            "kegiatan" => "Belajar CSS dan JavaScript"
        ],

        [
            "tahun" => "2026",
            "kegiatan" => "Belajar PHP dan database MySQL"
        ]

    ];

    function highlightTahun($tahun){

        if($tahun == "2025"){
            return "highlight";
        }

        return "";
    }

    ?>

    <div class="border-l-4 border-blue-500 pl-6 space-y-8">

        <?php foreach($timeline as $data){ ?>

            <div class="relative">

                <div class="absolute -left-9 top-1 w-4 h-4 bg-blue-500 rounded-full"></div>

                <p class="text-lg font-bold <?php echo highlightTahun($data['tahun']); ?>">

                    <?php echo $data['tahun']; ?>

                </p>

                <p class="text-slate-600 mt-1 leading-relaxed">

                    <?php echo $data['kegiatan']; ?>

                </p>

            </div>

        <?php } ?>

    </div>

    <div class="mt-10 flex gap-4">

        <a href="index.php"
           class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-3 rounded-xl">

            Kembali ke Profil

        </a>

        <a href="blog.php"
           class="bg-slate-700 hover:bg-slate-800 text-white px-5 py-3 rounded-xl">

            Menuju Blog Developer

        </a>

    </div>

</div>

</body>
</html>