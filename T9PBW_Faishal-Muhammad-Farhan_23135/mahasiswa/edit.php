<?php
include '../config/db.php';
include '../partials/sidebar.php';

// Validasi NPM
if (!isset($_GET['npm'])) {
    echo "<div class='container-fluid'><div class='alert alert-danger mt-3'>Error: NPM tidak ditemukan di URL.</div><a href='index.php' class='btn btn-secondary'>← Kembali</a></div>";
    exit;
}

$npm = $_GET['npm'];
$data = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE npm='$npm'");

if (mysqli_num_rows($data) == 0) {
    echo "<div class='container-fluid'><div class='alert alert-danger mt-3'>Error: Data mahasiswa dengan NPM $npm tidak ditemukan.</div><a href='index.php' class='btn btn-secondary'>← Kembali</a></div>";
    exit;
}

$row = mysqli_fetch_assoc($data);

if ($_POST) {
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];

    mysqli_query($conn, "UPDATE mahasiswa SET nama='$nama', jurusan='$jurusan', alamat='$alamat' WHERE npm='$npm'");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/style.css" rel="stylesheet">
    <style>
        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
        }
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
        }
        .form-container {
            max-width: 800px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="container-fluid form-container">
            <div class="card shadow">
                <div class="card-header-indigo"> <!-- Ubah class disini -->
                    <h3 class="mb-0 text-white"><i class="fas fa-edit me-2"></i>Edit Data Mahasiswa</h3>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">NPM:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="npm" 
                                       value="<?= htmlspecialchars($row['npm']) ?>" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Nama:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama" 
                                       value="<?= htmlspecialchars($row['nama']) ?>" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Jurusan:</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="jurusan">
                                    <option value="Teknik Informatika" <?= $row['jurusan'] == 'Teknik Informatika' ? 'selected' : '' ?>>Teknik Informatika</option>
                                    <option value="Sistem Operasi" <?= $row['jurusan'] == 'Sistem Operasi' ? 'selected' : '' ?>>Sistem Operasi</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Alamat:</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="alamat" rows="3" required><?= htmlspecialchars($row['alamat']) ?></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fas fa-save me-1"></i> Update Data
                                </button>
                                <a href="index.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS + Font Awesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>