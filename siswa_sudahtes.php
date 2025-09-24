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

//    <th class="py-3 px-4 text-left">No</th>
//                         <th class="py-3 px-4 text-left">Nama</th>
//                         <th class="py-3 px-4 text-left">Jenis Kelamin</th>
//                         <th class="py-3 px-4 text-left">Asal Sekolah</th>
//                         <th class="py-3 px-4 text-left">Tanggal Tes</th>
//                         <th class="py-3 px-4 text-left">Status Tes</th>

$data_siswa = select("SELECT nama, jenis_kelamin, sekolah_asal FROM siswa ");

?>




<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa Sudah Tes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 min-h-screen p-6">
    <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Data Siswa Sudah Tes</h1>
            <a href="dashboard.php"
                class="mt-3 sm:mt-0 inline-block bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold py-2 px-4 rounded-lg transition">
                ← Kembali ke Dashboard
            </a>
        </div>

        <!-- Table Responsive -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-purple-600 text-white text-sm">
                        <th class="py-3 px-4 text-left">No</th>
                        <th class="py-3 px-4 text-left">Nama</th>
                        <th class="py-3 px-4 text-left">Jenis Kelamin</th>
                        <th class="py-3 px-4 text-left">Asal Sekolah</th>
                        <th class="py-3 px-4 text-left">Tanggal Tes</th>
                        <th class="py-3 px-4 text-left">Status Tes</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 dark:text-gray-300 text-sm divide-y divide-gray-200 dark:divide-gray-700">

                    <!-- Contoh data statis -->
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="py-3 px-4">1</td>
                        <td class="py-3 px-4 font-medium">Aisyah Putri</td>
                        <td class="py-3 px-4">Perempuan</td>
                        <td class="py-3 px-4">SDIT Al-Hikmah</td>
                        <td class="py-3 px-4">2025-09-15</td>
                        <td class="py-3 px-4 text-green-600 font-semibold">Lulus</td>
                    </tr>

                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="py-3 px-4">2</td>
                        <td class="py-3 px-4 font-medium">Ahmad Zidan</td>
                        <td class="py-3 px-4">Laki-laki</td>
                        <td class="py-3 px-4">SDN 1 Cakranegara</td>
                        <td class="py-3 px-4">2025-09-16</td>
                        <td class="py-3 px-4 text-yellow-600 font-semibold">Menunggu</td>
                    </tr>

                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="py-3 px-4">3</td>
                        <td class="py-3 px-4 font-medium">Siti Khadijah</td>
                        <td class="py-3 px-4">Perempuan</td>
                        <td class="py-3 px-4">SD Muhammadiyah</td>
                        <td class="py-3 px-4">2025-09-17</td>
                        <td class="py-3 px-4 text-green-600 font-semibold">Lulus</td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>
</body>

</html>