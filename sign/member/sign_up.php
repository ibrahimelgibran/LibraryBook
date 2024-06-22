<?php 
require "../../loginSystem/connect.php";

if(isset($_POST["signUp"])) {
  if(signUp($_POST) > 0) {
    echo "<script>
      alert('Sign Up berhasil!')
    </script>";
  } else {
    echo "<script>
      alert('Sign Up gagal!')
    </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign Up || Member</title>
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
      <div class="col-md-8 col-lg-6">
        <div class="card p-4">
          <div class="text-center mb-4">
            <img src="../../assets/memberLogo.png" alt="adminLogo" class="card-img-top">
            <h1 class="pt-3 fw-bold">Sign Up</h1>
          </div>
          <hr>
          <form action="" method="post" class="needs-validation" novalidate>
            <div class="mb-3">
              <label for="nisn" class="form-label">NIM - 4 Digit Terakhir</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                <input type="number" class="form-control" id="nisn" name="nisn" required>
                <div class="invalid-feedback">
                  NIM wajib diisi!
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="kode_member" class="form-label">Tahun Masuk - (contoh : 2022 = 22)</label>
              <input type="text" class="form-control" id="kode_member" name="kode_member" required>
              <div class="invalid-feedback">
                Tahun Masuk wajib diisi!
              </div>
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Lengkap</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" class="form-control" id="nama" name="nama" required>
                <div class="invalid-feedback">
                  Nama wajib diisi!
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="invalid-feedback">
                  Password wajib diisi!
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="confirmPw" class="form-label">Confirm Password</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control" id="confirmPw" name="confirmPw" required>
                <div class="invalid-feedback">
                  Konfirmasi password wajib diisi!
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Gender</label>
              <select class="form-select" name="jenis_kelamin" required>
                <option selected disabled>Choose...</option>
                <option value="Laki laki">Laki laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
              <div class="invalid-feedback">
                Pilih jenis kelamin Anda!
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Kelas</label>
              <select class="form-select" name="kelas" required>
                <option selected disabled>Choose...</option>
                <option value="D3">D3</option>
                <option value="S1">S1</option>
              </select>
              <div class="invalid-feedback">
                Pilih kelas Anda!
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Jurusan</label>
              <select class="form-select" name="jurusan" required>
                <option selected disabled>Choose...</option>
                <option value="TEKNIK INFORMATIKA">TEKNIK INFORMATIKA</option>
                <option value="INFORMATIKA">INFORMATIKA</option>
                <option value="ILMU KOMPUTER">ILMU KOMPUTER</option>
                <!-- <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option> -->
             
              </select>
              <div class="invalid-feedback">
                Pilih jurusan Anda!
              </div>
            </div>
            <div class="mb-3">
              <label for="no_tlp" class="form-label">No Telepon</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                <input type="number" class="form-control" id="no_tlp" name="no_tlp" required>
                <div class="invalid-feedback">
                  No telepon wajib diisi!
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="tgl_pendaftaran" class="form-label">Tanggal Pendaftaran</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-calendar-days"></i></span>
                <input type="date" class="form-control" id="tgl_pendaftaran" name="tgl_pendaftaran" required>
                <div class="invalid-feedback">
                  Tanggal pendaftaran wajib diisi!
                </div>
              </div>
            </div>
            <button class="btn btn-primary" type="submit" name="signUp">Sign Up</button>
            <input type="reset" class="btn btn-warning text-light" value="Reset">
          </form>
          <p class="mt-3 text-center">Already have an account? <a href="sign_in.php" class="text-decoration-none text-primary">Sign In</a></p>
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
