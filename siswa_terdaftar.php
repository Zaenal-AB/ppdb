<?php
// session_start();

// if (!isset($_SESSION["login"])) {
//     echo "<script>
//     alert('Silahkan Anda Login Dahulu');
//     document.location.href = 'login.php';
//          </script>";
//     exit;
// }

include 'config/app.php';
// Tanggal hari ini
$today = date('Y-m-d');

// Ambil bulan dan tahun sekarang
$year = date('Y');
$month = date('n');

// Tentukan awal & akhir periode PPDB
if ($month >= 9) { // September - Desember
  $periode_awal = "$year-09-01";
  $periode_akhir = ($year + 1) . "-08-30";
} else { // Januari - Agustus
  $periode_awal = ($year - 1) . "-09-01";
  $periode_akhir = "$year-08-30";
}

// Ambil data siswa sesuai periode PPDB
$data_siswa = select("SELECT * FROM data_siswa 
                      WHERE created_at BETWEEN '$periode_awal' AND '$periode_akhir'
                      ORDER BY id ASC ");
?>




<!DOCTYPE html>
<html lang="id" class="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Siswa Terdaftar</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 min-h-screen p-6">
  <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
      <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Data Siswa Terdaftar</h1>
      <a href="dashboard.php"
        class="mt-3 sm:mt-0 inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded-lg transition">
        ← Kembali ke Dashboard
      </a>
    </div>

    <!-- Table Responsive -->
    <div class="overflow-x-auto">
      <table class="w-full border-collapse">
        <thead>
          <tr class="bg-blue-600 text-white text-sm">
            <th class="py-3 px-4 text-left">No</th>
            <th class="py-3 px-4 text-left">Nama</th>
            <th class="py-3 px-4 text-left">Jenis Kelamin</th>
            <th class="py-3 px-4 text-left">Asal Sekolah</th>
            <th class="py-3 px-4 text-left">Tanggal Daftar</th>
            <th class="py-3 px-4 text-center">Aksi</th>

          </tr>
        </thead>
        <tbody class="text-gray-700 dark:text-gray-300 text-sm divide-y divide-gray-200 dark:divide-gray-700">
          <?php $no = 1; ?>
          <?php foreach ($data_siswa as $siswa) : ?>
            <tr>
              <td class="py-3 px-4"><?= $no++; ?></td>
              <td class="py-3 px-4"><?= htmlspecialchars($siswa['nama_lengkap']); ?></td>
              <td class="py-3 px-4"><?= htmlspecialchars($siswa['jenis_kelamin']); ?></td>
              <td class="py-3 px-4"><?= htmlspecialchars($siswa['sekolah_asal']); ?></td>
              <td class="py-3 px-4"><?= date('d-m-Y H:i', strtotime($siswa['created_at'])); ?></td>
              <td class="py-3 px-4 text-center">
                <a href="detail_siswa.php?id=<?= $siswa['id']; ?>"
                  class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold py-1 px-3 rounded-lg transition">
                  Detail</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  </div>
</body>

</html>