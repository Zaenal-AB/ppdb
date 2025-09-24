<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "ppdb";

// $host = "localhost";
// $user = "u966478672_presensi";
// $pass = "Presensi!7";
// $db   = "u966478672_presensi";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

date_default_timezone_set('Asia/Makassar');

// tes..

?>