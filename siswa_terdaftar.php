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
          </tr>
        </thead>
        <tbody class="text-gray-700 dark:text-gray-300 text-sm divide-y divide-gray-200 dark:divide-gray-700">

          <!-- Contoh data statis -->
          <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
            <td class="py-3 px-4">1</td>
            <td class="py-3 px-4 font-medium">Ahmad Fauzi</td>
            <td class="py-3 px-4">Laki-laki</td>
            <td class="py-3 px-4">SDN 1 Mataram</td>
            <td class="py-3 px-4">2025-09-15</td>
          </tr>

          <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
            <td class="py-3 px-4">2</td>
            <td class="py-3 px-4 font-medium">Siti Aisyah</td>
            <td class="py-3 px-4">Perempuan</td>
            <td class="py-3 px-4">SDIT Al-Falah</td>
            <td class="py-3 px-4">2025-09-16</td>
          </tr>

          <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
            <td class="py-3 px-4">3</td>
            <td class="py-3 px-4 font-medium">Budi Santoso</td>
            <td class="py-3 px-4">Laki-laki</td>
            <td class="py-3 px-4">SD Muhammadiyah</td>
            <td class="py-3 px-4">2025-09-18</td>
          </tr>

        </tbody>
      </table>
    </div>

  </div>
</body>

</html>