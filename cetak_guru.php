<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Data Guru</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    h2 {
      text-align: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
    }
    th, td {
      border: 1px solid #000;
      padding: 10px;
      text-align: center;
    }
    th {
      background-color: #ccc;
    }
  </style>
</head>
<body onload="window.print()">
  <h2>Data Guru SMKN 71 Jakarta</h2>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Guru</th>
        <th>Jenis Kelamin</th>
        <th>Alamat</th>
        <th>Mapel</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $query = "SELECT * FROM tbl_guru";
      $result = mysqli_query($koneksi, $query);
      if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>
                  <td>{$row['No']}</td>
                  <td>{$row['Nama_Guru']}</td>
                  <td>{$row['Jenis_Kelamin']}</td>
                  <td>{$row['Alamat']}</td>
                  <td>{$row['Mapel']}</td>
                </tr>";
        }
      } else {
        echo "<tr><td colspan='5'>Tidak ada data.</td></tr>";
      }
      ?>
    </tbody>
  </table>
</body>
</html>
