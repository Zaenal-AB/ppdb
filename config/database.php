<?php
// $host = "localhost"; $user = "root"; $pass = ""; $db   = "ppdb";
$host = "localhost"; $user = "u966478672_ppdbnew"; $pass = "Zaenal!17"; $db   = "u966478672_ppdbnew";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

date_default_timezone_set('Asia/Makassar');

// tes..

?>