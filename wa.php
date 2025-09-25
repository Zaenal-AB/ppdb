<?php
session_start();

// Ambil nama siswa dari session
$nama_siswa = isset($_SESSION['nama_siswa']) ? $_SESSION['nama_siswa'] : 'Ananda';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Orang Tua - SMPIT Anak Sholeh Mataram</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="max-w-lg w-full bg-white rounded-2xl shadow-lg p-8 text-center">
        <!-- Logo Sekolah -->
        <img src="logo.png" alt="Logo Sekolah" class="mx-auto w-20 mb-4">

        <h1 class="text-2xl font-bold text-gray-800 mb-2">
            Terima Kasih 🙏
        </h1>
        <p class="text-gray-600 mb-6">
            Data pendaftaran <span class="font-semibold"><?= htmlspecialchars($nama_siswa) ?></span> sudah kami terima.<br>
            Silakan bergabung ke grup WhatsApp resmi orang tua SMPIT Anak Sholeh Mataram.
        </p>

        <a href="https://chat.whatsapp.com/JFZ1IDUOZltD3p18l8yIq9"
            target="_blank"
            class="inline-block px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow hover:bg-green-700 transition">
            📲 Gabung Grup WhatsApp
        </a>

        <div class="mt-6 text-sm text-gray-500">
            SMPIT Anak Sholeh Mataram &copy; <?php echo date("Y"); ?>
        </div>
    </div>

</body>

</html>