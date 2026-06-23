<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'koneksi.php';

$data = $pdo->query("SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>ERP Produk & Stok</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }

        .btn {
            background: green;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
        }

        input[type=number] {
            width: 60px;
        }
    </style>
</head>

<body>

    <h2>Master Produk & Kontrol Stok</h2>

    <a href="tambah.php" class="btn">Tambah Produk</a>

    <br><br>

    <table>

        <tr>
            <th>ID</th>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>

        <?php foreach ($data as $row): ?>

            <tr>

                <td><?= $row['id']; ?></td>
                <td><?= $row['kode_produk']; ?></td>
                <td><?= $row['nama_produk']; ?></td>
                <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                <td><?= $row['stock']; ?></td>

                <td>

                    <a href="edit.php?id=<?= $row['id']; ?>">Edit</a>

                    |

                    <a href="hapus.php?id=<?= $row['id']; ?>"
                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                        Hapus
                    </a>

                    |

                    <form action="update_stok.php"
                        method="POST"
                        style="display:inline;">

                        <input type="hidden"
                            name="id"
                            value="<?= $row['id']; ?>">

                        <input type="number"
                            name="qty"
                            min="1"
                            required>

                        <button type="submit"
                            name="action"
                            value="tambah">
                            +
                        </button>

                        <button type="submit"
                            name="action"
                            value="kurang">
                            -
                        </button>

                    </form>

                </td>

            </tr>

        <?php endforeach; ?>

    </table>

</body>

</html>