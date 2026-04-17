<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - SMKN 71 Jakarta</title>
    <!-- Font Awesome untuk ikon -->
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
            display: flex;
            flex-direction: column;
        }

        .container {
            display: flex;
            flex: 1;
            margin: 24px 28px;
            gap: 28px;
        }

        /* ========= SIDEBAR PASTEL TAPI TEGAS ========= */
        .sidebar {
            width: 280px;
            background: #5b8cae;
            background: linear-gradient(165deg, #4a7b9c, #6d9ebb);
            border-radius: 28px;
            padding: 2rem 1.2rem;
            display: flex;
            flex-direction: column;
            box-shadow: 0 18px 30px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255,245,210,0.5);
        }

        .sidebar h2 {
            font-size: 1.7rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 2rem;
            color: #fef1cf;
            background: #2c5a7a;
            padding: 14px 8px;
            border-radius: 60px;
            letter-spacing: -0.2px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.1), 0 4px 8px rgba(0,0,0,0.1);
        }

        .sidebar h2 i {
            color: #ffcd94;
            font-size: 1.7rem;
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
            font-size: 1.3rem;
            color: #ffe2aa;
        }

        .sidebar a:hover {
            background: #f6bc7c;
            color: #2a3e4e;
            transform: translateX(8px) scale(1.02);
            border-color: #ffdeae;
        }

        .sidebar a:hover i {
            color: #2f5570;
        }

        /* Tombol logout warna coral tegas */
        .logout-button {
            margin-top: auto !important;
            margin-bottom: 0.5rem;
            background: #d97a4a !important;
            color: white !important;
            border: none !important;
            justify-content: center;
            font-weight: 800;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .logout-button i {
            color: #ffefcf !important;
        }

        .logout-button:hover {
            background: #bc5e32 !important;
            transform: translateY(-3px) !important;
            box-shadow: 0 8px 16px rgba(0,0,0,0.25);
        }

        /* ========= MAIN CONTENT ========= */
        .main-content {
            flex: 1;
            background: #fef7ea;
            border-radius: 32px;
            padding: 2rem 2.5rem;
            box-shadow: 0 18px 32px rgba(54, 78, 94, 0.2);
            border: 1px solid #ffe1bb;
        }

        .selamat_datang-img {
            max-width: 100%;
            width: 420px;
            height: auto;
            border-radius: 28px;
            display: block;
            margin: 0 auto 2rem auto;
            box-shadow: 0 18px 26px -6px rgba(0, 0, 0, 0.2);
            border: 3px solid #f7cfa2;
            background: #ffe6cd;
        }

        .info-box {
            background: #ffffffea;
            padding: 2rem 2.2rem;
            border-radius: 36px;
            box-shadow: 0 8px 20px rgba(82, 109, 124, 0.12);
            border: 1px solid #ffddb0;
        }

        .info-box h2 {
            font-size: 2rem;
            color: #c2692e;
            margin-bottom: 1.2rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 14px;
            border-left: 8px solid #f3a35c;
            padding-left: 24px;
        }

        .info-box h2 i {
            color: #e98c42;
            font-size: 2rem;
        }

        .info-box p {
            line-height: 1.7;
            margin: 1rem 0;
            color: #2c4e62;
            font-size: 1.02rem;
            font-weight: 500;
        }

        .info-box ol {
            margin: 1rem 0 1rem 1.8rem;
            line-height: 1.8;
            color: #2f5568;
            font-weight: 500;
        }

        .info-box ol li {
            margin: 8px 0;
        }

        strong {
            color: #dc7f42;
            font-weight: 800;
        }

        /* Tombol Dark Mode tegas */
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

        /* ========= FOOTER ========= */
        footer.footer {
            background: #3c6e8c;
            color: #ffefcf;
            padding: 1.6rem 2rem;
            border-radius: 28px 28px 0 0;
            margin-top: 12px;
            border-top: 2px solid #f6c48c;
            font-weight: 600;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .footer-content p {
            margin: 8px 0;
            font-size: 0.9rem;
        }

        .footer-content i {
            margin-right: 8px;
            color: #ffd7a5;
        }

        /* ========= DARK MODE (gelap nyaman) ========= */
        body.dark-mode {
            background: #1e2b32;
            color: #e6edf0;
        }

        body.dark-mode .sidebar {
            background: linear-gradient(145deg, #1e424f, #2a5a68);
            border-color: #558c7a;
        }

        body.dark-mode .sidebar h2 {
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

        body.dark-mode .logout-button {
            background: #b45a30 !important;
        }

        body.dark-mode .main-content {
            background: #2c3d42;
            border-color: #7f9e8c;
        }

        body.dark-mode .info-box {
            background: #253b40;
            border-color: #b6895c;
        }

        body.dark-mode .info-box h2 {
            color: #ffbc7a;
            border-left-color: #f3a15b;
        }

        body.dark-mode .info-box p,
        body.dark-mode .info-box ol {
            color: #cfdfe3;
        }

        body.dark-mode strong {
            color: #ffae66;
        }

        body.dark-mode footer.footer {
            background: #1e3b40;
            color: #fad6aa;
            border-top-color: #e8b070;
        }

        body.dark-mode #toggleDarkMode {
            background: #f5b471;
            color: #1f383f;
        }

        /* Responsive */
        @media (max-width: 780px) {
            .container {
                flex-direction: column;
                margin: 16px;
            }
            .sidebar {
                width: 100%;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
                padding: 1.2rem;
            }
            .sidebar h2 {
                width: 100%;
                margin-bottom: 6px;
            }
            .sidebar a {
                width: auto;
                padding: 10px 16px;
            }
            .logout-button {
                margin-top: 0 !important;
            }
            .main-content {
                padding: 1.5rem;
            }
            .selamat_datang-img {
                width: 280px;
            }
        }
    </style>
</head>
<body>
    <button id="toggleDarkMode"><i class="fas fa-cloud-moon"></i> Dark Mode</button>

    <div class="container">
        <div class="sidebar">
            <h2><i class="fas fa-building-columns"></i> SMKN 71</h2>
            
            <a href="data_siswa.php" class="<?= ($current_page == 'data_siswa.php') ? 'active' : '' ?>">
                <i class="fas fa-users-viewfinder"></i> Data Siswa
            </a>
            <a href="data_guru.php" class="<?= ($current_page == 'data_guru.php') ? 'active' : '' ?>">
                <i class="fas fa-person-chalkboard"></i> Data Guru
            </a>
            <a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?')" class="logout-button">
                <i class="fas fa-right-from-bracket"></i> Logout
            </a>
        </div>

        <div class="main-content">
            <img src="selamat_datang.jpg" alt="selamat datang" class="selamat_datang-img">
            <div class="info-box">
                <h2><i class="fas fa-bullhorn"></i> Visi Misi & Moto</h2>
                <p><strong>✨ Visi:</strong> Terwujudnya sumber daya manusia yang berprestasi, unggul, dan berdaya saing global berlandaskan iman dan taqwa</p>
                <p><strong>⚡ Misi:</strong></p>
                <ol>
                    <li>Meningkatkan iman dan taqwa terhadap Tuhan Yang Maha Esa.</li>
                    <li>Menyelenggarakan proses pembelajaran secara profesional.</li>
                    <li>Menumbuh kembangkan jiwa seni dalam industri kreatif pada era digital</li>
                    <li>Menghasilkan lulusan yang mampu mengembangkan diri terhadap perkembangan ilmu pengetahuan dan teknologi informasi</li>
                    <li>Mampu bekerja secara profesional serta mampu bersaing secara global.</li>
                </ol>
                <p><strong>🏅 Moto:</strong> Unggul Dalam Mutu, Teladan Berprilaku</p>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <p><i class="fas fa-copyright"></i> 2025 SMKN 71 Jakarta</p>
            <p>
                <i class="fas fa-map-pin"></i> Jl. Dr. KRT Radjiman Widyodiningrat, Jl. Kp. Pulo Jahe, Jatinegara, Kec. Cakung, Jakarta Timur 13930
            </p>
            <p>
                <i class="fab fa-instagram"></i> @smkn71jakarta &nbsp; | &nbsp; <i class="fas fa-school-flag"></i> <strong>SMKN 71 Jakarta</strong>
            </p>
        </div>
    </footer>

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