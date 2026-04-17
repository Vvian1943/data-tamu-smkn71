<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM tb_admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query error: " . mysqli_error($koneksi));
    }

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['login'] = true;
        header("Location: home.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login Admin</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      position: relative;
      background-image: url('gedung sekolah.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      color: #222;
      transition: background-color 0.3s, color 0.3s;
    }

    body::before {
      content: "";
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 0;
      transition: background-color 0.3s;
    }

    .login-container {
      position: relative;
      z-index: 1;
      background-color: rgba(25, 121, 165, 0.9);
      color: white;
      width: 350px;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
      transition: background-color 0.3s, color 0.3s;
    }

    h3 {
      text-align: center;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    .input-wrapper {
      position: relative;
    }

    .input-wrapper input {
      width: 100%;
      padding: 8px 35px 8px 8px;
      border: none;
      border-radius: 5px;
      box-sizing: border-box;
    }

    .toggle-password {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .toggle-password svg {
      width: 20px;
      height: 20px;
      fill: #333;
    }

    .btn {
      width: 100%;
      padding: 10px;
      background-color: white;
      color: rgb(25, 121, 165);
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s, color 0.3s;
    }

    .btn:hover {
      background-color: rgb(220, 220, 220);
    }

    .error {
      background-color: rgb(204, 239, 255);
      color: red;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 15px;
      text-align: center;
      transition: background-color 0.3s, color 0.3s;
    }

    /* Dark Mode Styles */
    body.dark-mode {
      background-color: #121212;
      color: #ddd;
      background-image: none;
    }

    body.dark-mode::before {
      background-color: rgba(0, 0, 0, 0.8);
    }

    body.dark-mode .login-container {
      background-color: rgba(30, 30, 30, 0.9);
      color: #ddd;
      box-shadow: 0 4px 10px rgba(255,255,255,0.1);
    }

    body.dark-mode .input-wrapper input {
      background-color: #222;
      color: #ddd;
    }

    body.dark-mode .input-wrapper input::placeholder {
      color: #aaa;
    }

    body.dark-mode .btn {
      background-color: #444;
      color: #ddd;
    }

    body.dark-mode .btn:hover {
      background-color: #666;
    }

    body.dark-mode .error {
      background-color: #ffdddd;
      color: #aa0000;
    }

    body.dark-mode .toggle-password svg {
      fill: #ddd;
    }

    /* Dark mode toggle button */
    #toggleDarkMode {
      position: fixed;
      top: 20px;
      right: 20px;
      background-color: rgba(25, 121, 165, 0.9);
      color: white;
      border: none;
      padding: 10px 15px;
      cursor: pointer;
      border-radius: 5px;
      font-weight: bold;
      transition: background-color 0.3s;
      z-index: 1000;
    }

    #toggleDarkMode:hover {
      background-color: rgba(15, 90, 130, 0.9);
    }
  </style>
</head>
<body>
  <button id="toggleDarkMode">Dark Mode</button>

  <div class="login-container">
    <h3>Login Admin</h3>

    <?php if (isset($error)) : ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <div class="form-group">
        <label>Username</label>
        <div class="input-wrapper">
          <input type="text" name="username" required autofocus />
        </div>
      </div>

      <div class="form-group">
        <label>Password</label>
        <div class="input-wrapper">
          <input type="password" name="password" id="password" required />
          <span class="toggle-password" onclick="togglePassword()">
            <!-- Ikon Mata Terbuka (default) -->
            <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5C21.27 7.61 17 4.5 12 4.5zm0 12a4.5 4.5 0 1 1 0-9 4.5 4.5 0 0 1 0 9z"/>
              <circle cx="12" cy="12" r="2.5"/>
            </svg>
          </span>
        </div>
      </div>

      <button type="submit" name="login" class="btn">Login</button>
    </form>
  </div>

  <script>
    const toggleBtn = document.getElementById('toggleDarkMode');

    // Load mode dari localStorage
    if (localStorage.getItem('darkMode') === 'enabled') {
      document.body.classList.add('dark-mode');
      toggleBtn.textContent = 'Light Mode';
    }

    toggleBtn.addEventListener('click', () => {
      document.body.classList.toggle('dark-mode');

      if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('darkMode', 'enabled');
        toggleBtn.textContent = 'Light Mode';
      } else {
        localStorage.setItem('darkMode', 'disabled');
        toggleBtn.textContent = 'Dark Mode';
      }
    });

    function togglePassword() {
      const input = document.getElementById("password");
      const icon = document.getElementById("icon-eye");

      if (input.type === "password") {
        input.type = "text";
        icon.innerHTML = `
          <path d="M12 4.5C7 4.5 2.73 7.61 1 12c.54 1.37 1.35 2.63 2.38 3.73L2 17.1l1.06 1.06 2.19-2.19C7.54 17.16 9.69 18 12 18c5 0 9.27-3.11 11-7.5-.73-1.85-1.93-3.5-3.43-4.8L20.6 4.9 19.54 3.84l-2.11 2.11C15.74 5.27 13.92 4.5 12 4.5zM12 16.5c-2.48 0-4.5-2.02-4.5-4.5 0-.82.23-1.58.63-2.23l6.1 6.1c-.65.4-1.41.63-2.23.63zm7.5-4.5c0 .89-.2 1.74-.55 2.5l-2.17-2.17c.05-.26.08-.53.08-.83 0-2.48-2.02-4.5-4.5-4.5-.3 0-.57.03-.83.08L9.5 6.05c.76-.35 1.61-.55 2.5-.55 3.59 0 6.5 2.91 6.5 6.5z"/>`;
      } else {
        input.type = "password";
        icon.innerHTML = `
          <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5C21.27 7.61 17 4.5 12 4.5zm0 12a4.5 4.5 0 1 1 0-9 4.5 4.5 0 0 1 0 9z"/>
          <circle cx="12" cy="12" r="2.5"/>`;
      }
    }
  </script>
</body>
</html>
