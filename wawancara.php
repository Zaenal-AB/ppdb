<?php
session_start();
if (
    !isset($_SESSION["login"])
    && $_SESSION["identit4s"] !== "super4admin"
    && $_SESSION["identit4s"] !== "admin1!" // wawancara
) {
    echo "<script>
        alert('Akses Hanya untuk Tim Wawancara');
        document.location.href = 'dashboard.php';
    </script>";
    exit;
}

// data siswa yang terdaftar 

?>


<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Wawancara Orang Tua</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 min-h-screen p-6">
    <div class="max-w-4xl mx-auto bg-yellow-100 dark:bg-yellow-900 rounded-2xl shadow-lg p-8">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <a href="dashboard.php"
                class="mt-3 sm:mt-0 inline-block bg-yellow-600 hover:bg-yellow-900 text-white text-sm font-semibold py-2 px-4 rounded-lg transition">
                ← Kembali ke Dashboard
            </a>
        </div>

        <h2 class="text-center text-xl font-bold text-yellow-700 dark:text-yellow-200 mb-6">
            Form Wawancara Orang Tua
        </h2>

        <form action="proses_wawancara.php" method="POST" class="space-y-5">

            <!-- Nama Siswa -->
            <div>
                <label class="block text-sm font-semibold text-yellow-800 dark:text-yellow-100 mb-2">Nama Siswa *</label>
                <select name="nama_siswa" required
                    class="w-full border border-yellow-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 dark:bg-yellow-800 dark:border-yellow-700 dark:text-white">
                    <option value="">-- Pilih Siswa --</option>

                </select>
            </div>

            <!-- Data Orang Tua -->
            <!-- <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-yellow-800 dark:text-yellow-100 mb-2">Nama Ayah *</label>
                    <input type="text" name="nama_ayah" required
                        class="w-full border border-yellow-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 dark:bg-yellow-800 dark:border-yellow-700 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-yellow-800 dark:text-yellow-100 mb-2">Pekerjaan Ayah</label>
                    <input type="text" name="pekerjaan_ayah"
                        class="w-full border border-yellow-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 dark:bg-yellow-800 dark:border-yellow-700 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-yellow-800 dark:text-yellow-100 mb-2">Nama Ibu *</label>
                    <input type="text" name="nama_ibu" required
                        class="w-full border border-yellow-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 dark:bg-yellow-800 dark:border-yellow-700 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-yellow-800 dark:text-yellow-100 mb-2">Pekerjaan Ibu</label>
                    <input type="text" name="pekerjaan_ibu"
                        class="w-full border border-yellow-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 dark:bg-yellow-800 dark:border-yellow-700 dark:text-white">
                </div>
            </div> -->

            <!-- Pendidikan Orang Tua -->
            <!-- <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-yellow-800 dark:text-yellow-100 mb-2">Pendidikan Ayah</label>
                    <select name="pendidikan_ayah"
                        class="w-full border border-yellow-300 rounded-lg px-4 py-2 dark:bg-yellow-800 dark:border-yellow-700 dark:text-white">
                        <option value="">-- Pilih --</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                        <option value="Diploma">Diploma</option>
                        <option value="Sarjana">Sarjana</option>
                        <option value="Magister">Magister</option>
                        <option value="Doktor">Doktor</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-yellow-800 dark:text-yellow-100 mb-2">Pendidikan Ibu</label>
                    <select name="pendidikan_ibu"
                        class="w-full border border-yellow-300 rounded-lg px-4 py-2 dark:bg-yellow-800 dark:border-yellow-700 dark:text-white">
                        <option value="">-- Pilih --</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                        <option value="Diploma">Diploma</option>
                        <option value="Sarjana">Sarjana</option>
                        <option value="Magister">Magister</option>
                        <option value="Doktor">Doktor</option>
                    </select>
                </div>
            </div> -->

            <!-- Pertanyaan Wawancara -->
            <div>
                <label class="block text-sm font-semibold text-yellow-800 dark:text-yellow-100 mb-2">Alasan memilih sekolah ini *</label>
                <textarea name="alasan" rows="3" required
                    class="w-full border border-yellow-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 dark:bg-yellow-800 dark:border-yellow-700 dark:text-white"></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-yellow-800 dark:text-yellow-100 mb-2">Harapan orang tua terhadap anak *</label>
                <textarea name="harapan" rows="3" required
                    class="w-full border border-yellow-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 dark:bg-yellow-800 dark:border-yellow-700 dark:text-white"></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-yellow-800 dark:text-yellow-100 mb-2">Kebiasaan ibadah di rumah</label>
                <textarea name="ibadah" rows="3"
                    class="w-full border border-yellow-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 dark:bg-yellow-800 dark:border-yellow-700 dark:text-white"></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-yellow-800 dark:text-yellow-100 mb-2">Kondisi khusus anak (jika ada)</label>
                <textarea name="kondisi" rows="3"
                    class="w-full border border-yellow-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 dark:bg-yellow-800 dark:border-yellow-700 dark:text-white"></textarea>
            </div>

            <!-- Custom Multi Select: Bidang Terkait -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-yellow-800 dark:text-yellow-100 mb-2">
                    Bidang Terkait *
                </label>
                <div class="relative">
                    <!-- Input sebagai trigger -->
                    <div id="multiSelect"
                        class="w-full border border-yellow-300 rounded-lg px-3 py-2 bg-white dark:bg-yellow-800 dark:border-yellow-700 dark:text-white cursor-pointer flex flex-wrap gap-2 min-h-[45px]">
                        <span id="placeholder" class="text-gray-500 dark:text-gray-300">Pilih bidang terkait...</span>
                    </div>

                    <!-- Dropdown opsi -->
                    <div id="options"
                        class="absolute left-0 right-0 mt-1 bg-white dark:bg-yellow-900 border border-yellow-300 dark:border-yellow-700 rounded-lg shadow-lg hidden z-10">
                        <div class="p-2 hover:bg-yellow-100 dark:hover:bg-yellow-700 cursor-pointer" data-value="Kurikulum">Kurikulum</div>
                        <div class="p-2 hover:bg-yellow-100 dark:hover:bg-yellow-700 cursor-pointer" data-value="Qur'an">Qur'an</div>
                        <div class="p-2 hover:bg-yellow-100 dark:hover:bg-yellow-700 cursor-pointer" data-value="Kesiswaan">Kesiswaan</div>
                    </div>
                </div>
                <!-- Hidden input untuk form -->
                <input type="hidden" name="bidang" id="selectedValues">
            </div>




            <!-- Kesanggupan -->
            <div>
                <label class="block text-sm font-semibold text-yellow-800 dark:text-yellow-100 mb-2">Kesanggupan mendukung program sekolah *</label>
                <select name="kesanggupan" required
                    class="w-full border border-yellow-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 dark:bg-yellow-800 dark:border-yellow-700 dark:text-white">
                    <option value="">-- Pilih --</option>
                    <option value="Sangat Siap">Sangat Siap</option>
                    <option value="Siap">Siap</option>
                    <option value="Ragu-ragu">Ragu-ragu</option>
                    <option value="Tidak Siap">Tidak Siap</option>
                </select>
            </div>

            <!-- Tombol Submit -->
            <div class="text-center">
                <button type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-lg transition">
                    Simpan Wawancara
                </button>
            </div>
        </form>
    </div>



    <script>
        const multiSelect = document.getElementById('multiSelect');
        const options = document.getElementById('options');
        const placeholder = document.getElementById('placeholder');
        const selectedValuesInput = document.getElementById('selectedValues');

        let selected = [];

        // Toggle dropdown
        multiSelect.addEventListener('click', () => {
            options.classList.toggle('hidden');
        });

        // Pilih opsi
        options.querySelectorAll('div').forEach(option => {
            option.addEventListener('click', () => {
                const value = option.getAttribute('data-value');
                if (!selected.includes(value)) {
                    selected.push(value);
                    updateSelected();
                }
            });
        });

        // Update tampilan & hidden input
        function updateSelected() {
            multiSelect.innerHTML = '';
            selected.forEach(val => {
                const tag = document.createElement('span');
                tag.className = 'bg-yellow-200 text-yellow-900 px-2 py-1 rounded-lg text-sm flex items-center gap-1';
                tag.innerHTML = `${val} <button type="button" class="ml-1 text-red-600 font-bold" onclick="removeValue('${val}')">×</button>`;
                multiSelect.appendChild(tag);
            });
            if (selected.length === 0) {
                multiSelect.appendChild(placeholder);
            }
            selectedValuesInput.value = selected.join(',');
        }

        // Hapus pilihan
        function removeValue(val) {
            selected = selected.filter(v => v !== val);
            updateSelected();
        }

        // Klik di luar menutup dropdown
        document.addEventListener('click', (e) => {
            if (!multiSelect.contains(e.target) && !options.contains(e.target)) {
                options.classList.add('hidden');
            }
        });
    </script>

</body>

</html>