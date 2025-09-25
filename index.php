<?php


include 'config/app.php';

// Jika tombol tambah siswa ditekan
if (isset($_POST['tambah'])) {
  if (create_siswa($_POST, $_FILES) > 0) {
    // Simpan nama siswa ke session
    $_SESSION['nama_siswa'] = $_POST['nama_lengkap'];

    echo "<script>
        document.location.href = 'wa.php';
        </script>";
  } else {
    echo "<script>
        alert('Pendaftaran gagal disimpan!');
        document.location.href = 'index.php';
        </script>";
  }
}




?>



<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Formulir SPMB - SMPIT Anak Sholeh Mataram</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .form-label {
      font-weight: 600;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    .akta-warning {
      color: #dc2626;
      font-size: 0.75rem;
      margin-top: 0.25rem;
      display: none;
    }

    .akta-field:focus+.akta-warning {
      display: block;
    }
  </style>
</head>

<body
  class="h-full bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 transition-colors">
  <div class="max-w-5xl mx-auto p-6">
    <!-- Header Modern -->
    <header
      class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 shadow-lg mb-8">
      <div
        class="absolute inset-0 opacity-10 bg-[url('https://www.toptal.com/designers/subtlepatterns/uploads/double-bubble.png')]"></div>
      <div
        class="relative flex flex-col md:flex-row items-center justify-between px-6 py-6 md:py-8">
        <!-- Kiri -->
        <div class="text-center md:text-left">
          <h1
            class="text-2xl md:text-4xl font-extrabold text-white drop-shadow">
            Formulir SPMB 2026/2027
          </h1>
          <p class="text-sm md:text-base text-indigo-100 mt-2">
            SMPIT Anak Sholeh Mataram — Jalan Pondok Indah, Kota Mataram.
          </p>
        </div>

        <!-- Kanan -->
        <div class="flex items-center gap-4 mt-4 md:mt-0">
          <!-- Info Sekolah -->
          <div
            class="hidden md:block text-right text-white pr-4 border-r border-white/30">
            <p class="font-semibold">📍 Mataram, NTB</p>
            <p class="text-sm opacity-80">Tel/WA: 0878-6673-4399</p>
            <p class="text-sm opacity-80">
              Email: smpitanaksholehmataram@gmail.com
            </p>
          </div>
          <!-- Dark Mode Toggle -->
          <button
            id="darkToggle"
            type="button"
            class="p-3 rounded-full bg-white/20 hover:bg-white/30 transition">
            <span id="icon-sun" class="hidden">🌞</span>
            <span id="icon-moon" class="hidden">🌙</span>
          </button>
        </div>
      </div>
      <!-- Wave Effect -->
      <div
        class="absolute bottom-0 left-0 right-0 overflow-hidden leading-[0]">
        <svg
          viewBox="0 0 500 150"
          preserveAspectRatio="none"
          class="w-full h-12 fill-white dark:fill-gray-900">
          <path
            d="M-6.64,97.51 C149.99,150.00 271.62,8.60 500.00,100.00 L500.00,150.00 L0.00,150.00 Z"></path>
        </svg>
      </div>
    </header>

    <main>
      <form
        id="ppdbForm"
        action=""
        method="POST"
        enctype="multipart/form-data"
        class="space-y-8 bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6 border border-slate-300"
        autocomplete="off">
        <!-- Data Siswa -->
        <section>
          <h2
            class="text-xl font-black mb-4 text-blue-700 underline underline-offset-1">
            Data Calon Peserta Didik
          </h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="form-label">Nama Lengkap *</label>
              <input
                type="text"
                name="nama_lengkap"
                placeholder="Masukkan nama lengkap"
                required
                class="akta-field mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700" />
              <div class="akta-warning">
                Harus Sesuai dengan Akta Kelahiran
              </div>
            </div>
            <div>
              <label class="form-label">NISN</label>
              <input
                type="number"
                name="nisn"
                placeholder="Masukkan NISN"
                class="mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700" />
            </div>
            <div>
              <label class="form-label">Tempat Lahir *</label>
              <input
                type="text"
                name="tempat_lahir"
                placeholder="Masukkan tempat lahir"
                required
                class="akta-field mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700" />
              <div class="akta-warning">
                Harus Sesuai dengan Akta Kelahiran
              </div>
            </div>
            <div>
              <label class="form-label">Tanggal Lahir *</label>
              <input
                type="date"
                name="tanggal_lahir"
                required
                class="akta-field mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700" />
              <div class="akta-warning">
                Harus Sesuai dengan Akta Kelahiran
              </div>
            </div>
            <div>
              <label class="form-label">Jenis Kelamin *</label>
              <select
                name="jenis_kelamin"
                required
                class="mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700">
                <option value="">-- Pilih --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div>
              <label class="form-label">Sekolah Asal *</label>
              <input
                type="text"
                name="sekolah_asal"
                placeholder="nama SD/MI"
                required
                class="mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700" />
            </div>

            <div>
              <label class="form-label">Anak ke- *</label>
              <input
                type="number"
                placeholder="0"
                name="anakke"
                required
                class="mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700" />
            </div>

            <div>
              <label class="form-label">Jumlah Saudara Kandung *</label>
              <input
                type="number"
                placeholder="0"
                name="jsaudara"
                required
                class="mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700" />
            </div>

            <div class="md:col-span-2">
              <label class="form-label">Alamat Lengkap *</label>
              <textarea
                name="alamat"
                placeholder="Masukkan alamat lengkap"
                required
                class="akta-field mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700"></textarea>
              <div class="akta-warning">
                Harus Sesuai dengan Kartu Keluarga
              </div>
            </div>
            <div>
              <label class="form-label">Kecamatan *</label>
              <input
                type="text"
                name="kecamatan"
                placeholder="Masukkan kecamatan"
                required
                class="mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700" />
            </div>
            <div>
              <label class="form-label">Kabupaten/Kota *</label>
              <input
                type="text"
                name="kabupaten"
                placeholder="Masukkan kabupaten/kota"
                required
                class="mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700" />
            </div>
          </div>
          <hr class="my-6 border border-slate-600-slate-300" />
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="form-label">Pilih Kelas *</label>
              <select
                name="kelas"
                required
                class="mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700">
                <option value="">-- Pilih --</option>
                <option value="Kelas Tahfiz">Kelas Tahfidz</option>
                <option value="Kelas Reguler">Kelas Reguler</option>
              </select>
            </div>

            <div>
              <label class="form-label">Jalur Pendaftaran *</label>
              <select
                id="jalurSelect"
                name="jalur"
                required
                class="mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700">
                <option value="">-- Pilih --</option>
                <option value="Tahfiz">Tahfiz</option>
                <option value="Prestasi">Prestasi</option>
                <option value="Reguler">Reguler</option>
              </select>
            </div>

            <div id="jalurKeterangan" class="md:col-span-2 hidden">
              <label class="form-label">Keterangan Jalur Pendaftaran</label>
              <textarea
                id="keteranganInput"
                name="keterangan_jalur"
                placeholder="Tuliskan keterangan tambahan..."
                class="mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700"></textarea>
            </div>
          </div>
        </section>

        <!-- Data Orang Tua -->
        <section>
          <h2
            class="text-xl font-bold mb-4 text-blue-700 underline underline-offset-1">
            Data Orang Tua
          </h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="form-label">Nama Ayah *</label>
              <input
                type="text"
                name="nama_ayah"
                placeholder="Masukkan nama ayah"
                required
                class="akta-field mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700" />
              <div class="akta-warning">
                Harus Sesuai dengan Akta Kelahiran
              </div>
            </div>
            <div>
              <label class="form-label">Pekerjaan Ayah *</label>
              <input
                type="text"
                name="pekerjaan_ayah"
                placeholder="Pekerjaan ayah"
                required
                class="mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700" />
            </div>
            <div>
              <label class="form-label">Tempat Ayah Bekerja</label>
              <input
                type="text"
                name="tempat_bekerja_ayah"
                placeholder="Ex: PT. ABC, Dinas X, dsb"
                class="mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700" />
            </div>
            <div>
              <label class="form-label">Nama Ibu *</label>
              <input
                type="text"
                name="nama_ibu"
                placeholder="Masukkan nama ibu"
                required
                class="akta-field mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700" />
              <div class="akta-warning">
                Harus Sesuai dengan Akta Kelahiran
              </div>
            </div>
            <div>
              <label class="form-label">Pekerjaan Ibu *</label>
              <input
                type="text"
                name="pekerjaan_ibu"
                placeholder="Pekerjaan ibu"
                required
                class="mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700" />
            </div>
            <div>
              <label class="form-label">Tempat Ibu Bekerja</label>
              <input
                type="text"
                name="tempat_bekerja_ibu"
                placeholder="Ex: PT. ABC, Dinas X, dsb"
                class="mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700" />
            </div>
            <div>
              <label class="form-label">No. HP/WA Orang Tua *</label>
              <input
                type="tel"
                name="no_hp"
                placeholder="08xxxxxxxxxx"
                pattern="08[0-9]{8,11}"
                required
                class="mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700" />
            </div>
          </div>
        </section>

        <!-- Data Wali -->
        <section>
          <h2
            class="text-xl font-bold mb-4 text-blue-700 underline underline-offset-1">
            Data Wali Siswa
          </h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="form-label">Nama Wali</label>
              <input
                type="text"
                name="nama_wali"
                placeholder="Masukkan nama wali"
                class="mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700" />
            </div>
            <div>
              <label class="form-label">Pekerjaan Wali</label>
              <input
                type="text"
                name="pekerjaan_wali"
                placeholder="Pekerjaan wali"
                class="mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700" />
            </div>
            <div>
              <label class="form-label">No. HP Wali</label>
              <input
                type="tel"
                name="no_hp_wali"
                placeholder="08xxxxxxxxxx"
                pattern="08[0-9]{8,11}"
                class="mt-1 w-full p-2 rounded-lg border border-slate-600 dark:bg-gray-700" />
            </div>
          </div>
        </section>

        <section>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <h2
                class="text-xl font-bold mb-4 text-blue-700 underline underline-offset-1">
                Mendapatkan informasi PPDB dari mana? *
              </h2>
              <p class="mb-1">
                Pilih salah satu sumber informasi di bawah ini:
              </p>

              <label class="flex items-center gap-2">
                <input
                  type="radio"
                  name="sumber_info"
                  value="Website"
                  class="text-blue-600 focus:ring-blue-500" />
                <span>Website sekolah</span>
              </label>
              <label class="flex items-center gap-2">
                <input
                  type="radio"
                  name="sumber_info"
                  value="Media Sosial"
                  class="text-blue-600 focus:ring-blue-500" />
                <span>Media sosial (Instagram/Facebook/TikTok)</span>
              </label>
              <label class="flex items-center gap-2">
                <input
                  type="radio"
                  name="sumber_info"
                  value="Brosur"
                  class="text-blue-600 focus:ring-blue-500" />
                <span>Brosur / Spanduk</span>
              </label>
              <label class="flex items-center gap-2">
                <input
                  type="radio"
                  name="sumber_info"
                  value="Orang Tua"
                  class="text-blue-600 focus:ring-blue-500" />
                <span>Orang tua / Wali murid</span>
              </label>
              <label class="flex items-center gap-2">
                <input
                  type="radio"
                  name="sumber_info"
                  value="Alumni"
                  class="text-blue-600 focus:ring-blue-500" />
                <span>Alumni / Teman</span>
              </label>
              <label class="flex items-center gap-2">
                <input
                  type="radio"
                  name="sumber_info"
                  value="Lainnya"
                  id="infoLainnya"
                  class="text-blue-600 focus:ring-blue-500" />
                <span>Lainnya</span>
              </label>
              <!-- Input teks muncul jika pilih "Lainnya" -->
              <input
                type="text"
                id="inputLainnya"
                name="sumber_info_lainnya"
                placeholder="Tulis sumber informasi..."
                class="mt-2 hidden w-full border border-slate-600 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 p-2" />
            </div>

            <div>
              <!-- Upload Bukti Pendaftaran -->
              <h2
                class="text-xl font-bold mb-4 text-blue-700 underline underline-offset-1">
                Upload Bukti Pendaftaran*
              </h2>
              <input
                type="file"
                id="bukti"
                name="bukti"
                accept=".jpg,.jpeg,.png,.pdf"
                required
                class="block w-full text-sm text-gray-500 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-200" />
              <p class="text-xs opacity-70 mt-1">
                Format: JPG, PNG, PDF (maks 5MB)
              </p>
              <div id="preview" class="mt-3"></div>
            </div>
            <div>
              <!-- Upload Akta Kelahiran -->
              <h2
                class="text-xl font-bold mb-4 text-blue-700 underline underline-offset-1">
                Upload Akta Kelahiran*
              </h2>
              <input
                type="file"
                id="akta"
                name="akta"
                accept=".jpg,.jpeg,.png,.pdf"
                required
                class="block w-full text-sm text-gray-500 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-200" />
              <p class="text-xs opacity-70 mt-1">
                Format: JPG, PNG, PDF (maks 5MB)
              </p>
              <div id="previewAkta" class="mt-3"></div>
            </div>
            <div>
              <!-- Upload Kartu Keluarga -->
              <h2
                class="text-xl font-bold mb-4 text-blue-700 underline underline-offset-1">
                Upload Kartu Keluarga*
              </h2>
              <input
                type="file"
                id="kk"
                name="kk"
                accept=".jpg,.jpeg,.png,.pdf"
                required
                class="block w-full text-sm text-gray-500 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-200" />
              <p class="text-xs opacity-70 mt-1">
                Format: JPG, PNG, PDF (maks 5MB)
              </p>
              <div id="previewKK" class="mt-3"></div>
            </div>
          </div>
        </section>

        <div class="text-right">
          <button
            type="submit" name="tambah"
            class="px-6 py-3 bg-blue-600 text-white rounded-xl shadow hover:bg-blue-700">
            Kirim Formulir
          </button>
        </div>
      </form>
    </main>
  </div>

  <script>
    // JS untuk toggle textarea keterangan jalur
    const jalurSelect = document.getElementById("jalurSelect");
    const jalurKeterangan = document.getElementById("jalurKeterangan");
    const keteranganInput = document.getElementById("keteranganInput");

    jalurSelect.addEventListener("change", function() {
      if (this.value === "Tahfiz" || this.value === "Prestasi") {
        jalurKeterangan.classList.remove("hidden");
        keteranganInput.required = true; // wajib diisi
      } else {
        jalurKeterangan.classList.add("hidden");
        keteranganInput.required = false; // tidak wajib
        keteranganInput.value = ""; // kosongkan jika disembunyikan
      }
    });

    // JS untuk toggle input "Lainnya"
    document
      .querySelectorAll('input[name="sumber_info"]')
      .forEach((radio) => {
        radio.addEventListener("change", function() {
          const inputLainnya = document.getElementById("inputLainnya");
          if (this.value === "Lainnya") {
            inputLainnya.classList.remove("hidden");
            inputLainnya.required = true;
          } else {
            inputLainnya.classList.add("hidden");
            inputLainnya.required = false;
          }
        });
      });

    // Dark mode toggle
    const toggle = document.getElementById("darkToggle");
    const iconSun = document.getElementById("icon-sun");
    const iconMoon = document.getElementById("icon-moon");

    function applyDarkMode(prefersDark) {
      if (prefersDark) {
        document.documentElement.classList.add("dark");
        iconSun.classList.remove("hidden");
        iconMoon.classList.add("hidden");
      } else {
        document.documentElement.classList.remove("dark");
        iconSun.classList.add("hidden");
        iconMoon.classList.remove("hidden");
      }
    }

    const mediaQuery = window.matchMedia("(prefers-color-scheme: dark)");
    applyDarkMode(mediaQuery.matches);
    mediaQuery.addEventListener("change", (e) => applyDarkMode(e.matches));

    toggle.addEventListener("click", () => {
      const isDark = document.documentElement.classList.contains("dark");
      applyDarkMode(!isDark);
    });

    // Preview file upload untuk bukti pendaftaran
    document.getElementById("bukti").addEventListener("change", function() {
      const file = this.files[0];
      const preview = document.getElementById("preview");
      preview.innerHTML = "";
      if (file) {
        if (file.size > 5 * 1024 * 1024) {
          alert("Ukuran file maksimal 5MB");
          this.value = "";
          return;
        }
        if (file.type.startsWith("image/")) {
          const reader = new FileReader();
          reader.onload = (e) => {
            preview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="max-h-48 rounded-lg shadow">`;
          };
          reader.readAsDataURL(file);
        } else {
          preview.innerHTML = `<p class='text-sm'>File siap diunggah: ${file.name}</p>`;
        }
      }
    });

    // Preview file upload untuk akta kelahiran
    document.getElementById("akta").addEventListener("change", function() {
      const file = this.files[0];
      const preview = document.getElementById("previewAkta");
      preview.innerHTML = "";
      if (file) {
        if (file.size > 5 * 1024 * 1024) {
          alert("Ukuran file maksimal 5MB");
          this.value = "";
          return;
        }
        if (file.type.startsWith("image/")) {
          const reader = new FileReader();
          reader.onload = (e) => {
            preview.innerHTML = `<img src="${e.target.result}" alt="Preview Akta" class="max-h-48 rounded-lg shadow">`;
          };
          reader.readAsDataURL(file);
        } else {
          preview.innerHTML = `<p class='text-sm'>File siap diunggah: ${file.name}</p>`;
        }
      }
    });


    // Preview file upload untuk kartu keluarga
    document.getElementById("kk").addEventListener("change", function() {
      const file = this.files[0];
      const preview = document.getElementById("previewKK");
      preview.innerHTML = "";
      if (file) {
        if (file.size > 5 * 1024 * 1024) {
          alert("Ukuran file maksimal 5MB");
          this.value = "";
          return;
        }
        if (file.type.startsWith("image/")) {
          const reader = new FileReader();
          reader.onload = (e) => {
            preview.innerHTML = `<img src="${e.target.result}" alt="Preview KK" class="max-h-48 rounded-lg shadow">`;
          };
          reader.readAsDataURL(file);
        } else {
          preview.innerHTML = `<p class='text-sm'>File siap diunggah: ${file.name}</p>`;
        }
      }
    });

    form.addEventListener("submit", (e) => {
      if (!form.checkValidity()) {
        e.preventDefault();
        alert("Mohon lengkapi semua field wajib dengan benar.");
      }
      // kalau valid → biarkan form submit ke PHP
    });

    // Tambahan: Menampilkan pesan ketika field akta di-klik
    document.querySelectorAll(".akta-field").forEach((field) => {
      field.addEventListener("focus", function() {
        // Pesan sudah muncul otomatis melalui CSS
      });
    });
  </script>
</body>

</html>