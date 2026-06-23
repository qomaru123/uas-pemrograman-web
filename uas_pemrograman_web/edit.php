<?php
require 'koneksi.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    die("Data tidak ditemukan");
}

if (isset($_POST['update'])) {

    $stmt = $pdo->prepare("
        UPDATE products
        SET
            kode_produk = ?,
            nama_produk = ?,
            harga = ?
        WHERE id = ?
    ");

    $stmt->execute([
        $_POST['kode'],
        $_POST['nama'],
        $_POST['harga'],
        $id
    ]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Produk</title>
</head>

<body>

    <h2>Edit Produk</h2>

    <form method="POST">

        <p>Kode Produk</p>
        <input type="text" name="kode"
            value="<?= $data['kode_produk']; ?>" required>

        <p>Nama Produk</p>
        <input type="text" name="nama"
            value="<?= $data['nama_produk']; ?>" required>

        <p>Harga</p>
        <input type="number" name="harga"
            value="<?= $data['harga']; ?>" required>

        <br><br>

        <button type="submit" name="update">
            Update
        </button>

        <a href="index.php">
            Kembali
        </a>

    </form>

</body>

</html>