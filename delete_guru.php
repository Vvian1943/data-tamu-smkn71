<?php
session_start();
include "koneksi.php";
if (isset($_GET['hapus'])) {
    $no = intval($_GET['hapus']);  // Ambil dan bersihkan data No dari URL
    // Query hapus data guru berdasarkan nomor
    $query = "DELETE FROM tbl_guru WHERE No = $no";
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil, arahkan kembali ke halaman data guru dengan pesan sukses
        header("Location: data_guru.php?pesan=Data guru berhasil dihapus");
        exit;
    } else {
        // Jika gagal, tampilkan pesan error
        die("Gagal menghapus data: " . mysqli_error($koneksi));
    }
} else {
    // Jika parameter hapus tidak ada, kembali ke halaman data guru
    header("Location: data_guru.php");
    exit;
}
?>