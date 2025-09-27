<?php


include 'config/app.php';

// Cek apakah ada parameter id yang dikirim
if (!isset($_GET['id'])) {
    echo "<p class='text-center text-red-500 mt-10'>ID siswa tidak ditemukan!</p>";
    exit;
}

$id = (int)$_GET['id'];
$siswa = select("SELECT * FROM data_siswa WHERE id = $id");

if (empty($siswa)) {
    echo "<p class='text-center text-red-500 mt-10'>Data siswa tidak ditemukan!</p>";
    exit;
}

$data = $siswa[0];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Data Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-lg p-8">
        <h1 class="text-3xl font-bold text-center text-blue-700 mb-6">
            Detail Data Siswa
        </h1>

        <!-- Data Utama -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p><span class="font-semibold">Nama Lengkap:</span> <?= htmlspecialchars($data['nama_lengkap']); ?></p>
                <p><span class="font-semibold">NISN:</span> <?= htmlspecialchars($data['nisn']); ?></p>
                <p><span class="font-semibold">Tempat Lahir:</span> <?= htmlspecialchars($data['tempat_lahir']); ?></p>
                <p><span class="font-semibold">Tanggal Lahir:</span> <?= htmlspecialchars($data['tanggal_lahir']); ?></p>
                <p><span class="font-semibold">Jenis Kelamin:</span> <?= htmlspecialchars($data['jenis_kelamin']); ?></p>
                <p><span class="font-semibold">Sekolah Asal:</span> <?= htmlspecialchars($data['sekolah_asal']); ?></p>
            </div>
            <div>
                <p><span class="font-semibold">Anak ke-:</span> <?= htmlspecialchars($data['anakke']); ?></p>
                <p><span class="font-semibold">Jumlah Saudara:</span> <?= htmlspecialchars($data['jsaudara']); ?></p>
                <p><span class="font-semibold">Alamat:</span> <?= htmlspecialchars($data['alamat']); ?></p>
                <p><span class="font-semibold">Kecamatan:</span> <?= htmlspecialchars($data['kecamatan']); ?></p>
                <p><span class="font-semibold">Kabupaten/Kota:</span> <?= htmlspecialchars($data['kabupaten']); ?></p>
                <p><span class="font-semibold">Kelas:</span> <?= htmlspecialchars($data['kelas']); ?></p>
            </div>
        </div>

        <hr class="my-6 border-gray-300">

        <!-- Data Orang Tua -->
        <h2 class="text-xl font-bold text-blue-600 mb-4">Data Orang Tua</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p><span class="font-semibold">Ayah:</span> <?= htmlspecialchars($data['nama_ayah']); ?></p>
                <p><span class="font-semibold">Pekerjaan Ayah:</span> <?= htmlspecialchars($data['pekerjaan_ayah']); ?></p>
                <p><span class="font-semibold">Tempat Bekerja Ayah:</span> <?= htmlspecialchars($data['tempat_bekerja_ayah']); ?></p>
            </div>
            <div>
                <p><span class="font-semibold">Ibu:</span> <?= htmlspecialchars($data['nama_ibu']); ?></p>
                <p><span class="font-semibold">Pekerjaan Ibu:</span> <?= htmlspecialchars($data['pekerjaan_ibu']); ?></p>
                <p><span class="font-semibold">Tempat Bekerja Ibu:</span> <?= htmlspecialchars($data['tempat_bekerja_ibu']); ?></p>
            </div>
        </div>

        <hr class="my-6 border-gray-300">

        <!-- Data Wali -->
        <h2 class="text-xl font-bold text-blue-600 mb-4">Data Wali</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p><span class="font-semibold">Nama Wali:</span> <?= htmlspecialchars($data['nama_wali']); ?></p>
                <p><span class="font-semibold">Pekerjaan Wali:</span> <?= htmlspecialchars($data['pekerjaan_wali']); ?></p>
            </div>
            <div>
                <p><span class="font-semibold">No. HP Wali:</span> <?= htmlspecialchars($data['no_hp_wali']); ?></p>
                <p><span class="font-semibold">No. HP Ortu:</span> <?= htmlspecialchars($data['no_hp']); ?></p>
            </div>
        </div>

        <hr class="my-6 border-gray-300">

        <!-- Dokumen -->
        <h2 class="text-xl font-bold text-blue-600 mb-4">Dokumen</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Bukti Pendaftaran -->
            <div class="border rounded-lg shadow p-3">
                <h3 class="font-semibold mb-2">Bukti Pendaftaran</h3>
                <?php if (pathinfo($data['bukti'], PATHINFO_EXTENSION) === 'pdf'): ?>
                    <iframe src="uploads/bukti/<?= $data['bukti']; ?>" class="w-full h-64"></iframe>
                <?php else: ?>
                    <img src="uploads/bukti/<?= $data['bukti']; ?>" alt="Bukti" class="w-full h-64 object-contain">
                <?php endif; ?>
            </div>

            <!-- Akta Kelahiran -->
            <div class="border rounded-lg shadow p-3">
                <h3 class="font-semibold mb-2">Akta Kelahiran</h3>
                <?php if (pathinfo($data['akta'], PATHINFO_EXTENSION) === 'pdf'): ?>
                    <iframe src="uploads/akta/<?= $data['akta']; ?>" class="w-full h-64"></iframe>
                <?php else: ?>
                    <img src="uploads/akta/<?= $data['akta']; ?>" alt="Akta" class="w-full h-64 object-contain">
                <?php endif; ?>
            </div>

            <!-- Kartu Keluarga -->
            <div class="border rounded-lg shadow p-3">
                <h3 class="font-semibold mb-2">Kartu Keluarga</h3>
                <?php if (pathinfo($data['kk'], PATHINFO_EXTENSION) === 'pdf'): ?>
                    <iframe src="uploads/kk/<?= $data['kk']; ?>" class="w-full h-64"></iframe>
                <?php else: ?>
                    <img src="uploads/kk/<?= $data['kk']; ?>" alt="KK" class="w-full h-64 object-contain">
                <?php endif; ?>
            </div>

        </div>

        <div class="mt-8 text-center">
            <a href="siswa_terdaftar.php" class="px-6 py-3 bg-gray-600 text-white rounded-lg shadow hover:bg-gray-700">
                Kembali ke Daftar Siswa
            </a>
        </div>

    </div>

</body>

</html>