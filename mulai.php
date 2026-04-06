<?php 
require("konek/koneksi.php");
require("konek/function.php");

$array_browsers = ["OPR" => "Opera", "opera" => "Opera", "Edg" => "Microsoft Edge", "Chrome" => "Google Chrome", "Safari" => "Safari", "Firefox" => "Mozilla Firefox", "MSIE" => "Internet Explorer", "Trident" => "Internet Explorer"];

$agent = $_SERVER['HTTP_USER_AGENT'];
$jenis_browser = "Unknown Browser";
foreach ($array_browsers as $key => $value) {
    if (strpos($agent, $key) !== false) {
        $jenis_browser = $value;
        break;
    }
}

if ($jenis_browser !== "Google Chrome") {
    echo '<meta http-equiv="refresh" content="0;url=blok.php">';
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($setting['aplikasi']) ?> - <?= htmlspecialchars($setting['sekolah']) ?></title>
    <meta name="description" content="Sistem Aplikasi Pendidik Terintegrasi" />
    <link rel="icon" href="images/<?= htmlspecialchars($setting['logo']) ?>" type="image/png" />
    
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <!-- Bootstrap 4.6 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- iziToast -->
    <link href="assets/izitoast/css/iziToast.min.css" rel="stylesheet" />

    <style>
        /* Background Gradient */
        body {
            background: linear-gradient(135deg, #004d99, #0073e6);
            color: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* Container */
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
            animation: fadeIn 1s ease-out;
        }

        /* White card */
        .login-box {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            color: #333;
            max-width: 900px;
            width: 100%;
            display: flex;
            flex-wrap: wrap;
        }

        /* Left side image (hidden on small screens) */
        .login-image {
            background: url('images/login.png') center center no-repeat;
            background-size: contain;
            flex: 1;
            min-height: 300px;
        }

        /* Right side form */
        .login-form {
            flex: 1;
            padding: 40px;
            animation: slideIn 1s ease-out;
        }

        /* Logo & title */
        .logo-title {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .logo-title img {
            height: 50px;
            margin-right: 10px;
        }
        .logo-title h4 {
            font-weight: 700;
            color: #004d99;
            margin-bottom: 0;
        }
        .logo-title small {
            color: #0066cc;
        }

        /* Login form title */
        .login-form-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #004d99;
            margin-bottom: 15px;
            text-align: center;
            user-select: none;
        }

        /* Image below title */
        .login-image-below-title {
            text-align: center;
            margin-bottom: 50px;
        }
        .login-image-below-title img {
            max-width: 300px;
            width: 400%;
            height: auto;
            filter: drop-shadow(0 4px 8px rgba(0, 123, 255, 0.5));
            border-radius: 12px;
        }

        /* Form styles */
        .form-group label {
            font-weight: 600;
            color: #004d99;
        }
        .form-control {
            border-radius: 20px;
            border: 1.5px solid #0073e6;
            padding: 10px 15px;
            font-size: 1rem;
            transition: 0.3s;
        }
        .form-control:focus {
            border-color: #004d99;
            box-shadow: 0 0 8px #004d99aa;
            outline: none;
        }

        /* Password eye button */
        .input-group-append .btn {
            border-radius: 0 20px 20px 0;
            border: 1.5px solid #0073e6;
            border-left: none;
            color: #0073e6;
            background: #f0f8ff;
            transition: background-color 0.3s;
        }
        .input-group-append .btn:hover {
            background-color: #cce4ff;
        }

        /* Submit button */
        .btn-primary {
            border-radius: 25px;
            background-color: #004d99;
            border: none;
            font-weight: 700;
            padding: 12px 0;
            font-size: 1.1rem;
            box-shadow: 0 6px 15px rgba(0, 77, 153, 0.6);
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #003366;
            box-shadow: 0 8px 20px rgba(0, 51, 102, 0.8);
        }

        /* Animations */
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }
        @keyframes slideIn {
            from {opacity: 0; transform: translateX(20px);}
            to {opacity: 1; transform: translateX(0);}
        }

        /* Loader */
        .pre-loader {
            position: fixed;
            z-index: 9999;
            background: #003366;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: #fff;
            font-weight: 600;
            user-select: none;
        }
        .pre-loader img {
            width: 150px;
            margin-bottom: 20px;
        }

        /* Responsive adjustments */
        @media (max-width: 767.98px) {
            .login-box {
                flex-direction: column;
                max-width: 400px;
                box-shadow: 0 6px 20px rgba(0,0,0,0.2);
            }
            .login-image {
                min-height: 200px;
            }
        }
    </style>
</head>
<body>

<!-- Loader -->
<body>

<!-- Loader -->
<div class="pre-loader" id="preLoader">
    <img src="images/animasi.gif" alt="Loading..." />
    <div>Memuat aplikasi...</div>
</div>

<div class="login-wrapper">
    <div class="login-box">
        <!-- Optional left image for bigger screens -->
        <div class="login-image d-none d-md-block"></div>

        <div class="login-form">
            <div class="logo-title">
                <img src="images/<?= htmlspecialchars($setting['logo']) ?>" alt="Logo Sekolah" />
                <div>
                    <h4>
                        <a href="https://esandik.my.id" target="_blank" style="text-decoration: none; color: #004d99;">
                            <?= htmlspecialchars($setting['aplikasi']) ?>
                        </a>
                    </h4>
                    <small><?= htmlspecialchars($setting['sekolah']) ?> - TP <?= htmlspecialchars($setting['tp']) ?></small>
                </div>
            </div>

            <div class="login-form-title">Login Siswa</div>

            <!-- Gambar login.png di bawah teks Login Siswa -->
            <div class="login-image-below-title">
                <img src="images/login.png" alt="Login Logo" />
            </div>

            <form id="formlogin" action="ceklogin.php" method="POST" autocomplete="off" novalidate>
                <div class="form-group">
                    <label for="username"><i class="fa fa-user-circle"></i> Username</label>
                    <input type="text" class="form-control" id="username" name="username" required />
                </div>
                <div class="form-group">
                    <label for="password"><i class="fa fa-lock"></i> Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" required />
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Masuk</button>
            </form>
        </div>
    </div>
</div>

<!-- JS dependencies -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="assets/izitoast/js/iziToast.min.js"></script>
<script>
    // Preloader fade out
    $(window).on('load', function () {
        setTimeout(function () {
            $('#preLoader').fadeOut();
        }, 1200);
    });

    // AJAX login form submit
    $('#formlogin').submit(function (e) {
        e.preventDefault();
        $.post($(this).attr('action'), $(this).serialize(), function (data) {
            if (data === "ok") {
                location.href = "./";
            } else if (data === "nopass") {
                iziToast.error({ title: 'Gagal', message: 'Password salah!' });
            } else if (data === "td") {
                iziToast.warning({ title: 'Gagal', message: 'Akun tidak ditemukan!' });
            }
        });
    });

    // Toggle password visibility
    function togglePassword() {
        const input = document.getElementById("password");
        if(input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
</script>

</body>

</html>
