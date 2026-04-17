<?php
// Menghubungkan ke database
include('koneksi.php');
session_start();

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Proses menambahkan data guru
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_guru = $_POST['Nama_Guru'];
    $jenis_kelamin = $_POST['Jenis_Kelamin'];
    $alamat = $_POST['Alamat'];
    $mapel = $_POST['Mapel'];

    // Query untuk menambahkan data guru ke database
    $insert_query = "INSERT INTO tbl_guru (Nama_Guru, Jenis_Kelamin, Alamat, Mapel) VALUES (?, ?, ?, ?)";
    $stmt = $koneksi->prepare($insert_query);
    $stmt->bind_param("ssss", $nama_guru, $jenis_kelamin, $alamat, $mapel);

    if ($stmt->execute()) {
        header('Location: data_guru.php'); // Redirect ke halaman data guru
        exit();
    } else {
        $error_message = "Gagal menambahkan data guru. Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Tambah Data Guru</title>
    <style>
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
            transition: background-color 0.3s, color 0.3s;
        }

        h2 {
            text-align: center;
            color: #000;
            margin-bottom: 20px;
            transition: color 0.3s;
        }

        label {
            display: block;
            margin-top: 15px;
            color: rgb(0, 0, 0);
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

        /* DARK MODE */
        body.dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }

        body.dark-mode .form-container {
            background-color: #1e1e1e;
            color: #e0e0e0;
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
            border: 1px solid #555;
        }

        body.dark-mode .btn {
            background-color: #0d6efd;
        }

        body.dark-mode .btn:hover {
            background-color: #084298;
        }

        body.dark-mode .btn-secondary {
            background-color: #495057;
        }

        body.dark-mode .btn-secondary:hover {
            background-color: #343a40;
        }

        /* Tombol toggle dark mode fixed pojok kanan atas */
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
    <!-- Tombol toggle dark mode fixed pojok kanan atas -->
    <div class="toggle-container">
        <button class="toggle-btn" id="toggleDarkMode">Dark Mode</button>
    </div>

    <div class="form-container">
        <h2>Tambah Data Guru</h2>
        <?php if (isset($error_message)): ?>
            <p style="color: red; font-weight: bold; text-align: center;"><?= htmlspecialchars($error_message) ?></p>
        <?php endif; ?>
        <form action="tambah_guru.php" method="POST">
            <label for="Nama_Guru">Nama Guru:</label>
            <input type="text" id="Nama_Guru" name="Nama_Guru" required>

            <label for="Jenis_Kelamin">Jenis Kelamin:</label>
            <input list="Jenis_Kelamin_List" id="Jenis_Kelamin" name="Jenis_Kelamin" required>
            <datalist id="Jenis_Kelamin_List">
                <option value="Laki-laki">
                <option value="Perempuan">
            </datalist>

            <label for="Alamat">Alamat:</label>
            <input type="text" id="Alamat" name="Alamat" required>

            <label for="Mapel">Mata Pelajaran:</label>
            <input type="text" id="Mapel" name="Mapel" required>

            <button type="submit" name="add" class="btn">Simpan</button>
            <a href="data_guru.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script>
        const toggleBtn = document.getElementById('toggleDarkMode');

        // Set initial mode dari localStorage
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
            toggleBtn.textContent = 'Light Mode';
        }

        toggleBtn.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            if (document.body.classList.contains('dark-mode')) {
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
