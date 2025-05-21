<?php
include '../config/db.php';
include '../partials/sidebar.php';

$kodemk = $_GET['kodemk'];
$data = mysqli_query($conn, "SELECT * FROM matakuliah WHERE kodemk = '$kodemk'");
$row = mysqli_fetch_assoc($data);

if ($_POST) {
    $nama = $_POST['nama'];
    $sks = $_POST['jumlah_sks'];

    mysqli_query($conn, "UPDATE matakuliah SET nama = '$nama', jumlah_sks = $sks WHERE kodemk = '$kodemk'");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mata Kuliah</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            max-width: 600px;
            margin: 0 auto;
        }
        .kode-display {
            background-color: #f8f9fa;
            padding: 0.375rem 0.75rem;
            border-radius: 0.25rem;
            border: 1px solid #ced4da;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="container-fluid">
            <div class="form-container">
                <div class="card shadow-sm">
                    <div class="card-header-indigo"> <!-- Changed to indigo -->
                        <h3 class="mb-0 text-white"><i class="fas fa-edit me-2"></i>Edit Mata Kuliah</h3>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mb-3">
                                <label class="form-label">Kode Mata Kuliah</label>
                                <div class="kode-display"><?= htmlspecialchars($row['kodemk']) ?></div>
                                <input type="hidden" name="kodemk" value="<?= htmlspecialchars($row['kodemk']) ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Mata Kuliah</label>
                                <input type="text" class="form-control" id="nama" name="nama" 
                                       value="<?= htmlspecialchars($row['nama']) ?>" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="jumlah_sks" class="form-label">Jumlah SKS</label>
                                <input type="number" class="form-control" id="jumlah_sks" name="jumlah_sks" 
                                       value="<?= htmlspecialchars($row['jumlah_sks']) ?>" min="1" max="6" required>
                                <div class="form-text">Masukkan angka antara 1-6</div>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                                </button>
                                <a href="index.php" class="btn btn-outline-indigo"> <!-- Changed to outline-indigo -->
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