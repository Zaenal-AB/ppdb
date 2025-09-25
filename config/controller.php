<?php

function select($query, $params = [])
{
    // Panggil koneksi database
    global $conn;

    // Prepare the statement
    $stmt = $conn->prepare($query);

    if ($params) {
        // Generate the types string ('s' for strings, 'i' for integers, etc.)
        $types = str_repeat('s', count($params));
        $stmt->bind_param($types, ...$params);
    }

    // Execute and get result
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}


// ================ BAGIAN DATA SISWA ========================= //

function create_siswa($post, $files)
{
    global $conn;

    // Data dari form
    $nama_lengkap   = htmlspecialchars($post['nama_lengkap']);
    $nisn           = htmlspecialchars($post['nisn']);
    $tempat_lahir   = htmlspecialchars($post['tempat_lahir']);
    $tanggal_lahir  = htmlspecialchars($post['tanggal_lahir']);
    $jenis_kelamin  = htmlspecialchars($post['jenis_kelamin']);
    $sekolah_asal   = htmlspecialchars($post['sekolah_asal']);
    $anakke         = htmlspecialchars($post['anakke']);
    $jsaudara       = htmlspecialchars($post['jsaudara']);
    $alamat         = htmlspecialchars($post['alamat']);
    $kecamatan      = htmlspecialchars($post['kecamatan']);
    $kabupaten      = htmlspecialchars($post['kabupaten']);
    $kelas          = htmlspecialchars($post['kelas']);
    $jalur          = htmlspecialchars($post['jalur']);
    $keterangan_jalur = isset($post['keterangan_jalur']) ? htmlspecialchars($post['keterangan_jalur']) : null;
    $nama_ayah      = htmlspecialchars($post['nama_ayah']);
    $pekerjaan_ayah = htmlspecialchars($post['pekerjaan_ayah']);
    $nama_ibu       = htmlspecialchars($post['nama_ibu']);
    $pekerjaan_ibu  = htmlspecialchars($post['pekerjaan_ibu']);
    $no_hp          = htmlspecialchars($post['no_hp']);
    $nama_wali      = !empty($post['nama_wali']) ? htmlspecialchars($post['nama_wali']) : null;
    $pekerjaan_wali = !empty($post['pekerjaan_wali']) ? htmlspecialchars($post['pekerjaan_wali']) : null;
    $no_hp_wali     = !empty($post['no_hp_wali']) ? htmlspecialchars($post['no_hp_wali']) : null;
    $sumber_info    = htmlspecialchars($post['sumber_info']);
    $sumber_info_lainnya = isset($post['sumber_info_lainnya']) ? htmlspecialchars($post['sumber_info_lainnya']) : null;

    // Upload file
    $bukti = upload_file($files['bukti'], "uploads/bukti");
    $akta  = upload_file($files['akta'], "uploads/akta");
    $kk    = upload_file($files['kk'], "uploads/kk");

    if (!$bukti || !$akta || !$kk) {
        return 0; // jika upload gagal
    }

    // Query pakai prepared statement
    $query = "INSERT INTO data_siswa 
        (nama_lengkap, nisn, tempat_lahir, tanggal_lahir, jenis_kelamin, sekolah_asal, 
         anakke, jsaudara, alamat, kecamatan, kabupaten, kelas, jalur, keterangan_jalur, 
         nama_ayah, pekerjaan_ayah, nama_ibu, pekerjaan_ibu, no_hp, nama_wali, pekerjaan_wali, 
         no_hp_wali, sumber_info, sumber_info_lainnya, bukti, akta, kk, created_at)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())";

    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param(
        "sssssssssssssssssssssssssss",
        $nama_lengkap,
        $nisn,
        $tempat_lahir,
        $tanggal_lahir,
        $jenis_kelamin,
        $sekolah_asal,
        $anakke,
        $jsaudara,
        $alamat,
        $kecamatan,
        $kabupaten,
        $kelas,
        $jalur,
        $keterangan_jalur,
        $nama_ayah,
        $pekerjaan_ayah,
        $nama_ibu,
        $pekerjaan_ibu,
        $no_hp,
        $nama_wali,
        $pekerjaan_wali,
        $no_hp_wali,
        $sumber_info,
        $sumber_info_lainnya,
        $bukti,
        $akta,
        $kk
    );

    if ($stmt->execute()) {
        return $stmt->affected_rows;
    } else {
        die("Execute failed: " . $stmt->error);
    }
}


// Fungsi helper untuk upload file dengan nama unik & folder khusus
function upload_file($file, $folder = "uploads")
{
    $namaFile   = $file['name'];
    $tmpName    = $file['tmp_name'];

    // Jika tidak ada file
    if ($namaFile == "" || $tmpName == "") {
        return null;
    }

    // Ambil ekstensi file
    $extensifile = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

    // Generate nama file baru
    $namaFileBaru = uniqid() . '.' . $extensifile;

    // Pastikan folder target ada
    $upload_dir = $folder . "/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Pindahkan file
    move_uploaded_file($tmpName, $upload_dir . $namaFileBaru);

    return $namaFileBaru; // hanya nama file yg disimpan ke DB
}
