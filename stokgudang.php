<?php
include('db.php');

if (isset($_POST['save'])) {
    $no = isset($_POST['no']) ? $_POST['no'] : null;
    $produk = $_POST['produk'];
    $jenis_produk = $_POST['jenis_produk'];
    $kategori_produk = $_POST['kategori_produk'];
    $lokasi_gudang = $_POST['lokasi_gudang'];
    $stock = $_POST['stock'];
    $tanggal_input = $_POST['tanggal_input'];

    if ($_POST['action'] == 'create') {
        $sql = "INSERT INTO t_stokgudang (produk, jenis_produk, kategori_produk, lokasi_gudang, stock, tanggal_input) 
                VALUES ('$produk', '$jenis_produk', '$kategori_produk', '$lokasi_gudang', '$stock', '$tanggal_input')";
    } else {
        $sql = "UPDATE t_stokgudang 
                SET produk='$produk', jenis_produk='$jenis_produk', kategori_produk='$kategori_produk', lokasi_gudang='$lokasi_gudang', stock='$stock', tanggal_input='$tanggal_input' 
                WHERE no='$no'";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?page=stokgudang");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['delete'])) {
    $no = $_GET['delete'];
    $sql = "DELETE FROM t_stokgudang WHERE no='$no'";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?page=stokgudang");
    } else {
        echo "Error: " . $conn->error;
    }
}

$edit = false;
$no = $produk = $jenis_produk = $kategori_produk = $lokasi_gudang = $stock = $tanggal_input = '';

if (isset($_GET['edit'])) {
    $no = $_GET['edit'];
    $result = $conn->query("SELECT * FROM t_stokgudang WHERE no='$no'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $produk = $row['produk'];
        $jenis_produk = $row['jenis_produk'];
        $kategori_produk = $row['kategori_produk'];
        $lokasi_gudang = $row['lokasi_gudang'];
        $stock = $row['stock'];
        $tanggal_input = $row['tanggal_input'];
        $edit = true;
    }
}

$result = $conn->query("SELECT * FROM t_stokgudang");
?>

<h2>Manage Stok Gudang</h2>


<form method="POST" action="">
    <input type="hidden" name="action" value="<?php echo $edit ? 'update' : 'create'; ?>">
    <?php if ($edit) { ?>
        <input type="hidden" name="no" value="<?php echo $no; ?>">
    <?php } ?>
    
    <label for="produk">Produk:</label><br>
    <input type="text" name="produk" placeholder="Please input produk.." value="<?php echo $produk; ?>" required><br>
    
    <label for="jenis_produk">Jenis Produk:</label><br>
    <input type="text" name="jenis_produk" placeholder="Please input jenis produk.." value="<?php echo $jenis_produk; ?>" required><br>
    
    <label for="kategori_produk">Kategori Produk:</label><br>
    <input type="text" name="kategori_produk" placeholder="Please input kategori produk.."value="<?php echo $kategori_produk; ?>" required><br>
    
    <label for="lokasi_gudang">Lokasi Gudang:</label><br>
    <input type="text" name="lokasi_gudang" placeholder="Please input lokasi gudang.." value="<?php echo $lokasi_gudang; ?>" required><br>
    
    <label for="stock">Stock (Karton):</label><br>
    <input type="number" name="stock" placeholder="Please input jumlah stok.." value="<?php echo $stock; ?>" required><br>
    
    <label for="tanggal_input">Tanggal Input:</label><br>
    <input type="date" name="tanggal_input" placeholder="Please input tanggal.." value="<?php echo $tanggal_input; ?>" required><br><br>

    <button type="submit" name="save">Save</button>
</form>

<table>
    <tr>
        <th>No</th>
        <th>Produk</th>
        <th>Jenis Produk</th>
        <th>Kategori Produk</th>
        <th>Lokasi Gudang</th>
        <th>Stock (Karton)</th>
        <th>Tanggal Input</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['no']; ?></td>
            <td><?php echo $row['produk']; ?></td>
            <td><?php echo $row['jenis_produk']; ?></td>
            <td><?php echo $row['kategori_produk']; ?></td>
            <td><?php echo $row['lokasi_gudang']; ?></td>
            <td><?php echo $row['stock']; ?></td>
            <td><?php echo $row['tanggal_input']; ?></td>
            <td>
                <a href="index.php?page=stokgudang&edit=<?php echo $row['no']; ?>"><button class="edit">Edit</button></a>
                <a href="index.php?page=stokgudang&delete=<?php echo $row['no']; ?>"><button class="delete">Delete</button></a>
            </td>
        </tr>
    <?php } ?>
</table>
