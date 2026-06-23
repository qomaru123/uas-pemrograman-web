<?php
require 'koneksi.php';

$id = $_POST['id'];
$qty = $_POST['qty'];
$action = $_POST['action'];

$stmt = $pdo->prepare(
    "SELECT stock FROM products WHERE id=?"
);

$stmt->execute([$id]);

$produk = $stmt->fetch();

if ($action == "kurang") {

    if ($produk['stock'] < $qty) {
        die("Stok tidak mencukupi");
    }

    $sql = "
    UPDATE products
    SET stock=stock-?
    WHERE id=?
    ";
} else {

    $sql = "
    UPDATE products
    SET stock=stock+?
    WHERE id=?
    ";
}

$stmt = $pdo->prepare($sql);
$stmt->execute([$qty, $id]);

header("Location:index.php");
exit;
