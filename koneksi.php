<?php

$host     = "localhost";
$username = "root";
$password = "";
$database = "db_sekolah"; 

$koneksi = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
} else {
    // echo "Koneksi berhasil";
}
?>