<?php
session_start();
if (
    !isset($_SESSION["login"])
    && $_SESSION["identit4s"] !== "super4admin"
    && $_SESSION["identit4s"] !== "bendahara31#" // bendahara
) {
    echo "<script>
        alert('Akses Hanya untuk Tim Wawancara');
        document.location.href = 'dashboard.php';
    </script>";
    exit;
}

include 'config/app.php';

// ambil siswa yang belum daftar ulang
$data_siswa_sudah_tes = select("SELECT * FROM data_siswa 
                        WHERE tes_akademik = 'Sudah' 
                        AND tes_quran = 'Sudah'
                        AND pengumuman = 'Diterima' 
                        ORDER BY nama_lengkap ASC");


?>

<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ulang Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-pink-100 dark:bg-pink-900 min-h-screen p-6 flex items-center justify-center">
    <div class="w-[100%] sm:w-[80%] md:w-[60%] lg:w-[40%] bg-white rounded-xl shadow-lg p-6">
        <h1 class="text-2xl font-bold text-pink-800 dark:text-white mb-6">Form Daftar Ulang Siswa</h1>

        <form action="" method="POST" class="space-y-4">
            <!-- Dropdown Nama Siswa -->
            <div>
                <label class="block text-sm font-semibold mb-2">Nama Siswa</label>
                <select
                    name="siswa_id"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-teal-500"
                    required>
                    <option value="" disabled selected>Pilih Siswa</option>
                    <?php foreach ($data_siswa_sudah_tes as $siswa) : ?>
                        <option value="<?= $siswa['id']; ?>">
                            <?= htmlspecialchars($siswa['nama_lengkap']); ?> - <?= htmlspecialchars($siswa['sekolah_asal']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Tanggal DU -->
            <div>
                <label class="block text-sm font-semibold mb-2">Tanggal Daftar Ulang</label>
                <input
                    type="date"
                    name="tanggal_du"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-teal-500"
                    required />
            </div>

            <!-- option apakah siswa sudah daftar ulang atau tidak  -->
            <div>
                <label class="block text-sm font-semibold mb-2">Status Daftar Ulang</label>
                <select
                    name="daftar_ulang"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-teal-500"
                    required>
                    <option value="" disabled selected>Pilih Status</option>
                    <option value="1">Sudah Daftar Ulang</option>
                    <option value="0">Belum Daftar Ulang</option>
                </select>
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end">
                <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white font-semibold py-2 px-4 rounded-lg">
                    Simpan Daftar Ulang
                </button>
            </div>
        </form>
    </div>
</body>

</html>