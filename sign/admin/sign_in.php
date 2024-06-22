<?php
session_start();

if(isset($_SESSION["signIn"])) {
  header("Location: ../../DashboardAdmin/dashboardAdmin.php");
  exit;
}

require "../../loginSystem/connect.php";

$error = false;

if(isset($_POST["signIn"])) {
  $nama = strtolower($_POST["nama_admin"]);
  $password = $_POST["password"];

  $result = mysqli_query($connect, "SELECT * FROM admin WHERE nama_admin = '$nama' AND password = '$password' ");

  if(mysqli_num_rows($result) === 1) {
    // SET SESSION
    $_SESSION["signIn"] = true;
    $_SESSION["admin"]["nama_admin"] = $nama;
    header("Location: ../../DashboardAdmin/dashboardAdmin.php");
    exit;
  } else {
    $error = true;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign In || Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-REmv82eG9lhrZVdpdG2nMTKxu0N7/TQk4QpHtKcL/DJUZZjgK0Pft4zPxM6oJ00qBBrAXw4iO2+5Lpho6sP4xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    body {
      background-color: #f8f9fa;
    }
    .card {
      margin-top: 40px;
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
      <div class="col-md-8 col-lg-6">
        <div class="card p-4">
          <div class="text-center mb-4">
            <img src="../../assets/adminLogo.png" alt="adminLogo" class="card-img-top">
            <h1 class="pt-3 fw-bold">Sign In</h1>
          </div>
          <hr>
          <form action="" method="post" class="needs-validation" novalidate>
            <div class="mb-3">
              <label for="nama_admin" class="form-label">Nama Lengkap</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" class="form-control" id="nama_admin" name="nama_admin" required>
                <div class="invalid-feedback">
                  Masukkan Nama Anda!
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="invalid-feedback">
                  Masukkan Password Anda!
                </div>
              </div>
            </div>
            <div class="mb-3">
              <button class="btn btn-primary" type="submit" name="signIn">Sign In</button>
              <a class="btn btn-success" href="../link_login.html">Batal</a>
            </div>
          </form>
          <?php if($error) : ?>
            <div class="alert alert-danger mt-2" role="alert">Nama atau Password Salah!</div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
