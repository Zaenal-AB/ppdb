<?php
// Contoh data siswa (bisa diganti dari database)
$daftar_siswa = [
    [
        "nama" => "Ahmad Fauzi",
        "tgl_lahir" => "2025-09-24",
        "kelas" => "Tahfiz",
        "akademik" => "Nilai rata-rata 85",
        "alquran" => "Hafalan 3 Juz, Tajwid Baik"
    ]
];

$hasil = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $tgl_lahir = $_POST['tgl_lahir'];

    // Cari data siswa di array
    $ditemukan = false;
    foreach ($daftar_siswa as $siswa) {
        if ($siswa['nama'] == $nama && $siswa['tgl_lahir'] == $tgl_lahir) {
            $hasil = [
                "status" => "diterima",
                "kelas" => $siswa['kelas'],
                "akademik" => $siswa['akademik'],
                "alquran" => $siswa['alquran']
            ];
            $ditemukan = true;
            break;
        }
    }

    // Jika siswa tidak ditemukan
    if (!$ditemukan) {
        $hasil = [
            "status" => "belum_terdaftar",
            "kelas" => null,
            "akademik" => null,
            "alquran" => null
        ];
    }
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pengumuman Hasil Tes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 to-blue-500 text-white py-6 px-4 text-center">
        <img src="assets/logo-circle-web.png" alt="Logo Sekolah" class="mx-auto w-20 h-20 mb-3">
        <h1 class="text-3xl font-extrabold tracking-wide">Pengumuman Hasil Tes</h1>
        <p class="text-sm text-blue-100">Tahun Ajaran 2026/2027</p>
    </header>

    <!-- Konten Utama -->
    <main class="flex-grow p-6 lg:p-12">
        <!-- Form Input -->
        <form method="POST" class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 space-y-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="nama"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Masukkan nama lengkap" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>
            </div>
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
                Cek Hasil
            </button>
        </form>

        <!-- Hasil -->
        <?php if ($hasil): ?>
            <section class="mt-8 py-10 px-6 text-center rounded-lg
        <?php
            echo $hasil['status'] == 'diterima' ? 'bg-green-100' : ($hasil['status'] == 'ditolak' ? 'bg-pink-100' : 'bg-yellow-100');
        ?>">

                <!-- Nama siswa -->
                <?php if ($hasil['status'] != 'belum_terdaftar'): ?>
                    <p class="text-3xl font-bold mb-4 text-gray-700">
                        <?php echo htmlspecialchars($nama); ?>
                    </p>
                <?php endif; ?>

                <!-- Status -->
                <h2 class="text-4xl font-extrabold mb-4
            <?php
            echo $hasil['status'] == 'diterima' ? 'text-green-700' : ($hasil['status'] == 'ditolak' ? 'text-pink-700' : 'text-yellow-700');
            ?>">
                    <?php
                    if ($hasil['status'] == 'diterima') echo 'SELAMAT! ANDA DITERIMA';
                    elseif ($hasil['status'] == 'ditolak') echo 'MOHON MAAF, ANDA TIDAK LULUS';
                    else echo 'SISWA BELUM TERDAFTAR/BELUM TES';
                    ?>
                </h2>

                <?php if ($hasil['kelas']): ?>
                    <p class="text-lg font-semibold mb-6 text-gray-700">
                        Ditempatkan di Kelas: <span class="underline"><?php echo $hasil['kelas']; ?></span>
                    </p>
                <?php endif; ?>

                <?php if ($hasil['status'] != 'belum_terdaftar'): ?>
                    <!-- Tombol Detail -->
                    <button onclick="toggleDetail()"
                        class="mt-4 bg-gray-800 text-white px-6 py-2 rounded-lg hover:bg-gray-900 transition">
                        Lihat Detail Hasil Tes
                    </button>

                    <!-- Detail Hasil -->
                    <div id="detail" class="hidden mt-6 bg-white border rounded-lg p-6 shadow-lg max-w-2xl mx-auto text-left">
                        <h3 class="text-lg font-bold mb-3 text-gray-700">Detail Hasil Tes</h3>
                        <ul class="space-y-2 text-gray-700">
                            <li><strong>Akademik:</strong> <?php echo $hasil['akademik']; ?></li>
                            <li><strong>Al-Qur'an:</strong> <?php echo $hasil['alquran']; ?></li>
                        </ul>
                    </div>
                <?php endif; ?>
            </section>
        <?php endif; ?>

    </main>

    <!-- Footer -->
    <footer class="bg-gray-200 text-gray-600 text-center py-4 text-sm">
        &copy; 2025 SMPIT Anak Sholeh Mataram. All Rights Reserved.
    </footer>

    <script>
        function toggleDetail() {
            let detail = document.getElementById("detail");
            detail.classList.toggle("hidden");
        }
    </script>
</body>

</html>