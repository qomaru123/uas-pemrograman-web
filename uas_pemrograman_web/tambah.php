<?php
require 'koneksi.php';

if (isset($_POST['simpan'])) {

    $stmt = $pdo->prepare("
        INSERT INTO products
        (kode_produk,nama_produk,harga,stock)
        VALUES
        (:kode,:nama,:harga,:stock)
    ");

    $stmt->execute([
        'kode' => $_POST['kode'],
        'nama' => $_POST['nama'],
        'harga' => $_POST['harga'],
        'stock' => $_POST['stock']
    ]);

    header("Location:index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tambah Produk</title>
</head>

<body>

    <h2>Tambah Produk</h2>

    <form method="POST">

        <p>Kode Produk</p>
        <input type="text" name="kode" required>

        <p>Nama Produk</p>
        <input type="text" name="nama" required>

        <p>Harga</p>
        <input type="number" name="harga" required>

        <p>Stok Awal</p>
        <input type="number" name="stock" required>

        <br><br>

        <button type="submit" name="simpan">
            Simpan
        </button>

        <a href="index.php">
            Kembali
        </a>

    </form>

</body>

</html>