<?php
include "koneksi.php";
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Cek apakah parameter edit tersedia
if (!isset($_GET['edit'])) {
    header("Location: data_guru.php");
    exit;
}

$No = intval($_GET['edit']);
$query = "SELECT * FROM tbl_guru WHERE No = $No";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Jika data tidak ditemukan
if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}

// Proses update data guru
if (isset($_POST['update'])) {
    $Nama_Guru = mysqli_real_escape_string($koneksi, $_POST['Nama_Guru']);
    $Jenis_Kelamin = mysqli_real_escape_string($koneksi, $_POST['Jenis_Kelamin']);
    $Alamat = mysqli_real_escape_string($koneksi, $_POST['Alamat']);
    $Mapel = mysqli_real_escape_string($koneksi, $_POST['Mapel']);

    $update = "UPDATE tbl_guru SET 
                Nama_Guru = '$Nama_Guru',
                Jenis_Kelamin = '$Jenis_Kelamin',
                Alamat = '$Alamat',
                Mapel = '$Mapel'
               WHERE No = $No";

    if (mysqli_query($koneksi, $update)) {
        header("Location: data_guru.php");
        exit;
    } else {
        echo "Gagal mengupdate data.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Guru</title>
    <style>
        body {
            background-color: rgb(87, 162, 197);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 30px;
            transition: background-color 0.3s, color 0.3s;
        }

        .form-container {
            max-width: 600px;
            margin: 60px auto;
            background-color: rgb(25, 121, 165);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s, color 0.3s;
        }

        h2 {
            text-align: center;
            color: #000;
        }

        label {
            display: block;
            margin-top: 15px;
            color: #000;
        }

        input[type="text"],
        input[list] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .btn {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            margin-left: 10px;
        }

        .btn-secondary:hover {
            background-color: #545b62;
        }

        /* Dark Mode Styling */
        .dark-mode {
            background-color: #121212;
            color: #ffffff;
        }

        .dark-mode .form-container {
            background-color: #1e1e1e;
        }

        .dark-mode input[type="text"],
        .dark-mode input[list] {
            background-color: #2a2a2a;
            color: white;
            border: 1px solid #555;
        }

        .dark-mode .btn {
            background-color: #444;
        }

        .dark-mode .btn:hover {
            background-color: #333;
        }

        .dark-mode .btn-secondary {
            background-color: #666;
        }

        .dark-mode .btn-secondary:hover {
            background-color: #555;
        }

        .dark-toggle {
            position: absolute;
            top: 20px;
            right: 30px;
            padding: 8px 14px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .dark-toggle:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Tombol Toggle Dark Mode -->
    <button class="dark-toggle" onclick="toggleDarkMode()">Dark Mode</button>

    <div class="form-container">
        <h2>Edit Data Guru</h2>
        <form method="POST">
            <input type="hidden" name="No" value="<?= $data['No'] ?>">

            <label for="Nama_Guru">Nama Guru:</label>
            <input type="text" id="Nama_Guru" name="Nama_Guru" value="<?= htmlspecialchars($data['Nama_Guru']) ?>" required>

            <label for="Jenis_Kelamin">Jenis Kelamin:</label>
            <input list="Jenis_Kelamin_List" id="Jenis_Kelamin" name="Jenis_Kelamin" value="<?= htmlspecialchars($data['Jenis_Kelamin']) ?>" required>
            <datalist id="Jenis_Kelamin_List">
                <option value="Laki-laki">
                <option value="Perempuan">
            </datalist>

            <label for="Alamat">Alamat:</label>
            <input type="text" id="Alamat" name="Alamat" value="<?= htmlspecialchars($data['Alamat']) ?>" required>

            <label for="Mapel">Mata Pelajaran:</label>
            <input type="text" id="Mapel" name="Mapel" value="<?= htmlspecialchars($data['Mapel']) ?>" required>

            <button type="submit" name="update" class="btn">Simpan</button>
            <a href="data_guru.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

   <script>
    // Fungsi Toggle Dark Mode dan Simpan ke Local Storage
    function toggleDarkMode() {
        const body = document.body;
        const toggleBtn = document.querySelector('.dark-toggle');

        body.classList.toggle('dark-mode');
        const isDark = body.classList.contains('dark-mode');
        localStorage.setItem('mode', isDark ? 'dark' : 'light');

        toggleBtn.innerText = isDark ? 'Light Mode' : 'Dark Mode';
    }

    // Cek dan Terapkan Mode Saat Halaman Dimuat
    window.onload = function () {
        const savedMode = localStorage.getItem('mode');
        const toggleBtn = document.querySelector('.dark-toggle');

        if (savedMode === 'dark') {
            document.body.classList.add('dark-mode');
            toggleBtn.innerText = 'Light Mode';
        } else {
            toggleBtn.innerText = 'Dark Mode';
        }
    }
</script>
</body>
</html>
