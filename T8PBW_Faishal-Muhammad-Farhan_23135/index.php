<?php
session_start();

$bandara_asal = [
  "Soekarno Hatta" => 65000,
  "Husein Sastranegara" => 50000,
  "Abdul Rachman Saleh" => 40000,
  "Juanda" => 30000
];

$bandara_tujuan = [
  "Ngurah Rai" => 85000,
  "Hasanuddin" => 70000,
  "Inanwatan" => 90000,
  "Sultan Iskandar Muda" => 60000
];

if (!isset($_SESSION['data'])) {
  $_SESSION['data'] = [];
}

if (isset($_POST['submit'])) {
  $maskapai = $_POST['maskapai'];
  $asal = $_POST['asal'];
  $tujuan = $_POST['tujuan'];
  $harga = (int) $_POST['harga'];

  $pajak_asal = $bandara_asal[$asal];
  $pajak_tujuan = $bandara_tujuan[$tujuan];
  $total = $harga + $pajak_asal + $pajak_tujuan;

  $_SESSION['data'][] = [
    'maskapai' => $maskapai,
    'asal' => $asal,
    'tujuan' => $tujuan,
    'harga' => $harga,
    'pajak_asal' => $pajak_asal,
    'pajak_tujuan' => $pajak_tujuan,
    'total' => $total
  ];
}

if (isset($_GET['hapus'])) {
  $index = $_GET['hapus'];
  unset($_SESSION['data'][$index]);
  $_SESSION['data'] = array_values($_SESSION['data']);
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Maskapai</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="container">
    <h1>Form Input Penerbangan</h1>
    <form method="post">
      <label>Nama Maskapai</label>
      <input type="text" name="maskapai" required>

      <label>Bandara Asal</label>
      <select name="asal" required>
        <option value="" disabled selected>-- Pilih Bandara Asal --</option>
        <?php foreach ($bandara_asal as $nama => $pajak): ?>
          <option value="<?= $nama ?>"><?= $nama ?></option>
        <?php endforeach; ?>
      </select>

      <label>Bandara Tujuan</label>
      <select name="tujuan" required>
        <option value="" disabled selected>-- Pilih Bandara Tujuan --</option>
        <?php foreach ($bandara_tujuan as $nama => $pajak): ?>
          <option value="<?= $nama ?>"><?= $nama ?></option>
        <?php endforeach; ?>
      </select>

      <label>Harga Tiket</label>
      <input type="number" name="harga" required>

      <button type="submit" name="submit">Simpan</button>
    </form>

    <h2>Data Penerbangan</h2>
    <table>
      <tr>
        <th>Maskapai</th>
        <th>Rute</th>
        <th>Aksi</th>
      </tr>

      <?php foreach ($_SESSION['data'] as $key => $d): ?>
        <tr>
          <td><?= $d['maskapai'] ?></td>
          <td><?= $d['asal'] ?> → <?= $d['tujuan'] ?></td>
          <td><button onclick="toggleDetail(<?= $key ?>)">Detail</button></td>
        </tr>
        <tr id="detail-<?= $key ?>" class="detail-row" style="display:none;">
          <td colspan="3">
            <div class="detail-line">
              <div class="left"><strong>Harga Tiket:</strong></div>
              <div class="right">Rp <?= number_format($d['harga'], 0, ',', '.') ?></div>
            </div>
            <div class="detail-line">
              <div class="left"><strong>Pajak Asal (<?= $d['asal'] ?>):</strong></div>
              <div class="right">Rp <?= number_format($d['pajak_asal'], 0, ',', '.') ?></div>
            </div>
            <div class="detail-line">
              <div class="left"><strong>Pajak Tujuan (<?= $d['tujuan'] ?>):</strong></div>
              <div class="right">Rp <?= number_format($d['pajak_tujuan'], 0, ',', '.') ?></div>
            </div>
            <div class="detail-line total">
              <div class="left"><strong>Total Harga:</strong></div>
              <div class="right">Rp <?= number_format($d['total'], 0, ',', '.') ?></div>
            </div>
            <br>
            <a class="delete" href="?hapus=<?= $key ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>

<footer class="footer">
  <p>&copy; <?= date('Y') ?> Faishal Muhammad Farhan (2310631170135)</p>
</footer>

  <script>
    function toggleDetail(index) {
      const row = document.getElementById('detail-' + index);
      row.style.display = row.style.display === 'none' ? 'table-row' : 'none';
    }
  </script>
</body>
</html>
