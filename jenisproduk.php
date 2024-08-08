<?php
include('db.php');

if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $isActive = isset($_POST['isActive']) ? 1 : 0;


    if ($_POST['action'] == 'create') {
        $sql = "INSERT INTO m_jenisproduk (id, description, category, isActive) VALUES ('$id', '$description', '$category', '$isActive')";
    } else {
        $sql = "UPDATE m_jenisproduk SET description='$description', category='$category', isActive='$isActive' WHERE id='$id'";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?page=jenisproduk");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM m_jenisproduk WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?page=jenisproduk");
    } else {
        echo "Error: " . $conn->error;
    }
}

$edit = false;
$id = $description = $category = $isActive = '';
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM m_jenisproduk WHERE id='$id'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $description = $row['description'];
        $category = $row['category'];
        $isActive = $row['isActive'];
        $edit = true;
    }
}

$result = $conn->query("SELECT * FROM m_jenisproduk");
?>

<h2>Manage Jenis Produk</h2>

<form method="POST" action="">
    <input type="hidden" name="action" value="<?php echo $edit ? 'update' : 'create'; ?>">
    
    <label for="id">ID:</label><br>
    <input type="text" name="id" placeholder="Please input ID.." value="<?php echo $id; ?>" required><br>
    
    <label for="description">Description:</label><br>
    <input type="text" name="description" placeholder="Please input description.." value="<?php echo $description; ?>" required><br>
    
    <label for="category">Category:</label><br>
    <input type="text" name="category" placeholder="Please input category.." value="<?php echo $category; ?>" required><br>
    
    <label for="isActive">Active:</label>
    <input type="checkbox" name="isActive" <?php echo $isActive ? 'checked' : ''; ?>><br><br>
    
    <button type="submit" name="save">Save</button>
</form>

<table>
    <tr>
        <th>ID</th>
        <th>Description</th>
        <th>Category</th>
        <th>IsActive</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $row['isActive'] ? '✔' : '✘'; ?></td>
            <td>
                <a href="index.php?page=jenisproduk&edit=<?php echo $row['id']; ?>"><button class="edit">Edit</button></a>
                <a href="index.php?page=jenisproduk&delete=<?php echo $row['id']; ?>"><button class="delete">Delete</button></a>
            </td>
        </tr>
    <?php } ?>
</table>
