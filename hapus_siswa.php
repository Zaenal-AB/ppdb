<?php

include 'config/app.php';

//menerima id  yang dipilih pengguna

$id = (int)$_GET['id'];

if (delete_siswa($id) > 0) {
    echo "<script>
        alert('Data Calon Siswa Berhasil Dihapus');
        document.location.href = 'siswa_terdaftar.php';
        </script>";
} else {
    echo "<script>
        alert('Data  Gagal Dihapus');
        document.location.href = 'siswa_terdaftar.php';
        </script>";
}
