<?php
session_start();
if (
    !isset($_SESSION["login"])
    && $_SESSION["identit4s"] !== "super4admin"
    && $_SESSION["identit4s"] !== "admin7&"
) {
    echo "<script>
        alert('Akses Hanya untuk Tim Penguji Al-Qur\\'an.');
        document.location.href = 'dashboard.php';
    </script>";
    exit;
}


include 'config/app.php';

// ambil siswa yang belum tes Qur'an
$data_siswa_belum_quran = select("SELECT * FROM data_siswa WHERE tes_quran = 'Belum' ORDER BY nama_lengkap ASC");

if (isset($_POST['simpan_quran'])) {
    $siswa_id          = $_POST['siswa_id'];
    $tanggal_tes_quran = $_POST['tanggal_tes_quran'];
    $pengumuman        = $_POST['pengumuman'];

    $query = "UPDATE data_siswa 
              SET tes_quran = 'Sudah',
                  tanggal_tes_quran = '$tanggal_tes_quran',
                  pengumuman = '$pengumuman'
              WHERE id = '$siswa_id'";
}

if (mysqli_query($conn, $query)) {
    echo "<script>
          alert('Tes Al-Qur\\'an berhasil disimpan!');
          document.location.href = 'rekap_tes_quran.php';
        </script>";
} else {
    echo "<script>
          alert('Gagal menyimpan tes Qur\\'an!');
          document.location.href = 'form_tes_quran.php';
        </script>";
}


?>



<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Rekapan Hasil Tes Akademik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-indigo-300 min-h-screen flex items-center justify-center p-6">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 max-w-lg mx-auto mt-6">
        <h2 class="text-lg font-bold mb-4 text-center">Form Tes Al-Qur'an</h2>

        <form action="" method="POST">
            <!-- Pilih siswa -->
            <div class="mb-4">
                <label for="siswa_id" class="block mb-2 text-sm font-medium">Pilih Siswa</label>
                <select
                    name="siswa_id"
                    id="siswa_id"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                    required>
                    <option value="" disabled selected>Pilih Siswa</option>
                    <?php foreach ($data_siswa_belum_quran as $siswa) : ?>
                        <option value="<?= $siswa['id']; ?>">
                            <?= htmlspecialchars($siswa['nama_lengkap']); ?> - <?= htmlspecialchars($siswa['sekolah_asal']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Tanggal Tes -->
            <div class="mb-4">
                <label for="tanggal_tes_quran" class="block mb-2 text-sm font-medium">Tanggal Tes</label>
                <input
                    type="date"
                    name="tanggal_tes_quran"
                    id="tanggal_tes_quran"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <!-- Pengumuman -->
            <div class="mb-4">
                <label for="pengumuman" class="block mb-2 text-sm font-medium">Pengumuman</label>
                <select
                    name="pengumuman"
                    id="pengumuman"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="" selected>Belum Ada</option>
                    <option value="Lulus">Lulus</option>
                    <option value="Tidak Lulus">Tidak Lulus</option>
                </select>
            </div>

            <!-- Tombol Submit -->
            <button
                type="submit"
                name="simpan_quran"
                class="w-full bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                Simpan Tes Qur'an
            </button>
        </form>
    </div>

</body>

</html>