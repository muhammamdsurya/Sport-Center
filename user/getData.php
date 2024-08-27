<?php
require "../functions.php";
header('Content-Type: application/json');

// Pastikan ID lapangan disertakan dalam request
$id_lapangan = isset($_POST['id_lapangan']) ? $_POST['id_lapangan'] : '';

// Validasi ID lapangan
if (!$id_lapangan) {
    echo json_encode(['error' => 'ID lapangan tidak valid']);
    exit();
}

// Koneksi ke database dan query
$sewa = query("SELECT sewa_212279.*, lapangan_212279.212279_nama, user_212279.212279_nama_lengkap
FROM sewa_212279
JOIN lapangan_212279 ON sewa_212279.212279_id_lapangan = lapangan_212279.212279_id_lapangan
LEFT JOIN user_212279 ON sewa_212279.212279_id_user = user_212279.212279_id_user
WHERE lapangan_212279.212279_id_lapangan = '$id_lapangan'");

// Pastikan bahwa query sukses
if ($sewa) {
    echo json_encode($sewa);
} else {
    echo json_encode(['error' => 'Belum Ada Booking']);
}
?>
