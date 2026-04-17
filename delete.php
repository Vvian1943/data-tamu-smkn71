<?php
include "koneksi.php";
session_start();

// Pastikan user sudah login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Cek apakah ada parameter 'hapus'
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    // Query hapus data berdasarkan id
    $query = "DELETE FROM tbl_siswa WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: data_siswa.php");
        exit;
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    // Jika tidak ada parameter, kembali ke home
    header("Location: home.php");
    exit;
}
?>
