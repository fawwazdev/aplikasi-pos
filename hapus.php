<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "clothing_store");

// Cek koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Pastikan ada parameter id
if (!isset($_GET['id'])) {
    echo "<script>alert('ID barang tidak ditemukan!'); window.location='index.php';</script>";
    exit();
}

$id = $_GET['id'];

// Hapus data dari tabel barang
$query = "DELETE FROM barang WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<script>alert('Data berhasil dihapus!'); window.location='index.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data!'); window.location='index.php';</script>";
}

// Tutup koneksi
mysqli_close($koneksi);
?>
