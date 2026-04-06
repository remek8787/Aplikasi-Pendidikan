<?php
require("../konek/koneksi.php");
require("../konek/function.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="author" content="New Sandik" />
  <meta name="google" content="notranslate" />
  <title><?= htmlspecialchars($setting['sekolah']) ?></title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <!-- iziToast for notifications -->
  <link rel="stylesheet" href="<?= $baseurl ?>/assets/izitoast/css/iziToast.min.css" />

  <style>
    body, html {
      height: 100%;
      margin: 0;
      background: linear-gradient(135deg, #0d3b66, #5d8be7);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #f9f9f9;
      overflow-x: hidden;
    }

    .login-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .login-card {
      background: #e3eaf5;
      border-radius: 15px;
      box-shadow: 0 8px 24px rgba(13, 59, 102, 0.3);
      color: #0d3b66;
      max-width: 900px;
      width: 100%;
      display: flex;
      overflow: hidden;
      animation: fadeInUp 0.8s ease forwards;
    }

    .login-image {
      flex: 1;
      background: url('../images/login.png') center center no-repeat;
      background-size: contain;
      min-height: 350px;
      filter: drop-shadow(0 4px 6px rgba(13, 59, 102, 0.5));
    }

    .login-form-container {
      flex: 1.2;
      padding: 40px 30px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      background: #f9f9f9;
      border-left: 5px solid #f4900c;
      box-shadow: inset 0 0 10px rgba(244, 144, 12, 0.15);
    }

    .login-title {
      font-weight: 700;
      font-size: 1.8rem;
      margin-bottom: 10px;
      color: #0d3b66;
      text-align: center;
      user-select: none;
    }

    .login-subtitle {
      font-weight: 500;
      font-size: 1.1rem;
      color: #145bc7;
      margin-bottom: 30px;
      text-align: center;
      user-select: none;
    }

    .form-control {
      background: #f9f9f9;
      border: 2px solid #5d8be7;
      border-radius: 10px;
      color: #0d3b66;
      padding-left: 45px;
      transition: border-color 0.3s ease;
    }

    .form-control::placeholder {
      color: #a2b4d3;
    }

    .form-control:focus {
      border-color: #f4900c;
      box-shadow: 0 0 8px #f4900c;
      color: #0d3b66;
    }

    .input-icon {
      position: absolute;
      top: 50%;
      left: 15px;
      transform: translateY(-50%);
      color: #145bc7;
      pointer-events: none;
      font-size: 1.2rem;
    }

    .form-check-label {
      user-select: none;
      color: #5d8be7;
    }

    .form-check-input:checked + .form-check-label {
      color: #f4900c;
    }

    .btn-login {
      background: #145bc7;
      border: none;
      border-radius: 50px;
      padding: 12px 0;
      font-weight: 700;
      font-size: 1.1rem;
      transition: background-color 0.3s ease;
      box-shadow: 0 4px 15px #145bc7cc;
      user-select: none;
      color: white;
    }

    .btn-login:hover {
      background-color: #0d3b66;
      box-shadow: 0 6px 20px #0a2e56cc;
    }

    @media (max-width: 768px) {
      .login-card {
        flex-direction: column;
      }
      .login-image {
        min-height: 200px;
        width: 100%;
      }
    }

    @keyframes fadeInUp {
      0% {
        opacity: 0;
        transform: translateY(30px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .pre-loader {
      position: fixed;
      width: 100%;
      height: 100%;
      background: #145bc7;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
      flex-direction: column;
      color: #fff;
      font-weight: 600;
      font-size: 1.2rem;
      user-select: none;
    }

    .pre-loader.hidden {
      animation: fadeOut 0.8s forwards;
    }

    @keyframes fadeOut {
      to {
        opacity: 0;
        visibility: hidden;
      }
    }
  </style>
</head>
<body>

<!-- Loader -->
<div class="pre-loader" id="preLoader">
  <img src="../images/animasi.gif" alt="Loading..." width="140" style="margin-bottom: 20px" />
  Loading Sistem Aplikasi Pendidik...
</div>

<div class="login-container">
  <div class="login-card shadow-lg">
    <div class="login-image"></div>

    <div class="login-form-container">
      <h2 class="login-title">
        LOGIN <a href="https://esandik.my.id" target="_blank" style="color: #0d3b66; text-decoration: none;"><strong>SANDIK</strong></a> USERS <?= htmlspecialchars($setting['sekolah']) ?>
      </h2>
      <p class="login-subtitle">Tahun Pelajaran <?= htmlspecialchars($setting['tp']) ?></p>

      <form id="form-login" name="fmLogin" autocomplete="off" novalidate>
        <div class="position-relative mb-3">
          <i class="fa fa-user input-icon"></i>
          <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autocomplete="username" />
        </div>

        <div class="position-relative mb-3">
          <i class="fa fa-lock input-icon"></i>
          <input type="password" id="password" name="password" class="form-control" placeholder="Password" required autocomplete="current-password" />
        </div>

        <div class="mb-3">
          <select class="form-select" name="level" id="level" required>
            <option value="" disabled selected>-- Pilih Akun --</option>
            <option value="admin">Admin</option>
            <option value="guru">Guru</option>
            <option value="staff">Staff</option>
            <option value="awas">Pengawas</option>
          </select>
        </div>

        <div class="form-check mb-4">
          <input type="checkbox" class="form-check-input" id="btn-eye" onclick="togglePassword()" />
          <label class="form-check-label" for="btn-eye">Show Password</label>
        </div>

        <button type="submit" class="btn btn-login w-100">Masuk</button>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap 5 and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery (for AJAX and iziToast) -->
<script src="<?= $baseurl ?>/assets/plugins/jquery/jquery-3.5.1.min.js"></script>

<!-- iziToast -->
<script src="<?= $baseurl ?>/assets/izitoast/js/iziToast.min.js"></script>

<script>
  // Loader fade out after page load
  window.addEventListener('load', () => {
    const loader = document.getElementById('preLoader');
    loader.classList.add('hidden');
    setTimeout(() => loader.style.display = 'none', 800);
  });

  function togglePassword() {
    const passInput = document.getElementById('password');
    const checkbox = document.getElementById('btn-eye');
    passInput.type = checkbox.checked ? 'text' : 'password';
  }

  $(document).ready(function() {
    $('#form-login').submit(function(e) {
      e.preventDefault();

      if(!$('#username').val() || !$('#password').val() || !$('#level').val()){
        iziToast.warning({
          title: 'Peringatan',
          message: 'Semua field wajib diisi',
          position: 'topRight',
          timeout: 3000,
        });
        return;
      }

      $.ajax({
        type: 'POST',
        url: 'ceklogin.php',
        data: $(this).serialize(),
        success: function(data) {
          if (data === 'ok') {
            iziToast.success({
              title: 'Berhasil',
              message: 'Login berhasil! Silahkan tunggu...',
              position: 'topRight',
              timeout: 1500,
            });
            setTimeout(() => location.href = '.', 1600);
          } else if (data === 'nopass') {
            iziToast.error({
              title: 'Gagal',
              message: 'Password salah',
              position: 'topRight',
            });
          } else if (data === 'td') {
            iziToast.error({
              title: 'Gagal',
              message: 'Gagal masuk, periksa data anda',
              position: 'topRight',
            });
          } else {
            iziToast.error({
              title: 'Error',
              message: 'Terjadi kesalahan sistem',
              position: 'topRight',
            });
          }
        },
        error: function() {
          iziToast.error({
            title: 'Error',
            message: 'Tidak dapat menghubungi server',
            position: 'topRight',
          });
        }
      });
    });
  });
</script>

</body>
</html>
