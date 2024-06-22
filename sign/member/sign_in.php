<?php 
session_start();

// Redirect ke dashboard jika sudah login
if(isset($_SESSION["signIn"])) {
  header("Location: ../../DashboardMember/dashboardMember.php");
  exit;
}

require "../../loginSystem/connect.php";

if(isset($_POST["signIn"])) {
  
  $nama = strtolower($_POST["nama"]);
  $nisn = $_POST["nisn"];
  $password = $_POST["password"];
  
  $result = mysqli_query($connect, "SELECT * FROM member WHERE nama = '$nama' AND nisn = $nisn");
  
  if(mysqli_num_rows($result) === 1) {
    $pw = mysqli_fetch_assoc($result);
    if(password_verify($password, $pw["password"])) {
      $_SESSION["signIn"] = true;
      $_SESSION["member"]["nama"] = $nama;
      $_SESSION["member"]["nisn"] = $nisn;
      header("Location: ../../DashboardMember/dashboardMember.php");
      exit;
    }
  }
  $error = true;
  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign In || Member</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-REmv82eG9lhrZVdpdG2nMTKxu0N7/TQk4QpHtKcL/DJUZZjgK0Pft4zPxM6oJ00qBBrAXw4iO2+5Lpho6sP4xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    body {
      background-color: #f8f9fa;
    }
    .card {
      margin-top: 20px; /* Posisi vertikal tengah */
      margin-bottom: 20px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      border-radius: 10px;
    }
    .card-img-top {
      max-height: 150px;
      object-fit: contain;
    }
    .form-label {
      font-weight: bold;
    }
    .input-group-text {
      background-color: #f8f9fa;
    }
    .btn {
      width: 100%;
      margin-top: 10px;
      padding: 10px;
      font-size: 1.1rem;
    }
    .btn-cancel {
      background-color: #6c757d;
      border-color: #6c757d;
    }
    .btn-cancel:hover {
      background-color: #5a6268;
      border-color: #545b62;
    }
    .btn-cancel:focus {
      box-shadow: 0 0 0 0.25rem rgba(108, 117, 125, 0.5);
    }
    .alert {
      border-radius: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card p-4">
          <div class="text-center mb-4">
            <img src="../../assets/memberLogo.png" alt="adminLogo" class="card-img-top">
            <h1 class="pt-3 fw-bold">Sign In</h1>
          </div>
          <hr>
          <form action="" method="post" class="needs-validation" novalidate>
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Lengkap</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" class="form-control" id="nama" name="nama" required>
                <div class="invalid-feedback">
                  Masukkan nama anda!
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="nisn" class="form-label">NIM - 4 Digit Terakhir</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                <input type="number" class="form-control" id="nisn" name="nisn" required>
                <div class="invalid-feedback">
                  Masukkan NIM anda!
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="invalid-feedback">
                  Masukkan password anda!
                </div>
              </div>
            </div>
            <button class="btn btn-primary" type="submit" name="signIn">Sign In</button>
            <a class="btn btn-cancel" href="../link_login.html">Batal</a>
          </form>
          <?php if(isset($error)) : ?>
            <div class="alert alert-danger mt-3" role="alert">
              Nama / NISN / Password tidak sesuai!
            </div>
          <?php endif; ?>
          <p class="mt-3 text-center">Belum punya akun? <a href="sign_up.php" class="text-decoration-none text-primary">Daftar Sekarang</a></p>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script>
    // Script untuk validasi form menggunakan Bootstrap
    (function () {
      'use strict';
      var forms = document.querySelectorAll('.needs-validation');
      Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    })();
  </script>
</body>
</html>
