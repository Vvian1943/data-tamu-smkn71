<?php
include "koneksi.php";

if (!isset($_GET['edit'])) {
    header("Location: data_siswa.php");
    exit;
}

$id = $_GET['edit'];

// Ambil data siswa berdasarkan ID
$query = mysqli_query($koneksi, "SELECT * FROM tbl_siswa WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

// Jika tombol simpan ditekan
if (isset($_POST['update'])) {
    $Nama = $_POST['Nama'];
    $Kelas = $_POST['Kelas'];
    $Jurusan = $_POST['Jurusan'];

    $update = mysqli_query($koneksi, "UPDATE tbl_siswa SET 
        Nama = '$Nama',
        Kelas = '$Kelas',
        Jurusan = '$Jurusan'
        WHERE id = '$id'
    ");

    if ($update) {
        header("Location: data_siswa.php");
        exit;
    } else {
        echo "Gagal mengubah data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Siswa</title>
    <style>
    /* Light mode styles */
    body {
        background-color: rgb(87, 162, 197);
        font-family: Arial, sans-serif;
        padding: 30px;
        margin: 0;
        color: black;
        transition: background-color 0.3s, color 0.3s;
    }

    .form-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 30px;
        background-color: rgb(25, 121, 165);
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        transition: background-color 0.3s, box-shadow 0.3s;
        position: relative;
    }

    h2 {
        text-align: center;
        color: black;
        margin-bottom: 20px;
        transition: color 0.3s;
    }

    label {
        display: block;
        margin-top: 15px;
        color: black;
        transition: color 0.3s;
    }

    input[type="text"],
    input[list] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        transition: background-color 0.3s, color 0.3s, border-color 0.3s;
        color: black;
        background-color: white;
    }

    .btn {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        text-align: center;
        color: white;
        background-color: #007bff;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        text-decoration: none;
        font-size: 14px;
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

    /* Dark mode styles */
    body.dark-mode {
        background-color: #121212;
        color: #e0e0e0;
    }

    body.dark-mode .form-container {
        background-color: #1e1e1e;
        box-shadow: 0 5px 15px rgba(255, 255, 255, 0.1);
    }

    body.dark-mode h2,
    body.dark-mode label {
        color: #e0e0e0;
    }

    body.dark-mode input[type="text"],
    body.dark-mode input[list] {
        background-color: #2c2c2c;
        color: #e0e0e0;
        border-color: #555;
    }

    body.dark-mode .btn {
        background-color: #0d6efd;
    }

    body.dark-mode .btn-secondary {
        background-color: #495057;
    }

    /* Toggle button fixed di kanan atas */
    .toggle-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
    }

    .toggle-btn {
        cursor: pointer;
        padding: 8px 16px;
        background-color: #007bff;
        border: none;
        border-radius: 6px;
        color: white;
        font-weight: bold;
        transition: background-color 0.3s;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }

    .toggle-btn:hover {
        background-color: #0056b3;
    }
    </style>
</head>
<body>
    <!-- Tombol toggle dark mode di pojok kanan atas -->
    <div class="toggle-container">
        <button class="toggle-btn" id="toggleDarkMode">Dark Mode</button>
    </div>

    <div class="form-container">
        <h2>Edit Data Siswa</h2>
        <form action="" method="POST">
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" value="<?= htmlspecialchars($data['id']) ?>" readonly>

            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="Nama" value="<?= htmlspecialchars($data['Nama']) ?>" required>

            <label for="kelas">Kelas:</label>
            <input type="text" id="kelas" name="Kelas" value="<?= htmlspecialchars($data['Kelas']) ?>" required>

            <label for="jurusan">Jurusan:</label>
            <input type="text" id="jurusan" name="Jurusan" value="<?= htmlspecialchars($data['Jurusan']) ?>" required>

            <button type="submit" name="update" class="btn">Simpan</button>
            <a href="data_siswa.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script>
        const toggleBtn = document.getElementById('toggleDarkMode');
        const body = document.body;

        // Cek preferensi user di localStorage
        if (localStorage.getItem('darkMode') === 'enabled') {
            body.classList.add('dark-mode');
            toggleBtn.textContent = 'Light Mode';
        }

        toggleBtn.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            if (body.classList.contains('dark-mode')) {
                toggleBtn.textContent = 'Light Mode';
                localStorage.setItem('darkMode', 'enabled');
            } else {
                toggleBtn.textContent = 'Dark Mode';
                localStorage.setItem('darkMode', 'disabled');
            }
        });
    </script>
</body>
</html>
