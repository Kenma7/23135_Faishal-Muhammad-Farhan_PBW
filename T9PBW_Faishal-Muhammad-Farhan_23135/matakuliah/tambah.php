<?php
include '../config/db.php';
include '../partials/sidebar.php';

if ($_POST) {
    $kodemk = $_POST['kodemk'];
    $nama = $_POST['nama'];
    $sks = $_POST['jumlah_sks'];

    mysqli_query($conn, "INSERT INTO matakuliah VALUES ('$kodemk', '$nama', $sks)");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mata Kuliah</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            max-width: 600px;
            margin: 0 auto;
        }
        .form-label {
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="container-fluid">
            <div class="form-container">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0"><i class="fas fa-book-medical me-2"></i>Tambah Mata Kuliah</h3>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="kodemk" class="form-label">Kode Mata Kuliah</label>
                                <input type="text" class="form-control" id="kodemk" name="kodemk" required>
                                <div class="form-text">Contoh: MK001</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Mata Kuliah</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="jumlah_sks" class="form-label">Jumlah SKS</label>
                                <input type="number" class="form-control" id="jumlah_sks" name="jumlah_sks" min="1" max="6" required>
                                <div class="form-text">Masukkan angka antara 1-6</div>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save me-1"></i> Simpan
                                </button>
                                <a href="index.php" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>