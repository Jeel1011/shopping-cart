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

// Check if product ID is provided in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // SQL query to fetch product details
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row  = $result->fetch_assoc();
        $name = $row['name'];
        $desc = $row['desc'];
        $price = $row['price'];
        $rrp = $row['rrp'];
        $quantity = $row['quantity'];
        $img = $row['img'];
        $date_added = $row['date_added'];
        $brand = $row['brand'];
    } else {
        echo "Product not found.";
    }
}

// Check if the update product form is submitted
if (isset($_POST['update_product'])) {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $rrp = $_POST['rrp'];
    $quantity = $_POST['quantity'];
    $date_added = $_POST['date_added'];
    $brand = $_POST['brand'];

    // SQL query to update product details
    $sql_update = "UPDATE products SET name='$name', `desc`='$desc', price=$price, rrp=$rrp, quantity=$quantity, date_added='$date_added', brand='$brand' WHERE id=$product_id";
    if ($conn->query($sql_update) === TRUE) {
        echo "Product updated successfully.";
    } else {
        echo "Error updating product: " . $conn->error;
    }
}

?>

<?php require 'admin_functions.php'; ?>

<?php echo template_header('admin_update_product'); ?>

<main class="updateProduct_container">
    <h1 class="updateProduct_container-heading">Update Product</h1>
    <form method="post" class="update-product-form">
        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br>
        <label for="desc">Description:</label>
        <input type="text" id="desc" name="desc" value="<?php echo $desc; ?>" required><br>
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" value="<?php echo $price; ?>" required><br>
        <label for="rrp">RRP:</label>
        <input type="text" id="rrp" name="rrp" value="<?php echo $rrp; ?>" required><br>
        <label for="quantity">Quantity:</label>
        <input type="text" id="quantity" name="quantity" value="<?php echo $quantity; ?>" required><br>
        <label for="date_added">Date Added:</label>
        <input type="text" id="date_added" name="date_added" value="<?php echo $date_added; ?>" required><br>
        <label for="brand">Brand:</label>
        <input type="text" id="brand" name="brand" value="<?php echo $brand; ?>" required><br>
        <button type="submit" class="btn-update_product" name="update_product">Update Product</button>
    </form>
</main>

<?php echo template_footer(); ?>
