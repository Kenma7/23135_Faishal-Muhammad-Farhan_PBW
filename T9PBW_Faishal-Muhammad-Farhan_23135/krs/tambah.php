<?php
include '../config/db.php';
include '../partials/sidebar.php';

$mahasiswa = mysqli_query($conn, "SELECT * FROM mahasiswa");
$matakuliah = mysqli_query($conn, "SELECT * FROM matakuliah");

if ($_POST) {
    $npm = $_POST['mahasiswa_npm'];
    $kodemk = $_POST['matakuliah_kodemk'];
    mysqli_query($conn, "INSERT INTO krs (mahasiswa_npm, matakuliah_kodemk) VALUES ('$npm', '$kodemk')");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah KRS</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link href="../css/style.css" rel="stylesheet">
    <style>
        .main-content {
            margin-left: 260px;
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
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="container-fluid">
            <div class="form-container">
                <div class="card shadow-sm">
                    <div class="card-header-indigo">
                        <h3 class="mb-0 text-white"><i class="fas fa-plus-circle me-2"></i>Tambah KRS</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" id="krsForm">
                            <div class="mb-4">
                                <label for="mahasiswa" class="form-label fw-semibold">Mahasiswa</label>
                                <select class="form-select" id="mahasiswa" name="mahasiswa_npm" required>
                                    <option value="" selected disabled>-- Pilih Mahasiswa --</option>
                                    <?php while ($m = mysqli_fetch_assoc($mahasiswa)) : ?>
                                        <option value="<?= htmlspecialchars($m['npm']) ?>">
                                            <?= htmlspecialchars($m['nama']) ?> (NPM: <?= htmlspecialchars($m['npm']) ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="matakuliah" class="form-label fw-semibold">Mata Kuliah</label>
                                <select class="form-select" id="matakuliah" name="matakuliah_kodemk" required>
                                    <option value="" selected disabled>-- Pilih Mata Kuliah --</option>
                                    <?php 
                                    mysqli_data_seek($matakuliah, 0);
                                    while ($mk = mysqli_fetch_assoc($matakuliah)) : ?>
                                        <option value="<?= htmlspecialchars($mk['kodemk']) ?>" data-sks="<?= $mk['jumlah_sks'] ?>">
                                            <?= htmlspecialchars($mk['nama']) ?> 
                                            <span class="badge-sks"><?= $mk['jumlah_sks'] ?> SKS</span>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <!-- Preview Section -->
                            <div class="preview-section bg-light p-3 rounded mb-4">
                                <h6 class="text-muted mb-3">Preview:</h6>
                                <p id="previewText" class="mb-1">Pilih mahasiswa dan mata kuliah terlebih dahulu</p>
                                <p class="text-muted mb-0">Total SKS: <span id="totalSks" class="fw-semibold">0</span></p>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save me-1"></i> Simpan
                                </button>
                                <a href="index.php" class="btn btn-outline-indigo">
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
    <script>
        // Real-time preview
        document.getElementById('mahasiswa').addEventListener('change', updatePreview);
        document.getElementById('matakuliah').addEventListener('change', updatePreview);

        function updatePreview() {
            const mahasiswaSelect = document.getElementById('mahasiswa');
            const matakuliahSelect = document.getElementById('matakuliah');
            const previewText = document.getElementById('previewText');
            const totalSks = document.getElementById('totalSks');
            
            const selectedMahasiswa = mahasiswaSelect.options[mahasiswaSelect.selectedIndex];
            const selectedMatakuliah = matakuliahSelect.options[matakuliahSelect.selectedIndex];
            
            if (selectedMahasiswa.value && selectedMatakuliah.value) {
                const sks = selectedMatakuliah.getAttribute('data-sks');
                const mhsName = selectedMahasiswa.text.split(' (')[0];
                const mkName = selectedMatakuliah.text.split(' (')[0];
                
                previewText.innerHTML = `<span class="text-indigo fw-semibold">${mhsName}</span> akan mengambil mata kuliah <span class="text-indigo fw-semibold">${mkName}</span>`;
                totalSks.textContent = sks;
            } else {
                previewText.textContent = "Pilih mahasiswa dan mata kuliah terlebih dahulu";
                totalSks.textContent = "0";
            }
        }
    </script>
</body>
</html>