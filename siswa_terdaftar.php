<?php
session_start();

if (!isset($_SESSION["login"])) {
  echo "<script>
    alert('Silahkan Anda Login Dahulu');
    document.location.href = 'login.php';
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

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
      <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Data Siswa Terdaftar</h1>
      <div class="flex gap-2 mt-3 sm:mt-0">
        <a href="dashboard.php"
          class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded-lg transition">
          ← Kembali ke Dashboard
        </a>
        <a href="#"
          class="inline-block bg-green-600 hover:bg-green-700 text-white text-sm font-semibold py-2 px-4 rounded-lg transition">
          ⬇ Download Excel
        </a>
      </div>
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
            <?php if ($_SESSION['identit4s'] == "admin4$" || $_SESSION['identit4s'] == "super4admin") : ?>
              <th class="py-3 px-4 text-center">Aksi</th>
            <?php endif; ?>
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
              <?php if ($_SESSION['identit4s'] == "admin4$" || $_SESSION['identit4s'] == "super4admin") : ?>
                <td class="py-3 px-4 text-center flex gap-2 justify-center">
                  <a target="_blank" href="detail_siswa.php?id=<?= $siswa['id']; ?>"
                    class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold py-1 px-3 rounded-lg transition">
                    Detail
                  </a>
                  <button
                    onclick="openModal(<?= $siswa['id']; ?>, '<?= htmlspecialchars($siswa['nama_lengkap']); ?>')"
                    class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-1 px-3 rounded-lg transition">
                    Hapus
                  </button>
                </td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Konfirmasi Hapus -->
  <div id="deleteModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 max-w-sm w-full text-center">
      <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-4">Konfirmasi Hapus</h2>
      <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
        Apakah Anda yakin ingin menghapus data <span id="namaSiswa" class="font-semibold text-red-600"></span>?
      </p>
      <div class="flex justify-center gap-4">
        <button onclick="closeModal()"
          class="px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400 text-gray-800 dark:bg-gray-600 dark:hover:bg-gray-700 dark:text-white">
          Batal
        </button>
        <a id="confirmDeleteBtn" href="#"
          class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white">
          Hapus
        </a>
      </div>
    </div>
  </div>

  <script>
    function openModal(id, nama) {
      document.getElementById('deleteModal').classList.remove('hidden');
      document.getElementById('namaSiswa').innerText = nama;
      document.getElementById('confirmDeleteBtn').setAttribute('href', 'hapus_siswa.php?id=' + id);
    }

    function closeModal() {
      document.getElementById('deleteModal').classList.add('hidden');
    }
  </script>
</body>

</html>