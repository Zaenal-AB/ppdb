<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

if (!in_array($_SESSION["identit4s"], ["super4admin", "admin7&"])) {
    echo "<script>
        alert('Akses Hanya untuk Tim Penguji Al-Quran');
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



?>



<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Rekapan Hasil Tes Akademik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>


<body class="bg-teal-100 min-h-screen flex items-center justify-center p-6">
    <div class="w-[100%] sm:w-[80%] md:w-[60%] lg:w-[40%] bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-2xl font-bold text-center mb-6 text-teal-700">
            Form Rekapan Tes Al-Qur'an
        </h2>

        <form method="POST" class="space-y-4">
            <!-- Dropdown Nama Siswa -->
            <div>
                <label class="block text-sm font-semibold mb-2">Nama Siswa</label>
                <select
                    name="siswa_id"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-teal-500"
                    required>
                    <option value="" disabled selected>Pilih Siswa</option>
                    <?php foreach ($data_siswa_belum_tes as $siswa) : ?>
                        <option value="<?= $siswa['id']; ?>">
                            <?= htmlspecialchars($siswa['nama_lengkap']); ?> - <?= htmlspecialchars($siswa['sekolah_asal']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Tanggal Tes -->
            <div>
                <label class="block text-sm font-semibold mb-2">Tanggal Tes</label>
                <input
                    type="date"
                    name="tanggal_tes_akademik"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-teal-500"
                    required />
            </div>


            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-semibold mb-2">Deskripsi</label>
                <textarea
                    name="deskripsi"
                    rows="4"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-teal-500"
                    placeholder="Masukkan deskripsi hasil tes akademik..."
                    required></textarea>
            </div>

            <!-- Tombol Simpan -->
            <div class="text-center">
                <button
                    type="submit"
                    class="w-full bg-teal-600 text-white py-2 rounded-lg hover:bg-teal-700">
                    Simpan Rekapan
                </button>
            </div>
        </form>
    </div>
</body>

</html>