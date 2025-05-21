<?php
include '../config/db.php';
include '../partials/sidebar.php';
$result = mysqli_query($conn, "SELECT * FROM matakuliah");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mata Kuliah</title>
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
        .action-buttons .btn {
            min-width: 40px;
            transition: all 0.2s ease;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-book me-2 text-indigo"></i>Data Mata Kuliah</h2>
                <a href="tambah.php" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Tambah Mata Kuliah
                </a>
            </div>
            
            <div class="card shadow-sm">
                <div class="card-header-indigo"> <!-- Changed header to indigo -->
                    <h3 class="mb-0 text-white">Daftar Mata Kuliah</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-indigo text-white"> <!-- Changed to indigo -->
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">Kode</th>
                                    <th>Nama Mata Kuliah</th>
                                    <th width="10%">SKS</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['kodemk']) ?></td>
                                    <td><?= htmlspecialchars($row['nama']) ?></td>
                                    <td>
                                        <span class="badge-sks"><?= htmlspecialchars($row['jumlah_sks']) ?> SKS</span>
                                    </td>
                                    <td class="action-buttons">
                                        <div class="d-flex gap-2">
                                            <a href="edit.php?kodemk=<?= $row['kodemk'] ?>" 
                                               class="btn btn-sm btn-warning text-white"
                                               title="Edit Data">
                                                <i class="fas fa-edit"></i>
                                                <span class="d-none d-md-inline"> Edit</span>
                                            </a>
                                            
                                            <a href="hapus.php?kodemk=<?= $row['kodemk'] ?>" 
                                               class="btn btn-sm btn-danger"
                                               title="Hapus Data"
                                               onclick="return confirm('Yakin menghapus <?= htmlspecialchars(addslashes($row['nama'])) ?>?')">
                                                <i class="fas fa-trash-alt"></i>
                                                <span class="d-none d-md-inline"> Hapus</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Tambahkan efek hover dinamis
        document.querySelectorAll('.action-buttons .btn').forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 4px 8px rgba(0,0,0,0.1)';
            });
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'none';
            });
        });
    </script>
</body>
</html>