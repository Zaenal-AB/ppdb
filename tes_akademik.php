<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

if (!in_array($_SESSION["identit4s"], ["super4admin", "admin5%"])) {
    echo "<script>
        alert('Akses Hanya untuk Tim Penguji Akademik');
        document.location.href = 'dashboard.php';
    </script>";
    exit;
}

include 'config/app.php';

// <-------------- CONTROLLER -------------->



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


$data_siswa_belum_tes = select("SELECT * FROM data_siswa 
                      WHERE created_at BETWEEN '$periode_awal' AND '$periode_akhir'
                      AND tes_akademik = 'Belum' 
                      ORDER BY id ASC");


// Ambil data siswa untuk dropdown



?>


<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <title>Rekapan Hasil Tes Akademik</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-indigo-200 min-h-screen flex items-center justify-center p-6">
  <div class="w-[100%] sm:w-[80%] md:w-[60%] lg:w-[40%] bg-white rounded-xl shadow-lg p-6">
    <h2 class="text-2xl font-bold text-center mb-6 text-indigo-700">
      Form Rekapan Tes Akademik
    </h2>

    <form method="POST" class="space-y-4">
      <!-- Dropdown Nama Siswa -->
      <div>
        <label class="block text-sm font-semibold mb-2">Nama Siswa</label>
        <select
          name="siswa_id"
          class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500"
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
          class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500"
          required />
      </div>


      <!-- Deskripsi -->
      <div>
        <label class="block text-sm font-semibold mb-2">Deskripsi</label>
        <textarea
          name="deskripsi"
          rows="4"
          class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500"
          placeholder="Masukkan deskripsi hasil tes akademik..."
          required></textarea>
      </div>

      <!-- Tombol Simpan -->
      <div class="text-center">
        <button
          type="submit"
          class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700">
          Simpan Rekapan
        </button>
      </div>
    </form>
  </div>
</body>

</html>