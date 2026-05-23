<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Reflektif Developer</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 py-10">

<div class="max-w-5xl mx-auto bg-white p-8 rounded-2xl shadow-lg">

    <h1 class="text-3xl font-bold text-center text-blue-600 mb-10">
        Blog Reflektif Developer
    </h1>

    <?php

    $artikel = [

        "html" => [

            "judul" => "Belajar Python Pertama Kali",

            "tanggal" => "08 September 2025",

            "isi" => "Saat pertama belajar Python masih bingung dengan penggunaan if perulangan.",

            "gambar" => "awalpython.png",

            "link" => "https://www.w3schools.com/python/default.asp"
        ],

        "error" => [

            "judul" => "Error di Python Pertama Saat Coding",

            "tanggal" => "21 September 2025",

            "isi" => "Kesalahan syntax menjadi pengalaman yang cukup sering terjadi saat belajar coding dengan kesalahan kecil bisa berpengaruh besar. Dari error tersebut akhirnya mulai terbiasa mencari letak kesalahan dan memperbaikinya.",

            "gambar" => "errorpython.png",

            "link" => "https://www.w3schools.com/python/python_ref_exceptions.asp"
        ],

        "php" => [

            "judul" => "Mulai Belajar Figma",

            "tanggal" => "19 April 2026",

            "isi" => "Belajar Figma membantu membuat dessain website lebih menarik. Awalnya masih bingung dengan fitur-fiturnya, tapi lama kelamaan mulai terbiasa dan bisa membuat desain sederhana.",

            "gambar" => "figma.png",

            "link" => "https://www.figma.com/design/"
        ]
    ];

    $quotes = [

        "Jangan takut mencoba karena proses belajar membutuhkan latihan.",

        "Error dalam coding membantu memahami program lebih baik.",

        "Belajar sedikit demi sedikit tetap membawa perkembangan.",

        "Konsisten latihan mencoba desain membantu meningkatkan kemampuan."
    ];

    $randomQuote = $quotes[array_rand($quotes)];

    ?>

    <div class="mb-10">

        <h2 class="text-2xl font-semibold mb-5">
            Daftar Artikel
        </h2>

        <div class="flex flex-wrap gap-4">

            <?php foreach($artikel as $key => $data){ ?>

                <a href="?artikel=<?php echo $key; ?>"
                   class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-3 rounded-xl">

                    <?php echo $data['judul']; ?>

                </a>

            <?php } ?>

        </div>

    </div>

    <?php

    if(isset($_GET['artikel'])){

        $key = $_GET['artikel'];

        if(isset($artikel[$key])){

            $data = $artikel[$key];

    ?>

        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200">

            <h2 class="text-2xl font-bold text-slate-800 mb-2">

                <?php echo $data['judul']; ?>

            </h2>

            <p class="text-slate-500 mb-5">

                Tanggal Posting :
                <?php echo $data['tanggal']; ?>

            </p>

            <img src="<?php echo $data['gambar']; ?>"
                 class="w-full md:w-96 rounded-2xl mb-5">

            <p class="text-slate-700 leading-relaxed mb-5">

                <?php echo $data['isi']; ?>

            </p>

            <a href="<?php echo $data['link']; ?>"
               target="_blank"
               class="text-blue-600 font-medium hover:underline">

                Referensi Tambahan

            </a>

        </div>

    <?php

        }
    }

    ?>

    <div class="mt-10 bg-blue-50 border border-blue-200 p-5 rounded-2xl">

        <h3 class="text-xl font-semibold text-blue-700 mb-3">
            Kutipan Motivasi
        </h3>

        <p class="text-slate-700 italic">
            "<?php echo $randomQuote; ?>"
        </p>

    </div>

    <div class="mt-10 flex gap-4">

        <a href="timeline.php"
           class="bg-slate-700 hover:bg-slate-800 text-white px-5 py-3 rounded-xl">

            Kembali ke Timeline

        </a>

        <a href="index.php"
           class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-3 rounded-xl">

            Kembali ke Profil

        </a>

    </div>

</div>

</body>
</html>