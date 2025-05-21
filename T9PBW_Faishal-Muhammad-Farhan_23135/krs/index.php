<?php
include '../config/db.php';
include '../partials/sidebar.php';

// Query untuk ambil data KRS
$query = "
    SELECT krs.id, m.nama AS nama_mahasiswa, mk.nama AS nama_matkul, mk.jumlah_sks 
    FROM krs
    JOIN mahasiswa m ON krs.mahasiswa_npm = m.npm
    JOIN matakuliah mk ON krs.matakuliah_kodemk = mk.kodemk
";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data KRS</title>
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
        .keterangan-cell {
            max-width: 400px;
            white-space: normal;
        }
        .badge-sks {
            background-color: #6c757d; /* Tetap abu-abu */
            font-size: 0.8em;
        }
        .action-buttons .btn {
            min-width: 80px;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="container-fluid">
            <div class="card shadow-sm">
                <div class="card-header-indigo d-flex justify-content-between align-items-center">
                    <h3 class="mb-0 text-white"><i class="fas fa-clipboard-list me-2"></i>Data KRS</h3>
                    <a href="tambah.php" class="btn btn-light">
                        <i class="fas fa-plus me-1"></i>Tambah KRS
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="bg-indigo text-white">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="20%">Mahasiswa</th>
                                    <th width="20%">Mata Kuliah</th>
                                    <th class="keterangan-cell">Keterangan</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['nama_mahasiswa']) ?></td>
                                    <td>
                                        <?= htmlspecialchars($row['nama_matkul']) ?>
                                        <span class="badge-sks rounded-pill ms-2"><?= $row['jumlah_sks'] ?> SKS</span>
                                    </td>
                                    <td class="keterangan-cell">
                                        <span class="text-indigo fw-semibold"><?= htmlspecialchars($row['nama_mahasiswa']) ?></span> mengambil mata kuliah 
                                        <span class="text-success fw-semibold"><?= htmlspecialchars($row['nama_matkul']) ?></span>
                                        <span class="badge-sks ms-2"><?= $row['jumlah_sks'] ?> SKS</span>
                                    </td>
                                    <td class="action-buttons">
                                        <a href="hapus.php?id=<?= $row['id'] ?>" 
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Yakin menghapus KRS <?= htmlspecialchars(addslashes($row['nama_mahasiswa'])) ?> untuk mata kuliah <?= htmlspecialchars(addslashes($row['nama_matkul'])) ?> (<?= $row['jumlah_sks'] ?> SKS)?')">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </a>
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
        // Tambahkan efek hover pada baris tabel
        document.querySelectorAll('tbody tr').forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.backgroundColor = 'rgba(0, 0, 0, 0.02)';
                this.style.transform = 'translateX(2px)';
            });
            row.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '';
                this.style.transform = '';
            });
        });
    </script>
</body>
</html>