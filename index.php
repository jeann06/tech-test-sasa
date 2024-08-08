<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DB Sarirasa Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <a href="index.php?">Home</a>
        <a href="index.php?page=kategori">Manage Kategori</a>
        <a href="index.php?page=jenisproduk">Manage Jenis Produk</a>
        <a href="index.php?page=produk">Manage Produk</a>
        <a href="index.php?page=lokasi">Manage Lokasi</a>
        <a href="index.php?page=stokgudang">Manage Stok Gudang</a>
    </div>

    <div class="content">
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            include("$page.php");
        } else {
            echo "<h1>Welcome to Sarirasa Database Management</h1>";
        }
        ?>
    </div>
</body>
</html>
