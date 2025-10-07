<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "clothing_store");

// Cek koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Inisialisasi variabel pencarian
$cari = "";

// Jika form pencarian dikirim
if (isset($_GET['cari'])) {
    $cari = $_GET['cari'];
    $query = "SELECT * FROM barang WHERE nama_barang LIKE '%$cari%'";
} else {
    $query = "SELECT * FROM barang";
}

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang - Clothing Store</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Barang</h4>
                <!-- Form Pencarian -->
                <form method="GET" class="form-inline">
                    <input type="text" name="cari" class="form-control mr-2" placeholder="Cari nama barang..."
                        value="<?= htmlspecialchars($cari); ?>">
                    <button type="submit" class="btn btn-info">Cari</button>
                    <a href="index.php" class="btn btn-secondary ml-2">Reset</a>
                </form>
            </div>

            <div class="card-body px-0">
                <a href="tambah.php">
                    <button class="btn btn-primary ml-3 mb-3">Tambah Data</button>
                </a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Harga Pokok</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                                    <td class="text-right"><?= number_format($row['harga_pokok'], 0, ',', '.'); ?></td>
                                    <td class="text-right"><?= number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                                    <td class="text-center"><?= $row['stok']; ?></td>
                                    <td class="text-center">
                                        <a href="ubah.php?id=<?= $row['id']; ?>" class="btn btn-warning mr-2">Ubah</a>
                                        <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">Data tidak ditemukan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
</body>

</html>

<?php
// Tutup koneksi
mysqli_close($koneksi);
?>
