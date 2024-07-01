<?php
// Start the session
session_start();
?>

<?php
// Establish a connection to the database
$servername = '172.104.166.158';
$usernameDB = 'training_jeelp';
$passwordDB = 'ms9PxuU3eGz5RbjP';
$database   = 'training_jeelp';

// Create connection
$conn = new mysqli($servername, $usernameDB, $passwordDB, $database);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if the add product form is submitted
if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $rrp = $_POST['rrp'];
    $quantity = $_POST['quantity'];
    $img = $_FILES['img']['name']; // Getting the name of the uploaded image
    $img_temp = $_FILES['img']['tmp_name']; // Getting the temporary location of the uploaded image
    $date_added = $_POST['date_added'];
    $brand = $_POST['brand'];

    // Move the uploaded image to a designated folder
    $img_folder = 'img/';
    if (!is_dir($img_folder)) {
        mkdir($img_folder, 0755, true); // Create the directory if it doesn't exist
    }
    move_uploaded_file($img_temp, $img_folder . $img);

    // Prepare SQL statement using prepared statements to prevent SQL injection
    $sql_insert = "INSERT INTO products (name, `desc`, price, rrp, quantity, img, date_added, brand) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("ssddisss", $name, $desc, $price, $rrp, $quantity, $img, $date_added, $brand);
    if ($stmt->execute()) {
        echo "Product added successfully.";
    } else {
        echo "Error adding product: " . $conn->error;
    }
    $stmt->close();
}

// Check if the delete product form is submitted
if (isset($_POST['delete_product'])) {
    $product_id = $_POST['delete_product'];
    // SQL query to delete the product
    $sql_delete = "DELETE FROM products WHERE id = $product_id";
    if ($conn->query($sql_delete) === TRUE) {
        echo "Product deleted successfully.";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

// SQL query to fetch all products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

?>

<?php require 'admin_functions.php'; ?>

<?php echo template_header('admin_manage_products'); ?>

<main class="manageProduct_container">
    <h1 class="manageProduct_container-heading">Product Data</h1>
    <form method="post" class="add-product-form" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="desc">Description:</label>
        <input type="text" id="desc" name="desc" required><br>
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" required><br>
        <label for="rrp">RRP:</label>
        <input type="text" id="rrp" name="rrp" required><br>
        <label for="quantity">Quantity:</label>
        <input type="text" id="quantity" name="quantity" required><br>
        <label for="img">Image:</label>
        <input type="file" id="img" name="img" required><br>
        <label for="date_added">Date Added:</label>
        <input type="text" id="date_added" name="date_added" required><br>
        <label for="brand">Brand:</label>
        <input type="text" id="brand" name="brand" required><br>
        <button type="submit" name="add_product">Add Product</button>
    </form>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>RRP</th>
            <th>Quantity</th>
            <th>Image</th>
            <th>Date Added</th>
            <th>Brand</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['desc'] . '</td>';
                echo '<td>' . $row['price'] . '</td>';
                echo '<td>' . $row['rrp'] . '</td>';
                echo '<td>' . $row['quantity'] . '</td>';
                echo '<td><img src="img/' . $row['img'] . '" alt="' . $row['name'] . '" width="100"></td>';
                echo '<td>' . $row['date_added'] . '</td>';
                echo '<td>' . $row['brand'] . '</td>';
                echo '<td class="admin_actions">
                        <a href="admin_update_product.php?id=' . $row['id'] . '">Update</a>
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="delete_product" value="' . $row['id'] . '">
                            <button type="submit">Delete</button>
                        </form>
                      </td>';
                echo '</tr>';
            }
        } else {
            echo "<tr><td colspan='10'>0 results</td></tr>";
        }
        ?>
    </table>
</main>

<?php echo template_footer(); ?>
