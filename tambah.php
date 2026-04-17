<?php
include "koneksi.php";

if (isset($_POST['add'])) {
    $nama = $_POST['Nama'];
    $kelas = $_POST['Kelas'];
    $jurusan = $_POST['Jurusan'];

    $query = "INSERT INTO tbl_siswa (Nama, Kelas, Jurusan) VALUES ('$nama', '$kelas', '$jurusan')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: data_siswa.php");
        exit;
    } else {
        echo "Gagal menambahkan data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Tambah Data Siswa</title>
    <style>
        /* Light mode styles */
        body {
            background-color: rgb(87, 162, 197);
            font-family: Arial, sans-serif;
            padding: 30px;
            color: black;
            transition: background-color 0.3s, color 0.3s;
        }
        .form-container {
            max-width: 600px;
            margin: 100px auto;
            padding: 30px;
            background-color: rgb(25, 121, 165);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            transition: background-color 0.3s, box-shadow 0.3s;
            position: relative;
        }
        h2 {
            text-align: center;
            color: rgb(0, 0, 0);
            transition: color 0.3s;
        }
        label {
            display: block;
            margin-top: 15px;
            color: rgb(0, 0, 0);
            transition: color 0.3s;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: background-color 0.3s, color 0.3s, border-color 0.3s;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 16px;
            text-align: center;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .btn-secondary {
            background-color: #6c757d;
            margin-left: 10px;
            transition: background-color 0.3s;
        }

        /* Dark mode styles */
        body.dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }
        body.dark-mode .form-container {
            background-color: #1e1e1e;
            box-shadow: 0 5px 15px rgba(255,255,255,0.1);
        }
        body.dark-mode h2,
        body.dark-mode label {
            color: #e0e0e0;
        }
        body.dark-mode input[type="text"] {
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
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
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
        <h2>Tambah Data Siswa</h2>
        <form action="tambah.php" method="POST">
            <label for="Nama">Nama:</label>
            <input type="text" id="Nama" name="Nama" required />

            <label for="Kelas">Kelas:</label>
            <input type="text" id="Kelas" name="Kelas" required />

            <label for="Jurusan">Jurusan:</label>
            <input type="text" id="Jurusan" name="Jurusan" required />

            <button type="submit" name="add" class="btn">Simpan</button>
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
            if(body.classList.contains('dark-mode')) {
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
