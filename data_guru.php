<?php
include "koneksi.php";
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data Guru SMKN 71 Jakarta</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', 'Poppins', system-ui, sans-serif;
      background: #d4e0f0;
      color: #1e2f3a;
      transition: all 0.3s ease;
      min-height: 100vh;
    }

    .wrapper {
      display: flex;
      min-height: 100vh;
    }

    /* ========= SIDEBAR SAMA SEPERTI HOME ========= */
    .sidebar {
      width: 280px;
      background: linear-gradient(165deg, #4a7b9c, #6d9ebb);
      border-radius: 0 28px 28px 0;
      padding: 2rem 1.2rem;
      display: flex;
      flex-direction: column;
      box-shadow: 8px 0 30px rgba(0, 0, 0, 0.15);
      border-right: 1px solid rgba(255,245,210,0.5);
    }

    .sidebar h3 {
      font-size: 1.7rem;
      font-weight: 800;
      text-align: center;
      margin-bottom: 2rem;
      color: #fef1cf;
      background: #2c5a7a;
      padding: 14px 8px;
      border-radius: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      box-shadow: inset 0 1px 3px rgba(0,0,0,0.1), 0 4px 8px rgba(0,0,0,0.1);
    }

    .sidebar h3 i {
      color: #ffcd94;
      font-size: 1.5rem;
    }

    .sidebar a {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 14px 20px;
      margin: 8px 0;
      border-radius: 40px;
      text-decoration: none;
      font-weight: 700;
      color: #ffffff;
      background: rgba(255, 248, 225, 0.2);
      backdrop-filter: blur(4px);
      transition: all 0.25s ease;
      border: 1px solid rgba(255,235,190,0.5);
    }

    .sidebar a i {
      width: 28px;
      font-size: 1.2rem;
      color: #ffe2aa;
    }

    .sidebar a:hover {
      background: #f6bc7c;
      color: #2a3e4e;
      transform: translateX(8px);
      border-color: #ffdeae;
    }

    .sidebar a:hover i {
      color: #2f5570;
    }

    /* Logout button di sidebar */
    .sidebar a:last-child {
      margin-top: auto !important;
      margin-bottom: 0.5rem;
      background: #d97a4a !important;
      color: white !important;
      border: none !important;
      justify-content: center;
      font-weight: 800;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    .sidebar a:last-child:hover {
      background: #bc5e32 !important;
      transform: translateY(-3px) !important;
      box-shadow: 0 8px 16px rgba(0,0,0,0.25);
    }

    /* ========= MAIN CONTAINER ========= */
    .container {
      flex: 1;
      background: #fef7ea;
      margin: 24px 28px;
      padding: 2rem 2rem;
      border-radius: 32px;
      box-shadow: 0 18px 32px rgba(54, 78, 94, 0.2);
      border: 1px solid #ffe1bb;
      overflow-x: auto;
    }

    h2 {
      text-align: center;
      color: #c2692e;
      margin-bottom: 1.5rem;
      font-size: 1.8rem;
      font-weight: 800;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
    }

    h2 i {
      color: #e98c42;
      font-size: 1.8rem;
    }

    /* Tombol aksi */
    .actions {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
      margin-bottom: 24px;
    }

    .btn {
      padding: 10px 20px;
      border: none;
      border-radius: 40px;
      cursor: pointer;
      text-decoration: none;
      font-size: 14px;
      font-weight: 700;
      transition: all 0.2s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .btn-primary {
      background-color: #5b8cae;
      color: white;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .btn-primary:hover {
      background-color: #4a7b9c;
      transform: translateY(-2px);
    }

    .btn-danger {
      background-color: #dc7f5a;
      color: white;
    }

    .btn-danger:hover {
      background-color: #c26942;
      transform: translateY(-2px);
    }

    .btn-success {
      background-color: #7fa87c;
      color: white;
    }

    .btn-success:hover {
      background-color: #689565;
      transform: translateY(-2px);
    }

    .btn-gray {
      background-color: #b8a99a;
      color: white;
    }

    .btn-gray:hover {
      background-color: #a08d7a;
      transform: translateY(-2px);
    }

    /* Search bar */
    .search-bar {
      display: flex;
      justify-content: flex-end;
      margin-bottom: 24px;
    }

    .search-bar form {
      display: flex;
      gap: 10px;
      align-items: center;
    }

    .search-bar input {
      padding: 10px 16px;
      border-radius: 40px;
      border: 1px solid #e2cfb5;
      width: 240px;
      font-size: 14px;
      background: white;
      transition: all 0.2s;
    }

    .search-bar input:focus {
      outline: none;
      border-color: #c2692e;
      box-shadow: 0 0 0 2px rgba(194,105,46,0.2);
    }

    /* Tabel */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
      border-radius: 20px;
      overflow: hidden;
    }

    th, td {
      padding: 14px 12px;
      text-align: center;
      border-bottom: 1px solid #f0e2cf;
    }

    th {
      background-color: #e8d9c6;
      color: #5a4a3a;
      font-weight: 800;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    tr {
      background-color: #fffdf8;
      transition: background 0.2s;
    }

    tr:hover {
      background-color: #fff3e4;
    }

    td a {
      margin: 0 4px;
      padding: 6px 12px;
      font-size: 12px;
      border-radius: 30px;
    }

    /* Dark mode toggle button */
    #toggleDarkMode {
      position: fixed;
      bottom: 28px;
      right: 28px;
      background: #386a86;
      border: none;
      color: #fef0db;
      padding: 12px 22px;
      border-radius: 50px;
      font-weight: 800;
      cursor: pointer;
      z-index: 1000;
      backdrop-filter: blur(6px);
      box-shadow: 0 8px 18px rgba(0, 0, 0, 0.25);
      transition: all 0.2s;
      font-size: 0.9rem;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    #toggleDarkMode:hover {
      background-color: #f3a766;
      color: #1f3f4d;
      transform: scale(0.97);
    }

    /* ========= DARK MODE ========= */
    body.dark-mode {
      background: #1e2b32;
      color: #e6edf0;
    }

    body.dark-mode .sidebar {
      background: linear-gradient(145deg, #1e424f, #2a5a68);
      border-right-color: #558c7a;
    }

    body.dark-mode .sidebar h3 {
      background: #0f2e3a;
      color: #ffe2bb;
    }

    body.dark-mode .sidebar a {
      background: rgba(25, 50, 55, 0.7);
      color: #fbebcd;
    }

    body.dark-mode .sidebar a i {
      color: #ffcf8a;
    }

    body.dark-mode .sidebar a:hover {
      background: #e29254;
      color: #1c2f38;
    }

    body.dark-mode .sidebar a:last-child {
      background: #b45a30 !important;
    }

    body.dark-mode .container {
      background: #2c3d42;
      border-color: #7f9e8c;
    }

    body.dark-mode h2 {
      color: #ffbc7a;
    }

    body.dark-mode th {
      background-color: #3a5548;
      color: #f5e2c9;
    }

    body.dark-mode tr {
      background-color: #2e4440;
    }

    body.dark-mode tr:hover {
      background-color: #3f5e58;
    }

    body.dark-mode td {
      border-bottom-color: #4e6b63;
      color: #e0e7e3;
    }

    body.dark-mode .search-bar input {
      background-color: #3a5548;
      border-color: #6b8f7a;
      color: #f0ede5;
    }

    body.dark-mode .search-bar input::placeholder {
      color: #bdd0c4;
    }

    body.dark-mode .btn-primary {
      background-color: #4a7b9c;
    }

    body.dark-mode .btn-success {
      background-color: #5f8b6a;
    }

    body.dark-mode .btn-danger {
      background-color: #c26942;
    }

    body.dark-mode .btn-gray {
      background-color: #8e7b68;
    }

    /* Responsive */
    @media (max-width: 780px) {
      .wrapper {
        flex-direction: column;
      }
      .sidebar {
        width: 100%;
        border-radius: 0 0 28px 28px;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 8px;
        padding: 1rem;
      }
      .sidebar h3 {
        width: 100%;
        margin-bottom: 8px;
        font-size: 1.3rem;
      }
      .sidebar a {
        width: auto;
        padding: 10px 16px;
      }
      .sidebar a:last-child {
        margin-top: 0 !important;
      }
      .container {
        margin: 16px;
        padding: 1.2rem;
      }
      .search-bar form {
        width: 100%;
      }
      .search-bar input {
        flex: 1;
      }
      .actions {
        flex-direction: column;
      }
      .btn {
        justify-content: center;
      }
      table {
        font-size: 13px;
      }
      th, td {
        padding: 8px 6px;
      }
    }

    @media print {
      body {
        background: white;
      }
      .sidebar,
      .actions,
      .search-bar,
      #toggleDarkMode,
      .btn,
      a[href] {
        display: none !important;
      }
      .container {
        margin: 0;
        padding: 0;
        box-shadow: none;
        background: white;
      }
      table {
        border: 1px solid #000;
      }
      th, td {
        border: 1px solid #000;
      }
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <div class="sidebar">
      <h3><i class="fas fa-building-columns"></i> SMKN 71</h3>
      <a href="home.php"><i class="fas fa-home"></i> Home</a>
      <a href="data_siswa.php"><i class="fas fa-users-viewfinder"></i> Data Siswa</a>
      <a href="data_guru.php"><i class="fas fa-person-chalkboard"></i> Data Guru</a>
      <a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?')"><i class="fas fa-right-from-bracket"></i> Logout</a>
    </div>

    <div class="container">
      <h2><i class="fas fa-chalkboard-user"></i> Data Guru SMKN 71 Jakarta</h2>

      <div class="actions">
        <a href="tambah_guru.php" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
        <a href="cetak_guru.php" class="btn btn-gray" target="_blank"><i class="fas fa-print"></i> Cetak Data</a>
      </div>

      <div class="search-bar">
        <form method="GET">
          <input type="text" name="cari" placeholder="Cari Nama Guru / Mapel..."
                 value="<?php echo isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : ''; ?>">
          <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
          <a href="data_guru.php" class="btn btn-success"><i class="fas fa-sync-alt"></i> Refresh</a>
        </form>
      </div>

      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Guru</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Mapel</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($_GET['cari']) && !empty($_GET['cari'])) {
            $cari = mysqli_real_escape_string($koneksi, $_GET['cari']);
            $query = "SELECT * FROM tbl_guru 
                      WHERE Nama_Guru LIKE '%$cari%' 
                      OR Mapel LIKE '%$cari%' ";
          } else {
            $query = "SELECT * FROM tbl_guru";
          }

          $result = mysqli_query($koneksi, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>
                      <td>".htmlspecialchars($row['No'])."</td>
                      <td>".htmlspecialchars($row['Nama_Guru'])."</td>
                      <td>".htmlspecialchars($row['Jenis_Kelamin'])."</td>
                      <td>".htmlspecialchars($row['Alamat'])."</td>
                      <td>".htmlspecialchars($row['Mapel'])."</td>
                      <td>
                        <a href='edit_guru.php?edit=".urlencode($row['No'])."' class='btn btn-success'><i class='fas fa-edit'></i> Edit</a>
                        <a href='delete_guru.php?hapus=".urlencode($row['No'])."' class='btn btn-danger' onclick='return confirm(\"Yakin ingin menghapus?\")'><i class='fas fa-trash'></i> Hapus</a>
                       </td>
                    </tr>";
            }
          } else {
            echo "<tr><td colspan='6' style='text-align:center; padding:40px;'><i class='fas fa-database'></i> Tidak ada data Guru.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <button id="toggleDarkMode"><i class="fas fa-cloud-moon"></i> Dark Mode</button>

  <script>
    const toggleBtn = document.getElementById('toggleDarkMode');

    if (localStorage.getItem('darkMode') === 'enabled') {
      document.body.classList.add('dark-mode');
      toggleBtn.innerHTML = '<i class="fas fa-sun-bright"></i> Light Mode';
    } else {
      toggleBtn.innerHTML = '<i class="fas fa-cloud-moon"></i> Dark Mode';
    }

    toggleBtn.addEventListener('click', () => {
      document.body.classList.toggle('dark-mode');
      if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('darkMode', 'enabled');
        toggleBtn.innerHTML = '<i class="fas fa-sun-bright"></i> Light Mode';
      } else {
        localStorage.setItem('darkMode', 'disabled');
        toggleBtn.innerHTML = '<i class="fas fa-cloud-moon"></i> Dark Mode';
      }
    });
  </script>
</body>
</html>