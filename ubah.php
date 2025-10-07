<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "clothing_store");

// Cek koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Ambil ID barang dari URL
if (!isset($_GET['id'])) {
    echo "<script>alert('ID barang tidak ditemukan!'); window.location='index.php';</script>";
    exit();
}

$id = $_GET['id'];

// Ambil data barang berdasarkan ID
$query = "SELECT * FROM barang WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Jika data tidak ditemukan
if (!$data) {
    echo "<script>alert('Data barang tidak ditemukan!'); window.location='index.php';</script>";
    exit();
}

// Proses update data
if (isset($_POST['simpan'])) {
    $nama_barang = $_POST['nama_barang'];
    $harga_pokok = $_POST['harga_pokok'];
    $harga_jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    $update = "UPDATE barang SET 
                nama_barang='$nama_barang',
                harga_pokok='$harga_pokok',
                harga_jual='$harga_jual',
                stok='$stok',
                deskripsi='$deskripsi'
               WHERE id='$id'";

    if (mysqli_query($koneksi, $update)) {
        echo "<script>alert('Data berhasil diubah!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal mengubah data!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Barang</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <a href="index.php">
            <button class="btn btn-info">Kembali</button>
        </a>
        <div class="card mt-2">
            <div class="card-header">
                <h3 class="ml-3">Ubah Barang</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" value="<?= htmlspecialchars($data['nama_barang']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Pokok</label>
                        <input type="number" name="harga_pokok" class="form-control" value="<?= $data['harga_pokok']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Jual</label>
                        <input type="number" name="harga_jual" class="form-control" value="<?= $data['harga_jual']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control" value="<?= $data['stok']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"><?= htmlspecialchars($data['deskripsi']); ?></textarea>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-success">Simpan Perubahan</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>

<?php
mysqli_close($koneksi);
?>
