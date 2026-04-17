<?php
include 'koneksi.php'; // Pastikan file koneksi.php di-include
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Ambil data siswa
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : ''; // Ambil keyword pencarian
if ($keyword) {
    $query = "SELECT * FROM tbl_siswa WHERE nis LIKE '%$keyword%' OR nama LIKE '%$keyword%'";
} else {
    $query = "SELECT * FROM tbl_siswa"; // Query tanpa filter
}

$result = mysqli_query($koneksi, $query); // Eksekusi query

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        background-color:rgb(87, 162, 197);
        color: white;
      }
      .content-wrapper {
        background:rgb(25, 121, 165);
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      }
      .btn-outline-secondary {
        color: white;
        border-color: white;
      }
      .btn-outline-secondary:hover {
        background-color: white;
        color: #a00855;
      }
      .form-control {
        background-color: #fff;
        color: #000;
      }
      table, th, td {
        color: white;
      }
      .table-light {
        background-color: #ffffff;
        color: black;
      }
    </style>
</head>
<body class="container mt-5">
    <div class="content-wrapper">
        <section class="text-center">
            <h2 class="mb-4">Manajemen Data Siswa</h2>
        </section>

        <!-- button tambah -->
        <a href="tambah.php" class="btn btn-primary mb-3"> + Tambah Data</a>


        <!-- tabel data -->
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>id</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1; 
                while($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['Nama'] ?></td>
                        <td><?= $row['Kelas'] ?></td>
                        <td><?= $row['Jurusan'] ?></td>
                        <td class="text-center">
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-success">Edit</a>
                            <a href="index.php?hapus=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                               onclick="return confirm('Apakah Anda Yakin?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <a href="logout.php" class="btn btn-sm btn-danger">Logout</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
